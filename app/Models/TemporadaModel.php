<?php

namespace App\Models;

use CodeIgniter\Model;

class TemporadaModel extends Model
{
    protected $table            = 'temporada';
    protected $primaryKey       = 'id_temporada';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_area', 'id_turno', 'id_categoria', 'id_servicio', 'tipo_temporada', 'nombre', 'fecha_inicio', 'fecha_fin', 'valido'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTemporadaAreaComplejo($id = null)
    {
        if($id == null)
        {
            return $this->select('temporada.*, area.nombre as area_nombre, area.cap_max as area_cap_max, area.valido as area_valido, area.id_temporada as id_temporada
                                complejo.nombre as complejo_nombre, complejo.descripcion as complejo_descripcion, complejo.valido as complejo_valido')
                        ->join('area', 'temporada.id_area = area.id_area')
                        ->join('complejo', 'area.id_complejo = complejo.id_complejo')
                        ->orderBy('temporada.fecha_inicio', 'ASC')
                        ->findAll();
        }
        else
        {
            return $this->select('temporada.*, area.nombre as area_nombre, area.cap_max as area_cap_max, area.valido as area_valido, area.id_complejo as id_complejo,
                                complejo.nombre as complejo_nombre, complejo.descripcion as complejo_descripcion, complejo.valido as complejo_valido')
                        ->join('area', 'temporada.id_area = area.id_area')
                        ->join('complejo', 'area.id_complejo = complejo.id_complejo')
                        ->where('temporada.id_temporada', $id)
                        ->orderBy('temporada.fecha_inicio', 'DESC')
                        ->first();
        }
    }

    public function getTemporadaConRelaciones($id = null)
    {
        if($id == null)
        {
            return $this->select('temporada.*, servicio.tipo_servicio as servicio_tipo_servicio, servicio.nombre as servicio_nombre, servicio.descripcion as servicio_descripcion, servicio.id_dep as servicio_id_dep, servicio.valido as servicio_valido, servicio.id_costo as id_costo,
                                costo.tipo_costo as costo_tipo_costo, costo.fecha_inicio as costo_fecha_inicio, costo.fecha_final as costo_fecha_final, costo.valor as costo_valor, costo.nro_cuotas_max as costo_nro_cuotas_max, costo.valido as costo_valido, 
                                area.nombre as area_nombre, area.cap_max as area_cap_max, area.valido as area_valido, area.id_complejo as id_complejo,
                                complejo.nombre as complejo_nombre, complejo.descripcion as complejo_descripcion, complejo.valido as complejo_valido')
                        ->join('servicio', 'temporada.id_servicio = servicio.id_servicio')
                        ->join('costo', 'servicio.id_costo = costo.id_costo')
                        ->join('area', 'temporada.id_area = area.id_area')
                        ->join('complejo', 'area.id_complejo = complejo.id_complejo')
                        ->orderBy('temporada.fecha_inicio', 'ASC')
                        ->findAll();
        }
        else
        {
            return $this->select('temporada.*, servicio.tipo_servicio as servicio_tipo_servicio, servicio.nombre as servicio_nombre, servicio.descripcion as servicio_descripcion, servicio.id_dep as servicio_id_dep, servicio.valido as servicio_valido, costo.id_costo as id_costo,
                                costo.tipo_costo as costo_tipo_costo, costo.fecha_inicio as costo_fecha_inicio, costo.fecha_final as costo_fecha_final, costo.valor as costo_valor, costo.nro_cuotas_max as costo_nro_cuotas_max, costo.valido as costo_valido,
                                area.nombre as area_nombre, area.cap_max as area_cap_max, area.valido as area_valido, area.id_complejo as id_complejo,
                                complejo.nombre as complejo_nombre, complejo.descripcion as complejo_descripcion, complejo.valido as complejo_valido')
                        ->join('servicio', 'temporada.id_servicio = servicio.id_servicio')
                        ->join('costo', 'servicio.id_servicio = costo.id_servicio')
                        ->join('area', 'temporada.id_area = area.id_area')
                        ->join('complejo', 'area.id_complejo = complejo.id_complejo')
                        ->where('temporada.id_temporada', $id)
                        ->orderBy('temporada.fecha_inicio', 'DESC')
                        ->first();
        }
    }
}
