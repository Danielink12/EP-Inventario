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

                if($this->$session->tipousuarioid==1){
                    $db = \Config\Database::connect();
                $table = new \CodeIgniter\View\Table();
                $query = $db->query("SELECT USUARIOID,NOMBRES,APELLIDOS,USERN AS USUARIO,TU.TIPOUSUARIO FROM TBUSUARIO U INNER JOIN TBTIPOUSUARIO TU ON U.TIPOUSUARIOID=TU.TIPOUSUARIOID ");
                $resultado = $query->getResult();

                $template = [
                    'table_open' => '<table id="example" class="table table-hover" style="width:100%">',
                ];
                
                $table->setTemplate($template);
                
                $table->setHeading('NOMBRES', 'APELLIDOS', 'USUARIO','TIPO USUARIO','ACCIONES');

                foreach ($query->getResult() as $row) {
                    $row->USUARIOID;
                    $row->NOMBRES;
                    $row->APELLIDOS;
                    $row->USERN;

                    $links  = '<a class="btn btn-primary" href="Usuario/vistaEditarUsuario/'.$row->USUARIOID.'" role="button">EDITAR</a>';
                    $links .= '<a class="btn btn-danger" href="Usuario/eliminarUsuario/'.$row->USUARIOID.'" role="button">ELIMINAR</a>';

                    $table->addRow($row->NOMBRES,$row->APELLIDOS,$row->USUARIO,$row->TIPOUSUARIO,$links);
                }

                $datos_dinamicos = [
                    'title' => 'IEMM - Usuarios',
                    'nombresession' => $this->$session->nombre,
                    'tipousuarioid' => $this->$session->tipousuarioid,
                    'content' => 'usuario',
                    'data' => $table->generate()
                ];
                
                return view('dashboard',$datos_dinamicos);
            }else{
                $datos_dinamicos = [
                    'title' => 'IEMM - Usuarios',
                    'nombresession' => $this->$session->nombre,
                    'tipousuarioid' => $this->$session->tipousuarioid,
                    'content' => '404',
                    //'data' => $table->generate()
                ];
                
                return view('dashboard',$datos_dinamicos);
            }
        
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearUsuario(){
        $datos_dinamicos = [
            'title' => 'IEMM - Nuevo Usuario',
            'nombresession' => $this->$session->nombre,
            'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarUsuario',
            'seccion' => 'NUEVO USUARIO',
            'txtbtn' => 'CREAR USUARIO',
            'nuevo' => true,
            'urlpost' => 'http://localhost:8080/EP/public/Usuario/crearUsuario'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearUsuario(){
        $db = \Config\Database::connect();

        $userid= $_POST['userid'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $usern = $_POST['usuario'];
        $passw = $_POST['pass'];
        $tipousuarioid = $_POST['tipousuario'];
        $estado = $_POST['estadousuario'];

        if ($estado=="on"){
            $estadoid = true;
        }else{
            $estadoid = false;
        }

        $passw = Encrypt($passw);
        
        //$query = $db->query("SELECT * FROM TBUSUARIO WHERE USUARIOID=".$userid);
        //$resultado = $query->getResult();

        try {
            //code...
            //echo "UPDATE TBUSUARIO SET NOMBRES='".$nombres."',APELLIDOS='".$apellidos."',TELEFONO='".$telefono."',USERN='".$usern."',PASSW='".$passw."',TIPOUSUARIOID=".$tipousuarioid.",ESTADOID=".$estadoid.",USUARIOMODID=".$this->$session->usuarioid.",FECHAMOD=GETDATE() WHERE USUARIOID=".$userid;
            $query = $db->query("INSERT INTO TBUSUARIO (NOMBRES,APELLIDOS,TELEFONO,USERN,PASSW,TIPOUSUARIOID,ESTADOID,USUARIOREGID) VALUES('".$nombres."','".$apellidos."','".$telefono."','".$usern."','".$passw."',".$tipousuarioid.",1,".$this->$session->usuarioid.")");
            return redirect()->to(site_url('Usuario'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarUsuario($id){

        $db = \Config\Database::connect();
        $query = $db->query("SELECT USUARIOID,NOMBRES,APELLIDOS,TELEFONO,USERN,PASSW,CASE WHEN U.ESTADOID=1 THEN 'checked' END AS ESTADO, CASE WHEN TU.TIPOUSUARIOID=1 THEN 'selected' END AS TUADMIN,CASE WHEN TU.TIPOUSUARIOID=2 THEN 'selected' END AS TUOPERADOR FROM TBUSUARIO U INNER JOIN TBTIPOUSUARIO TU ON U.TIPOUSUARIOID=TU.TIPOUSUARIOID WHERE USUARIOID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'IEMM - Editar Usuario',
            'nombresession' => $this->$session->nombre,
            'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarUsuario',
            'datosUsuario' => $resultado,
            'seccion' => 'EDITAR USUARIO',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'http://localhost:8080/EP/public/Usuario/editarUsuario'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarUsuario(){
        $db = \Config\Database::connect();

        $userid= $_POST['userid'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $usern = $_POST['usuario'];
        $passw = $_POST['pass'];
        $tipousuarioid = $_POST['tipousuario'];
        $estado = $_POST['estadousuario'];

        if ($estado=="on"){
            $estadoid = true;
        }else{
            $estadoid = false;
        }
        
        $query = $db->query("SELECT * FROM TBUSUARIO WHERE USUARIOID=".$userid);
        $resultado = $query->getResult();

        if($resultado[0]->PASSW==$passw){
            //return redirect()->to(site_url('Home'));
        }else{
            $passw = Encrypt($passw);
        }

        try {
            //code...
            //echo "UPDATE TBUSUARIO SET NOMBRES='".$nombres."',APELLIDOS='".$apellidos."',TELEFONO='".$telefono."',USERN='".$usern."',PASSW='".$passw."',TIPOUSUARIOID=".$tipousuarioid.",ESTADOID=".$estadoid.",USUARIOMODID=".$this->$session->usuarioid.",FECHAMOD=GETDATE() WHERE USUARIOID=".$userid;
            $query = $db->query("UPDATE TBUSUARIO SET NOMBRES='".$nombres."',APELLIDOS='".$apellidos."',TELEFONO='".$telefono."',USERN='".$usern."',PASSW='".$passw."',TIPOUSUARIOID=".$tipousuarioid.",ESTADOID=".$estadoid.",USUARIOMODID=".$this->$session->usuarioid.",FECHAMOD=GETDATE() WHERE USUARIOID=".$userid);
            return redirect()->to(site_url('Usuario'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarUsuario($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM TBUSUARIO WHERE USUARIOID=".$id);
            return redirect()->to(site_url('Usuario'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}