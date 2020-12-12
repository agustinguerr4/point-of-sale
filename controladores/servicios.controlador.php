<?php


class ControladorServicios{
        /* ================================
        CREAR SERVICIOS
        =================================*/

        static public function ctrCrearServicio(){
            
        if(isset($_POST['nuevoServicio']) && isset($_POST['nuevoPrecioServicio'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚÜ ]+$/', $_POST['nuevoServicio']) &&
            preg_match('/^[0-9,]+$/', $_POST['nuevoPrecioServicio'])){

                $tabla = "servicios";

                $datos = array("servicio"=>$_POST['nuevoServicio'],
                                "precio"=>$_POST['nuevoPrecioServicio']);
                

                    $respuesta = ModeloServicios::mdlIngresarServicio($tabla,$datos);

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
                                window.location = "servicios";

                            }   

                        });
                    </script>';
                    }

            }else{
                echo '<script>
                    swal.fire({
                        type: "error",
                        title: "Los datos no pueden estar vacíos o contener carateres especiales",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){
                        if(result.value){
                            window.location = "servicios";

                        }   

                    });
                </script>';
            }
        }

        }


        /* ================================
        MOSTRAR SERVICIOS
        =================================*/
        static public function ctrMostrarServicios($item,$valor,$orden){

            $tabla = "servicios";
            $respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor,$orden);

            return $respuesta;
        }

        /* ================================
        EDITAR SERVICIOS
        =================================*/

        static public function ctrEditarServicio(){
            
            if(isset($_POST['editarServicio']) && isset($_POST['editarPrecioServicio'])){
    
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚÜ ]+$/', $_POST['editarServicio']) &&
                preg_match('/^[0-9,]+$/', $_POST['editarPrecioServicio'])){
    
                    $tabla = "servicios";
    
                    $datos = array("servicio"=>$_POST['editarServicio'],
                                    "id"=>$_POST["idServicio"],
                                    "precio"=>$_POST['editarPrecioServicio']);
                    
    
                        $respuesta = ModeloServicios::mdlEditarServicio($tabla,$datos);
    
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
                                    window.location = "servicios";
    
                                }   
    
                            });
                        </script>';
                        }
    
                }else{
                    echo '<script>
                        swal.fire({
                            type: "error",
                            title: "Los datos no pueden estar vacíos o contener carateres especiales",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
    
                        }).then(function(result){
                            if(result.value){
                                window.location = "servicios";
    
                            }   
    
                        });
                    </script>';
                }
            }
    
            }


        /* ================================
        ELIMINAR SERVICIOS
        =================================*/
        static public function ctrBorrarServicio(){

            if(isset($_GET["idServicio"])){
                $tabla = "servicios";
                $datos = $_GET["idServicio"];

                $respuesta = ModeloServicios::mdlBorrarServicio($tabla, $datos);

                if($respuesta == "ok"){
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "El servicio fue eliminado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){
                        if(result.value){
                            window.location = "servicios";

                        }   

                    });
                  </script>';
            }
        }
    }
}