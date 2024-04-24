<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CostoModel;
use App\Models\ServicioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Costo extends BaseController
{
    private $costo_model;
    private $servicio_model;

    function __construct()
    {
        $this->costo_model = new CostoModel();
        $this->servicio_model = new ServicioModel();
    }
    public function getCostosJSON($idServicio){
        $list_costo = $this->costo_model->where('id_servicio',$idServicio)->findAll();
        return json_encode($list_costo);
    }

    public function getFindCostoJSON($idCosto){
        $list_costo = $this->costo_model->find($idCosto);
        return json_encode($list_costo);
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $costo_list = $this->costo_model->select('costo.*,servicio.nombre as nombre_servicio, servicio.id_dep as servicio_id_dep')->join('servicio','servicio.id_servicio=costo.id_servicio')->orderBy('costo.tipo_costo', 'ASC')->findAll();
        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableCosto" class="table table-striped mb-0 text-nowrap">',
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Servicio', 'Costo', 'Fecha Inicio', 'Fecha Final', 'Valor', 'Estado', 'Acciones');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($costo_list as $key => $value) {
            array_push($grid, [
                $value['nombre_servicio'],
                $value['tipo_costo'],
                $value['fecha_inicio'],
                $value['fecha_final'],
                $value['valor'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('costo/changeStatus') . "'" . ',' . $value['id_costo'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'costo/edit'" . ', ' . $value['id_costo'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index($token = null)
    {
        $data['title'] = [
            'module' => 'Costo',
            'page'   => 'Gestion de Costos',
            'icon'  => 'fa fa-phone'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Lista Costos', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable($token);
        $data['idServicio'] = $token;

        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Costo');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('costo/index', $data);
        $dataTable['idTable'] = 'tableCosto';
        $dataTable['tituloTable'] = 'Lista de Costos';
        echo view('template/footer', $dataTable);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'Costo',
            'page' => 'Gestion de Costos',
            'icon' => 'fas fa-plus'
        ];

        $data['servicio_list'] = $this->servicio_model->where('id_dep',null)->orderBy('nombre','ASC')->findAll();
        return view('costo/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_costo'))) {
            $id = $this->request->getPost('id_costo');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $idServicio = ($this->request->getPost('sub_servicio'))?$this->request->getPost('sub_servicio'):$this->request->getPost('servicio');
        $data = [
            'id_costo' => $id,
            'id_servicio' => $idServicio,
            'tipo_costo' => $this->request->getPost('tipo_costo'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_final' => $this->request->getPost('fecha_final'),
            'valor' => $this->request->getPost('valor'),
        ];
        if ($this->costo_model->save($data)) {
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
            'module' => 'Edit Doctor',
            'page' => 'Edit Doctor',
            'icon' => 'fas fa-edit'
        ];
        if (empty($token)) {
            return redirect()->to('/doctor');
        }

        $data['obj'] = $this->costo_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/doctor');
        };

        return view('doctor/form', $data);
    }

    public function delete($id)
    {
        if($this->costo_model->delete($id)){
            return 'ok';
        }else {
            return 'error';
        }
        
    }
}
