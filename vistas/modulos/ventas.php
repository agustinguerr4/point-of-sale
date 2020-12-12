<?php

if($_SESSION["perfil"] == "Vendedor"){
    echo '<script> alert("No tienes permiso para entrar a esta página"); </script>';
    echo '<script> window.location = "inicio"; </script>';
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Ventas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header ">
          <a href="crear-venta">
              <button class="btn btn-primary">Agregar Venta</button>
          </a>
          <button type="button" class="btn btn-default float-right" id="daterange-btn">
                       <i class="far fa-calendar-alt"></i>
                       <span id="spanRango">Rango de fechas</span>
                       
                      <i class="fas fa-caret-down"></i>
          </button>
        </div>
        <div class="card-body">
          
          <table class="table table-striped table-bordered dt-responsive nowrap tablaVentas" id="tablaVentas" style="width:100%"> 
          
            <thead>
              <tr>
                <th style="width:10px">#</th>
                
                <th>Cliente</th>
                <th>Colaborador</th>
                <th>Forma de Pago</th>
                <th>Precio Servicio</th>
                <th>Precio Productos</th>
                <th>Fecha</th>
                <?php if($_SESSION["perfil"] == "Administrador"){
                    echo '
                <th>Acciones</th>';}?>
              </tr>
            </thead>
           
          </table>
          <?php
 $eliminarVenta = new ControladorVentas();
 $eliminarVenta -> ctrEliminarVenta();

 ?>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>


