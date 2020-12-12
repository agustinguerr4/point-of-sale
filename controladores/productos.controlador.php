<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden){

        $tabla = "productos";
        

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

    }


    /*=============================================
	CREAR PRODUCTOS
	=============================================*/

	static public function ctrCrearProducto(){
		
		if(isset($_POST["nuevaDescripcion"])){
			
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚÜ ]+$/', $_POST['nuevaDescripcion']) &&
              preg_match('/^[0-9]+$/', $_POST['nuevoStock']) &&
              preg_match('/^[0-9.]+$/', $_POST['nuevoPrecioCompra']) &&
              preg_match('/^[0-9.]+$/', $_POST['nuevoPrecioVenta'])){
				
			
				/*===========================================
				VALIDAR IMAGEN
				===========================================*/	
				$ruta = "vistas/img/productos/anonymous.png";

                

                if(isset($_FILES["nuevaImagen"]["tmp_name"])){
                    
                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                }

                /*==========================================
                CREAR DIRECTORIO PARA GUARDAR FOTO
                ==========================================*/

                $directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];

                mkdir($directorio, 0755);

                /*==========================================
                DE ACUERDO AL TIPO DE IMAGEN
                ==========================================*/
                if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/productos/".$_POST['nuevoCodigo']."/".$aleatorio.".jpg";
                    $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);
                }

                if($_FILES["nuevaImagen"]["type"] == "image/png"){

                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/productos/".$_POST['nuevoCodigo']."/".$aleatorio.".png";
                    $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
				}
				
				
                $tabla = "productos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "imagen" => $ruta,
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"]);

				
				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal.fire({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}

            }else{

                echo '<script>
                swal.fire({
                    type: "error",
                    title: "Los datos no pueden estar vacíos o contener carateres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    

                }).then(function(result){
                    if(result.value){
                        window.location = "productos";

                    }   

                })
              </script>';

                  
              }
        }
    }

    /*=============================================
	EDITAR PRODUCTOS
	=============================================*/

	static public function ctrEditarProducto(){
		function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
          }

		if(isset($_POST["editarDescripcion"])){
			console_log($_POST['editarStock']);
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚÜ ]+$/', $_POST['editarDescripcion']) &&
                 preg_match('/^[0-9]+$/', $_POST['editarStock']) &&
                 preg_match('/^[0-9.]+$/', $_POST['editarPrecioCompra']) &&
                preg_match('/^[0-9.]+$/', $_POST['editarPrecioVenta'])){
				
			
				/*===========================================
				VALIDAR IMAGEN
				===========================================*/	
				$ruta = $_POST['imagenActual'];

                

                if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){
                    
                    list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                }

                /*==========================================
                PREGUNTAMOS SI EXISTE IMAGEN EN LA BD
                ==========================================*/
                if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/anonymous.png"){
                    unlink($_POST["imagenActual"]);
                }else{
                    /*==========================================
                    CREAR DIRECTORIO PARA GUARDAR FOTO
                    ==========================================*/

                    $directorio = "vistas/img/productos/".$_POST["editarCodigo"];

                    mkdir($directorio, 0755);
                }

                

                /*==========================================
                DE ACUERDO AL TIPO DE IMAGEN
                ==========================================*/
                if($_FILES["editarImagen"]["type"] == "image/jpeg"){

                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".jpg";
                    $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);
                }

                if($_FILES["editarImagen"]["type"] == "image/png"){

                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".png";
                    $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
				}
				
				
                $tabla = "productos";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "imagen" => $ruta,
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"]);

				
				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal.fire({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}

            }else{

                echo '<script>
                swal.fire({
                    type: "error",
                    title: "Los datos no pueden estar vacíos o contener carateres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    

                }).then(function(result){
                    if(result.value){
                        window.location = "productos";

                    }   

                })
              </script>';

                  
              }
        }
    }


/*==========================================
ELIMINAR PRODUCTO
==========================================*/

static public function ctrEliminarProducto(){
    if(isset($_GET["idProducto"])){

        $tabla = "productos";
        $datos = $_GET["idProducto"];

        if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/anonymous.png"){

            unlink($_GET["imagen"]);
            rmdir('vistas/img/productos/'.$_GET["codigo"]);
        }

        $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal.fire({
							  type: "success",
							  title: "El producto ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}
    }
}

}

    