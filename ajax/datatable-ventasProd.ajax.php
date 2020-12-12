<?php


require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";






class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosVentas(){

        $item = null;
        $valor = null;
        $orden = "id";

        $productos = ControladorProductos::ctrMostrarProductos($item,$valor, $orden);

        
        

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($productos); $i++){

               
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
                $botones = "<div class='btn-group'><button class='btn btn-info agregarProducto recuperarBotonProducto' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>";

                $datosJson .='[
                    "'.($i+1).'",
                    "'.$productos[$i]["descripcion"].'",
                    "$ '.$productos[$i]["precio_venta"].'",
                     "'.$stock.'",
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
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();

