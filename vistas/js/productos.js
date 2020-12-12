/*=====================================
CARGAR LA TABLA DINAMICA DE PRODUCTOS
=====================================*/


/*
$.ajax({

     url : "ajax/datatable-productos.ajax.php",
     success: function(respuesta){
         console.log(respuesta);
     }
});
*/

/*===========================================
CARGANDO LA TABLA DE PRODUCTOS DINAMICAMENTE
Y TRADUCIENDOLA AL ESPAÑOL
===========================================*/

    

$('.tablaProductos').dataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

    }
    
});

/*===========================================
DATATABLE DE PRODUCTOS PARA LA PAGINA DE INICIO
===========================================*/

    

$('.tablaProductosInicio').dataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
    
    "deferRender": true,
	"retrieve": true,
    "processing": true,
    "columns" : [
        {"data": 3},
        {"data": 7},
        {"data": 5}
    ],
    "pageLength": 3,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

    }
    
});

/*===========================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CODIGO
===========================================*/

$("#nuevaCategoria").change(function(){
    var idCategoria = $(this).val();

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            if(!respuesta){
                var nuevoCodigo = idCategoria + "01";
                $("#nuevoCodigo").val(nuevoCodigo);
            }else{
                var nuevoCodigo = Number(respuesta["codigo"]) + 1;
                $("#nuevoCodigo").val(nuevoCodigo);
            }




        }


    })

})

/*===========================================
AGREGANDO PRECIO DE VENTA
===========================================*/
$("#nuevoPrecioCompra").change(function(){

    if($("#checkboxPorcentaje").prop("checked")){
            
            var valorPorcentaje = $(".nuevoPorcentaje").val();

            var porcentaje =  Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

            $("#nuevoPrecioVenta").val(porcentaje);
            $("#nuevoPrecioVenta").prop("readonly", true);
            
        }
})



/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

	if($("#checkboxPorcentaje").prop("checked")){

		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);


	}

})

/*===========================================
Editando PRECIO DE VENTA
===========================================*/
$("#editarPrecioCompra").change(function(){

    if($("#checkboxPorcentajeEditar").prop("checked")){
            
            var valorPorcentaje = $(".editarPorcentaje").val();

            var porcentaje =  Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

            $("#editarPrecioVenta").val(porcentaje);
            $("#editarPrecioVenta").prop("readonly", true);
            
        }
})

$(".editarPorcentaje").change(function(){

	if($("#checkboxPorcentajeEditar").prop("checked")){

		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#editarPrecioVenta").val(porcentaje);
		$("#editarPrecioVenta").prop("readonly",true);


	}

})

if($("#checkboxPorcentaje").prop("checked",true)){
    $("#checkboxPorcentaje").change(function(){

        $("#nuevoPrecioVenta").prop("readonly",false);
        $("#nuevoPrecioCompra").val("");
        $("#nuevoPrecioVenta").val("");
        

    })
}else if($("#checkboxPorcentaje").prop("checked", false)){
    $("#checkboxPorcentaje").change(function(){

        $("#nuevoPrecioVenta").prop("readonly",true);
        
    
    })
}

if($("#checkboxPorcentajeEditar").prop("checked",true)){
    $("#checkboxPorcentajeEditar").change(function(){

        $("#editarPrecioVenta").prop("readonly",false);
        $("#editarPrecioCompra").val("");
        $("#editarPrecioVenta").val("");
        

    })
}else if($("#checkboxPorcentajeEditar").prop("checked", false)){
    $("#checkboxPorcentajeEditar").change(function(){

        $("#nuevoPrecioVenta").prop("readonly",true);
        
    
    })
}

/*=================================================
SUBIENDO FOTO DE PRODUCTO
=================================================*/


    


$(".nuevaImagen").change(function(){

    var imagen = this.files[0];

    /*=================================================
    VALIDAR FORMATO
    =================================================*/

    if(imagen['type'] != "image/jpg" && imagen['type'] != "image/png" && imagen['type'] != "image/jpeg"){
        $(".nuevaImagen").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "La imagen debe estar en formato JPG o PNG",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    } else if(imagen['size'] > 2000000){

        $(".nuevaImagen").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "La imagen debe pesar menos de 2mb",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;
            $(".previsualizarImagen").attr("src", rutaImagen);
        })
    }


})


/*=============================================
EDITAR PRODUCTO
=============================================*/

$("#tablaProductos").on("click", ".btnEditarProducto", function(){
   
	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

              }

          })

           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           $("#editarStock").val(respuesta["stock"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

           	$("#imagenActual").val(respuesta["imagen"]);

           	$(".previsualizarImagenActual").attr("src",  respuesta["imagen"]);

           }

      }

  })

})


/*=================================================
SUBIENDO FOTO DE PRODUCTO
=================================================*/


    


$(".editarImagen").change(function(){

    var imagen = this.files[0];

    /*=================================================
    VALIDAR FORMATO
    =================================================*/

    if(imagen['type'] != "image/jpg" && imagen['type'] != "image/png" && imagen['type'] != "image/jpeg"){
        $(".editarImagen").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "La imagen debe estar en formato JPG o PNG",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    } else if(imagen['size'] > 2000000){

        $(".editarImagen").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "La imagen debe pesar menos de 2mb",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;
            $(".previsualizarImagenActual").attr("src", rutaImagen);
        })
    }


})


/*=================================================
ELIMINAR PRODUCTO
=================================================*/
$("#tablaProductos").on("click", "button.btnEliminarProducto", function(){
   
    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    
    swal.fire({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

        }


	})
    
})
