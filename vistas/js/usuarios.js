/*=================================================
SUBIENDO FOTO DE USUARIO
=================================================*/


    


$(".nuevaFoto").change(function(){

    var imagen = this.files[0];

    /*=================================================
    VALIDAR FORMATO
    =================================================*/

    if(imagen['type'] != "image/jpg" && imagen['type'] != "image/png" && imagen['type'] != "image/jpeg"){
        $(".nuevaFoto").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "La imagen debe estar en formato JPG o PNG",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    } else if(imagen['size'] > 2000000){

        $(".nuevaFoto").val("");

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
            $(".previsualizarNueva").attr("src", rutaImagen);
        })
    }


})



  /*=================================================
    EDITAR USUARIO
    =================================================*/


    $(document).on("click", ".btnEditarUsuario", function(){
        
        var idUsuario = $(this).attr("idUsuario");
       
        
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
       
        $.ajax({

            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $("#editarNombre").val(respuesta["nombre"]);
                $("#editarUsuario").val(respuesta["usuario"]);
                $("#editarPerfil").html(respuesta["perfil"]);
                $("#editarPerfil").val(respuesta["perfil"]);
                $("#fotoActual").val(respuesta["foto"]);


                $("#passwordActual").val(respuesta["password"]);

                if(respuesta["foto"] != ""){
                    $(".previsualizarActual").attr("src", respuesta["foto"])
                }
            }
            
        });
        
    })

    $(".editarFoto").change(function(){

        var imagen = this.files[0];
    
        /*=================================================
        VALIDAR FORMATO
        =================================================*/
    
        if(imagen['type'] != "image/jpg" && imagen['type'] != "image/png" && imagen['type'] != "image/jpeg"){
            $(".editarFoto").val("");
    
            swal.fire({
                title: "Error al subir la imagen",
                text: "La imagen debe estar en formato JPG o PNG",
                type: "error",
                confirmButtonText: "Cerrar"
            });
        } else if(imagen['size'] > 2000000){
    
            $(".editarFoto").val("");
    
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
                $(".previsualizarActual").attr("src", rutaImagen);
            })
        }
    
    
    })

      /*=================================================
        Método para reiniciar la foto anonima del modal de usuario
        =================================================*/
    $(document).on("click", ".btnAgregarUsuario", function(){
    
        $(".previsualizarNueva").attr("src", "vistas\\img\\usuarios\\anonymous.png")
    }) 

      /*=================================================
        ACTIVAR USUARIO
        =================================================*/
        $(document).on("click", ".btn-activar", function(){
        

            var idUsuario = $(this).attr('idUsuario');
            var estadoUsuario = $(this).attr('estadoUsuario');

            var datos = new FormData();
            datos.append('activarId', idUsuario);
            datos.append('activarUsuario', estadoUsuario);

            $.ajax({
                url: 'ajax/usuarios.ajax.php',
                method: 'POST',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){


                }


            })

            

            if(estadoUsuario == 1){
                $(this).addClass('btn-success');
                $(this).removeClass('btn-danger');
                $(this).html('Activado');
                $(this).attr('estadoUsuario', 0);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                  })
                  
                  Toast.fire({
                    type: 'success',
                    title: 'El usuario ha sido activado!'
                  })
            }
                


            else {
                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
                $(this).html('Desactivado');
                $(this).attr('estadoUsuario', 1);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                  })
                  
                  Toast.fire({
                    type: 'error',
                    title: 'El usuario ha sido desactivado!'
                  })
            }
            
    })

    

/*=================================================
REVISAR DUPLICADOS EN NOMBRE DE USUARIO
=================================================*/

$("#nuevoUsuario").change(function(){
    $(".alert").remove();
    var usuario = $(this).val();

    var datos = new FormData();

    datos.append("validarUsuario", usuario);

    $.ajax({
        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}
        }
    })
})

/*=================================================
ELIMINAR USUARIO
=================================================*/
$(".tablas").on("click", ".btnEliminarUsuario", function(){

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");
  
    swal.fire({
      title: '¿Está seguro de borrar el usuario?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
  
      }
  
    })
  
  })
