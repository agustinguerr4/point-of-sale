<?php
if($_SESSION["perfil"] != "Administrador"){
  echo '<script> alert("No tienes permiso para entrar a esta página"); </script>';
  echo '<script> window.location = "inicio"; </script>';
}
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
      $arrayServicios = array();
      $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

      $cajaProductos = 0;
      $cajaServicios = 0;
         foreach($respuesta as $key => $value){
           $cajaProductos += $value["precio_productos"];
           $cajaServicios += $value["precio_servicios"];
                     
         }


         $arrayP = 0;
         $arrayS = 0;
                    
         foreach($respuesta as $key => $value){
          
          
          $prod = json_decode($value["productos"]);
          foreach($prod as $key => $value){
           
            $arrayP += 1 ;
          }

                     
        }

        foreach($respuesta as $key => $value){
          
          
          $serv = json_decode($value["servicios"]);
          foreach($serv as $key => $value){
            
            $arrayS += 1 ;
          }

                     
        }

     
                


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reportes</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Reportes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card">
    <div class="card-header">
            <div class="input-group d-inline">
                    <button type="button" class="btn btn-secondary" id="daterange-btn2">
                                <i class="far fa-calendar-alt"></i>
                                <span id="spanRango">Rango de fechas</span>
                                
                                <i class="fas fa-caret-down"></i>
                    </button>
                   
            </div>
            <div class="card-tools float-right">

            <?php
            if(isset($_GET["fechaInicial"])){

              $url = 'descargar-reporte.php?reporte=reporte&fechaInicial='.$fechaInicial.'&fechaFinal='.$fechaFinal;
           
              echo '<a href="vistas/modulos/'.$url.'">';
              

            }else{

              echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';


            }
            ?>
             
                
              <button class="btn btn-success">Descargar reporte en Excel</button>

              </a>
      
            </div>

          
            

              
            </div>
    </div>

    <div class="card">
      <div class="card-body">
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>$ <?php echo $cajaServicios; ?></h3>

                <p>Caja de Servicios</p>
              </div>
              <div class="icon">
              <i class="fas fa-dollar-sign"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>$ <?php echo $cajaProductos; ?></h3>

                <p>Caja de Productos</p>
              </div>
              <div class="icon">
              <i class="fas fa-dollar-sign"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php 
                    echo(($arrayS));
                ?></h3>

                <p>Cantidad de Servicios</p>
              </div>
              <div class="icon">
              <i class="far fa-gem"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php 
                    echo(($arrayP));
                ?></h3>

                <p>Cantidad de Productos</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </div>
      <!-- Default box -->
      <div class="card">
      
          <div class="card-body">
            <div class="row">
                <div class="col-12">
                  <?php
                    include "reportes/grafico-ventas-servicios.php";
                  ?>
                </div>
            </div>
          </div>

        <div class="card">
          <div class="card-body">

            <div class="row">
              <div class="col-12">
                <?php
                  include "reportes/grafico-ventas-productos.php";
                ?>
              </div>
            </div>

            
            <div class="card-body">

                <div class="row">
                  <div class=" col-xs-12 col-md-6 ">
                      <?php
                        include "reportes/clientes.php";
                      ?>
                  </div>
                  <div class=" col-xs-12 col-md-6 ">
                      <?php
                        include "reportes/vendedores.php";
                      ?>
                  </div>
                
                </div>
            </div>

            <div class="card-body">

            <div class="row">
              <div class=" col-xs-12 col-md-6 ">
                  <?php
                    include "reportes/grafico-cant-serv.php";
                  ?>
              </div>
              <div class="col-xs-12 col-md-6">
                  <?php
                    include "reportes/grafico-cant-prod.php";
                  ?>
              </div>
            </div>
            </div>

          
          </div>
         

            </div>
          
        </div>
        

        

      
    

    </section>
    <!-- /.content -->
  </div>