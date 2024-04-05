<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TurnoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Turno extends BaseController
{
    private $turno_model;

    function __construct()
    {
        $this->turno_model = new TurnoModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $turno_list = $this->turno_model->orderBy('nombre','ASC')->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableTurno" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('#', 'Nombre', 'Hora Inicio', 'Hora Final', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($turno_list as $key => $value) {
            $c++;
            array_push($grid, [
                $c,
                $value['nombre'],
                $value['hora_inicio'],
                $value['hora_fin'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('turno/changeStatus') . "'" . ',' . $value['id_turno'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'turno/edit'" . ', ' . $value['id_turno'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Turno',
            'page'   => 'Lista de Turnos',
            'icon'  => 'fa fa-building'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();

        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Turno');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('turno/index', $data);
        echo view('template/footer');
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('turno/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_turno'))) {
            $id = $this->request->getPost('id_turno');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_turno' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
        ];

        if ($this->turno_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function edit($token = null)
    {
        $data['title'] = [
            'module' => 'Turno',
            'page' => 'Editar Turno',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/turno');
        }

        $data['obj'] = $this->turno_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/turno');
        };

        return view('turno/form', $data);
    }

    public function delete($id)
    {
        $this->turno_model->delete($id);
        return 'Médico eliminado.';
    }
    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        echo ($this->turno_model->save(['id_turno' => $id, 'valido' => $estado==0?false:1]));
    }
}
