<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CostoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Costo extends BaseController
{
    private $costo_model;

    function __construct()
    {
        $this->costo_model = new CostoModel();
    }
    public function getCostosJSON($idServicio){
        $list_costo = $this->costo_model->where('id_servicio',$idServicio)->findAll();
        return json_encode($list_costo);
    }

    public function generateTable($id_servicio)
    {
        /**recuperar datos de la DB */
        $data['costo_list'] = $this->costo_model->where('id_servicio', $id_servicio)->orderBy('tipo_costo', 'ASC')->findAll();
        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableCosto" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">',
            'tbody_open'  => '<tbody id="costosBody">',
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Tipo', 'Fecha Inicio', 'Fecha Final', 'Valor', 'Acciones');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($data['costo_list'] as $key => $value) {
            $ids = json_encode(['idCosto' => $value['id_costo'], 'idServicio' => $value['id_servicio']]);
            array_push($grid, [
                $value['tipo_costo'],
                $value['fecha_inicio'],
                $value['fecha_final'],
                $value['valor'],
                "<button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" . $ids . "'>Eliminar</button> <button type='button' class='btn btn-primary btn-sm editBtn'>Editar</button>"
            ]);
        }
        return $table->generate($grid);
    }

    public function index($token = null)
    {
        $data['title'] = [
            'module' => 'Costos',
            'page'   => 'Costos',
            'icon'  => 'fa fa-phone'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Lista Costos', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable($token);
        $data['idServicio'] = $token;

        echo view('costo/modal_costo', $data);
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
        $result = null;
        $id = null;

        // Obtener el ID original del objeto antes de la actualización
        $idOriginal = $this->request->getPost('id_costo');
        if (empty($idOriginal)) {
            $result = 'Usuario registrado con exito.';
        } else {
            $id = $idOriginal;
            $result = 'Usuario actualizado con exito.';
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_costo' => $id,
            'id_servicio' => $this->request->getPost('id_servicio'),
            'tipo_costo' => $this->request->getPost('tipo_costo'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_final' => $this->request->getPost('fecha_final'),
            'valor' => $this->request->getPost('valor'),
        ];
        //var_dump($data);
        $this->costo_model->save($data);
        // Obtener el ID del registro actualizado
        // Si el registro se ha actualizado, el ID será el mismo que el ID original
        // Si se ha insertado un nuevo registro, el ID será el ID generado automáticamente
        $updatedId = $id != null ? $id : $this->costo_model->insertID();
        return json_encode($this->costo_model->find($updatedId));
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
