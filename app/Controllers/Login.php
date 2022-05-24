<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $datos_dinamicos = [
            'title' => 'IEMM - Login'
        ];

        return view('login',$datos_dinamicos);
    }
}
