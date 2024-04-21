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

    public function getPagosWithEstudiantes($id_pago = null)
    {
        if ($id_pago == null) {
            return $this->select('pago.*, costo.valor as valor_total, costo.nro_cuotas_max as nro_cuotas_max, persona.id_persona as per_id_persona, persona.dni as per_dni, persona.extension as per_extension, persona.complemento as per_complemento,
                                persona.nombres as per_nombres, persona.ap_paterno as per_ap_paterno, persona.ap_materno as per_ap_materno, persona.fecha_nac as per_fecha_nac,
                                persona.sexo as per_sexo, persona.direccion as per_direccion, persona.foto as per_foto, persona.nacionalidad per_nacionalidad, estudiante.*, costo.*, 
                                (SELECT COUNT(nro_cuota) FROM pago as pagos WHERE pagos.id_dep = pago.id_pago OR pagos.id_pago = pago.id_pago) AS total_cuota,
                                (SELECT SUM(monto_pagado) FROM pago as pagoss WHERE pagoss.id_dep = pago.id_pago OR pagoss.id_pago = pago.id_pago) AS total_monto,
                                (SELECT MAX(fecha_pago) FROM pago as pagosss WHERE pagosss.id_dep = pago.id_pago OR pagosss.id_pago = pago.id_pago) AS ultimo_pago')
                ->join('persona', 'persona.id_persona = pago.id_persona')
                ->join('tutor', 'pago.id_estudiante = tutor.id_tutor')
                ->join('persona as estudiante', 'estudiante.id_persona = tutor.id_persona')
                ->join('costo', 'costo.id_costo = pago.id_costo')
                ->where('pago.id_dep', null)
                ->orderBy('pago.fecha_pago', 'ASC')
                ->findAll();
        } else {
            return $this->select('pago.*, costo.valor as valor_total, costo.nro_cuotas_max as nro_cuotas_max, persona.id_persona as per_id_persona, persona.dni as per_dni, persona.extension as per_extension, persona.complemento as per_complemento,
                                persona.nombres as per_nombres, persona.ap_paterno as per_ap_paterno, persona.ap_materno as per_ap_materno, persona.fecha_nac as per_fecha_nac,
                                persona.sexo as per_sexo, persona.direccion as per_direccion, persona.foto as per_foto, persona.nacionalidad per_nacionalidad, estudiante.*, costo.*, 
                                (SELECT COUNT(nro_cuota) FROM pago as pagos WHERE pagos.id_dep = pago.id_pago OR pagos.id_pago = pago.id_pago) AS total_cuota,
                                (SELECT SUM(monto_pagado) FROM pago as pagoss WHERE pagoss.id_dep = pago.id_pago OR pagoss.id_pago = pago.id_pago) AS total_monto,
                                (SELECT MAX(fecha_pago) FROM pago as pagosss WHERE pagosss.id_dep = pago.id_pago OR pagosss.id_pago = pago.id_pago) AS ultimo_pago')
                ->join('persona', 'persona.id_persona = pago.id_persona')
                ->join('tutor', 'pago.id_estudiante = tutor.id_tutor')
                ->join('persona as estudiante', 'estudiante.id_persona = tutor.id_persona')
                ->join('costo', 'costo.id_costo = pago.id_costo')
                ->where('pago.id_pago', $id_pago)
                ->orWhere('pago.id_dep', $id_pago) // Aquí agregas la condición OR
                ->orderBy('pago.fecha_pago', 'ASC')
                ->findAll();
        }
    }
}
