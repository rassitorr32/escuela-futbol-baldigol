<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Error extends BaseController
{
    public function index()
    {
        return view('404');
    }
}
