<?php

require_once "conexion.php";

class ModeloVentas{

    	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		}
		
		$stmt -> close();

		$stmt = null;

    }
    

    /*=============================================
	MOSTRAR VENTAS POR RANGO DE FECHA
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

	}else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial 00:00:00' AND '$fechaFinal 23:59:59'");
            
    		$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
		
		$stmt -> close();

		$stmt = null;

    }

     /*=============================================
	MOSTRAR VENTAS DE HOY DEL USUARIO EN LINEA
	=============================================*/

	static public function mdlVentasDiarias($tabla,$fechaDeHoy,$usuarioEnLinea){

	
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_vendedor = :id_vendedor AND fecha BETWEEN '$fechaDeHoy 00:00:00' AND '$fechaDeHoy 23:59:59'");
            $stmt->bindParam(":id_vendedor",$usuarioEnLinea , PDO::PARAM_INT);
    		$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
		
		$stmt -> close();

		$stmt = null;

    }
    

/*=======================================
REGISTRO VENTA
=======================================*/

static public function mdlIngresarVenta($tabla,$datos){


    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, servicios, precio_productos, precio_servicios, metodo_pago) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :servicios, :precio_productos, :precio_servicios, :metodo_pago)");

    $stmt->bindParam(":codigo",$datos["codigo"] , PDO::PARAM_INT);
    $stmt->bindParam(":id_cliente",$datos["id_cliente"] , PDO::PARAM_INT);
    $stmt->bindParam(":id_vendedor",$datos["id_vendedor"] , PDO::PARAM_INT);
    $stmt->bindParam(":productos",$datos["productos"] , PDO::PARAM_STR);
    $stmt->bindParam(":servicios",$datos["servicios"] , PDO::PARAM_STR);
    $stmt->bindParam(":precio_productos",$datos["precio_productos"] , PDO::PARAM_STR);
    $stmt->bindParam(":precio_servicios",$datos["precio_servicios"] , PDO::PARAM_STR);
    $stmt->bindParam(":metodo_pago",$datos["metodo_pago"] , PDO::PARAM_STR);


    if($stmt->execute()){
        return "ok";
    }else{
        return "error";
    }

    $stmt ->close();

    $stmt -> null;


    
}



        /*=======================================
        EDITAR VENTA
        =======================================*/

        static public function mdlEditarVenta($tabla,$datos){


            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, servicios = :servicios, precio_productos = :precio_productos, precio_servicios = :precio_servicios, metodo_pago = :metodo_pago WHERE codigo = :codigo");

            $stmt->bindParam(":codigo",$datos["codigo"] , PDO::PARAM_INT);
            $stmt->bindParam(":id_cliente",$datos["id_cliente"] , PDO::PARAM_INT);
            $stmt->bindParam(":id_vendedor",$datos["id_vendedor"] , PDO::PARAM_INT);
            $stmt->bindParam(":productos",$datos["productos"] , PDO::PARAM_STR);
            $stmt->bindParam(":servicios",$datos["servicios"] , PDO::PARAM_STR);
            $stmt->bindParam(":precio_productos",$datos["precio_productos"] , PDO::PARAM_STR);
            $stmt->bindParam(":precio_servicios",$datos["precio_servicios"] , PDO::PARAM_STR);
            $stmt->bindParam(":metodo_pago",$datos["metodo_pago"] , PDO::PARAM_STR);


            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt ->close();

            $stmt -> null;


            
        }



        /*=======================================
        ELIMINAR VENTA
        =======================================*/


        static public function mdlEliminarVenta($tabla,$datos){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

	    	if($stmt->execute()){

			    return "ok";

		    }else{

		    	return "error";
		
		    }

            $stmt->close();
            $stmt = null;
            }




 }