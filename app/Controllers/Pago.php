<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PagoModel;
use App\Models\PersonaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pago extends BaseController
{
    private $pago_model;

    function __construct()
    {
        $this->pago_model = new PagoModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $pago_list = $this->pago_model->getPagosWithEstudiantes();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tablePago" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'pago/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('#', 'Nombre(s)', 'Apellido(s)', 'Descripción', 'Monto', 'Nro. Cuotas', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($pago_list as $key => $value) {
            $c++;
            array_push($grid, [
                $c,
                $value['nombres'],
                $value['ap_paterno'].' '.isset($value['ap_materno'])?$value['ap_materno']:'',
                $value['tipo_costo'],
                $value['total_monto'],
                $value['total_cuota'],
                '<span class="tag tag-' . ($value['total_monto'] == $value['valor'] ? 'green' : 'orange') . '" onclick="cambiarEstado(this,' . "'" . base_url('pago/changeStatus') . "'" . ',' . $value['id_pago'] . ')" disabled>' . ($value['valido'] == 1 ? 'Pagado' : 'Pendiente') . '</span>',
                '<div class="btn-group">
                <button type="button" class="btn btn-icon btn-sm" title="View"><i class="fa fa-eye" onclick="verItem(' . "'" . base_url() . "pago/verItem'" . ', ' . $value['id_pago'] . ')"></i></button>
                <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'pago/edit'" . ', ' . $value['id_pago'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }

        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Pago',
            'page'   => 'Lista de Pagos',
            'icon'  => 'fa fa-credit-card'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Doctor List', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();

        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Pago');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('pago/index', $data);
        // echo var_dump($this->pago_model->getPagosWithEstudiantes());
        echo view('template/footer');
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        return view('pago/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_pago'))) {
            $id = $this->request->getPost('id_pago');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_pago' => $id,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        if ($this->pago_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/pago');
            return 'ok';
        } else {
            return 'error';
        }
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
