<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CostoModel;
use App\Models\EstudianteModel;
use App\Models\PagoModel;
use App\Models\PersonaModel;
use App\Models\ServicioModel;
use App\Models\TutorModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pago extends BaseController
{
    private $pago_model;
    private $tutor_model;
    private $estudiante_model;
    private $servicio_model;
    private $costo_model;
    private $persona_model;

    function __construct()
    {
        $this->pago_model = new PagoModel();
        $this->tutor_model = new TutorModel();
        $this->estudiante_model = new EstudianteModel();
        $this->servicio_model = new ServicioModel();
        $this->costo_model = new CostoModel();
        $this->persona_model = new PersonaModel();
    }
    public function generateTableModal($id_padre)
    {
        /**recuperar datos de la DB */
        $pago_list = $this->pago_model->getPagosWithEstudiantes($id_padre);
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
        $table->setHeading('#', 'Nombre(s)', 'Apellido(s)', 'Servicio', 'Descripción', 'Pagado', 'Costo Total', 'Nro. Cuotas', 'Máx. Cuotas', 'Ultimo Pago', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($pago_list as $key => $value) {
            $costo = $this->costo_model->find($value['id_costo']);
            $servicio=$this->servicio_model->find($costo['id_servicio']);
            $c++;
            array_push($grid, [
                $c,
                $value['nombres'],
                $value['ap_paterno'].' '.(isset($value['ap_materno'])?$value['ap_materno']:''),
                $servicio['id_dep']==null?$servicio['nombre']:'<div><b>' . ($this->servicio_model->find($servicio['id_dep']))['nombre'] . '</b></div>
                <div class="text-muted">' . $servicio['nombre'] . '</div>',
                $value['tipo_costo'],
                $value['total_monto'],
                $value['valor'],
                $value['total_cuota'],
                $value['nro_cuotas_max'],
                $value['ultimo_pago'],
                '<span class="tag tag-' . ($value['total_monto'] == $value['valor'] ? 'green' : 'orange') . '">' . ($value['total_monto'] == $value['valor'] ? 'Pagado' : 'Pendiente') . '</span>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="Edit(' . "'pago/modalIndex'".','.$value['id_pago'].' )"><i class="fa fa-eye"></i></button>
                </div>',
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
        $dataTable['idTable'] = 'tablePago';
        $dataTable['tituloTable'] = 'Lista de Pagos';
        echo view('template/footer', $dataTable);
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
        $data['idPadre'] = $token;

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
        $data['estudiante_list'] = $this->estudiante_model->getEstudiantesWithPersona();
        $data['servicio_list'] = $this->servicio_model->findAll();
        $data['persona_list'] = $this->persona_model->findAll();
        return view('pago/form', $data);
    }

    public function addCuota($idPadre)
    {
        $data['title'] = [
            'module' => 'Pagos',
            'page' => 'Agregar Cuota',
            'icon' => 'fa fa-plus'
        ];
        $data['obj'] = $this->pago_model->getPagosWithEstudiantes($idPadre)[0];
        $data['tutor_list'] = $this->tutor_model->getTutoresWithPersona();
        $data['estudiante_list'] = $this->estudiante_model->getEstudiantesWithPersona();
        $data['servicio_list'] = $this->servicio_model->findAll();
        $data['persona_list'] = $this->persona_model->findAll();
        $data['idPadre'] = $idPadre;
        return view('pago/form', $data);
    }

    public function store()
    {
        $session = session();
        $imagePago = $this->request->getFile('imageUser');
        $image = ($imagePago->getName() == '') ? '' : $imagePago->getName();
        //Si no esta vacio significa que se subio una imagen
        if (!empty($image)) {
            // Genera un nombre único para la imagen
            $image = time() . $image;
        } else {
            //Pregunta si no esta vacio esq hay una imagen actual y por else inserta la imagen por defecto
            if (!empty($this->request->getPost('imagenActual'))) {
                $image = $this->request->getPost('imagenActual');
            } else {
                $image = null;
            }
        }
        $result = null;

        $idPagoPadre = null;
        if (!empty($this->request->getPost('id_pago_padre'))) {
            $idPagoPadre = $this->request->getPost('id_pago_padre');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $id = null;
        if (!empty($this->request->getPost('id_pago'))) {
            $id = $this->request->getPost('id_pago');
        }
        $data = [
            'id_pago' => $id,
            'id_costo' => $this->request->getPost('id_costo'),
            'monto_pagado' => $this->request->getPost('monto_pagado'),
            'fecha_pago' => $this->request->getPost('fecha_pago'),
            'nro_cuota' => 1,
            'id_persona' => $this->request->getPost('id_persona'),
            'id_estudiante' => $this->request->getPost('id_estudiante'),
            'id_dep' => $idPagoPadre,
            'id_usuario' => $this->request->getPost('id_usuario'),
            'archivo' => $image,
        ];

        if ($this->pago_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            // Obtener los errores del modelo
            $errores = $this->pago_model->errors();

            // Variable para almacenar los mensajes de error
            $mensajeError = '';

            // Iterar sobre el array de errores
            // Verificar si $errores es un array
            if (is_array($errores)) {
                // Iterar sobre el array de errores
                foreach ($errores as $campo => $reglas) {
                    // Verificar si $reglas es una cadena de texto
                    if (is_string($reglas)) {
                        // Si $reglas es una cadena, agregarla directamente a $mensajeError
                        $mensajeError .= "$campo: $reglas\n";
                    } else {
                        // Si $reglas es un array, iterar sobre él para construir la cadena de errores
                        foreach ($reglas as $regla => $mensaje) {
                            // Agregar el mensaje de error a la cadena
                            $mensajeError .= "$campo: $mensaje\n";
                        }
                    }
                }
            } else {
                // Si $errores no es un array, tratarlo como un único mensaje de error
                $mensajeError = $errores;
            }


            // Mostrar los mensajes de error como una cadena
            // echo $mensajeError;
            return 'error';
        }
        //return redirect()->to('/usuario');
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
