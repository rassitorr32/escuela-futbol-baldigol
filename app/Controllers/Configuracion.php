<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;
use CodeIgniter\HTTP\ResponseInterface;

class Configuracion extends BaseController
{
    private $configuracion_model;

    function __construct()
    {
        $this->configuracion_model = new ConfiguracionModel();
    }

    public function index()
    {
        //
    }

    public function store()
    {
        $session = session();
        $id = $this->request->getPost('id_configuracion');
        //echo var_dump($this->request->getPost());
        // if (!empty($this->request->getPost('id_complejo'))) {
        //     $id = $this->request->getPost('id_complejo');
        // }
        // /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_configuracion' => $id,
            'choose-skin' => $this->request->getPost('choose-skin'),
            'font_setting' => $this->request->getPost('font'),
            'darkmode' => $this->request->getPost('custom-switch-checkbox')['darkmode']=='on'?true:false,
            //'fixnavbar' => $this->request->getPost('custom-switch-checkbox')['fixnavbar']=='on'?true:false,
            'pageheader' => $this->request->getPost('custom-switch-checkbox')['pageheader']=='on'?true:false,
            'min_sidebar' => $this->request->getPost('custom-switch-checkbox')['min_sidebar']=='on'?true:false,
            'sidebar' => $this->request->getPost('custom-switch-checkbox')['sidebar']=='on'?true:false,
            'iconcolor' => $this->request->getPost('custom-switch-checkbox')['iconcolor']=='on'?true:false,
            'gradient' => $this->request->getPost('custom-switch-checkbox')['gradient']=='on'?true:false,
            'rtl' => $this->request->getPost('custom-switch-checkbox')['rtl']=='on'?true:false,
            'boxlayout' => $this->request->getPost('custom-switch-checkbox')['boxlayout']=='on'?true:false,
        ];

        if ($this->configuracion_model->save($data)) {
            session()->set('configuracion', $this->configuracion_model->find($id));
            //$session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function storeGridMenu()
    {
        $id = session('configuracion')['id_configuracion'];
        $data = [
            'id_configuracion' => $id,
            'grid_menu' => $this->request->getPost('grid_menu')=='on'?true:false,
        ];

        if ($this->configuracion_model->save($data)) {
            session()->set('configuracion', $this->configuracion_model->find($id));
            //$session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/doctor');
            return 'ok';
        } else {
            return 'error';
        }
    }
}
