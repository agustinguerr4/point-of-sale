<?php

require_once "../modelos/turnos.modelo.php";
require_once "../controladores/turnos.controlador.php";


    
    $data = ControladorTurnos::ctrMostrarTurnos();
    $data2 = [];
    foreach($data as $value){
        $data2[] = json_decode($value["datos"]);
    }
    //returns data as JSON format
    echo (json_encode($data2));

   