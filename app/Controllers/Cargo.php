<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CargoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Cargo extends BaseController
{
    private $cargo_model;

    function __construct()
    {
        $this->cargo_model = new CargoModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $complejo_list = $this->cargo_model->orderBy('nombre','ASC')->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableComplejo" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('#', 'Nombre', 'Descripción', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($complejo_list as $key => $value) {
            $c++;
            array_push($grid, [
                $c,
                $value['nombre'],
                $value['descripcion'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('complejo/changeStatus') . "'" . ',' . $value['id_complejo'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'complejo/edit'" . ', ' . $value['id_complejo'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Complejo',
            'page'   => 'Lista de Complejos',
            'icon'  => 'fa fa-building'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();

        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Complejo');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('complejo/index', $data);
        $dataTable['idTable'] = 'tableComplejo';
        $dataTable['tituloTable'] = 'Lista de Complejos';
        echo view('template/footer', $dataTable);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('complejo/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_complejo'))) {
            $id = $this->request->getPost('id_complejo');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_complejo' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        if ($this->cargo_model->save($data)) {
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
            'module' => 'Complejo',
            'page' => 'Editar Complejo',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/complejo');
        }

        $data['obj'] = $this->cargo_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/complejo');
        };

        return view('complejo/form', $data);
    }

    public function delete($id)
    {
        $this->cargo_model->delete($id);
        return 'Médico eliminado.';
    }
    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        echo ($this->cargo_model->save(['id_complejo' => $id, 'valido' => $estado==0?false:1]));
    }
}
