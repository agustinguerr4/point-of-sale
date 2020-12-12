<?php


require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";






class TablaServiciosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE SERVICIOS
  	=============================================*/ 

	public function mostrarTablaServiciosVentas(){

        $item = null;
        $valor = null;
        $orden = "id";

        $servicios = ControladorServicios::ctrMostrarServicios($item,$valor,$orden);

        
        

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($servicios); $i++){

               
               

                

                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 
                $botones = "<div class='btn-group'><button class='btn btn-info agregarServicio recuperarBotonServicio' idServicio='".$servicios[$i]["id"]."'>Agregar</button></div>";

                $datosJson .='[
                    "'.($i+1).'",
                    "'.$servicios[$i]["servicio"].'",
                    "'.$servicios[$i]["precio"].'",
                     
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
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
$activarServiciosVentas = new TablaServiciosVentas();
$activarServiciosVentas -> mostrarTablaServiciosVentas();

