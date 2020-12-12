/*===========================================
VAR LOCALSTORAGE
===========================================*/

if (localStorage.getItem("capturarRango2") != null) {


    $("#daterange-btn2").children("#spanRango").html(localStorage.getItem("capturarRango2"));

} else {
    $("#daterange-btn2").children("#spanRango").html('Rango de fechas');

}
/*======================================================
SELECCIONAR RANGO DE FECHAS
======================================================*/
$('#daterange-btn2').daterangepicker({
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
        $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var fechaInicialRango = start.format('DD-MMM-YYYY');

        var fechaFinalRango = end.format('DD-MMM-YYYY');

        var capturarRango = fechaInicialRango + " - " + fechaFinalRango;

        $("#daterange-btn2").children("#spanRango").html(capturarRango);

        localStorage.setItem("capturarRango2", capturarRango);

        window.location = "index.php?ruta=reportes&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;
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



        localStorage.setItem("capturarRango2", "Hoy");
        var url = window.location
                                var parts = url.toString().split("/");
                                var lastSegment = parts.pop() || parts.pop();
                                var parts2 = lastSegment.toString().split("ruta=", );
                                var lastSegment2 = parts2.pop() || parts2.pop();
                                var parts3 = lastSegment2.toString().split("&", );
                                var goto = parts3[0];
                                destino = goto;
        window.location = "index.php?ruta="+destino+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;
    }
})