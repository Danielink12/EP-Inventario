<?php

namespace App\Controllers;

class Login extends BaseController
{

    public function __construct(){
        $this->$db = \Config\Database::connect();
        helper("utilidades");
    }

    public function index()
    {
        $datos_dinamicos = [
            'title' => 'IEMM - Login',
            'loglogin' => ''
        ];

        return view('login',$datos_dinamicos);
    }

    public function loginweb(){

        $usuario = $_POST['usuario'];
        $pass = $_POST['password'];

        $passencrypt = Encrypt($pass);

        //echo (Decrypt(utf8_decode( 'ÀÆØÐÚFb^`pÊèäÀÐ')));

        $query = $this->$db->query("SELECT * FROM TBUSUARIO WHERE USERN='".$usuario."' AND PASSW='".$passencrypt."'");

        $resultado = $query->getNumRows();
        $datos = $query->getResult();
        
        if($resultado>0){

            $this->response->setStatusCode(200,'Autorizado'); 
            //redirect(base_url() . 'Home/');
            //return view('dashboard');
            $token = otorgarToken();
            $session = \Config\Services::session($config);

            $newdata = [
                'usuario'  => $usuario,
                'nombre' => $datos[0]->NOMBRES,
                'tipousuarioid' => $datos[0]->TIPOUSUARIOID,
                'token'=>$token,
                'logged_in' => TRUE
            ];
            
            $session->set($newdata);
            
            return redirect()->to(site_url('Home'));
        }else{
            //$this->response->setStatusCode(401,'No autorizado');
            //return redirect()->to(site_url('Login'));
            $datos_dinamicos = [
                'title' => 'IEMM - Login',
                'loglogin' => ''
            ];
            echo view('login',$datos_dinamicos);
            echo "<script> badlogin(); </script>";
        }

    }

}
