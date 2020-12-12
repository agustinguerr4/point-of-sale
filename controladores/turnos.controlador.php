<?php


class ControladorTurnos{

        /*=============================================
        MOSTRAR TURNOS
        =============================================*/

        static public function ctrMostrarTurnos(){

		$respuesta = ModeloTurnos::mdlMostrarTurnos();

		return $respuesta;

         }


         /*=============================================
        CREAR CLIENTES
        =============================================*/

     public function ctrCrearTurno(){

        if(isset($_POST["turnos"])){
            echo '<script>alert("piola")</script>';
                       
            $listaTurnos = json_decode($_POST["turnos"]);

           

            foreach($listaTurnos as $key => $value){
                
                
                     $respuesta = ModeloTurnos::mdlActualizarTurnos($value);

            }


        }
}
}
