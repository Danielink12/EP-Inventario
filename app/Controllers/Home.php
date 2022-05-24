<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session($config);

       /* $newdata = [
            'usuario'  => 'administrador',
            'logged_in' => true,
        ];

        $session->set($newdata);*/

        //unset($session);
        
        $datos_dinamicos = [
            'title' => 'IEMM - Dashboard',
            'content' => 'welcome.php'
        ];

        return view('dashboard',$datos_dinamicos);

        /*if(isset($session->usuario)){

            return view('dashboard',$datos_dinamicos);
        }else{
            return redirect()->to(site_url('Login'));
        }*/
    }
}
