<?php

namespace App\Controllers;

class Marca extends BaseController
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
            $query = $db->query("SELECT * FROM TBMARCA");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('MARCAID', 'MARCA', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                $row->MARCAID;
                $row->MARCA;

                $links  = '<a class="btn btn-primary" href="Marca/vistaEditarMarca/'.$row->MARCAID.'" role="button">EDITAR</a>';
                $links .= '<a class="btn btn-danger" href="Marca/eliminarMarca/'.$row->MARCAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->MARCAID,$row->MARCA,$links);
            }

            $datos_dinamicos = [
                'title' => 'IEMM - Marcas',
                'nombresession' => $this->$session->nombre,
                'content' => 'marca',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearMarca(){
        $datos_dinamicos = [
            'title' => 'IEMM - Nueva Marca',
            'nombresession' => $this->$session->nombre,
            'content' => 'creareditarMarca',
            'seccion' => 'NUEVA MARCA',
            'txtbtn' => 'CREAR MARCA',
            'urlpost' => 'http://localhost:8080/EP/public/Marca/crearMarca'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearMarca(){
        $db = \Config\Database::connect();

        $nombres = $_POST['nombre'];

        try {
            //code...
            $query = $db->query("INSERT INTO TBMARCA (MARCA) VALUES('".$nombres."')");
            return redirect()->to(site_url('Marca'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarMarca($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM TBMARCA WHERE MARCAID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'IEMM - Editar Marca',
            'nombresession' => $this->$session->nombre,
            'content' => 'creareditarMarca',
            'datosMarca' => $resultado,
            'seccion' => 'EDITAR MARCA',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'http://localhost:8080/EP/public/Marca/editarMarca'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarMarca(){
        $db = \Config\Database::connect();

        $marcaid= $_POST['marcaid'];
        $nombre = $_POST['nombre'];

        try {
            //code...
            $query = $db->query("UPDATE TBMARCA SET MARCA='".$nombre."' WHERE MARCAID=".$marcaid);
            return redirect()->to(site_url('Marca'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarMarca($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM TBMARCA WHERE MARCAID=".$id);
            return redirect()->to(site_url('Marca'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}