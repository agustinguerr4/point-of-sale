


            <?php

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$item = null;
$valor = null;
$orden = "ventas";
$productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

foreach($respuesta as $key =>  $value){

  // ACA TENGO QUE PODER TRAER LA CANTIDAD DE LOS PRODUCTOS SEGUN LA FECHA ELEGIDA


}


?>


<!-- GRAFICO DE VENTAS -->

<!-- DONUT CHART -->
<div class="card card-warning">
<div class="card-header">
<h3 class="card-title">Top Productos (Desde Siempre)</h3>

<div class="card-tools">
  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
  </button>
  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
</div>
</div>
<div class="card-body">
<canvas id="cant-prod" style="height:230px; min-height:230px"></canvas>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->


<script>
//-------------
//- DONUT CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
var donutChartCanvas = $('#cant-prod').get(0).getContext('2d')
var donutData        = {
labels: 
<?php
echo '[';
 for($i=0; $i < 5; $i++){
     if($i < 4){

        echo '"'.$productos[$i]["descripcion"].'",';
     }else{
        echo '"'.$productos[$i]["descripcion"].'"'; 
     }
 }
 echo ']';
?>
,
datasets: [
{
data: <?php
echo '[';
 for($i=0; $i < 5; $i++){
     if($i < 4){

        echo '"'.$productos[$i]["ventas"].'",';
     }else{
        echo '"'.$productos[$i]["ventas"].'"'; 
     }
 }
 echo ']';
?>,
backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
}
]
}
var donutOptions     = {
maintainAspectRatio : false,
responsive : true,
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
var donutChart = new Chart(donutChartCanvas, {
type: 'doughnut',
data: donutData,
options: donutOptions      
})

</script>