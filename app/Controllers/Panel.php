<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Panel extends BaseController
{
    private $usuario_model;
    private $tutor_model;

    function __construct()
    {
        $this->usuario_model = new UsuarioModel();
        $this->tutor_model = new TutorModel();
    }
    public function generateTableUltLogin()
    {
        /**recuperar datos de la DB */
        // Calcular la fecha de hace 3 días
        $fecha_hace_tres_dias = date('Y-m-d', strtotime('-3 days'));

        // Obtener los últimos logins de los últimos 3 días
        $lista_usuario = $this->usuario_model
            ->where('ultimo_login >=', $fecha_hace_tres_dias) // Último login es mayor o igual a hace 3 días
            ->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table class="table card-table table-vcenter text-nowrap table-striped mb-0">'
        ]);
        $table->setHeading('Foto', 'Usuario', 'Ultimo Acceso');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($lista_usuario as $key => $value) {
            $usuario = $this->usuario_model->getUsuariosWithPersona($value['id_usuario']);
            unset($usuario['contraseña']);
            array_push($grid, [
                $usuario['foto'] == null || $usuario['foto'] == 'user_default.png' || !file_exists(FCPATH . 'assets/dist/img/personal/' . $usuario['foto']) ? '<div class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">
                <span>' . strtoupper(substr($usuario['nombres'], 0, 1)) . strtoupper(substr($usuario['ap_paterno'], 0, 1)) . '</span>
            </div>' :
                    '<span class="avatar" style="background-image: url(' ."'". base_url() . 'assets/dist/img/personal/' . $usuario['foto'] ."'". ')"></span>',
                '<div>' . $usuario['usuario'] . '</div>
                <div class="text-muted">' . $usuario['id_cargo'] . '</div>',
                $usuario['ultimo_login'],
            ]);
        }
        return $table->generate($grid);
    }

    public function generateTableUltEstudiantes()
    {
        // Obtener los últimos 5 usuarios según la fecha de último login
        $lista_estudiante = $this->tutor_model
            ->where('tipo_tutor','estudiante')
            ->orderBy('created_at', 'DESC') // Ordenar por último login en orden descendente
            ->limit(5) // Limitar a 5 resultados
            ->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table class="table table-striped mb-0 text-nowrap">'
        ]);
        $table->setHeading('Foto', 'Nombre(s)', 'Apellido(s)', 'Honorarios', 'Creado el', 'Editar');
        $grid = array();
        /**Llenar el contenido de la tabla */
        foreach ($lista_estudiante as $key => $value) {
            $estudiante = $this->tutor_model->getTutoresWithPersona($value['id_tutor']);
            array_push($grid, [
                $estudiante['foto'] == null || $estudiante['foto'] == 'user_default.png' || !file_exists(FCPATH . 'assets/dist/img/estudiantes/' . $estudiante['foto']) ? '<div class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">
                <span>' . strtoupper(substr($estudiante['nombres'], 0, 1)) . strtoupper(substr($estudiante['ap_paterno'], 0, 1)) . '</span>
            </div>' :
                    '<span class="avatar" style="background-image: url('."'" . base_url() . 'assets/dist/img/estudiantes/' . $estudiante['foto'] . "'".')"></span>',
                $estudiante['nombres'],
                $estudiante['ap_paterno'].' '.$estudiante['ap_materno'],
                '<span class="tag tag-danger">No pagado</span>',
                $estudiante['created_at'],
                '<button class="btn btn-' . ($estudiante['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('estudiante/changeStatus') . "'" . ',' . $estudiante['id_tutor'] . ')">' . ($estudiante['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $usuario = session()->get('usuario');
        $data = [];
        $data['title'] = [
            'module' => 'Panel',
            'page'   => 'Panel',
            'icon'  => ''
        ];

        $data['breadcrumb'] = [
            ['title' => 'Panel', 'route' => "", 'active' => true]
        ];
        $data['tableUltimoLogin'] = $this->generateTableUltLogin();
        $data['tableNuevosEstudiantes'] = $this->generateTableUltEstudiantes();
        $data['totalNuevosEstudiantes'] = count($this->tutor_model
        ->where('tipo_tutor','estudiante') // Ordenar por último login en orden descendente
        ->limit(5) // Limitar a 5 resultados
        ->findAll());
        $data['totalNuevosUsuarios'] = count($lista_usuario = $this->usuario_model
        ->where('created_at >=', session('usuario')['ultimo_login']) // Último login es mayor o igual a hace 3 días
        ->findAll());
        session()->set('leftbar_section', 'Escuela');
        session()->set('leftbar_link', 'Panel');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('panel/panel_control', $data);
        echo view('template/footer');
    }
}
