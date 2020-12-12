<?php

require_once "../modelos/turnos.modelo.php";
require_once "../controladores/turnos.controlador.php";

class AjaxTurnos{

    public $turno;
   

    public function ajaxEliminarTurno(){
        $datos = ($this->idTurno);
        $tabla = "turnos";
        $respuesta = ModeloTurnos::mdlEliminarTurno($tabla,$datos);
        
        return $datos;
    }


}

    /*==============================
    ACTUALIZAR TURNOS
    ==============================*/
    if(isset($_POST["idTurno"])){
        
        $turnos = new AjaxTurnos();
        $turnos -> idTurno = $_POST["idTurno"];
        $turnos -> ajaxEliminarTurno();
    }