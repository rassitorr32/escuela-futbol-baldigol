<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Categoria extends BaseController
{
    private $categoria_model;

    function __construct()
    {
        $this->categoria_model = new CategoriaModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $categoria_list = $this->categoria_model->orderBy('nombre','ASC')->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableCategoria" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('#', 'Nombre', 'Edad Inicial', 'Edad Máxima', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($categoria_list as $key => $value) {
            $c++;
            array_push($grid, [
                $c,
                $value['nombre'],
                $value['edad_inicio'],
                $value['edad_final'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('categoria/changeStatus') . "'" . ',' . $value['id_categoria'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'categoria/edit'" . ', ' . $value['id_categoria'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Categoría',
            'page'   => 'Lista de Categorías',
            'icon'  => 'fa fa-building'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();

        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Categoria');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('categoria/index', $data);
        echo view('template/footer');
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'Categoria',
            'page' => 'Nueva Categoria',
            'icon' => 'fas fa-plus'
        ];
        return view('categoria/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_categoria'))) {
            $id = $this->request->getPost('id_categoria');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_categoria' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'edad_inicio' => $this->request->getPost('edad_inicio'),
            'edad_final' => $this->request->getPost('edad_final'),
        ];

        if ($this->categoria_model->save($data)) {
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
            'module' => 'Categoría',
            'page' => 'Editar Categoria',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/categoria');
        }

        $data['obj'] = $this->categoria_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/categoria');
        };

        return view('categoria/form', $data);
    }

    public function delete($id)
    {
        $this->categoria_model->delete($id);
        return 'Médico eliminado.';
    }
    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        echo ($this->categoria_model->save(['id_categoria' => $id, 'valido' => $estado==0?false:1]));
    }
}
