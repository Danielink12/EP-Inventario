<?php

namespace App\Controllers;

class Entradasalida extends BaseController
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
            $query = $db->query("SELECT *,PRO.PRODUCTO,TP.TIPOPROCESO FROM TBINGRESOSYSALIDAS EYS INNER JOIN TBTIPOPROCESO TP ON EYS.TIPOPROCESOID=TP.TIPOPROCESOID INNER JOIN TBPRODUCTO PRO ON EYS.PRODUCTOID=PRO.PRODUCTOID");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('ESID', 'PRODUCTO', 'CANTIDAD','TIPO PROCESO','ACCIONES');

            foreach ($query->getResult() as $row) {
                $row->IYSID;
                $row->PRODUCTO;
                $row->CANTIDAD;
                $row->TIPOPROCESO;

                $links  = '<a class="btn btn-primary" href="Entradasalida/vistaEditarES/'.$row->IYSID.'" role="button">EDITAR</a>';
                $links .= '<a class="btn btn-danger" href="Entradasalida/eliminarES/'.$row->IYSID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->IYSID,$row->PRODUCTO,$row->CANTIDAD,$row->TIPOPROCESO,$links);
            }

            $datos_dinamicos = [
                'title' => 'IEMM - Entradas y Salidas',
                'nombresession' => $this->$session->nombre,
                'content' => 'entradasalida',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearES(){
        $db = \Config\Database::connect();
        $producto = $db->query("SELECT * FROM TBPRODUCTO");
        $tipoproceso = $db->query("SELECT * FROM TBTIPOPROCESO");

        $datos_dinamicos = [
            'title' => 'IEMM - Nueva ENTRADA/SALIDA',
            'nombresession' => $this->$session->nombre,
            'content' => 'creareditarEntradaSalida',
            'seccion' => 'NUEVA ENTRADA/SALIDA',
            'txtbtn' => 'CREAR ENTRADA/SALIDA',
            'producto' => $producto,
            'tipoproceso' => $tipoproceso,
            'urlpost' => 'http://localhost:8080/EP/public/Entradasalida/crearES'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearES(){
        $db = \Config\Database::connect();

        $productoid = $_POST['productoid'];
        $cantidad = $_POST['cantidad'];
        $tipoprocesoid = $_POST['tipoprocesoid'];

        try {
            //code...
            $query = $db->query("INSERT INTO TBINGRESOSYSALIDAS (PRODUCTOID,CANTIDAD,TIPOPROCESOID,USUARIOREGID) VALUES(".$productoid.",".$cantidad.",".$tipoprocesoid.",".$this->$session->usuarioid.")");
            return redirect()->to(site_url('Entradasalida'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarES($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM TBINGRESOSYSALIDAS WHERE IYSID=".$id);
        $producto = $db->query("SELECT * FROM TBPRODUCTO");
        $tipoproceso = $db->query("SELECT * FROM TBTIPOPROCESO");
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'IEMM - Editar ESNTRADA/SALIDA',
            'nombresession' => $this->$session->nombre,
            'content' => 'creareditarEntradaSalida',
            'datosES' => $resultado,
            'seccion' => 'EDITAR ENTRADA/SALIDA',
            'txtbtn' => 'GURDAR CAMBIOS',
            'producto' => $producto,
            'tipoproceso' => $tipoproceso,  
            'urlpost' => 'http://localhost:8080/EP/public/Entradasalida/editarES'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarES(){
        $db = \Config\Database::connect();

        $esid= $_POST['esid'];
        $productoid = $_POST['productoid'];
        $cantidad = $_POST['cantidad'];
        $tipoprocesoid = $_POST['tipoprocesoid'];

        try {
            //code...
            $query = $db->query("UPDATE TBINGRESOSYSALIDAS SET PRODUCTOID=".$productoid.",CANTIDAD=".$cantidad.",TIPOPROCESOID=".$tipoprocesoid." WHERE IYSID=".$esid);
            return redirect()->to(site_url('Entradasalida'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarES($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM TBINGRESOSYSALIDAS WHERE IYSID=".$id);
            return redirect()->to(site_url('Entradasalida'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}