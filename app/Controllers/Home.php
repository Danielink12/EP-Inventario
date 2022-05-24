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
        
        $datos_dinamicos = [
            'title' => 'IEMM - Dashboard',
            'content' => 'welcome.php'
        ];

        if(isset($this->$session->usuario)){

            return view('dashboard',$datos_dinamicos);
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function cerrarSesion(){
        $array_items = ['usuario', 'token','logged_in'];
        $this->$session->remove($array_items);
        //unset($this->$session);
        return redirect()->to(site_url('Home'));
    }
}
