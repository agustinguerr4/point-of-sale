<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";






class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

        $item = null;
        $valor = null;
        $orden = "id";

        $productos = ControladorProductos::ctrMostrarProductos($item,$valor, $orden);

        
        

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($productos); $i++){

               

                /*=============================================
                TRAEMOS LA CATEGORIA
                =============================================*/ 
                $item = "id";
                $valor = $productos[$i]["id_categoria"];
                $categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);

                /*=============================================
                TRAEMOS LA IMAGEN
                =============================================*/ 

                $imagen = "<img src='".$productos[$i]["imagen"]."' class='img-thumbnail' width='40px'>";


                /*=============================================
                STOCK
                =============================================*/ 

                if($productos[$i]["stock"] <= 10){
                    $stock = "<button class='btn btn-danger' data-toggle='popover' title='Reponer Stock!' data-content='Estás quedándote sin stock. Debes reponerlo.'>".$productos[$i]["stock"]."</button>";
                }else if($productos[$i]["stock"] >11 && $productos[$i]["stock"] < 20){
                    $stock = "<button class='btn btn-warning' title='Cuidado! Estás quedándote con poco stock'>".$productos[$i]["stock"]."</button>";
                }else{
                    $stock = "<button class='btn btn-success' title='Estás bien!'>".$productos[$i]["stock"]."</button>";
                }
                

                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 
                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";


                $datosJson .='[
                    "'.($i+1).'",
                    "'.$imagen.'",
                    "'.$productos[$i]["codigo"].'",
                    "'.$productos[$i]["descripcion"].'",
                    "'.$categorias['categoria'].'",
                    "'.$stock.'",
                    "$'.$productos[$i]["precio_compra"].'",
                    "$'.$productos[$i]["precio_venta"].'",
                    "'.$productos[$i]["fecha"].'",
                    "'.$botones.'"
                ],';

            }
            $datosJson = substr($datosJson, 0, -1);
            $datosJson .=']
         }';

         
         echo $datosJson;


         

        
        
        

		


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

