<?php

/* ================================
CREAR CATEGORIAS
================================*/

class ControladorCategorias{
    static public function ctrCrearCategoria(){
       
        if(isset($_POST['nuevaCategoria'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚÜ ]+$/', $_POST['nuevaCategoria'])){

                $tabla = "categorias";

                $datos = $_POST['nuevaCategoria'];

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla,$datos);

                if($respuesta == "ok"){
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "La categoria ha sido guardada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){
                        if(result.value){
                            window.location = "categorias";

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
                            window.location = "categorias";

                        }   

                    });
                  </script>';
            }
             
        }


    }

    /* ================================
    MOSTRAR CATEGORIAS
    =================================*/
    static public function ctrMostrarCategorias($item, $valor){

        $tabla = "categorias";

        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;
    }

    /* ================================
    EDITAR CATEGORIAS
    =================================*/
    static public function ctrEditarCategoria(){
       
        if(isset($_POST['editarCategoria'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚÜ ]+$/', $_POST['editarCategoria'])){

                $tabla = "categorias";

                $datos = array("categoria"=>$_POST['editarCategoria'],
                                "id"=>$_POST["idCategoria"]);

                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla,$datos);

                if($respuesta == "ok"){
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "La categoria ha sido editada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){
                        if(result.value){
                            window.location = "categorias";

                        }   

                    });
                  </script>';
                }

            }else{
                echo '<script>
                    swal.fire({
                        type: "error",
                        title: "El nombre de la categoría no puede estar vacío o contener carateres especiales",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){
                        if(result.value){
                            window.location = "categorias";

                        }   

                    });
                  </script>';
            }
             
        }


    }


        /* ================================
        ELIMINAR CATEGORIA
        =================================*/

        static public function ctrBorrarCategoria(){

            if(isset($_GET["idCategoria"])){
                $tabla = "categorias";
                $datos = $_GET["idCategoria"];

                $respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

                if($respuesta == "ok"){
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "La categoría fue eliminada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){
                        if(result.value){
                            window.location = "categorias";

                        }   

                    });
                  </script>';
                }
            }
        }
}