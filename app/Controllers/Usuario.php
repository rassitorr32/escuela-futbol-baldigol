<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;
use App\Models\PersonaModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuario extends BaseController
{
    private $usuario_model;
    private $persona_model;

    function __construct()
    {
        $this->usuario_model = new UsuarioModel();
        $this->persona_model = new PersonaModel();
    }

    public function verificarUsuarioRepetidoJSON(){
        $nombre_usuario = $this->request->getPost('usuario');
        $nombre_usuario_actual = $this->request->getPost('usuarioActual');
        $existeUsuario = $this->usuario_model->where('usuario', $nombre_usuario)->countAllResults() > 0;
        if($nombre_usuario_actual!=''){
            if($nombre_usuario==$nombre_usuario_actual){
                return json_encode(true);
            }
        }
        // Devuelve una respuesta JSON
        return json_encode(!$existeUsuario);
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $lista_usuario = $this->usuario_model->getUsuariosWithPersona();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableUsuario" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'doctor/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('Foto', 'Usuario', 'Nombre', 'Apellido', 'C.I.', 'Fecha Nac.', 'Télefono', 'Rol', 'Cargo', 'F. creacion', 'F. actualización', 'Estado', 'Acción');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($lista_usuario as $key => $usuario) {
            array_push($grid, [
                $usuario['foto'] == null || $usuario['foto'] == 'user_default.png' || !file_exists(FCPATH . 'assets/dist/img/personal/' . $usuario['foto']) ? '<div class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">
                <span>' . strtoupper(substr($usuario['nombres'], 0, 1)) . strtoupper(substr($usuario['ap_paterno'], 0, 1)) . '</span>
            </div>' :
                    '<span class="avatar" style="background-image: url(' . base_url() . 'assets/dist/img/personal/' . $usuario['foto'] . ')"></span>',
                $usuario['usuario'],
                $usuario['nombres'],
                $usuario['ap_paterno'] . ' ' . $usuario['ap_materno'],
                $usuario['dni'],
                $usuario['fecha_nac'],
                79898489,
                $usuario['id_rol'],
                $usuario['id_cargo'],
                $usuario['created_at'],
                $usuario['updated_at'],
                '<button class="btn btn-' . ($usuario['estado'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('usuario/changeStatus') . "'" . ',' . $usuario['id_usuario'] . ')">' . ($usuario['estado'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                // '<div class="btn-group">
                //             <button class="btn btn-secondary btn-circle" onclick="Edit(' . "'doctor/edit'" . ', ' . $usuario['id_usuario'] . ')">
                //             <i class="fas fa-edit"></i>
                //             </button>
                //             <button class="btn btn-danger btn-circle" onclick="Delete(' . "'doctor/delete'" . ', ' . $usuario['id_usuario'] . ')">
                //             <i class="fas fa-trash"></i>
                //             </button>
                //         </div>'
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="verItem(' . "'" . base_url() . "usuario/verItem'" . ', ' . $usuario['id_usuario'] . ')"><i class="fa fa-eye"></i></button>
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'usuario/edit'" . ', ' . $usuario['id_usuario'] . ')"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-icon btn-sm" title="View" onclick="Edit(' . "'telefono/index'" . ',' . $usuario['id_persona'] . ' )"><i class="fa fa-phone"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Personal',
            'page'   => 'Lista del Personal',
            'icon'  => 'fas fa-user-md'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Panel', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();
        // // Obtener el enrutador desde el contenedor de servicios
        // $router = service('router');
        // // Obtener el nombre del controlador actual
        // $controllerName = $router->controllerName();
        // // Extraer el nombre del controlador sin el namespace
        // $controllerNameWithoutNamespace = class_basename($controllerName);
        // session()->set('leftbar_link', $controllerNameWithoutNamespace);
        // // para tener el link donde nos encontramos para activarlos en llas pestañas
        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Usuario');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('usuario/index', $data);
        $dataTable['idTable'] = 'tableUsuario';
        $dataTable['tituloTable'] = 'Lista de Usuarios';
        echo view('template/footer', $dataTable);
    }

    public function perfil()
    {
        $data['title'] = [
            'module' => 'Usuario',
            'page'   => 'Mi perfil',
            'icon'  => 'fas fa-user-md'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Panel', 'route' => "/home", 'active' => false],
            ['title' => 'MI PERFIL', 'route'  => "", 'active' => true]
        ];

        //$data['table'] = $this->generateTable();
        //session()->set('leftbar_section', 'Escuela');
        session()->set('leftbar_link', '');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('usuario/perfil');
        echo view('template/footer');
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('usuario/form', $data);
    }

    public function store()
    {
        $session = session();
        $imageUser = $this->request->getFile('imageUser');
        $image = ($imageUser->getName() == '') ? '' : $imageUser->getName();
        //si sq no cambiaron la password, comparar para no volver a hashear
        if ($this->request->getPost('contraseña') == $this->request->getPost('contraseñaActual')) {
            $password = $this->request->getPost('contraseña');
        } else {
            $password = password_hash((string)$this->request->getPost('contraseña'), PASSWORD_DEFAULT);
        }
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
            //'telefono' => $this->request->getPost('telefono'),
            'dni' => $this->request->getPost('ci'),
            //Pregunta si esq se subio una imagen, por true imprime la imagen, por false(pregunta si y hay una imagen q se cargo de la base de datos, por el true imprime la imagen de la db, por el false imprime la imagen por defecto de usuario)
            'foto' => $image
        ];
        $persona = null;
        if ($this->persona_model->save($dataPersona)) {
            $persona = $idPersona == null ? $this->persona_model->find($this->persona_model->insertID()) : $this->persona_model->find($idPersona);

            if ($imageUser->getName() != '') {
                // Obtiene la ubicación temporal del archivo de imagen
                $archImage = $imageUser->getTempName();
                // Ruta base donde se guardarán las imágenes
                $rutaBase = "./assets/dist/img/personal/";
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
        /**si $id es null entonces se esta agregando nuevo registro */
        $id = null;
        if (!empty($this->request->getPost('id_usuario'))) {
            $id = $this->request->getPost('id_usuario');
        }
        $data = [
            'id_usuario' => $id,
            'id_rol' => $this->request->getPost('rol'),
            'id_cargo' => $this->request->getPost('cargo'),
            'id_persona' => $persona['id_persona'],
            'usuario' => $this->request->getPost('usuario'),
            'contraseña' => $password,
        ];

        if ($this->usuario_model->save($data)) {
            if ($id == null) {
                // Obtener el ID del último registro guardado
                $ultimo_id = $this->usuario_model->insertID();
                $configuracion_model = new ConfiguracionModel();
                $configuracion_model->save(['id_usuario' => $ultimo_id]);
            }
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            // Obtener los errores del modelo
            $errores = $this->usuario_model->errors();

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
            'module' => 'Usuarios',
            'page' => 'Editar Usuario',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/usuario');
        }

        $data['obj'] = $this->usuario_model->find($token);
        if ($data['obj'] == null) {
            return redirect()->to('/usuario');
        };
        $data['objPersona'] = $this->persona_model->find($data['obj']['id_persona']);

        return view('usuario/form', $data);
    }

    public function delete($id)
    {
        $this->usuario_model->delete($id);
        return 'Médico eliminado.';
    }

    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        $this->usuario_model->save(['id_usuario' => $id, 'estado' => $estado == 0 ? false : 1]);
    }

    //Ver item
    public function verItem($token = null)
    {
        $data['title'] = [
            'module' => 'Usuarios',
            'page' => 'Usuario',
            'icon' => 'fa fa-user-o'
        ];
        if (empty($token)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(json_encode(['message' => 'Id es null']));
        }

        $data['obj'] = $this->usuario_model->find($token);
        if ($data['obj'] == null) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(json_encode(['message' => 'Item no encontrado']));
        };

        $data['objPersona'] = $this->persona_model->find($data['obj']['id_persona']);

        return view('usuario/ver_usuario', $data);
    }

    public function calendario(){
        return view('usuario/calendario');
    }
}
