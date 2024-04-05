<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;
use App\Models\PersonaModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    private $user_model;
    private $persona_model;
    private $configuracion_model;
    function __construct()
    {
        $this->user_model = new UsuarioModel();
        $this->persona_model = new PersonaModel();
        $this->configuracion_model = new ConfiguracionModel();
    }
    public function index()
    {
        return view('login');
    }
    public function login()
    {

        if (!empty($this->request->getPost('usuario')) && !empty($this->request->getPost('contraseña'))) {
            // preg_match controla los caracteres que va a recibir
            if (
                preg_match('/^[a-zA-Z0-9.\s_-]+\s*$/', (string)$this->request->getPost('usuario')) &&
                preg_match('/^[a-zA-Z0-9]+$/', (string)$this->request->getPost('contraseña'))
            ) {
                $usuario = $this->request->getPost('usuario');
                $password = $this->request->getPost('contraseña');

                //$data = $user_model->findAll();//select * from user
                $data['usuario'] = $this->user_model->access($usuario);

                if ($data['usuario'] != null && password_verify((string)$password, $data['usuario']['contraseña'])) {
                    // if ($data != null && (string)$password == $data['contraseña']) {
                    //Encuentra la tabla persona
                    $persona = $this->persona_model->find($data['usuario']['id_persona']);
                    //Une los datos para guardar en la sesion
                    $data['id_usuario'] = $data['usuario']['id_usuario'];
                    // Eliminar el elemento 'contraseña'
                    unset($data['usuario']['contraseña']);
                    $data['usuario'] = array_merge((array)$data['id_usuario'], (array)$data['usuario'], (array)$persona);
                    $data['configuracion'] = $this->configuracion_model->find($data['usuario']['id_usuario']);
                    $session = session(); //inicializa la sesion
                    $session->set($data);
                    date_default_timezone_set('America/La_Paz');
                    $this->user_model->update($data['usuario']['id_usuario'], ['ultimo_login' => date("Y-m-d H:i:s")]);

                    return  redirect()->to(base_url());
                    // $this->controlPanel();
                } else {
                    return redirect()->to(base_url('/login'))->with('error', ['credenciales' => 'Credenciales de acceso invalidas']);
                }
            } else {
                return redirect()->to(base_url('/login'))->with('error', ['credenciales' => 'Caracteres invalidos']);
            }
        } else {
            return redirect()->to(base_url('/login'))->with('error', ['session' => 'Inicie session para acceder']);
        }
    }
    public function exit()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
    // public function controlPanel()
    // {
    //     $name = session()->get('usuario');
    //     $data = [];
    //     $data['title'] = [
    //         'module' => 'Hola ' . $name,
    //         'page'   => '¡A continuación se muestran algunos indicadores para hoy!',
    //         'icon'  => ''
    //     ];

    //     $data['breadcrumb'] = [
    //         ['title' => 'Panel', 'route' => "", 'active' => true]
    //     ];

    //     /**Informacion de Inicio*/
    //     // $data['summary_dashboard'] = [
    //     //     'total_doctor' => $this->doctor_model->countAllResults(),
    //     //     'total_patient' => $this->patient_model->countAllResults(),
    //     //     'total_consultation' => $this->consultation_model->countAllResults(),
    //     //     'total_user' => $this->user_model->countAllResults(),
    //     // ];
    //     // echo view('aside_menu');
    //     // echo view('control_panel', $data);
    //     // echo view('footer');
    //     // return redirect()->to(base_url())->with('error', ['session' => 'Inicie session para acceder']);
    //     $data['user'] = $this->user_model->findAll();
    //     echo view('template/head');
    //     echo view('template/leftbar',$data);
    //     echo view('template/header');
    //     echo view('template');
    //     echo view('template/footer');
    // }
}
