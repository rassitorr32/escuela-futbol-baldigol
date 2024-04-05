<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    public function index($pagina = 'template')
    {
        $usuario = session()->get('usuario');
        $data = [];
        $data['title'] = [
            'module' => 'Hola ' . $usuario,
            'page'   => '¡A continuación se muestran algunos indicadores para hoy!',
            'icon'  => ''
        ];

        $data['breadcrumb'] = [
            ['title' => 'Panel', 'route' => "", 'active' => true]
        ];
        session()->set('leftbar_link', 'Usuario');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('panel_control', $data);
        echo view('template/footer');
    }
}
