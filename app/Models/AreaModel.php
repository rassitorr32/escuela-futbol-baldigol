<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table            = 'area';
    protected $primaryKey       = 'id_area';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'id_complejo', 'cap_max', 'valido'];

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

    public function getAreaWithComplejo($id = null)
    {
        if ($id == null) {
            return $this->select('area.*, complejo.nombre AS complejo_nombre, complejo.descripcion AS complejo_descripcion, complejo.valido AS complejo_valido,')
            ->join('complejo', 'area.id_complejo = complejo.id_complejo')
            ->where('complejo.valido','1')
            ->orderBy('area.nombre', 'ASC')
            ->findAll();
        } else {
            return $this->select('area.*, complejo.nombre AS complejo_nombre, complejo.descripcion AS complejo_descripcion, complejo.valido AS complejo_valido,')
                ->join('complejo', 'area.id_complejo = complejo.id_complejo')
                ->where('area.id_area', $id)
                ->where('complejo_valido','1')
                ->orderBy('area.nombre', 'ASC')
                ->first();
        }
    }
}
