<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DatosMedicosModel;
use CodeIgniter\HTTP\ResponseInterface;

class DatosMedicos extends BaseController
{
    private $dm_model;

    function __construct()
    {
        $this->dm_model = new DatosMedicosModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $data['dm_list'] = $this->dm_model->orderBy('name_doctor','ASC')->findAll();

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
        foreach ($data['dm_list'] as $key => $value) {
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
        return $table->generate($data['dm_list']);
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

        $data['table'] = $this->generateTable();

        echo view('aside_menu');
        echo view('doctor/index', $data);
        echo view('footer');
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
        if (empty($this->request->getPost('id_doctor'))) {
            $result = 'Usuario registrado con exito.';
        } else {
            $id = $this->request->getPost('id_doctor');
            $result = 'Usuario actualizado con exito.';
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_doctor' => $id,
            'name_doctor' => $this->request->getPost('nameDoctor'),
            'lastname_doctor' => $this->request->getPost('lastnameDoctor'),
            'second_lastname_doctor' => $this->request->getPost('secondLastnameDoctor'),
            'specialty_doctor' => $this->request->getPost('specialtyDoctor'),
            'ci_doctor' => $this->request->getPost('ciDoctor'),
            'email_doctor' => $this->request->getPost('emailDoctor'),
            'phone_number' => $this->request->getPost('phoneNumberDoctor'),
        ];

        $this->dm_model->save($data);
        return $result;
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

        $data['obj'] = $this->dm_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/doctor');
        };

        return view('doctor/form', $data);
    }

    public function delete($id)
    {
        $this->dm_model->delete($id);
        return 'Médico eliminado.';
    }
}
