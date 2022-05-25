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
            if ($this->$session->tipousuarioid == 1){
                $query = $db->query("SELECT PRODUCTOID,PRODUCTO,PRECIOPROVEEDOR,PRECIOVENTA,STOCK FROM TBPRODUCTO");
            }else {
                $query = $db->query("SELECT PRODUCTOID,PRODUCTO,PRECIOVENTA,STOCK FROM TBPRODUCTO");
            }
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $datos_dinamicos = [
                'title' => 'IEMM - Productos',
                'nombresession' => $this->$session->nombre,
                'content' => 'producto',
                'data' => $table->generate($query)
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

}