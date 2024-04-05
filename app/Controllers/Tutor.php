<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstudianteModel;
use App\Models\PersonaModel;
use App\Models\TutorModel;
use CodeIgniter\HTTP\ResponseInterface;

class Tutor extends BaseController
{
    private $tutor_model;
    private $persona_model;
    private $estudiante_model;

    function __construct()
    {
        $this->tutor_model = new TutorModel();
        $this->persona_model = new PersonaModel();
        $this->estudiante_model = new EstudianteModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $lista_tutor = $this->tutor_model->getTutoresWithPersona();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableTutor" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Foto', 'Nombre', 'Ap. Paterno', 'Ap. Materno', 'C.I.', 'Fecha Nac.', 'Género', 'Dirección', 'Nacionalidad', 'Rol', 'Descripción', 'Estado', 'Acción');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($lista_tutor as $key => $value) {
            //$persona = $this->persona_model->find($value['id_persona']);
            array_push($grid, [
                $value['foto']==null || $value['foto'] == 'user_default.png' || !file_exists(FCPATH . 'assets/dist/img/tutores/' . $value['foto']) ? '<div class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">
                <span>' . strtoupper(substr($value['nombres'], 0, 1)) . strtoupper(substr($value['ap_paterno'], 0, 1)) . '</span>
            </div>' :
                    '<span class="avatar" style="background-image: url(' . base_url() . 'assets/dist/img/estudiantes/' . $value['foto'] . ')"></span>',
                $value['nombres'],
                $value['ap_paterno'],
                $value['ap_materno'],
                $value['dni'].' '.$value['extension'],
                $value['fecha_nac'],
                $value['sexo'],
                $value['direccion'],
                $value['nacionalidad'],
                $value['tipo_tutor'],
                $value['descripcion'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('estudiante/changeStatus') . "'" . ',' . $value['id_tutor'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                // '<div class="btn-group">
                //             <button class="btn btn-secondary btn-circle" onclick="Edit(' . "'doctor/edit'" . ', ' . $usuario['id_usuario'] . ')">
                //             <i class="fas fa-edit"></i>
                //             </button>
                //             <button class="btn btn-danger btn-circle" onclick="Delete(' . "'doctor/delete'" . ', ' . $usuario['id_usuario'] . ')">
                //             <i class="fas fa-trash"></i>
                //             </button>
                //         </div>'
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="View"><i class="fa fa-eye" onclick="verItem(' . "'" . base_url() . "tutor/verItem'" . ', ' . $value['id_tutor'] . ')"></i></button>
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'tutor/edit'" . ', ' . $value['id_tutor'] . ')"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="Edit(' . "'telefono/index'".','.$value['id_persona'].' )"><i class="fa fa-phone"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Tutor',
            'page'   => 'Lista de Tutores',
            'icon'  => 'fas fa-user-md'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Panel', 'route' => "/home", 'active' => false],
            ['title' => 'Lista Estudiantes', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();
        
        $data['estudiante_list'] = $this->estudiante_model->getEstudiantesWithPersona();
        session()->set('leftbar_section', 'Escuela');
        session()->set('leftbar_link', 'Tutor');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('tutor/index', $data);
        echo view('template/footer');
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('tutor/form', $data);
    }

    public function store()
    {
        $session = session();
        $imageUser = $this->request->getFile('imageTutor');
        $image = ($imageUser->getName() == '') ? '' : $imageUser->getName();
        //Si no esta vacio significa que se subio una imagen
        if (!empty($image)) {
            // Genera un nombre único para la imagen
            $image = time() . $image;
        }else{
            //Pregunta si npo esta vacio esq hay una imagen actual y por else inserta la imagen por defecto
            if(!empty($this->request->getPost('imagenActual'))){
                $image = $this->request->getPost('imagenActual');
            }else{
                $image = null;
            }
        }

        $idPersona = null;
        if (!empty($this->request->getPost('id_persona'))) {
            $idPersona = $this->request->getPost('id_persona');
        }
        $dataPersona = [
            'id_persona' => $idPersona,
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
            'foto' => $image
        ];
        //Primero guardamos persona y recuperamos sus datos
        $persona = null;
        if ($this->persona_model->save($dataPersona)) {
            $persona = $idPersona == null ? $this->persona_model->find($this->persona_model->insertID()) : $this->persona_model->find($idPersona);

            if ($imageUser->getName() != '') {
                // Obtiene la ubicación temporal del archivo de imagen
                $archImage = $imageUser->getTempName();
                // Ruta base donde se guardarán las imágenes
                $rutaBase = "./assets/dist/img/estudiantes/";
                // Ruta completa donde se moverá la imagen
                $rutaDestino = $rutaBase . $image;

                // Verifica si la ruta base existe, si no existe, la crea
                if (!file_exists($rutaBase)) {
                    mkdir($rutaBase, 0777, true); // Crea el directorio recursivamente
                }

                // Intenta mover la imagen y verifica si fue exitoso
                if (move_uploaded_file($archImage, $rutaDestino)) {
                    echo "La imagen se movió correctamente a: $rutaDestino";
                } else {
                    echo "¡Error! La imagen no se pudo mover.";
                }
            }
        } else {
            return var_dump($this->persona_model->errors());
        }
        $id = null;
        if (!empty($this->request->getPost('id_tutor'))) {
            $id = $this->request->getPost('id_tutor');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_tutor' => $id,
            'id_persona' => $persona['id_persona'],
            'tipo_tutor' => 'tutor',
            'descripcion' => 'Tutor de estudiante'
        ];

        if ($this->tutor_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            // Obtener los errores del modelo
            $errores = $this->tutor_model->errors();

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
            'module' => 'Estudiantes',
            'page' => 'Editar Estudiante',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/tutor');
        }

        $data['obj'] = $this->tutor_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/tutor');
        };
        $data['objPersona'] = $this->persona_model->find($data['obj']['id_persona']);

        return view('tutor/form', $data);
    }

    public function delete($id)
    {
        $this->tutor_model->delete($id);
        return 'Médico eliminado.';
    }

    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        $estado = ($estado === '1') ? true : false;
        $this->tutor_model->save(['id_tutor' => $id, 'valido' => $estado==0?false:1]);
    }

    //Ver item
    public function verItem($token = null)
    {
        $data['title'] = [
            'module' => 'Usuarios',
            'page' => 'Datos del tutor',
            'icon' => 'fa fa-user-o'
        ];
        if (empty($token)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(json_encode(['message' => 'Id es null']));
        }

        $data['obj'] = $this->tutor_model->getEstudiantesWithPersona($token);
        if ($data['obj'] == null) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(json_encode(['message' => 'Item no encontrado']));
        };
        return view('tutor/ver_tutor', $data);
    }
}
