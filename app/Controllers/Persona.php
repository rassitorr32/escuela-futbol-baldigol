<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PersonaModel;

class Persona extends BaseController
{
    private $persona_model;

    function __construct()
    {
        $this->persona_model = new PersonaModel();
    }
    public function index()
    {
        //
    }
    public function getPersonasJSON($idPersona=null){
        if($idPersona!=null){
            $list_persona = $this->persona_model->where('id_persona',$idPersona)->first();
            return json_encode($list_persona);
        }else{
            $list_persona = $this->persona_model->findAll();
            return json_encode($list_persona);
        }
    }
}
