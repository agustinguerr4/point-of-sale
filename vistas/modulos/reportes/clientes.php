<?php
  if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
  }else{
    $fechaInicial = null;
    $fechaFinal = null;
  }

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

$arrayClientes = array();
$arraylistaVendedoresP = array();
$arraylistaVendedoresS = array();

foreach ($ventas as $key => $valueVentas) {

  foreach ($clientes as $key => $valueClientes) {

    if($valueClientes["id"] == $valueVentas["id_cliente"]){

        #Capturamos los vendedores en un array
        array_push($arrayClientes, $valueClientes["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaClientesP = array($valueClientes["nombre"] => $valueVentas["precio_productos"]);
        $arraylistaClientesS = array($valueClientes["nombre"] => $valueVentas["precio_servicios"]);

         #Sumamos los netos de cada vendedor

        foreach ($arraylistaClientesP as $key => $value) {

            $sumaTotalClientesP[$key] += $value;

         }
         foreach ($arraylistaClientesS as $key => $value) {

          $sumaTotalClientesS[$key] += $value;

       }

    }
  
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayClientes);


?>


   <!-- STACKED BAR CHART -->
   <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tabla de Clientes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart2" style="height:230px; min-height:230px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <script>
                    //--------------
    //- AREA CHART -
    //--------------


var areaChartData = {
  labels  : [<?php

foreach($noRepetirNombres as $key => $value){
  echo "'".$value."',";
}

?>],
  datasets: [
    {
      label               : 'Servicios',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius          : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : [ <?php

foreach($sumaTotalClientesS as $key => $value){
  echo "'".$value."',";
}

?>]
    },
    {
      label               : 'Productos',
      backgroundColor     : 'rgba(210, 214, 222, 1)',
      borderColor         : 'rgba(210, 214, 222, 1)',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [ <?php

                foreach($sumaTotalClientesP as $key => $value){
                  echo "'".$value."',";
                }

                ?>]
    }
  ]
}


            
                 //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart2').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, areaChartData)

    var stackedBarChartOptions = {
        preUnits: '$',
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true,
          ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + value;
                    }}
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
            </script>