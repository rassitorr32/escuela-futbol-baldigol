<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Panel extends BaseController
{
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
