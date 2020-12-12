<?php

error_reporting(0);

  if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
  }else{
    $fechaInicial = null;
    $fechaFinal = null;
  }

      $suma = array();
      $arrayFechas = array();
      $arrayProductos = array();
      $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

         foreach($respuesta as $key => $value){
            $fecha = (substr($value["fecha"],0,7));

            #Introducir fechas en arrayFechas
            array_push($arrayFechas, $fecha);

            #Capturamos las ventas
            $arrayProductos = array($fecha => $value["precio_productos"]);



            #Sumamos los pagos del mismo mes


            foreach ($arrayProductos as $key => $value){
                $suma[$key] += $value;
            }

         }

         $noRepetirFecha = array_unique($arrayFechas);

?>


<!-- GRAFICO DE VENTAS -->



<div class="card bg-gradient-danger">
    <div class="card-header">
        <i class=" fa fa-2x fa-th"></i>
        <h2 class="d-inline ml-1">Productos</h2>
        <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
        
        
    </div>

    <div class="card-body">
    <div id="precio-productos" style="height: 250px;"></div>
        
    </div>
    </div>
</div>

<script>
    new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'precio-productos',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
      <?php 
      if($noRepetirFecha != null){
      foreach($noRepetirFecha as $key){
          echo "{ year: '".$key."', productos: ".$suma[$key]." },";
      }
      echo " { year: '".$key."', productos: ".$suma[$key]." }";
    }else{
        echo " { year: '0', productos: '0' }" ;
    }

      ?>
  ],
  gridTextColor: 'white',
  
  // The name of the data record attribute that contains x-productos.
  xkey: 'year',
  // A list of names of data record attributes that contain y-productos.
  ykeys: ['productos'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['productos'],
  preUnits: '$'
});
</script>