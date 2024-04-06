<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Panel extends BaseController
{
    private $usuario_model;
    private $tutor_model;

    function __construct()
    {
        $this->usuario_model = new UsuarioModel();
        $this->tutor_model = new UsuarioModel();
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
                    '<span class="avatar" style="background-image: url(' . base_url() . 'assets/dist/img/personal/' . $usuario['foto'] . ')"></span>',
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
        $lista_usuario = $this->tutor_model
            ->orderBy('ultimo_login', 'DESC') // Ordenar por último login en orden descendente
            ->limit(5) // Limitar a 5 resultados
            ->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table class="table table-striped mb-0 text-nowrap">'
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
                    '<span class="avatar" style="background-image: url(' . base_url() . 'assets/dist/img/personal/' . $usuario['foto'] . ')"></span>',
                '<div>' . $usuario['usuario'] . '</div>
                <div class="text-muted">' . $usuario['id_cargo'] . '</div>',
                $usuario['ultimo_login'],
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
