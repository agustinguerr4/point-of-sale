<?php

require_once "../modelos/turnos.modelo.php";
require_once "../controladores/turnos.controlador.php";

class AjaxTurnos{

    public $data;
   

    public function ajaxActualizarTurnos(){
        $datos = ($this->data);
        foreach(json_decode($datos) as $value){
              $respuesta = ModeloTurnos::mdlActualizarTurnos(json_encode($value).PHP_EOL);
        }
        return $respuesta;
    }


}

    /*==============================
    ACTUALIZAR TURNOS
    ==============================*/
    if(isset($_POST["data"])){
        
        ModeloTurnos::mdlTruncarTurnos();
        $turnos = new AjaxTurnos();
        $turnos -> data = $_POST["data"];
        $turnos -> ajaxActualizarTurnos();
    }