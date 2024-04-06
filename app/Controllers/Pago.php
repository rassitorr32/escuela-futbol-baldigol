<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PagoModel;
use App\Models\PersonaModel;
use App\Models\TutorModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pago extends BaseController
{
    private $pago_model;
    private $tutor_model;

    function __construct()
    {
        $this->pago_model = new PagoModel();
        $this->tutor_model = new TutorModel();
    }
    public function generateTableModal($id_pago)
    {
        /**recuperar datos de la DB */
        $pago_list = $this->pago_model->getPagosWithEstudiantes($id_pago);
        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tablePagoModal" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0" style="border-radius: 10px; overflow: hidden;">',
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Quién Pagó', 'Estudiante', 'Descripción', 'Monto', 'Nro. Cuota');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($pago_list as $key => $value) {
            array_push($grid, [
                $value['per_nombres'].' '.$value['per_ap_paterno'].' '.(isset($value['per_ap_materno'])?$value['per_ap_materno']:''),
                $value['nombres'].' '.$value['ap_paterno'].' '.(isset($value['ap_materno'])?$value['ap_materno']:''),
                $value['tipo_costo'],
                $value['monto_pagado'],
                $value['nro_cuota'],
            ]);
        }
        return $table->generate($grid);
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $pago_list = $this->pago_model->getPagosWithEstudiantes();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tablePago" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $table->setHeading('#', 'Nombre(s)', 'Apellido(s)', 'Descripción', 'Pagado', 'Costo Total', 'Nro. Cuotas', 'Máx. Cuotas', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($pago_list as $key => $value) {
            $c++;
            array_push($grid, [
                $c,
                $value['nombres'],
                $value['ap_paterno'].' '.(isset($value['ap_materno'])?$value['ap_materno']:''),
                $value['tipo_costo'],
                $value['total_monto'],
                $value['valor'],
                $value['total_cuota'],
                $value['nro_cuotas_max'],
                '<span class="tag tag-' . ($value['total_monto'] == $value['valor'] ? 'green' : 'orange') . '">' . ($value['total_monto'] == $value['valor'] ? 'Pagado' : 'Pendiente') . '</span>',
                '<div class="btn-group">
                <button type="button" class="btn btn-icon btn-sm" title="View"><i class="fa fa-eye" onclick="Edit(' . "'pago/modalIndex'".','.$value['id_pago'].' )"></i></button>   
                <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'usuario/edit'" . ', ' . $value['id_pago'] . ')"><i class="fa fa-edit"></i></button>'
            ]);
        }

        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Pago',
            'page'   => 'Pagos por Estudiante',
            'icon'  => 'fa fa-credit-card'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();


        session()->set('leftbar_section', 'Escuela');
        session()->set('leftbar_link', 'Pago');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('pago/index', $data);
        // echo var_dump($this->pago_model->getPagosWithEstudiantes());
        echo view('template/footer');
    }

    public function modalIndex($token = null)
    {
        $data['title'] = [
            'module' => 'Pagos',
            'page'   => 'Pago(s)',
            'icon'  => 'fa fa-phone'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTableModal($token);
        $data['idDep'] = $token;

        echo view('pago/modal_pago', $data);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'Pagos',
            'page' => 'Agregar Pago',
            'icon' => 'fa fa-plus'
        ];
        $data['tutor_list'] = $this->tutor_model->getTutoresWithPersona();
        return view('pago/form', $data);
    }

    public function addCuota($idPago)
    {
        $data['title'] = [
            'module' => 'Pagos',
            'page' => 'Agregar Cuota',
            'icon' => 'fa fa-plus'
        ];
        $data['obj'] = $this->pago_model->getPagosWithEstudiantes($idPago)[0];
        $data['tutor_list'] = $this->tutor_model->getTutoresWithPersona();
        return view('pago/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_pago'))) {
            $id = $this->request->getPost('id_pago');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_pago' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        if ($this->pago_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/pago');
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
            return redirect()->to('/pago');
        }

        $data['obj'] = $this->pago_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/pago');
        };

        return view('pago/form', $data);
    }

    public function delete($id)
    {
        $this->pago_model->delete($id);
        return 'Médico eliminado.';
    }
    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        echo ($this->pago_model->save(['id_pago' => $id, 'valido' => $estado == 0 ? false : 1]));
    }
}
