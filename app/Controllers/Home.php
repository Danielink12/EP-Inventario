<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct(){
        $this->$db = \Config\Database::connect();
        $this->$session = session();
        helper("utilidades");
    }
    public function index()
    {

       /* $newdata = [
            'usuario'  => 'administrador',
            'logged_in' => true,
        ];

        $this->$session->set($newdata);*/

        //unset($this->$session);

        try {
            decodeToken($this->$session->token);
        } catch (\Throwable $th) {
            cerrarSesion();
        }
        
        $datos_dinamicos = [
            'title' => 'IEMM - Dashboard',
            'nombresession' => $this->$session->nombre,
            'content' => 'reporte'
        ];

        if(isset($this->$session->usuario)){

            return view('dashboard',$datos_dinamicos);
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

}
