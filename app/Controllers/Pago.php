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
use DateTime;

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

    public function getPago($id_pago = null)
    {
        if ($id_pago == null)
            return json_encode($this->pago_model->getPagosWithEstudiantes());
        else
            return json_encode($this->pago_model->getPagosWithEstudiantes($id_pago));
    }

    public function generateTableModal($id_padre)
    {
        /**recuperar datos de la DB */
        $pago_list = $this->pago_model->getPagosWithEstudiantes($id_padre);
        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tablePagoModal" class="table table-striped mb-0 text-nowrap">',
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Quién Pagó', 'Estudiante', 'Descripción', 'Monto', 'Cod. Cuota');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($pago_list as $key => $value) {
            array_push($grid, [
                $value['per_nombres'] . ' ' . $value['per_ap_paterno'] . ' ' . (isset($value['per_ap_materno']) ? $value['per_ap_materno'] : ''),
                $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . (isset($value['ap_materno']) ? $value['ap_materno'] : ''),
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
        $table->setHeading('Cod.', 'Nombre(s)', 'Apellido(s)', 'Servicio', 'Descripción', 'Pagado', 'Costo Total', 'Nro. Cuotas', 'Máx. Cuotas', 'Ultimo Pago', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($pago_list as $key => $value) {
            $costo = $this->costo_model->find($value['id_costo']);
            $servicio = $this->servicio_model->find($costo['id_servicio']);
            $c++;
            array_push($grid, [
                $value['id_pago'],
                $value['nombres'],
                $value['ap_paterno'] . ' ' . (isset($value['ap_materno']) ? $value['ap_materno'] : ''),
                $servicio['id_dep'] == null ? $servicio['nombre'] : '<div><b>' . $servicio['nombre'] . '</b></div>
                <div class="text-muted">' . ($this->servicio_model->find($servicio['id_dep']))['nombre'] . '</div>',
                $value['tipo_costo'],
                $value['total_monto'],
                $value['valor_costo'],
                $value['total_cuota'],
                $value['pago_cuotas_max'],
                $value['ultimo_pago'],
                '<span class="tag tag-' . ($value['total_monto'] == $value['valor_costo'] ? 'green' : 'orange') . '">' . ($value['total_monto'] == $value['valor_costo'] ? 'Pagado' : 'Pendiente') . '</span>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="Edit(' . "'pago/modalIndex'" . ',' . $value['id_pago'] . ' )"><i class="fa fa-eye"></i></button>
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

        $pagoPadre = $this->pago_model->find($token);
        //true si el pago ya se completo
        $data['pago_completo'] = json_decode($this->verificarCuota($pagoPadre['id_costo'], $pagoPadre['id_estudiante']));

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
        $personas = $this->persona_model->orderBy('ap_paterno', 'ASC')->findAll();
        $personas_mayores = [];

        foreach ($personas as $persona) {
            $fecha_nacimiento = new DateTime($persona['fecha_nac']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nacimiento);

            // Verificar si la persona tiene 18 años o más y si ya cumplió años este año
            if ($edad->y >= 18 && ($hoy->format('md') >= $fecha_nacimiento->format('md'))) {
                $personas_mayores[] = $persona;
            }
        }

        $data['persona_list'] = $personas_mayores;
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
        $data['servicio_list'] = $this->servicio_model->join('costo', 'servicio.id_servicio=costo.id_servicio')->where('id_costo', $data['obj']['id_costo'])->findAll();
        $personas = $this->persona_model->orderBy('ap_paterno', 'ASC')->findAll();
        $personas_mayores = [];

        foreach ($personas as $persona) {
            $fecha_nacimiento = new DateTime($persona['fecha_nac']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nacimiento);

            // Verificar si la persona tiene 18 años o más y si ya cumplió años este año
            if ($edad->y >= 18 && ($hoy->format('md') >= $fecha_nacimiento->format('md'))) {
                $personas_mayores[] = $persona;
            }
        }
        $data['persona_list'] = $personas_mayores;
        $data['idPadre'] = $idPadre;
        return view('pago/form', $data);
    }

    public function store()
    {
        $session = session();
        $imagePago = $this->request->getFile('imagePago');
        $image = ($imagePago == null) ? '' : $imagePago->getName();
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

        $idCosto = $this->request->getPost('costo');
        $idEstudiante = $this->request->getPost('estudiante');
        // $dep = $this->pago_model->selectSum('monto_pagado', 'monto_total')
        //     ->selectCount('nro_cuota', 'cuota_total')
        //     ->where('id_costo', $idCosto)
        //     ->where('id_estudiante', $idEstudiante)->first();
        $idPagoPadre = $this->pago_model->where('id_costo', $idCosto)
            ->where('id_estudiante', $idEstudiante)->where('id_dep', null)->first();

        // if ($idPagoPadre != null) {
        //     $depCosto = $this->costo_model->find($idPagoPadre['id_costo']);
        //     if ($dep['cuota_total'] >= $depCosto['nro_cuotas_max']) {
        //         return 'El pago ya cumplió sus cuotas';
        //     }
        // }
        //return var_dump($dep);
        $idPersona = null;
        if (!empty($this->request->getPost('id_persona'))) {
            $idPersona = $this->request->getPost('id_persona');
        }

        $dataPersona = [];
        if ($idPersona == null) {
            $dataPersona = [
                'id' => null,
                'nombres' => $this->request->getPost('nombre'),
                'ap_paterno' => $this->request->getPost('ap_paterno'),
                'ap_materno' => $this->request->getPost('ap_materno'),
                'fecha_nac' => $this->request->getPost('fechaNac'),
                'dni' => $this->request->getPost('ci'),
                'extension' => $this->request->getPost('extension'),
                'sexo' => $this->request->getPost('genero'),
                'direccion' => $this->request->getPost('direccion'),
                'nacionalidad' => $this->request->getPost('nacionalidad'),
                //Pregunta si esq se subio una imagen, por true imprime la imagen, por false(pregunta si y hay una imagen q se cargo de la base de datos, por el true imprime la imagen de la db, por el false imprime la imagen por defecto de usuario)
                'foto' => null
            ];
            if ($this->persona_model->save($dataPersona)) {
                $idPersona = $this->persona_model->insertID();
            }else{
                return 'error';
            }
        }

        // return var_dump($dataPersona);
        $data = [];
        if($idPersona !== null){
            $data = [
                'id_pago' => $id,
                'id_costo' => $idCosto,
                'monto_pagado' => $this->request->getPost('monto'),
                'fecha_pago' => date("Y-m-d H:i:s"),
                'nro_cuota' => 1,
                'id_persona' => $idPersona,
                'id_estudiante' => $idEstudiante,
                'id_dep' => $idPagoPadre != null ? $idPagoPadre['id_pago'] : null,
                'id_usuario' => session('usuario')['id_usuario'],
                'archivo' => $image,
                'valor_costo' => $idPagoPadre == null ? ($this->costo_model->find($idCosto))['valor'] : ($this->pago_model->find($idPagoPadre['id_pago']))['valor_costo'],
                'pago_cuotas_max' => $idPagoPadre != null ? $this->pago_model->find($idPagoPadre['id_pago'])['pago_cuotas_max']:$this->costo_model->find($idCosto)['nro_cuotas_max'],
            ];
        }else{
            return 'error';
        }
        // return var_dump($data);
        //return  var_dump($dataPersona);
        // $this->pago_model->save($data);
        if ($this->pago_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            // Obtener los errores del modelo
            // $errores = $this->pago_model->errors();

            // // Variable para almacenar los mensajes de error
            // $mensajeError = '';
            // // Iterar sobre el array de errores
            // // Verificar si $errores es un array
            // if (is_array($errores)) {
            //     // Iterar sobre el array de errores
            //     foreach ($errores as $campo => $reglas) {
            //         // Verificar si $reglas es una cadena de texto
            //         if (is_string($reglas)) {
            //             // Si $reglas es una cadena, agregarla directamente a $mensajeError
            //             $mensajeError .= "$campo: $reglas\n";
            //         } else {
            //             // Si $reglas es un array, iterar sobre él para construir la cadena de errores
            //             foreach ($reglas as $regla => $mensaje) {
            //                 // Agregar el mensaje de error a la cadena
            //                 $mensajeError .= "$campo: $mensaje\n";
            //             }
            //         }
            //     }
            // } else {
            //     // Si $errores no es un array, tratarlo como un único mensaje de error
            //     $mensajeError = $errores;
            // }
            // Mostrar los mensajes de error como una cadena
            // echo $mensajeError;
            return 'error';
        }
        //return redirect()->to('/usuario');
    }

    public function verificarCuota($id_costo = null, $id_estudiante = null)
    {
        $idCosto = $this->request->getPost('idCosto') ?  $this->request->getPost('idCosto') : $id_costo;
        $idEstudiante = $this->request->getPost('idEstudiante') ? $this->request->getPost('idEstudiante') : $id_estudiante;
        // $idPagoPadre = $this->pago_model->where('id_costo', $idCosto)
        //     ->where('id_estudiante', $idEstudiante)->where('id_dep', null)->first();

        if ($idCosto != null && $idEstudiante != null) {
            $dep = $this->pago_model->selectSum('monto_pagado', 'monto_total')
                ->selectCount('nro_cuota', 'cuota_total')
                ->where('id_costo', $idCosto)
                ->where('id_estudiante', $idEstudiante)->first();
            if ($dep != null && $dep['monto_total'] != null && $dep['cuota_total'] != 0) {
                // $depCosto = $this->costo_model->find($idCosto);
                $pagPadre = $this->pago_model->where('id_costo', $idCosto)->where('id_estudiante', $idEstudiante)->where('id_dep', null)->first();
                if ($pagPadre != null) {
                    if ($dep['cuota_total'] >= $pagPadre['pago_cuotas_max'] || $pagPadre['valor_costo'] == $dep['monto_total']) {
                        return json_encode(false);
                    } else {
                        return json_encode($pagPadre);
                    }
                } else {
                    $depCosto = $this->costo_model->find($idCosto);
                    if ($dep['cuota_total'] >= $depCosto['nro_cuotas_max'] || $depCosto['valor'] == $dep['monto_total']) {
                        return json_encode(false);
                    } else {
                        return json_encode(true);
                    }
                }
            } else {
                return json_encode(true);
            }
        } else
            return json_encode(true);
    }

    public function getCostoJSON($idCosto = null, $idEstudiante = null)
    {
        $idCosto = $this->request->getPost('idCosto') !== null ? $this->request->getPost('idCosto') : $idCosto;
        $idEstudiante = $this->request->getPost('idEstudiante') !== null ? $this->request->getPost('idEstudiante') : $idEstudiante;

        if ($idCosto != null && $idEstudiante != null) {
            $infoPagoCostoCuota = $this->pago_model->selectMin('pago.id_pago', 'id_pago')->selectSum('pago.monto_pagado', 'monto_total')
                ->selectCount('pago.nro_cuota', 'cuota_total')
                ->where('pago.id_costo', $idCosto)
                ->where('pago.id_estudiante', $idEstudiante)->first();
            // ->join('costo', 'costo.id_costo=' . $idCosto)->first();
            $obj = $this->pago_model->select('valor_costo,pago_cuotas_max as nro_cuotas_max, id_estudiante')->where('id_costo', $idCosto)->where('id_estudiante', $idEstudiante)->where('id_dep', null)->first();
            if ($obj == null) {
                $obj = $this->costo_model->select('valor as valor_costo,nro_cuotas_max')->find($idCosto);
            }
            $infoPagoCostoCuota['valor_costo'] = $obj['valor_costo'];
            $infoPagoCostoCuota['nro_cuotas_max'] = $obj['nro_cuotas_max'];
            return json_encode($infoPagoCostoCuota);
        } else {
            if ($idCosto != null) {
                json_encode($this->costo_model->find($idCosto));
            }
            return json_encode($idCosto . ' post ' . $idEstudiante);
        }
    }

    public function getFindCostoJSON($idCosto = null, $idEstudiante = null)
    {
        $obj = $this->pago_model->select('valor_costo,pago_cuotas_max as nro_cuotas_max, id_estudiante')->where('id_costo', $idCosto)->where('id_estudiante', $idEstudiante)->where('id_dep', null)->first();
        if ($obj == null) {
            $obj = $this->costo_model->select('valor as valor_costo,nro_cuotas_max')->find($idCosto);
        }
        return json_encode($obj);
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
