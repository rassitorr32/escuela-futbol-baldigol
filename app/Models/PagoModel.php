<?php

namespace App\Models;

use CodeIgniter\Model;

class PagoModel extends Model
{
    protected $table            = 'pago';
    protected $primaryKey       = 'id_pago';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['concepto', 'monto', 'fecha_ingreso', 'fecha_fin', 'id_usuario', 'id_estudiante'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
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

    public function getPagosWithEstudiantes()
    {
        // return $this->join('persona', 'persona.id_persona = pago.id_persona')
        //             ->join('tutor', 'pago.id_estudiante = tutor.id_tutor')
        //             ->join('persona as estudiante', 'estudiante.id_persona = tutor.id_persona')
        //             ->join('costo', 'costo.id_costo = pago.id_costo')
        //             ->orderBy('pago.id_pago', 'ASC')
        //             ->where('pago.id_dep','null')
        //             ->findAll();
        // return $this->join('persona', 'persona.id_persona = pago.id_persona')
        //             ->join('tutor', 'pago.id_estudiante = tutor.id_tutor')
        //             ->join('persona as estudiante', 'estudiante.id_persona = tutor.id_persona')
        //             ->join('costo', 'costo.id_costo = pago.id_costo')
        //             ->where('pago.id_dep', null) // Aquí corregimos el valor null para que no sea una cadena sino el valor NULL
        //             ->orderBy('pago.fecha_pago', 'ASC')
        //             ->findAll();
    
        // return $this->select('pago.id_costo')
        // // ->from('pago')
        // ->join('persona', 'persona.id_persona = pago.id_persona', 'left')
        // ->groupStart()
        //     ->where('pago.id_dep', 'null')
        //     // ->orGroupStart()
        //     //     ->where('b', 'b')
        //     //     ->where('c', 'c')
        //     // ->groupEnd()
        // ->groupEnd()
        // // ->where('d', 'd')
        // ->groupBy('pago.id_costo') // Agrupar por id_costo
        // ->findAll();

        return $this->select('pago.*, persona.*, estudiante.*, costo.*, 
                     (SELECT SUM(nro_cuota) FROM pago as pagos WHERE pagos.id_dep = pago.id_pago OR pagos.id_pago = pago.id_pago) AS total_cuota,
                     (SELECT SUM(monto_pagado) FROM pago as pagoss WHERE pagoss.id_dep = pago.id_pago OR pagoss.id_pago = pago.id_pago) AS total_monto')
            ->join('persona', 'persona.id_persona = pago.id_persona')
            ->join('tutor', 'pago.id_estudiante = tutor.id_tutor')
            ->join('persona as estudiante', 'estudiante.id_persona = tutor.id_persona')
            ->join('costo', 'costo.id_costo = pago.id_costo')
            ->where('pago.id_dep', null)
            ->orderBy('pago.fecha_pago', 'ASC')
            ->findAll();

    }
}
