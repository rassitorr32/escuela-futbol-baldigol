<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TelefonoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Telefono extends BaseController
{
    private $telefono_model;

    function __construct()
    {
        $this->telefono_model = new TelefonoModel();
    }

    public function generateTable($id_persona)
    {
        /**recuperar datos de la DB */
        $data['telefono_list'] = $this->telefono_model->where('id_persona', $id_persona)->orderBy('numero', 'ASC')->findAll();
        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableTelefono" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">',
            'tbody_open'  => '<tbody id="telefonosBody">',
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Número', 'Código de Area', 'Tipo de Telefono', 'Acciones');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($data['telefono_list'] as $key => $value) {
            $ids = json_encode(['idTelefono' => $value['id_telefono'], 'idPersona' => $value['id_persona']]);
            array_push($grid, [
                $value['numero'],
                $value['cod_area'],
                $value['tipo_tel'],
                "<button type='button' class='btn btn-icon btn-sm deleteBtn' data-id='" . $ids . "'><i class='fa fa-trash-o'></i></i></button> <button type='button' class='btn btn-icon btn-sm editBtn'><i class='fa fa-edit'></i></button>"
            ]);
        }
        return $table->generate($grid);
    }

    public function index($token = null)
    {
        $data['title'] = [
            'module' => 'Telefonos',
            'page'   => 'Telefono(s)',
            'icon'  => 'fa fa-phone'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable($token);
        $data['idPersona'] = $token;

        echo view('telefono/modal_telefono', $data);
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
        $idOriginal = $this->request->getPost('id_telefono');
        if (empty($idOriginal)) {
            $result = 'Usuario registrado con exito.';
        } else {
            $id = $idOriginal;
            $result = 'Usuario actualizado con exito.';
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_telefono' => $id,
            'id_persona' => $this->request->getPost('id_persona'),
            'tipo_tel' => $this->request->getPost('tipo_tel'),
            'cod_area' => $this->request->getPost('cod_area'),
            'numero' => $this->request->getPost('numero'),
        ];
        $this->telefono_model->save($data);
        // Obtener el ID del registro actualizado
        // Si el registro se ha actualizado, el ID será el mismo que el ID original
        // Si se ha insertado un nuevo registro, el ID será el ID generado automáticamente
        $updatedId = $id != null ? $id : $this->telefono_model->insertID();
        return json_encode($this->telefono_model->find($updatedId));
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

        $data['obj'] = $this->telefono_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/doctor');
        };

        return view('doctor/form', $data);
    }

    public function delete($id)
    {
        if($this->telefono_model->delete($id)){
            return 'ok';
        }else {
            return 'error';
        }
        
    }
}
