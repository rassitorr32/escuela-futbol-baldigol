<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'id_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_rol', 'id_cargo', 'id_persona', 'usuario', 'contraseña', 'estado', 'ultimo_login'];

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

    public function access($user){
        $this->select('*');
        $this->where('usuario',$user);
        $result = $this->first();
        return $result;
    }

    public function getUsuariosWithPersona($id = null)
    {
        if($id == null){
            return $this->join('persona', 'usuario.id_persona = persona.id_persona')
                    ->orderBy('persona.ap_paterno', 'ASC')
                    ->findAll();
        }else{
            return $this->join('persona', 'usuario.id_persona = persona.id_persona')
                    ->where('id_usuario',$id)
                    ->orderBy('persona.ap_paterno', 'ASC')
                    ->first();
        }
    }
}
