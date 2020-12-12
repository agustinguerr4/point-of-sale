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
$usuarios = array();

$ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$respUsuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

foreach($respUsuarios as $key => $value){
  if($value["estado"] == 1){
    array_push($usuarios,$value);
  }
}

$arrayVendedores = array();
$arraylistaVendedoresP = array();
$arraylistaVendedoresS = array();

foreach ($ventas as $key => $valueVentas) {

  foreach ($usuarios as $key => $valueUsuarios) {
    

    if($valueUsuarios["id"] == $valueVentas["id_vendedor"]){

        #Capturamos los vendedores en un array
        array_push($arrayVendedores, $valueUsuarios["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaVendedoresP = array($valueUsuarios["nombre"] => $valueVentas["precio_productos"]);
        $arraylistaVendedoresS = array($valueUsuarios["nombre"] => $valueVentas["precio_servicios"]);

         #Sumamos los netos de cada vendedor

        foreach ($arraylistaVendedoresP as $key => $value) {

            $sumaTotalVendedoresP[$key] += $value;

         }
         foreach ($arraylistaVendedoresS as $key => $value) {

          $sumaTotalVendedoresS[$key] += $value;

       }

    }
  
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayVendedores);


?>

  
  
  <!-- STACKED BAR CHART -->
   <div class="card card-teal">
              <div class="card-header">
                <h3 class="card-title">Tabla de Vendedores</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="height:230px; min-height:230px"></canvas>
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


  labels  : [
    <?php

       foreach($noRepetirNombres as $key => $value){
         echo "'".$value."',";
       }

    ?>
  ],
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
      data                : [
        <?php

            foreach($sumaTotalVendedoresS as $key => $value){
              echo "'".$value."',";
            }

        ?>
      ]
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
      data                : [
        <?php

            foreach($sumaTotalVendedoresP as $key => $value){
              echo "'".$value."',";
            }

        ?>
      ]
    }
  ]
}


            
                 //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
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