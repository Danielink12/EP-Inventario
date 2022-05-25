<?php

namespace App\Controllers;

class Usuario extends BaseController
{

    public function __construct(){
        $this->$session = session();
        helper("utilidades");
    }
    
    public function index()
    {

        try {
            decodeToken($this->$session->token);
        } catch (\Throwable $th) {
            cerrarSesion();
        }
        

        if(isset($this->$session->usuario)){
        
            $db = \Config\Database::connect();
            $table = new \CodeIgniter\View\Table();
            $query = $db->query("SELECT NOMBRES,APELLIDOS,USERN AS USUARIO,TU.TIPOUSUARIO FROM TBUSUARIO U INNER JOIN TBTIPOUSUARIO TU ON U.TIPOUSUARIOID=TU.TIPOUSUARIOID ");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $datos_dinamicos = [
                'title' => 'IEMM - Usuarios',
                'nombresession' => $this->$session->nombre,
                'content' => 'usuario',
                'data' => $table->generate($query)
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

}