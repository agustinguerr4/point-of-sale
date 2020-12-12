<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class TablaClientes{

 	/*=============================================
 	 MOSTRAR LA TABLA DE CLIENTES
  	=============================================*/ 

	public function mostrarTablaClientes(){

        $item = null;
        $valor = null;

        $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);

        
        

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($clientes); $i++){

               $nombre = $clientes[$i]["nombre"];
               $documento = $clientes[$i]["documento"];
               $email = $clientes[$i]["email"];
               $telefono = $clientes[$i]["telefono"];
               $direccion = $clientes[$i]["direccion"];
               $compras = $clientes[$i]["compras"];
               $fecha = $clientes[$i]["fecha"];


                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 
                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$clientes[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-times'></i></button></div>";


                $datosJson .='[
                    "'.($i+1).'",
                    "'.$nombre.'",
                    "'.$documento.'",
                    "'.$email.'",
                    "'.$telefono.'",
                    "'.$direccion.'",
                    "'.$compras.'",
                    "'.$fecha.'",
                    
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
ACTIVAR TABLA DE CLIENTES
=============================================*/ 
$activarClientes = new TablaClientes();
$activarClientes -> mostrarTablaClientes();

