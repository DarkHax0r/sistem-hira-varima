<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_login;
use CodeIgniter\HTTP\ResponseInterface;

class Frontend extends BaseController
{
    public function index()
    {
        return view('Auth/login');
    }

    public function register(){
        return view('Auth/v_register');
    }

    public function admin(){
        echo view('main-content/filter');
        echo view('admin/sidebar');
    }

    public function main(){
        return view('main-content/filter');
    }

    
    

}
