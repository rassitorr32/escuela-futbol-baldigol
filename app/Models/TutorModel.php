<?php

namespace App\Models;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

class TutorModel extends Model
{
    protected $table            = 'tutor';
    protected $primaryKey       = 'id_tutor';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_persona', 'tipo_tutor', 'descripcion', 'id_dep', 'valido'];

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

    public function getTutoresWithPersona($id = null)
    {
        if($id == null)
        {
            return $this->join('persona', 'tutor.id_persona = persona.id_persona')
                    //Evitar que aparezcan personas que no son estudiantes
                    ->whereNotIn('tutor.id_persona', function(BaseBuilder $builder) {
                        $builder->select('usuario.id_persona')
                                ->from('usuario');
                    })
                    ->where('tutor.tipo_tutor','tutor')
                    ->orderBy('persona.ap_paterno', 'ASC')
                    ->findAll();
        }
        else
        {
            return $this->join('persona', 'tutor.id_persona = persona.id_persona')
                    ->where('tutor.id_tutor', $id)
                    ->orderBy('persona.ap_paterno', 'ASC')
                    ->first();
        }
    }
}
