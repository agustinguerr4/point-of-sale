<?php

require_once "conexion.php";

class ModeloTurnos{

    
    /*=============================================
	MOSTRAR TURNOS
	=============================================*/

	static public function mdlMostrarTurnos(){

            $tabla = "turnos";

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		

    }
    /*===========================================
    Actualizar Turnos
    ===========================================*/

    static public function mdlActualizarTurnos($datos){
        $tabla = "turnos";
        

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(datos) VALUES (:datos)");

        $stmt->bindParam(":datos", $datos, PDO::PARAM_STR);
        

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt ->close();

        $stmt -> null;
    }

   	/*=============================================
	Eliminar Turno
	=============================================*/

	static public function mdlEliminarTurno($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}


    /*=============================================
	TRUNCAR TABLA TURNOS
	=============================================*/
    static public function mdlTruncarTurnos(){
        $tabla = "turnos";
        $stmt1 = Conexion::conectar()->prepare("TRUNCATE $tabla");
        $stmt1->execute();
        
    }

    }


