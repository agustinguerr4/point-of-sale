<?php


class ControladorVentas{
    public function ctrVentas(){
        include "vistas/ventas.php";
    }


    /*===============================================
    MOSTRAR VENTAS
    ===============================================*/
    static public function ctrMostrarVentas($item,$valor){
        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

        return $respuesta;
    }

    
    /*===============================================
    MOSTRAR VENTAS POR RANGO DE FECHAS
    ===============================================*/
    
    static public function ctrRangoFechasVentas($fechaInicial,$fechaFinal){
        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla,$fechaInicial,$fechaFinal);

        return $respuesta;
    }
     
    /*===============================================
    MOSTRAR VENTAS DE HOY DEL USUARIO EN LINEA
    ===============================================*/
    static public function ctrVentasDiarias($fechaDeHoy,$usuarioEnLinea){
        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlVentasDiarias($tabla,$fechaDeHoy,$usuarioEnLinea);

        return $respuesta;
    }
    

    /*===============================================
    CREAR VENTAS
    ===============================================*/
    static public function ctrCrearVenta(){

        if(isset($_POST["nuevaVenta"])){

             /*===============================================
              ACTUALIZAR LAS COMPRAS DEL CLIENTE, REDUCIR STOCK Y AUMENTAR VENTAS DE LOS PRODUCTOS
             ===============================================*/

     
                $listaProductos = json_decode($_POST["listaProductos"], true);

   
                if($listaProductos != ""){
                    foreach($listaProductos as $key => $value){
   
                        $tablaProductos = "productos";
        
                        $item = "id";
                        $valor = $value["id"];
                        $orden = "id";
                        $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
        
                       
        
                        $item1a = "ventas";
                        $valor1a = $value["cantidad"] + $traerProducto["ventas"];
        
                        $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor);
                         
                        $item1b = "stock";
                        $valor1b = $value["stock"];
        
                        $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b,$valor);
                         
                     
        
                     $tablaClientes = "clientes";
        
                     $item = "id";
                     $valor = $_POST["agregarCliente"];
        
                     $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);
              
                   
                     $item1 = "compras";
                     $valor1 = $value["cantidad"] + $traerCliente["compras"];
        
                     $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1,$valor1,$valor);
     
     
                  }
                }
                


                    $listaServicios = json_decode($_POST["listaServicios"], true);
                  

            

                    
       
                    foreach($listaServicios as $key => $value){

                     
                       $tablaServicios = "servicios";
       
                       $item = "id";
                       $valor = $value["id"];
       
                       $orden = "id";
                       $traerServicio = ModeloServicios::mdlMostrarServicios($tablaServicios, $item, $valor, $orden);
       
                      
       
                       $item1a = "ventas";
                       $valor1a = 1 + $traerServicio["ventas"];
       
                       $nuevoServicio = ModeloServicios::mdlActualizarServicio($tablaServicios, $item1a, $valor1a,$valor);
                        
                     
                        
                    
                    $tablaClientes = "clientes";
       
                    $item = "id";
                    $valor = $_POST["agregarCliente"];
       
                    $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

               
                 
       
                    $item1 = "servicios";
                    $valor1 = 1 + $traerCliente["servicios"];

       
                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1,$valor1,$valor);
    
                 } 
                 
                 
                 if($_POST["listaServicios"] == "" && $_POST["listaProductos"] == ""){
                    echo '<script>
                    swal.fire({
                        type: "error",
                        title: "Debe cargar al menos un servicio o un producto",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        
    
                    }).then(function(result){
                        if(result.value){
                            window.location = "productos";
    
                        }   
    
                    })
                  </script>';
    
                 }

             

           

                /*===============================================
                GUARDAR LA VENTA
                ===============================================*/
                if($_POST["listaServicios"] == "" && $_POST["listaProductos"] == ""){
                    echo '<script>
                    swal.fire({
                        type: "error",
                        title: "Debe cargar al menos un servicio o un producto",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        
    
                    }).then(function(result){
                        if(result.value){
                            window.location = "crear-venta";
    
                        }   
    
                    })
                  </script>';
    
                 }else{
                $tabla = "ventas";

                $datos = array("codigo"=>$_POST["nuevaVenta"],
                        "id_cliente" => $_POST["agregarCliente"],
                        "id_vendedor" => $_POST["idVendedor"],
                        "productos" => $_POST["listaProductos"],
                        "servicios" => $_POST["listaServicios"],
                        "precio_productos" => $_POST["precioFinalProductos"],
                        "precio_servicios" => $_POST["precioFinalServicios"],
                        "metodo_pago" => $_POST["nuevoMetodoPago"]);

                    $respuesta = ModeloVentas::mdlIngresarVenta($tabla,$datos);

                    if($respuesta == "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "El servicio ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then(function(result){
                            if(result.value){
                                window.location = "inicio";

                            }   

                        });
                    </script>';
                    }}

                        }


   
    
    }


     /*===============================================
    EDIAR VENTAS
    ===============================================*/
    static public function ctrEditarVenta(){

        if(isset($_POST["editarVenta"])){

            
             /*=====================================================================================
              FORMATEAR LA VENTA AL ESTADO ANTERIOR 
             ======================================================================================*/

             $tabla = "ventas";

             $item = "codigo";
             $valor = $_POST["editarVenta"];

             $traerVenta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

             
                

             $tablaClientes = "clientes";
   
             $itemCliente = "id";
             $valorCliente = $_POST["agregarCliente"];

             $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);


             
             /*=====================================================================================
              REVISAR SI VIENEN PRODUCTOS EDITADOS
             ======================================================================================*/


             if($_POST["listaProductos"] == ""){
                $listaProductos = $traerVenta["productos"];
                $cambioProductos = false;
             }else{
                $listaProductos = $_POST["listaProductos"];
                $cambioProductos = true;
             }


             if($_POST["listaServicios"] == ""){
                $listaServicios = $traerVenta["servicios"];
                $cambioServicios = false;
             }else{
                 $listaServicios = $_POST["listaServicios"];    
                 $cambioServicios = true;
             }
            


             $productos = json_decode($listaProductos, true);
             $servicios = json_decode($listaServicios, true);
             $productos_2 = json_decode($traerVenta["productos"],true);
             $servicios_2 = json_decode($traerVenta["servicios"],true);
             
                   
                $totalProductosComprados = array();  

                if($cambioProductos){

                    foreach($productos_2 as $key => $value){
                        array_push($totalProductosComprados,$value["cantidad"]);
                        $tablaProductos = "productos";
    
                        $item = "id";
                        $valor = $value["id"];
                        $orden = "id";
    
                        $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
    
                        $item1a = "ventas";
                        $valor1a = $traerProducto["ventas"] - $value["cantidad"];
    
                        $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor);
                        
    
                        $item1b = "stock";
                        $valor1b = $value["cantidad"] + $traerProducto["stock"];
        
                        $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b,$valor);
                            
        
                    }
        
                                   
                    $item1 = "compras";
                    $valor1 = ($traerCliente["compras"]) - array_sum($totalProductosComprados);
       
                   
                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1,$valor1,$valorCliente);
                }

             
             
              

           
                $totalServiciosRecibidos = array();   
            
                if($cambioServicios){
                    foreach($servicios_2 as $key => $value){
                        array_push($totalServiciosRecibidos,1);
                        $tablaServicios = "servicios";
    
                        $item = "id";
                        $valor = $value["id"];
                        $orden = "id";
    
                        $traerServicio = ModeloServicios::mdlMostrarServicios($tablaServicios, $item, $valor, $orden);
    
                        $item1a = "ventas";
                        $valor1a = $traerServicio["ventas"] - 1;
                        
    
                        $nuevasVentas = ModeloServicios::mdlActualizarServicio($tablaServicios, $item1a, $valor1a,$valor);
                        
    
                                
                    }
            
    
                    $item2 = "servicios";
                    $valor2 = $traerCliente["servicios"] - array_sum($totalServiciosRecibidos);
                    
       
                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item2,$valor2,$valorCliente);
    
    
    
                }
              



             /*=====================================================================================
              ACTUALIZAR LAS COMPRAS DEL CLIENTE, REDUCIR STOCK Y AUMENTAR VENTAS DE LOS PRODUCTOS
             =======================================================================================*/

             

                $listaProductos_2 = json_decode($listaProductos, true);

             

                $totalProductosComprados_2 = array();   
   
                if($cambioProductos){
                    foreach($listaProductos_2 as $key => $value){
   
                        array_push($totalProductosComprados_2,$value["cantidad"]);
        
                        $tablaProductos_2 = "productos";
        
                        $item_2 = "id";
                        $valor_2 = $value["id"];
                        $orden = "id";
        
                        $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);
        
                       
        
                        $item1a_2 = "ventas";
                        $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];
        
                        $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2,$valor_2);
                         
                        $item1b_2 = "stock";
                        $valor1b_2 = $value["stock"];
        
                        $nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2,$valor_2);
     
     
                  } 
                  if(array_sum($totalProductosComprados_2) > 0){
                      
                     $tablaClientes_2 = "clientes";
        
                     $item_2 = "id";
                     $valor_2 = $_POST["agregarCliente"];
        
                     $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);
                
                   
                     $item1_2 = "compras";
                     $valor1_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];
        
                     $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1_2,$valor1_2,$valor_2);
                  }
                }
   
               


                    $listaServicios_2 = json_decode($listaServicios, true);
                  

                    $totalServiciosRecibidos_2 = array();   

                    if($cambioServicios){
                        foreach($listaServicios_2 as $key => $value){

                     
       
                            array_push($totalServiciosRecibidos_2,1);
            
                            $tablaServicios_2 = "servicios";
            
                            $item_2 = "id";
                            $valor_2 = $value["id"];
                            $orden = "id";
            
                            $traerServicio_2 = ModeloServicios::mdlMostrarServicios($tablaServicios_2, $item_2, $valor_2, $orden);
            
                           
            
                            $item1a_2 = "ventas";
                            $valor1a_2 = 1 + $traerServicio_2["ventas"];
            
                            $nuevoServicio_2 = ModeloServicios::mdlActualizarServicio($tablaServicios_2, $item1a_2, $valor1a_2,$valor_2);
                             
                          
                   
         
                      } 
                      if(array_sum($totalServiciosRecibidos_2) > 0){
                                    
                         
            
                         $tablaClientes_2 = "clientes";
            
                         $item_2 = "id";
                         $valor_2 = $_POST["agregarCliente"];
            
                         $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);
                    
                    
                      
            
                         $item1_2 = "servicios";
                         $valor1_2 = array_sum($totalServiciosRecibidos_2) + $traerCliente_2["servicios"];
                        
            
                         $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1_2,$valor1_2,$valor_2);
                      }
                    }
       
       
               
                 
                 
                 if($listaServicios_2 == "" && $listaProductos_2 == ""){
                    echo '<script>
                    swal.fire({
                        type: "error",
                        title: "Debe cargar al menos un servicio o un producto",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        
    
                    }).then(function(result){
                        if(result.value){
                            window.location = "productos";
    
                        }   
    
                    })
                  </script>';
    
                 }

             


                /*===============================================
                GUARDAR LA VENTA
                =============================================== */

                $tabla = "ventas";

                $datos = array("codigo"=>$_POST["editarVenta"],
                        "id_cliente" => $_POST["agregarCliente"],
                        "id_vendedor" => $_POST["idVendedor"],
                        "productos" => json_encode($listaProductos_2),
                        "servicios" => json_encode($listaServicios_2),
                        "precio_productos" => $_POST["precioFinalProductos"],
                        "precio_servicios" => $_POST["precioFinalServicios"],
                        "metodo_pago" => $_POST["nuevoMetodoPago"]);

                    $respuesta = ModeloVentas::mdlEditarVenta($tabla,$datos);

                    if($respuesta == "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "El servicio ha sido editado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then(function(result){
                            if(result.value){
                                window.location = "ventas";

                            }   

                        });
                    </script>';
                    }

        }


   
    
    }


        /*===============================================
        ELIMINAR VENTA
        =============================================== */

        static public function ctrEliminarVenta(){

            if(isset($_GET["idVenta"])){

                $tabla = "ventas";

                $item = "id";
                $valor = $_GET["idVenta"];

                $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

                
                $tablaClientes = "clientes";
    
                $itemCliente = "id";
                $valorCliente = $traerVenta["id_cliente"];

                $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);


                /*=============================
                FORMATEAR PRODUCTOS Y SERVICIOS
                ===============================*/

                $productos_2 = json_decode($traerVenta["productos"],true);
                $servicios_2 = json_decode($traerVenta["servicios"],true);
                
                      
                   $totalProductosComprados = array();  
                        
                       foreach($productos_2 as $key => $value){
                           array_push($totalProductosComprados,$value["cantidad"]);
                           $tablaProductos = "productos";
       
                           $item__ = "id";
                           $valor__ = $value["id"];
                           $orden__ = "id";
       
                           $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item__, $valor__, $orden__);
       
                           $item1a = "ventas";
                           $valor1a = $traerProducto["ventas"] - $value["cantidad"];
       
                           $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor__);
                           
       
                           $item1b = "stock";
                           $valor1b = $value["cantidad"] + $traerProducto["stock"];
           
                           $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b,$valor__);
                               
           
                       }
           
                                      
                       $item1 = "compras";
                       $valor1 = ($traerCliente["compras"]) - array_sum($totalProductosComprados);
          
                      
                       $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1,$valor1,$valorCliente);
                   
                
                
                 
   
              
                   $totalServiciosRecibidos = array();   
               
                   
                       foreach($servicios_2 as $key => $value){
                           array_push($totalServiciosRecibidos,1);
                            $tablaServicios = "servicios";
       
                           $item_ = "id";
                           $valor_ = $value["id"];
       
                           $orden_ = "id";
                           $traerServicio = ModeloServicios::mdlMostrarServicios($tablaServicios, $item_, $valor_, $orden_);
       
                           $item1a = "ventas";
                           $valor1a = $traerServicio["ventas"] - 1;
                           
       
                           $nuevasVentas = ModeloServicios::mdlActualizarServicio($tablaServicios, $item1a, $valor1a,$valor_);
                           
       
                                   
                       }
               
       
                       $item2 = "servicios";
                       $valor2 = $traerCliente["servicios"] - array_sum($totalServiciosRecibidos);
                       
          
                       $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item2,$valor2,$valorCliente);

                     
                       $respuesta = ModeloVentas::mdlEliminarVenta($tabla, $valor);

                       if($respuesta == "ok"){

                        echo'<script>
    
                            swal.fire({
                                  type: "success",
                                  title: "El servicio ha sido eliminado correctamente",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar"
                                  }).then(function(result){
                                            if (result.value) {
    
                                            window.location = "ventas";
    
                                            }
                                        })
    
                            </script>';
    
                    }
       
    
       
                   
            }
        }



        
    /*===============================================
    DESCARGAR REPORTE EN EXCEL
    ===============================================*/

    public function ctrDescargarReporte(){

        if(isset($_GET["reporte"])){

            $tabla = "ventas";

            if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

                  
                    // Si vienen fechas el reporte sera sobre una porcion de tiempo
                    $fechaInicial = $_GET["fechaInicial"];
                    $fechaFinal = $_GET["fechaFinal"];
                    $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial,$fechaFinal);
            }else{

                    // Sino se devuelve un archivo con el historial de todas las ventas del negocio
                    $item = null;
                    $valor = null;
                    $ventas = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);
            }

                /*===============================================
                CREAMOS ARCHVIO DE EXCEL
                ===============================================*/

                $Name = $_GET["reporte"].'.xls';


                
			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>SERVICIOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO SERVICIOS</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

                 $productos =  json_decode($item["productos"], true);
                 if($productos != ""){

                    foreach ($productos as $key => $valueProductos) {
			 			
                        echo utf8_decode($valueProductos["cantidad"]."<br>");
                    }

                echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

                foreach ($productos as $key => $valueProductos) {
                        
                    echo utf8_decode($valueProductos["descripcion"]."<br>");
                
                }
                     
                 }else{
                    echo utf8_decode("- <br>");
                

                    echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

                      
                    echo utf8_decode("- <br>");

                 }


                 $servicios =  json_decode($item["servicios"], true);
                 

                echo utf8_decode("</td><td style='border:1px solid #eee;'>");
                 if($servicios != ""){

                  	

                foreach ($servicios as $key => $valueServicios) {
                        
                    echo utf8_decode($valueServicios["descripcion"]."<br>");
                
                }
                     
                 }else{
                   
	

                      
                    echo utf8_decode("- <br>");

                 }

			 	

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["precio_productos"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["precio_servicios"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format(($item["precio_productos"]+$item["precio_servicios"]),2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";




        }
    }
}