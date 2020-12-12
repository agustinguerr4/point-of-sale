/*===========================================
CARGAR TABLA DE VENTAS DINAMICAMENTE
===========================================*/

var fechaInicial = location.search.substring(26, 36)
var fechaFinal = location.search.substring(48, 58)







$("#tablaVentas").dataTable({

    "ajax": "ajax/datatable-ventas.ajax.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    "deferRender": true,
    "iDisplayLength": 10,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_",
        "sInfoEmpty": "Mostrando registros del 0 al 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

});


/*===========================================
VAR LOCALSTORAGE
===========================================*/

if (localStorage.getItem("capturarRango") != null) {


    $("#daterange-btn").children("#spanRango").html(localStorage.getItem("capturarRango"));

} else {
    $("#daterange-btn").children("#spanRango").html('Rango de fechas');

}


$('#tablaVentaProductos').dataTable({
    "ajax": "ajax/datatable-ventasProd.ajax.php",
    "deferRender": true,
    "iDisplayLength": 5,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_",
        "sInfoEmpty": "Mostrando registros del 0 al 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});

/*===========================================
CARGANDO LA TABLA DE VENTAS DE SERVICIOS
 DINAMICAMENTE Y TRADUCIENDOLA AL ESPAÑOL
===========================================*/
$('#tablaVentaServicios').dataTable({
    "ajax": "ajax/datatable-ventasSer.ajax.php",
    "deferRender": true,
    "iDisplayLength": 5,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_",
        "sInfoEmpty": "Mostrando registros del 0 al 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});

/*===========================================
AGREGANDO PRODUCTOS A LA VENTA
===========================================*/
$("#tablaVentaProductos tbody").on("click", "button.agregarProducto", function() {
    $(".botonNuevoProducto").removeClass("d-none");
    var idProducto = $(this).attr("idProducto");
    // Guardo en una variable, el string de localStorage con los productos a quitar


    var productosAEliminar = localStorage.getItem("quitarProducto");

    // Corroboro que el string serviciosAEliminar tenga contenido,para evitar error, y lo convierto a objeto JSON
    if (productosAEliminar != undefined) {
        var productosJSON = JSON.parse(productosAEliminar);
        var filtro = productosJSON.filter((e) => e.idProducto !== idProducto);


        var unique = [...new Set(filtro.map(item => item))];

        localStorage.setItem("quitarProducto", JSON.stringify(unique));



    }
    $(this).removeClass("btn-info agregarProducto");
    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            /*======================================================
            EVITAR CARGAR PRDUCTO SI NO HAY STOCK
            ======================================================*/

            if (stock == 0) {
                swal.fire({
                    title: "No hay stock disponible",
                    type: "error",
                    confirmButtonText: "Cerrar"
                });
                $("button.recuperarBotonProducto[idProducto='" + idProducto + "']").removeClass('btn-default');
                $("button.recuperarBotonProducto[idProducto='" + idProducto + "']").addClass('btn-info agregarProducto');
                return;
            }

            $(".nuevoProducto").append(
                '<div class="row mb-2 ml-1 mr-1">' +
                '<div class="col-6">' +

                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '">' +
                '<i class="fa fa-times"></i>' +
                '</button>' +
                '</span>' +
                '</div>' +
                '<input type="text" class="js-example-basic-multiple js-states form-control inputAgregarProducto" multiple="multiple" idProducto="' + idProducto + '" name="inputAgregarProducto" value="' + descripcion + '" readonly required>' +
                '<input type="text" class="js-example-basic-multiple js-states form-control inputAgregarProducto" multiple="multiple" idProducto="' + idProducto + '" name="inputAgregarProducto" value="' + descripcion + '" readonly required>' +

                '</div>' +

                '</div>' +

                '<!-- Cantidad del producto -->' +
                '<div class="col-2 ingresoCantidad">' +
                ' <div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1"  value="1" stock="' + stock + '" nuevoStock="' + (Number(stock) - 1) + '" required>' +
                '</div>' +
                '</div>' +
                '</div>' +


                '<!-- Precio del producto -->' +

                '<div class="col-3 ingresoPrecio">' +

                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +

                '<i class="fas fa-dollar-sign"></i>' +

                '</span>' +
                '<input type="number" min="1" class="form-control nuevoPrecioProducto" precioReal="' + precio + '" name="nuevoPrecioProducto"  value="' + precio + '" readonly required>' +



                '</div>' +
                '</div>' +

                '</div>' +

                '</div> '



            )

            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()

            // Agrupar productos en JSON
            listarProductos()
            listarServicios()

        }
    });

})

/*===========================================
CUANDO CARGUE LA TABLA DE PRODUCTOS AL NAVEGAR EN ELLA
===========================================*/

$("#tablaVentaProductos").on("draw.dt", function() {

    if (localStorage.getItem("quitarProducto") != null) {
        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        for (var i = 0; i < listaIdProductos.length; i++) {

            $("button.recuperarBotonProducto[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');
            $("button.recuperarBotonProducto[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-info agregarProducto');

        }
    }
})

/*===========================================
QUITAR PRODUCTOS E LA VENTA Y RECUPERANDO BOTON
===========================================*/
var idQuitarProducto = [];
localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function() {

    $(this).parent().parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");
    /*===========================================
    ALMACENAR ID EN LOCALSTORAGE
    ===========================================*/

    if (localStorage.getItem("quitarProducto") == null) {
        idQuitarProducto = [];
    } else {
        var unique = [...new Set(idQuitarProducto.map(item => item.idProducto))];
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
    }

    idQuitarProducto.push({ "idProducto": idProducto });

    var unique = [...new Set(idQuitarProducto.map(item => item.idProducto))];
    idQuitarProducto = [];
    unique.map((e) => idQuitarProducto.push({ "idProducto": e }));

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBotonProducto[idProducto='" + idProducto + "']").removeClass('btn-default');
    $("button.recuperarBotonProducto[idProducto='" + idProducto + "']").addClass('btn-info agregarProducto');

    // SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios()

    // Agrupar productos en JSON
    listarProductos()
    listarServicios()


})


/*===========================================
AGREGANDO SERVICIOS A LA VENTA
===========================================*/
$("#tablaVentaServicios tbody").on("click", "button.agregarServicio", function() {
    var idServicio = $(this).attr("idServicio");

    $(".botonNuevoServicio").removeClass("d-none");
    // Guardo en una variable, el string de localStorage con los servicios a quitar


    var serviciosAEliminar = localStorage.getItem("quitarServicio");

    // Corroboro que el string serviciosAEliminar tenga contenido,para evitar error, y lo convierto a objeto JSON
    if (serviciosAEliminar != undefined) {
        var serviciosJSON = JSON.parse(serviciosAEliminar);
        var filtro = serviciosJSON.filter((e) => e.idServicio !== idServicio);


        var unique = [...new Set(filtro.map(item => item))];

        localStorage.setItem("quitarServicio", JSON.stringify(unique));



    }
    $(this).removeClass("btn-info agregarServicio");
    $(this).addClass("btn-default");

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
        success: function(respuesta) {

            var servicio = respuesta["servicio"];

            var precio = respuesta["precio"];

            $(".nuevoServicio").append(
                '<div class="row mb-2 ml-1 ">' +
                '<div class="col-6" >' +

                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio="' + idServicio + '">' +
                '<i class="fa fa-times"></i>' +
                '</button>' +
                '</span>' +
                '</div>' +
                '<input type="text" class="form-control inputAgregarServicio" name="inputAgregarServicio" value="' + servicio + '" readonly required>' +
                '<input type="hidden" class="idServicio" value="' + idServicio + '">' +

                '</div>' +

                '</div>' +




                '<!-- Precio del servicio -->' +

                '<div class="col-6">' +

                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +

                '<i class="fas fa-dollar-sign"></i>' +

                '</span>' +
                '<input type="number" min="1" class="form-control nuevoPrecioServicio" name="nuevoPrecioServicio"  value="' + precio + '" readonly required>' +



                '</div>' +
                '</div>' +

                '</div>' +

                '</div> '


            )

            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()

            // Agrupar productos en JSON

            listarServicios()


        }
    });

})



/*===========================================
CUANDO CARGUE LA TABLA DE SERVICIOS AL NAVEGAR EN ELLA
===========================================*/

$("#tablaVentaServicios").on("draw.dt", function() {

    if (localStorage.getItem("quitarServicio") != null) {
        var listaIdServicios = JSON.parse(localStorage.getItem("quitarServicio"));




        for (var i = 0; i < listaIdServicios.length; i++) {


            $("button.recuperarBotonServicio[idServicio='" + listaIdServicios[i]["idServicio"] + "']").removeClass('btn-default');
            $("button.recuperarBotonServicio[idServicio='" + listaIdServicios[i]["idServicio"] + "']").addClass('btn-info agregarServicio');



        }

    }

})


/*===========================================
QUITAR SERVICIOS DE LA VENTA Y RECUPERANDO BOTON
===========================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioVenta").on("click", "button.quitarServicio", function() {



    $(this).parent().parent().parent().parent().parent().remove();


    var idServicio = $(this).attr("idServicio");

    /*===========================================
    ALMACENAR ID EN LOCALSTORAGE
    ===========================================*/

    if (localStorage.getItem("quitarServicio") == null) {
        idQuitarServicio = [];
    } else {

        var unique = [...new Set(idQuitarServicio.map(item => item.idServicio))];
        idQuitarServicio.concat(localStorage.getItem("quitarServicio"))
    }

    idQuitarServicio.push({ "idServicio": idServicio });

    var unique = [...new Set(idQuitarServicio.map(item => item.idServicio))];
    idQuitarServicio = [];
    unique.map((e) => idQuitarServicio.push({ "idServicio": e }));


    localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));



    $("button.recuperarBotonServicio[idServicio='" + idServicio + "']").removeClass('btn-default');
    $("button.recuperarBotonServicio[idServicio='" + idServicio + "']").addClass('btn-info agregarServicio');

    // SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios()

    // Agrupar productos en JSON
    listarProductos()

    listarServicios()

})


/*======================================================
AGREGAR PRODUCTS DESDE EL BTN PARA DISPOSITIVOS MOVILES
======================================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function() {
        $(".botonNuevoProducto").removeClass("d-none");

        numProducto++;

        var datos = new FormData();
        datos.append("traerProductos", "ok");

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                $(".nuevoProducto").append(
                    '<div class="row mb-3 ml-1 mr-1">' +
                    '<div class="col-12 col-md-7" >' +

                    '<div class="input-group">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">' +
                    '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto>' +
                    '<i class="fa fa-times"></i>' +
                    '</button>' +
                    '</span>' +
                    '</div>' +
                    '<select class="form-control nuevaDescripcionProducto inputAgregarProducto" idProducto id="producto' + numProducto + '"  name="nuevaDescripcionProducto" required>' +
                    '<option>Seleccione el producto</option>' +
                    '</select>' +


                    '</div>' +

                    '</div>' +

                    '<!-- Cantidad del producto -->' +
                    '<div class="col-6 col-md-2 ingresoCantidad">' +
                    ' <div class="input-group">' +
                    '<div class="input-group-prepend">' +
                    '<input type="number" class="form-control nuevaCantidadProducto" placeholder="cantidad" name="nuevaCantidadProducto" min="1"  value="1" stock nuevoStock="" readonly required>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +


                    '<!-- Precio del producto -->' +

                    '<div class="col-6 col-md-3 ingresoPrecio" id="ingresoPrecio">' +

                    '<div class="input-group">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">' +

                    '<i class="fas fa-dollar-sign"></i>' +

                    '</span>' +
                    '<input type="number" min="1" class="form-control nuevoPrecioProducto" precioReal name="nuevoPrecioProducto" value readonly required>' +



                    '</div>' +
                    '</div>' +

                    '</div>' +

                    '</div> '


                )

                // AGREGAR PRODUCTOS AL SELECT
                respuesta.forEach(funcionForEach);

                function funcionForEach(item, index) {

                    if (item.stock > 0) {
                        $("#producto" + numProducto).append(

                            '<option class="optionProducto" idProducto="' + item.id + '" value="' + item.descripcion + '">' + item.descripcion + '</option>'

                        )
                    }
                }
                sumarTotalPrecios()



            }


        })

    })
    /*======================================================
    SELECCIONAR PRODUCTOS PARA DISPOSITIVOS MOVILES
    ======================================================*/



$(document).on("change", ".nuevaDescripcionProducto", function() {

    var nombreProducto = $(this).val();

    var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children().children(".nuevoPrecioProducto");

    var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children().children().children(".nuevaCantidadProducto");

    nuevaCantidadProducto.prop("readonly", false);

    var id = $(this)

    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {


            $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
            $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"]) - 1);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
            $(id).attr("idProducto", respuesta["id"])


            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()
                // Agrupar productos en JSON
            listarProductos()
            listarServicios();
        }
    })
})

/*======================================================
MODIFICAR LA CANTIDAD
======================================================*/

$(document).on("change", "input.nuevaCantidadProducto", function() {

    var precio = $(this).parent().parent().parent().parent().children(".ingresoPrecio").children().children().children(".nuevoPrecioProducto");

    var precioFinal = $(this).val() * precio.attr("precioReal");

    var precioFinalRounded = precioFinal.toFixed(2)
    precio.val(precioFinalRounded);

    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock)

    if (Number($(this).val()) > Number($(this).attr("stock"))) {


        $(this).val(0);
        precio.val(precio.attr("precioReal"));

        swal.fire({
            title: "La cantidad supera el stock",
            text: "Sólo hay " + $(this).attr("stock") + " unidades.",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    }


    sumarTotalPrecios()

    // Agrupar productos en JSON
    listarProductos()
    listarServicios();

})

/*======================================================
SUMAR TODOS LOS PRECIOS
======================================================*/

function sumarTotalPreciosProductos() {
    var precioItem = $(".nuevoPrecioProducto");
    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
    }

    function sumaArrayPrecios(total, numero) {
        return total + numero;
    }

    sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios, 0)

    return sumaTotalPrecio
}

function sumarTotalPreciosServicios() {
    var precioItem = $(".nuevoPrecioServicio");
    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
    }

    function sumaArrayPrecios(total, numero) {
        return total + numero;
    }

    sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios, 0)

    return sumaTotalPrecio
}

function sumarTotalPrecios() {
    var num = sumarTotalPreciosProductos() + sumarTotalPreciosServicios()

    var total = num.toFixed(2)
    $("#nuevoTotalVenta").val(total)

    $("#nuevoTotalVenta").html('<i class="fas fa-dollar-sign"></i> ' + total);

}


/*======================================================
SELECCIONAR METODO DE PAGO
======================================================*/


$("#nuevoMetodoPago").change(function() {

    var metodo = $(this).val();

    if (metodo == "Efectivo") {
        $(this).parent().parent().parent().parent().removeClass("col-sm-6");
        $(this).parent().parent().parent().parent().addClass("col-sm-4");

        $(this).parent().parent().parent().parent().parent().children(".cajasMetodoPago").html(
            '<div class="row " style="margin-left:0.4%">' +
            ' <div class="col-xs-12 col-sm-6">' +
            '<div class="form-group">' +
            '<div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>' +
            '<input type="text" class="form-control-sm nuevoValorEfectivo" >' +

            '</div>' +
            '</div>' +
            '<small class="form-text text-muted ml-4">Paga con...</small>' +
            '</div>' +

            '</div>' +

            '<div class="col-xs-12 col-sm-6 capturarCambioEfectivo">' +

            '<div class="form-group">' +
            '<div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>' +
            '<input type="text" class="form-control-sm nuevoCambioEfectivo" readonly >' +

            '</div>' +

            '</div>' +
            '<small class="form-text text-muted ml-4">Vuelto</small>' +
            '</div>' +

            '</div>' +
            '</div>'
        )
        listarMetodos()
    } else {
        $(this).parent().parent().parent().parent().removeClass("col-sm-4");
        $(this).parent().parent().parent().parent().addClass("col-sm-6");

        $(this).parent().parent().parent().parent().parent().children(".cajasMetodoPago").html(

            ' <div class="col-12    ">' +
            ' <div class="form-group">' +
            ' <div class="input-group">' +
            '<div class="input-group-prepend">' +
            ' <span class="input-group-text">' +

            ' <i class="fas fa-lock"></i>' +

            ' </span>' +
            '<input type="text" class="form-control-sm" name="nuevoCodigoTransaccion" id="nuevoCodigoTransaccion" placeholder="Código Transacción">' +
            '</div>' +
            '</div>' +
            ' </div>' +
            '</div>'
        );
    }



})


/*======================================================
CAMBIO EN EFECTIVO
======================================================*/

$(".formularioVenta").on("change", "input.nuevoValorEfectivo", function() {

    var efectivo = $(this).val();

    var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

    var nuevoCambioEfectivo = $(this).parent().parent().parent().parent().parent().parent().children().children('.capturarCambioEfectivo').children().children().children().children('.nuevoCambioEfectivo')

    nuevoCambioEfectivo.val(cambio.toFixed(2))


})

/*======================================================
CAMBIO METODO TRANSACCION
======================================================*/

$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function() {

    listarMetodos()


})


/*======================================================
LISTAR TODOS LOS PRODUCTOS Y SERVICIOS
======================================================*/

function listarProductos() {

    var listaProductos = [];


    var descripcion = $(".inputAgregarProducto");

    var cantidad = $(".nuevaCantidadProducto");

    var precio = $(".nuevoPrecioProducto");

    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({
            "id": $(descripcion[i]).attr("idProducto"),
            "descripcion": $(descripcion[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "stock": $(cantidad[i]).attr("nuevoStock"),
            "precio": $(precio[i]).attr("precioReal"),
            "total": $(precio[i]).val()
        })

    }

    precioProductos = 0;
    for (var i = 0; i < listaProductos.length; i++) {
        precioProductos = precioProductos + Number(listaProductos[i]["total"])
    }

    $("#listaProductos").val(JSON.stringify(listaProductos));
    $("#precioFinalProductos").val(precioProductos)

}

function listarServicios() {
    var listaServicios = [];

    var descripcion = $(".inputAgregarServicio");
    var precio = $(".nuevoPrecioServicio");
    var id = $(".idServicio");

    for (var i = 0; i < descripcion.length; i++) {

        listaServicios.push({
                "descripcion": $(descripcion[i]).val(),
                "precio": $(precio[i]).val(),
                "id": $(id[i]).val()

            }

        )
    }
    precioServicios = 0;
    for (var i = 0; i < listaServicios.length; i++) {
        precioServicios = precioServicios + Number(listaServicios[i]["precio"])
    }
    console.log("Precio de Servicios: ", precioServicios)

    $("#listaServicios").val(JSON.stringify(listaServicios));
    $("#precioFinalServicios").val(precioServicios)
}



/*======================================================
LISTAR METODO DE PAGO
======================================================*/



function listarMetodos() {

    var listaMetodos = "";

    if ($("#nuevoMetodoPago").val() == "Efectivo") {

        $("#listaMetodoPago").val("Efectivo");
    } else {
        $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val());
    }
}



/*======================================================
EDITAR VENTA
======================================================*/

$(document).on("click", ".btnEditarVenta", function() {
    var idVenta = $(this).attr("idVenta");

    window.location = "index.php?ruta=editar-venta&idVenta=" + idVenta;
})



/*======================================================
ELIMINAR VENTA
======================================================*/

$(document).on("click", ".btnEliminarVenta", function() {
    var idVenta = $(this).attr("idVenta");

    swal.fire({

        title: '¿Está seguro de borrar el servicio?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar servicio!'
    }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=ventas&idVenta=" + idVenta;

        }


    })


})

/*======================================================
SELECCIONAR RANGO DE FECHAS
======================================================*/
$('#daterange-btn').daterangepicker({
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimas 7 Días': [moment().subtract(6, 'days'), moment()],
            'Últimas 30 Días': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()
    },
    function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var fechaInicialRango = start.format('DD-MMM-YYYY');

        var fechaFinalRango = end.format('DD-MMM-YYYY');

        var capturarRango = fechaInicialRango + " - " + fechaFinalRango;

        $("#daterange-btn").children("#spanRango").html(capturarRango);

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;
    }
)



/*======================================================
CANCELAR RANGO DE FECHAS
======================================================*/
$(".cancelBtn2").on("click", function() {
    localStorage.removeItem("capturarRango");
    localStorage.removeItem("capturarRango2");
    localStorage.clear();
    var url = window.location
    var parts = url.toString().split("/");
    var lastSegment = parts.pop() || parts.pop();
    var parts2 = lastSegment.toString().split("ruta=", );
    var lastSegment2 = parts2.pop() || parts2.pop();
    var parts3 = lastSegment2.toString().split("&", );
    var goto = parts3[0];
    window.location = goto;
})


/*======================================================
CAPTURAR HOY
======================================================*/
$(".daterangepicker .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");

    if (textoHoy == "Hoy") {
        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var ano = d.getFullYear();

        if (mes < 10) {
            var fechaInicial = ano + "-0" + mes + "-" + dia;
            var fechaFinal = ano + "-0" + mes + "-" + dia;
        } else if (dia < 10) {
            var fechaInicial = ano + "-" + mes + "-0" + dia;
            var fechaFinal = ano + "-" + mes + "-0" + dia;
        } else if (mes < 10 && dia < 10) {
            var fechaInicial = ano + "-0" + mes + "-0" + dia;
            var fechaFinal = ano + "-0" + mes + "-0" + dia;
        } else {
            var fechaInicial = ano + "-" + mes + "-" + dia;
            var fechaFinal = ano + "-" + mes + "-" + dia;
        }



        localStorage.setItem("capturarRango", "Hoy");
        window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;
    }
})

/*===========================================
COLOCO BUSCADORES A LOS SELECT CLIENTES Y PRODUCTOS
===========================================*/

$("#agregarCliente").select2({
    placeholder: "Seleccionar Cliente"
});


$('body').on('DOMNodeInserted', '.inputAgregarProducto', function() {
    $(this).select2({
        placeholder: "Seleccionar Producto"
    });
});