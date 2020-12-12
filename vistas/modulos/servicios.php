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
                    <h1>Administrar Servicios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Servicios</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">Agregar
                    Servicio</button>
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered tablas dt-responsive nowrap" id="tablaServicios"style="width:100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th class="col-6">Nombre</th>
                            <th class="col-3">Precio</th>
                            <?php if($_SESSION["perfil"] == "Administrador"){
                    echo '
                            <th class="col-3">Acciones</th>';}?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
            $item = null;
            $valor = null;

            $orden = "id";
            $servicios = ControladorServicios::ctrMostrarServicios($item, $valor,$orden);


            foreach($servicios as $key => $value){
              echo '
              <tr>
              <td>'.($key+1).'</td>
              <td class="text-capitalize">'.$value['servicio'].'</td>
              <td>$'.$value['precio'].'</td>';
              if($_SESSION["perfil"] == "Administrador"){
                echo '
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarServicio" idServicio="'.$value['id'].'" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-pencil-alt"></i></button>
                  <button class="btn btn-danger btnEliminarServicio" idServicio="'.$value['id'].'"><i class="fa fa-times"></i></button>
                  
                </div>
              </td>';
             
             echo '</tr>';
            }}
            ?>



                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>


<!-- Modal Agregar Servicio -->

<div class="modal fade" id="modalAgregarServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Agregar Servicio</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre del servicio-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-gem"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevoServicio"
                                    placeholder="Ingresar nuevo servicio" required>

                            </div>

                        </div>

                        <!-- Entrada para el precio -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa-money-bill-alt"></i></span>
                                </div>

                                <input class="form-control" type="number" name="nuevoPrecioServicio"
                                    placeholder="Ingresar precio" required>

                            </div>

                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php 
                  $crearServicio = new ControladorServicios();
                  $crearServicio -> ctrCrearServicio();
                ?>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Editar Servicio</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre del servicio-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-gem"></i></span>
                                </div>

                                <input class="form-control" type="text" name="editarServicio" id="editarServicio"
                                    required>
                                <input class="form-control" type="hidden" name="idServicio" id="idServicio">

                            </div>

                        </div>

                        <!-- Entrada para el precio -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa-money-bill-alt"></i></span>
                                </div>

                                <input class="form-control" type="number" name="editarPrecioServicio"
                                    id="editarPrecioServicio" required>

                            </div>

                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php 
                  $editarServicio = new ControladorServicios();
                  $editarServicio -> ctrEditarServicio();
                ?>

            </form>
        </div>
    </div>
</div>

<?php 
                  $borrarServicio = new ControladorServicios();
                  $borrarServicio -> ctrBorrarServicio();
                ?>