<?php


require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class TablaVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE VENTAS
  	=============================================*/ 

	public function mostrarTablaVentas(){

     
    if(isset($_GET["fechaInicial"])){

        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
    }else{
        $fechaInicial = null;
        $fechaFinal = null;
    }
    
      $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);


      if($respuesta != ""){

        
       $datosJson = '{"data":[';

        for($i=0;$i < count($respuesta);$i++){


            
            $item = "id";
            $valor = $respuesta[$i]["id_cliente"];
            $cliente = ControladorClientes::ctrMostrarClientes($item,$valor);
        
            $valor2 = $respuesta[$i]["id_vendedor"];
            $vendedor = ControladorUsuarios::ctrMostrarUsuarios($item,$valor2);

            $botones = "<button class='btn btn-warning btnEditarVenta' idVenta='".$respuesta[$i]['id']."'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarVenta' idVenta='".$respuesta[$i]['id']."'><i class='fa fa-times'></i></button>";
                          
                

  

            $datosJson .= '[
                        "'.($respuesta[$i]["codigo"]).'",
                        "'.$cliente["nombre"].'",
                        "'.$vendedor["nombre"].'",
                        "'.$respuesta[$i]["metodo_pago"].'",
                        "'.$respuesta[$i]["precio_servicios"].'",
                        "'.$respuesta[$i]["precio_productos"].'",
                        "'.$respuesta[$i]["fecha"].'",
                        "'.$botones.'"
            ],';
        }

        $datosJson = substr($datosJson, 0, -1);
        $datosJson .= ']}';
      }
      else {
          $datosJson = '{ "data": [] }}';
      }
    
      
        echo $datosJson;
      
        return;


    }

}



 	/*=============================================
 	 ACTIVAR LA TABLA DE VENTAS
      =============================================*/ 
      
      $activarVentas = new TablaVentas();
      $activarVentas -> mostrarTablaVentas();
      
