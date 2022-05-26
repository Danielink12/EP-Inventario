<?php

namespace App\Controllers;

class Categoria extends BaseController
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
            $query = $db->query("SELECT * FROM TBCATEGORIA");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('CATEGORIAID', 'CATEGORIA', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                $row->CATEGORIAID;
                $row->CATEGORIA;

                $links  = '<a class="btn btn-primary" href="Categoria/vistaEditarCategoria/'.$row->CATEGORIAID.'" role="button">EDITAR</a>';
                $links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->CATEGORIAID,$row->CATEGORIA,$links);
            }

            $datos_dinamicos = [
                'title' => 'IEMM - Categorias',
                'nombresession' => $this->$session->nombre,
                'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'categoria',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearCategoria(){
        $datos_dinamicos = [
            'title' => 'IEMM - Nueva Categoria',
            'nombresession' => $this->$session->nombre,
            'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarCategoria',
            'seccion' => 'NUEVA CATEGORIA',
            'txtbtn' => 'CREAR CATEGORIA',
            'urlpost' => '/EP/public/Categoria/crearCategoria'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearCategoria(){
        $db = \Config\Database::connect();

        $nombres = $_POST['nombre'];

        try {
            //code...
            $query = $db->query("INSERT INTO TBCATEGORIA (CATEGORIA) VALUES('".$nombres."')");
            return redirect()->to(site_url('Categoria'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarCategoria($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM TBCATEGORIA WHERE CATEGORIAID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'IEMM - Editar Categoria',
            'nombresession' => $this->$session->nombre,
            'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarCategoria',
            'datosCategoria' => $resultado,
            'seccion' => 'EDITAR CATEGORIA',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => '/EP/public/Categoria/editarCategoria'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarCategoria(){
        $db = \Config\Database::connect();

        $categoriaid= $_POST['categoriaid'];
        $nombre = $_POST['nombre'];

        try {
            //code...
            $query = $db->query("UPDATE TBCATEGORIA SET CATEGORIA='".$nombre."' WHERE CATEGORIAID=".$categoriaid);
            return redirect()->to(site_url('Categoria'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarCategoria($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM TBCATEGORIA WHERE CATEGORIAID=".$id);
            return redirect()->to(site_url('Categoria'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}