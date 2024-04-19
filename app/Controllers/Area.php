<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AreaModel;
use App\Models\ComplejoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Area extends BaseController
{
    private $area_model;
    private $complejo_model;

    function __construct()
    {
        $this->area_model = new AreaModel();
        $this->complejo_model = new ComplejoModel();
    }

    public function getAreasJSON($idComplejo){
        $list_area = $this->area_model->where('id_complejo',$idComplejo)->findAll();
        return json_encode($list_area);
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $are_list = $this->area_model->getAreaWithComplejo();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableArea" class="table table-striped mb-0 text-nowrap">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Nombre', 'Cap. Max', 'Complejo', 'Estado', 'Acción');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($are_list as $key => $value) {
            array_push($grid, [
                $value['nombre'],
                $value['cap_max'],
                $value['complejo_nombre'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('area/changeStatus') . "'" . ',' . $value['id_area'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'area/edit'" . ', ' . $value['id_area'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Area',
            'page'   => 'Lista de Areas',
            'icon'  => 'fa-map-pin'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();
        $data['complejo_list'] = $this->complejo_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();


        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Area');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('area/index', $data);
        $dataTable['idTable'] = 'tableArea';
        $dataTable['tituloTable'] = 'Lista de Areas';
        echo view('template/footer', $dataTable);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('area/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_area'))) {
            $id = $this->request->getPost('id_area');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_area' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'cap_max' => $this->request->getPost('cap_max'),
            'id_complejo' => $this->request->getPost('complejo'),
        ];

        if ($this->area_model->save($data)) {
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
            'page' => 'Editar Area',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/complejo');
        }

        $data['obj'] = $this->area_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/complejo');
        };

        $data['complejo_list'] = $this->complejo_model->where('valido', 1)->orderBy('nombre', 'ASC')->findAll();
        return view('area/form', $data);
    }

    public function delete($id)
    {
        $this->area_model->delete($id);
        return 'Médico eliminado.';
    }
    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        $this->area_model->save(['id_area' => $id, 'valido' => $estado==0?false:1]);
    }
}
