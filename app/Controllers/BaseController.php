<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\PersonaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['general'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $configuracion_model = new ConfiguracionModel();
        $persona_model = new PersonaModel();
        $user_model = new UsuarioModel();
        if (session('usuario') != null) {
            $data['usuario'] = $user_model->find(session('id_usuario'));
            $persona = $persona_model->find($data['usuario']['id_persona']);
            //Une los datos para guardar en la sesion
            // Eliminar el elemento 'contraseña'
            unset($data['usuario']['contraseña']);
            $data['usuario'] = array_merge((array)$data['usuario'], (array)$persona);
            $data['configuracion'] = $configuracion_model->find($data['usuario']['id_usuario']);
            session()->set('usuario', $data['usuario']);
            session()->set('configuracion', $data['configuracion']);
        }
    }
}
