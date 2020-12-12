<?php
error_reporting(0);

  
$hoy = getdate();

$fechaDeHoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
$usuarioEnLinea = $_SESSION['id'];


      $respuesta = ControladorVentas::ctrVentasDiarias($fechaDeHoy,$usuarioEnLinea);
    
      $cajaProductos = 0;
      $cajaServicios = 0;
         foreach($respuesta as $key => $value){
           $cajaProductos += $value["precio_productos"];
           $cajaServicios += $value["precio_servicios"];
                     
         }


                


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tablero</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row ml-1">
            <div class="col-md-6 col-12">
                <div class="card bg-dark">
                    <div class="card-header">
                        <h4 class="d-inline">Accesos rápidos</h4>
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body" style="background-color:#e0e0e0">
                        <div class="row">
                            <div class="col-md-4 col-12 mb-2">

                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalAgregarCliente">Cargar Cliente</button>
                            </div>
                            <div class="col-md-4 col-12 mb-2">
                                <a href="/crear-venta" class="btn btn-danger">Cargar Servicio</a>

                            </div>
                            <div class="col-md-4 col-12 ">
                                <a href="/turnos" class="btn btn-success">Asignar Turno</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="card bg-dark">
                <div class="card-header">
                        <h4 class="d-inline">Mis números diarios</h4>
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="background-color:#e0e0e0;" >
                        <div class="row">
                            <div class="col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h4>$ <?php echo $cajaServicios; ?></h4>

                                        <p>Caja de servicios de <?php echo $_SESSION['nombre']; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h4>$ <?php echo $cajaProductos; ?></h4>

                                        <p>Caja de productos de <?php echo $_SESSION['nombre']; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                           
                            <!-- ./col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12">
                  <!-- Main content -->
                        <section class="content">

                                <!-- Default box -->
                                <div class="card">
                                <div class="card-header bg-dark">
                                                        <h4 class="d-inline">Productos</h4>
                                                        <div class="card-tools">

                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                                                title="Collapse">
                                                                <i class="fas fa-minus"></i></button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                                                title="Remove">
                                                                <i class="fas fa-times"></i></button>
                                                        </div>
                                                    </div>
                                    <div class="card-body">

                                        <table class="table table-striped table-bordered dt-responsive nowrap  tablaProductosInicio" 
                                            style="width:100%">

                                            <thead>
                                                <tr>
                                                

                                                    <th>Producto</th>
                                                    
                                                    <th>Precio</th>
                                                    <th>Stock</th>
                                                </tr>
                                            </thead>





                                        </table>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                    </section>

            </div>
            <div class="col-md-6 col-12">
                  <!-- Main content -->
                        <section class="content">

                                <!-- Default box -->
        <div class="card">
        <div class="card-header bg-dark">
                                                        <h4 class="d-inline">Servicios</h4>
                                                        <div class="card-tools">

                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                                                title="Collapse">
                                                                <i class="fas fa-minus"></i></button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                                                title="Remove">
                                                                <i class="fas fa-times"></i></button>
                                                        </div>
                                                    </div>
            <div class="card-body">

                <table data-page-length='4' class="table table-striped table-bordered tablas dt-responsive nowrap tablaServiciosInicio" id="tablaServicios"style="width:100%">

                    <thead>
                        <tr>
                            <th class="col-8">Servicio</th>
                            <th class="col-4">Precio</th>
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
              <td class="text-capitalize">'.$value['servicio'].'</td>
              <td>$'.$value['precio'].'</td>
              
             
            </tr>';
            }
            ?>



                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
                    </section>

            </div>
        </div>

        <!-- Default box -->
        <div class="card bg-dark">
            <div class="card-header">

                <h4 class="d-inline">Turnos</h4>
                <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body bg-gray"  >
                <div class="content-wrapper">



                    <!-- Main content -->
                    <section class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class=" mb-3">
                                        <div class="card">

                                            <!-- the events -->
                                            <div id="external-events">
                                            </div>

                                        </div>
                                        <?php
            ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-body p-0">
                                            <!-- THE CALENDAR -->
                                            <div id="calendar"></div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
                <!-- Modal -->
            </div>
            <!-- /.card-body -->
            
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del turno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-auto">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="far fa-user"></i></div>
                        </div>
                        <input type="text" class="form-control" id="title" readonly>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-users"></i></div>
                        </div>
                        <input type="text" class="form-control" id="modal-barbero" readonly>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="far fa-gem"></i></div>
                        </div>
                        <input type="text" class="form-control" id="modal-servicio" readonly>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <input type="text" class="form-control" id="date" readonly>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                        <input type="text" class="form-control" id="start" readonly>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                        </div>
                        <input type="text" class="form-control" id="end" readonly>
                    </div>
                </div>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                <button type="button" class="btn btn-danger eliminarTurno">Eliminar</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Agregar Cliente -->

<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Agregar Cliente</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevoCliente"
                                    placeholder="Ingresar nombre" required>

                            </div>

                        </div>

                        <!-- Entrada para el DNI-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-id-card"></i></span>
                                </div>

                                <input class="form-control" type="text" min="0" name="nuevoDocumento"
                                    id="nuevoDocumento" placeholder="Ingresar DNI" required>

                            </div>

                        </div>

                        <!-- Entrada para el mail-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-mail-bulk"></i></span>
                                </div>

                                <input class="form-control" type="email" name="nuevoEmail" placeholder="Ingresar email">

                            </div>

                        </div>

                        <!-- Entrada para el teléfono-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevoTelefono" id="nuevoTelefono"
                                    placeholder="Ingresar teléfono">

                            </div>

                        </div>

                        <!-- Entrada para LA DIRECCÍON-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-map-marker-alt"></i></span>
                                </div>

                                <input class="form-control d-inline" type="text" name="nuevaDireccion"
                                    placeholder="Ingresar dirección">

                            </div>

                        </div>



                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>





                <?php
                      $crearCliente = new ControladorClientes();
                      $crearCliente -> ctrCrearCliente();

                    ?>
            </form>
        </div>
    </div>
</div>