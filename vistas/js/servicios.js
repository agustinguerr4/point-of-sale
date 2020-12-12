/*==============================
EDITAR SERVICIO
==============================*/   
$("#tablaServicios").on("click", ".btnEditarServicio", function(){


    var idServicio = $(this).attr("idServicio");

    var datos = new FormData();
    datos.append("idServicio", idServicio);

    $.ajax({
        url: "ajax/servicios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $("#editarServicio").val(respuesta["servicio"]);
            $("#editarPrecioServicio").val(respuesta["precio"]);
            $("#idServicio").val(respuesta["id"]);
        }
    })

})

/*==============================
ELIMNAR SERVICIO
==============================*/   
$("#tablaServicios").on("click", ".btnEliminarServicio", function(){

    var idServicio = $(this).attr("idServicio");

    swal.fire({

        title: "¿Está seguro de borrar el servicio?",
        text: "Si no lo está puede cancelar la acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'd33',
        cancelmButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar'

    }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=servicios&idServicio="+idServicio;
        }
    })
})