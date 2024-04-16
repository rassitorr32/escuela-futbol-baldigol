<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AreaModel;
use App\Models\CategoriaModel;
use App\Models\ServicioModel;
use App\Models\TemporadaModel;
use App\Models\TurnoModel;
use App\Models\ComplejoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Temporada extends BaseController
{
    private $temporada_model;
    private $area_model;
    private $turno_model;
    private $categoria_model;
    private $servicio_model;
    private $complejo_model;

    function __construct()
    {
        $this->temporada_model = new TemporadaModel();
        $this->area_model = new AreaModel();
        $this->turno_model = new TurnoModel();
        $this->categoria_model = new CategoriaModel();
        $this->servicio_model = new ServicioModel();
        $this->complejo_model = new ComplejoModel();
    }

    public function generateTable()
    {
        /**recuperar datos de la DB */
        $temporada_list = $this->temporada_model->orderBy('nombre','ASC')->findAll();

        /**Generar tabla y botones */
        $table = new \CodeIgniter\View\Table([
            'table_open' => '<table id="tableTemporada" class="table table-hover table-vcenter table_custom text-nowrap spacing5 border-style mb-0">'
        ]);
        $btnNew = '<button class="btn btn-primary" onclick="New(' . "'temporada/add'" . ')">
            <i class="fas fa-plus"></i> Nuevo
        </button>';
        $table->setHeading('#', 'Nombre', 'Area', 'Turno', 'Categoria', 'Servicio', 'Tipo', 'Fecha Inicio', 'Fecha Fin', 'Estado', 'Acción');
        $grid = array();
        $c = 0;
        /**Llenar el contenido de la tabla */
        foreach ($temporada_list as $key => $value) {
            $c++;
            array_push($grid, [
                $c,
                $value['nombre'],
                $this->area_model->find($value['id_area'])['nombre'],
                $this->turno_model->find($value['id_turno'])['nombre'],
                $this->categoria_model->find($value['id_categoria'])['nombre'],
                $this->servicio_model->find($value['id_servicio'])['nombre'],
                $value['tipo_temporada'],
                $value['fecha_inicio'],
                $value['fecha_fin'],
                '<button class="btn btn-' . ($value['valido'] == 1 ? 'success' : 'danger') . '" onclick="cambiarEstado(this,' . "'" . base_url('temporada/changeStatus') . "'" . ',' . $value['id_temporada'] . ')">' . ($value['valido'] == 1 ? 'Activo' : 'Inactivo') . '</button>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-icon btn-sm" title="Edit" onclick="Edit(' . "'temporada/edit'" . ', ' . $value['id_temporada'] . ')"><i class="fa fa-edit"></i></button>
               </div>'
            ]);
        }
        return $table->generate($grid);
    }

    public function index()
    {
        $data['title'] = [
            'module' => 'Temporada',
            'page'   => 'Lista de Temporadas',
            'icon'  => 'fa fa-building'
        ];

        $data['breadcrumb'] = [
            ['title' => 'Home', 'route' => "/home", 'active' => false],
            ['title' => 'Lista Temporada', 'route'  => "", 'active' => true]
        ];

        $data['table'] = $this->generateTable();

        session()->set('leftbar_section', 'Admin');
        session()->set('leftbar_link', 'Temporada');
        echo view('template/head');
        echo view('template/rightbar');
        echo view('template/theme_panel');
        echo view('template/quick_menu');
        echo view('template/leftbar');
        echo view('template/header');
        echo view('temporada/index', $data);
        $dataTable['idTable'] = 'tableTemporada';
        $dataTable['tituloTable'] = 'Lista de Temporadas';
        echo view('template/footer', $dataTable);
    }

    public function add()
    {
        $data['title'] = [
            'module' => 'New Doctor',
            'page' => 'New Doctor',
            'icon' => 'fas fa-plus'
        ];
        $data['area_list'] = $this->area_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['turno_list'] = $this->turno_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['categoria_list'] = $this->categoria_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['servicio_list'] = $this->servicio_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['complejo_list'] = $this->complejo_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        return view('temporada/form', $data);
    }

    public function store()
    {
        $session = session();
        $id = null;
        if (!empty($this->request->getPost('id_temporada'))) {
            $id = $this->request->getPost('id_temporada');
        }
        /**si $id es null entonces se esta agregando nuevo registro */
        $data = [
            'id_temporada' => $id,
            'id_turno' => $this->request->getPost('turno'),
            'id_categoria' => $this->request->getPost('categoria'),
            'id_area' => $this->request->getPost('area'),
            'id_servicio' => $this->request->getPost('servicio'),
            'nombre' => $this->request->getPost('nombre'),
            'tipo_temporada' => $this->request->getPost('tipo_temporada'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_fin' => $this->request->getPost('fecha_fin'),
        ];

        if ($this->temporada_model->save($data)) {
            $session->setFlashdata('sweet', ['success', ($id == null ? 'Guardado con exito!' : 'Modificación exitosa!')]);
            // return redirect()->to('/temporada');
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function edit($token = null)
    {
        $data['title'] = [
            'module' => 'Temporada',
            'page' => 'Editar Temporada',
            'icon' => 'fa fa-pencil-square-o'
        ];
        if (empty($token)) {
            return redirect()->to('/temporada');
        }

        $data['obj'] = $this->temporada_model->getTemporadaConRelaciones($token);
        if ($data['obj'] == null) {
            return redirect()->to('/temporada');
        };

        $data['area_list'] = $this->area_model->where('valido', true)->where('id_complejo',$data['obj']['id_complejo'])->orderBy('nombre', 'ASC')->findAll();
        $data['turno_list'] = $this->turno_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['categoria_list'] = $this->categoria_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['servicio_list'] = $this->servicio_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        $data['complejo_list'] = $this->complejo_model->where('valido', true)->orderBy('nombre', 'ASC')->findAll();
        return view('temporada/form', $data);
    }

    public function delete($id)
    {
        $this->temporada_model->delete($id);
        return 'Médico eliminado.';
    }
    public function changeStatus($id)
    {
        $estado = $this->request->getPost('estado');
        echo ($this->temporada_model->save(['id_temporada' => $id, 'valido' => $estado==0?false:1]));
    }
}
