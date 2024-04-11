<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CalendarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use stdClass;

class Calendario extends BaseController
{
    private $calendario_model;

    function __construct()
    {
        $this->calendario_model = new CalendarioModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $data['calendario_list'] = $this->calendario_model->orderBy('name_doctor', 'ASC')->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="example1" class="table table-bordered table-striped">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Nombre del Médico', 'Especialidad', 'E_mail', 'C.I.', 'Télefono', $btnNew);
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($data['doctor_list'] as $key => $value) {
            array_push($grid, [
                $value['name_doctor'] . ' ' . $value['lastname_doctor'] . ' ' . $value['second_lastname_doctor'],
                $value['specialty_doctor'],
                $value['email_doctor'],
                $value['ci_doctor'],
                $value['phone_number'],
                '<div class="btn-group">
                            <button class="btn btn-secondary btn-circle" onclick="Edit(' . "'doctor/edit'" . ', ' . $value['id_doctor'] . ')">
                            <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-circle" onclick="Delete(' . "'doctor/delete'" . ', ' . $value['id_doctor'] . ')">
                            <i class="fas fa-trash"></i>
                            </button>
                        </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Doctor List',
            'page'   => 'Doctor List',
            'icon'  => 'fas fa-user-md'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        // $data['table'] = $this->generateTable();
        session()->set('leftbar_section', 'Escuela');
        session()->set('leftbar_link', 'Calendario');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('calendario/index', $data);
        echo view('template/footer');
    }

    public function getCalendario()
    {
        // Crear un array de objetos de eventos
        $eventos = $this->calendario_model->where('id_usuario',session('id_usuario'))->findAll();

        // Codificar los eventos en formato JSON y devolverlos
        return json_encode($eventos);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('doctor/form', $data);
    }

    public function store()
    {
        $id = null;
        if (!empty($this->request->getPost('id_calendario'))) {
            $id = $this->request->getPost('id_calendario');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_calendario' => $id,
            'id_usuario' => session('id_usuario'),
            'titulo' => $this->request->getPost('titulo'),
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin'),
            'className' => $this->request->getPost('className'),
            'allDay' => $this->request->getPost('allDay')=='false'?false:true,
        ];
        // return var_dump($data);
        if($this->calendario_model->save($data)){
            return json_encode($this->calendario_model->insertID());
        }else{
            return 'error';
        }
    }

    public function edit($token = null)
    {
        $data['title'] = [
            'module' => 'Edit Doctor',
            'page' => 'Edit Doctor',
            'icon' => 'fas fa-edit'
        ];
        if (empty($token)) {
            return redirect()->to('/doctor');
        }

        $data['obj'] = $this->calendario_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/doctor');
        };

        return view('doctor/form', $data);
    }

    public function delete($id)
    {
        if ($this->calendario_model->delete($id)) {
            return 'ok';
        }else{
            return 'error';
        }
    }

    public function getViewCalendario($id)
    {
        return view('calendario/viewCalendario');
    }
}
