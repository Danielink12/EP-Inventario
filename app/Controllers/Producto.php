<?php

namespace App\Controllers;

class Producto extends BaseController
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
            $query = $db->query("SELECT PRODUCTOID,PRODUCTO,PRECIOPROVEEDOR,PRECIOVENTA,STOCK FROM TBPRODUCTO");
    
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            if ($this->$session->tipousuarioid == 1){
                $table->setHeading('PRODUCTOID', 'PRODUCTO', 'PRECIOPROVEEDOR','PRECIOVENTA','STOCK','ACCIONES');
                foreach ($query->getResult() as $row) {
                    $row->PRODUCTOID;
                    $row->PRODUCTO;
                    $row->PRECIOPROVEEDOR;
                    $row->PRECIOVENTA;
                    $row->STOCK;
    
                    $links  = '<a class="btn btn-primary" href="Producto/vistaEditarProducto/'.$row->PRODUCTOID.'" role="button">EDITAR</a>';
                    $links .= '<a class="btn btn-danger" href="Producto/eliminarProducto/'.$row->PRODUCTOID.'" role="button">ELIMINAR</a>';
    
                    $table->addRow($row->PRODUCTOID,$row->PRODUCTO,$row->PRECIOPROVEEDOR,$row->PRECIOVENTA,$row->STOCK,$links);
                }
    
            }else {
                $table->setHeading('PRODUCTOID', 'PRODUCTO','PRECIOVENTA','STOCK');
                foreach ($query->getResult() as $row) {
                    $row->PRODUCTOID;
                    $row->PRODUCTO;
                    $row->PRECIOVENTA;
                    $row->STOCK;

                    $table->addRow($row->PRODUCTOID,$row->PRODUCTO,$row->PRECIOVENTA,$row->STOCK);
                }
    
            }

            $datos_dinamicos = [
                'title' => 'IEMM - Productos',
                'nombresession' => $this->$session->nombre,
                'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'producto',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearProducto(){
        $db = \Config\Database::connect();
        $marca = $db->query("SELECT * FROM TBMARCA");
        $categoria = $db->query("SELECT * FROM TBCATEGORIA");

        $datos_dinamicos = [
            'title' => 'IEMM - Nuevo Producto',
            'nombresession' => $this->$session->nombre,
            'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarProducto',
            'seccion' => 'NUEVO PRODUCTO',
            'txtbtn' => 'CREAR PRODUCTO',
            'marca' => $marca,
            'categoria' => $categoria,
            'nuevo' => true,
            'urlpost' => 'http://localhost:8080/EP/public/Producto/crearProducto'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearProducto(){
        $db = \Config\Database::connect();

        $nombre = $_POST['nombreproducto'];
        $stock = $_POST['stock'];
        $preciopro = $_POST['precioproveedor'];
        $precioventa = $_POST['precioventa'];
        $ancho = $_POST['ancho'];
        $alto = $_POST['alto'];
        $marcaid = $_POST['marcaid'];
        $categoriaid = $_POST['categoriaid'];
        $estado = $_POST['estadoproducto'];

        if ($estado=="on"){
            $estadoid = true;
        }else{
            $estadoid = false;
        }

        try {
            //code...
            $query = $db->query("INSERT INTO TBPRODUCTO (MARCAID,CATEGORIAID,PRODUCTO,PRECIOPROVEEDOR,PRECIOVENTA,STOCK,ANCHO,ALTO,ESTADOID) VALUES(".$marcaid.",".$categoriaid.",'".$nombre."',".$preciopro.",".$precioventa.",".$stock.",".$ancho.",".$alto.",1)");
            return redirect()->to(site_url('Producto'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarProducto($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT *,CASE WHEN ESTADOID=1 THEN 'checked' END AS ESTADO2 FROM TBPRODUCTO WHERE PRODUCTOID=".$id);
        $marca = $db->query("SELECT * FROM TBMARCA");
        $categoria = $db->query("SELECT * FROM TBCATEGORIA");
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'IEMM - Editar Producto',
            'nombresession' => $this->$session->nombre,
            'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarProducto',
            'datosProducto' => $resultado,
            'seccion' => 'EDITAR PRODUCTO',
            'txtbtn' => 'GURDAR CAMBIOS',
            'marca' => $marca,
            'categoria' => $categoria,
            'urlpost' => 'http://localhost:8080/EP/public/Producto/editarProducto'
        ];
        
        return view('dashboard',$datos_dinamicos);

    }

    public function editarProducto(){
        $db = \Config\Database::connect();

        $productoid = $_POST['productoid'];
        $nombre = $_POST['nombreproducto'];
        $stock = $_POST['stock'];
        $preciopro = $_POST['precioproveedor'];
        $precioventa = $_POST['precioventa'];
        $ancho = $_POST['ancho'];
        $alto = $_POST['alto'];
        $marcaid = $_POST['marcaid'];
        $categoriaid = $_POST['categoriaid'];
        $estado = $_POST['estadoproducto'];

        if ($estado=="on"){
            $estadoid = true;
        }else{
            $estadoid = false;
        }

        try {
            //code...
            //echo "UPDATE TBPRODUCTO SET MARCAID=".$marcaid.",CATEGORIAID=".$categoriaid.",PRODUCTO='".$nombre."',PRECIOPROVEEDOR=".$preciopro.",PRECIOVENTA=".$precioventa.",STOCK=".$stock.",ANCHO=".$ancho.",ALTO=".$alto.",ESTADOID=".$estadoid.",USUARIOREGID=".$this->$session->usuarioid." WHERE PRODUCTOID=".$productoid;
            $query = $db->query("UPDATE TBPRODUCTO SET MARCAID=".$marcaid.",CATEGORIAID=".$categoriaid.",PRODUCTO='".$nombre."',PRECIOPROVEEDOR=".$preciopro.",PRECIOVENTA=".$precioventa.",STOCK=".$stock.",ANCHO=".$ancho.",ALTO=".$alto.",ESTADOID=".$estadoid.",USUARIOREGID=".$this->$session->usuarioid." WHERE PRODUCTOID=".$productoid);
            return redirect()->to(site_url('Producto'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarProducto($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM TBPRODUCTO WHERE PRODUCTOID=".$id);
            return redirect()->to(site_url('Producto'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}