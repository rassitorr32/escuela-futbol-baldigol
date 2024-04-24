<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicioModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Stmt\Return_;

class Servicio extends BaseController
{
    private $servicio_model;

    function __construct()
    {
        $this->servicio_model = new ServicioModel();
    }
    public function getServicios(){
        return json_encode($this->servicio_model->orderBy('nombre','ASC')->findAll());
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $lista_servicio = $this->servicio_model->orderBy('nombre','ASC')->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableServicio" class="table table-striped mb-0 text-nowrap">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Cod.', 'Nombre', 'Descripción', 'Servicio', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($lista_servicio as $key => $value) {
            $c++;
            //$persona = $this->persona_model->find($value['id_persona']);
            array_push($grid, [
                $value['id_servicio'],
                $value['id_dep'] == null ? $value['nombre'] : '<div><b>' . $value['nombre'] . '</b></div>
                <div class="text-muted">' . ($this->servicio_model->find($value['id_dep']))['nombre'] . '</div>',
                //$value['tipo_servicio'],
                $value['descripcion'],
                isset($value['id_dep'])?$value['id_dep']:'',
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('servicio/changeStatus') . "'" . ',' . $value['id_servicio'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="verItem(' . "'" . base_url() . "servicio/verItem'" . ', ' . $value['id_servicio'] . ')"><i class="fa fa-eye"></i></button>
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'servicio/edit'" . ', ' . $value['id_servicio'] . ')"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="Edit(' . "'costo/index'".','.$value['id_servicio'].' )"><i class="fa fa-phone"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Servicios',
            'page'   => 'Lista de Servicios',
            'icon'  => 'fas fa-user-md'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Panel', 'route' => "/home", 'active' => false],
            ['title' => 'Lista Servicios', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();
        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Servicio');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('servicio/index', $data);
        $dataTable['idTable'] = 'tableServicio';
        $dataTable['tituloTable'] = 'Lista de Servicios';
        echo view('template/footer', $dataTable);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'Estudiante',
            'page' => 'Nuevo Estudiante',
            'icon' => 'fas fa-plus'
        ];
        $data['servicio_list'] = $this->servicio_model->orderBy('nombre','ASC')->findAll();
        return view('servicio/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_servicio'))) {
            $id = $this->request->getPost('id_servicio');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_servicio' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => 'Estudiante de la escuela',
            'id_dep' => $this->request->getPost('id_dep')?$this->request->getPost('id_dep'):null,
        ];

        if ($this->servicio_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            // Obtener los errores del modelo
            $errores = $this->servicio_model->errors();

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
            'module' => 'Servicios',
            'page' => 'Editar Estudiante',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/servicio');
        }

        $data['obj'] = $this->servicio_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/servicio');
        };
        $data['servicio_list'] = $this->servicio_model->where('id_servicio!=',$token)->orderBy('nombre','ASC')->findAll();

        return view('servicio/form', $data);
    }

    public function delete($id)
    {
        $this->servicio_model->delete($id);
        return 'Médico eliminado.';
    }

    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        $estado = ($estado === '1') ? true : false;
        $this->servicio_model->save(['id_servicio' => $id, 'valido' => $estado==0?false:1]);
    }

    //Ver item
    public function verItem($token = null)
    {
        $data['title'] = [
            'module' => 'Usuarios',
            'page' => 'Datos del servicio',
            'icon' => 'fa fa-user-o'
        ];
        if (empty($token)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(json_encode(['message' => 'Id es null']));
        }

        $data['obj'] = $this->servicio_model->getServiciosWithPersona($token);
        if ($data['obj'] == null) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(json_encode(['message' => 'Item no encontrado']));
        };
        $item_padre = $this->servicio_model->find($data['obj']['id_dep']);
        $data['objServicio'] = isset($item_padre)? $item_padre:'';
        return view('servicio/ver_servicio', $data);
    }

    public function listSubServicio($id){
        $subservicio_list = $this->servicio_model->where('id_dep',$id)->orderBy('tipo_servicio','ASC')->findAll();
        return json_encode($subservicio_list);
    }
}
