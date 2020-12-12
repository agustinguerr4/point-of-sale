<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Venta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Crear Venta</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content pb-1">

        <div class="row">


            <!-- FORMULARIO DE VENTA -->
            <div class="col-lg-6 col-xs-12">
                <div class="card border border-success">
                    <form method="post" role="form" class="formularioVenta">
                        <div class="card-body mt-4">

                            <div class="ribbon-wrapper ribbon-lg">
                                <div class="ribbon bg-success">
                                    Venta Actual
                                </div>
                            </div>

                            <div class="card p-1">
                                <!-- VENDEDOR -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                                            value="<?php echo $_SESSION['nombre']; ?>" readonly>
                                        <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]?>">
                                    </div>
                                </div>

                                <!-- CODIGO DE LA VENTA -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                        <?php

                                            $item = null;
                                            $valor = null;

                                            $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                                            if(!$ventas){

                                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';


                                            }else{

                                            foreach ($ventas as $key => $value) {
                                                
                                                
                                            
                                            }

                                            $codigo = $value["codigo"] + 1;



                                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';


                                            }

                                        ?>
                                        
                                    </div>
                                </div>

                                <!-- CLIENTE -->
                                <div class="form-group">
                                    <div class="input-group"  style="flex-wrap:nowrap;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                                        </div>
                                        <select type="text" class="js-example-basic-multiple js-states form-control" id="agregarCliente"
                                            name="agregarCliente" required>
                                            <option value="">Seleccionar Cliente</option>
                                            <?php
                                                $item = null;
                                                $valor = null;

                                                $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);

                                                foreach($clientes as $key => $value){
                                                    echo '<option value="'.$value["id"].'">'.$value["nombre"].' - Dni: '.$value["documento"].'</option>';
                                                }
                                            ?>
                                        </select>

                                        <span class="input-group-text">
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                                data-target="#modalAgregarCliente" data-dismiss="modal"
                                                placeholder="Agregar Cliente">
                                                Agregar Cliente
                                            </button>
                                        </span>
                                    </div>
                                </div>


                                <!-- AGREGAR PRODUCTOS Y SERVICIOS -->
                                <div class="form-group nuevoServicio mb-4"> 
                                    <div class="row botonNuevoServicio d-none ml-4">
                                        
                                            <div class="col-12"> <h4 class="text-uppercase">Servicios</h4></div>
                                            
                                        
                                    </div>

                                    <input type="hidden" id="listaServicios" name="listaServicios">
                                    
                                    
                                </div>
                                <div class="form-group nuevoProducto mb-2"> 
                                        <div class="row botonNuevoProducto d-none ml-4">
                                        <div class="col-12"> <h4 class="text-uppercase">Productos</h4></div>
                                                
                                        </div>
                                        <input type="hidden" id="listaProductos" name="listaProductos">
                                
                                </div>
                                
                                

                                <!-- Boton Agregar Producto -->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-default btnAgregarProducto">Agregar
                                            producto</button>

                                    </div>

                                </div>

                                <!-- TOTAL -->
                                <div class="row  justify-content-end d-flex mr-1">
                                    <div class="col-xs-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Total</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                    <td><button class="btn btn-success btn-lg" id="nuevoTotalVenta">
                                                            
                                                    <i class="fas fa-dollar-sign"></i>&nbsp;0
                                                            
                                                        </button>

                                                        </td>    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <input type="hidden" id="precioFinalProductos" name="precioFinalProductos">
                                <input type="hidden" id="precioFinalServicios" name="precioFinalServicios">


                                <!-- METODO DE PAGO -->
                                <div class="row ml-2">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select class="form-control-sm" name="nuevoMetodoPago"
                                                        id="nuevoMetodoPago" required>
                                                        <option value="">Seleccione método de pago</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="TC">Tarjeta de Crédito</option>
                                                        <option value="TD">Tarjeta de Débito</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cajasMetodoPago"></div>
                                    <input type="hidden" name="listaMetodoPago" id="listaMetodoPago">
                                </div>

                                


                            </div>
                        </div>
                        <div class="card-footer bg-white float-right">
                            <button type="submit" class="btn btn-primary btn-lg">Guardar Venta</button>
                        </div>
                    </form>
                    <?php

                    $crearVenta = new ControladorVentas();
                    $crearVenta -> ctrCrearVenta();


                    ?>



                </div>
            </div>

            <div class="col-lg-6 col-xs-12">
                <div class="row">
                    <div class="col-12">
                        <!-- TABLA DE SERVICIOS -->


                        <div class="card border border-warning">
                            <div class="card-header ">

                                <!-- card tools -->
                                <div class="card-tools float-left">

                                    <button type="button" class="btn btn-warning btn-sm " data-card-widget="collapse"
                                        data-toggle="collapse" title="Collapse" aria-expanded="false">
                                        <i class="fas fa-minus "></i>
                                    </button>
                                </div>
                            </div>
                            <div class=" card-body mt-4 ">
                                <div class="ribbon-wrapper ribbon-lg ">
                                    <div class="ribbon bg-warning">
                                        SERVICIOS
                                    </div>
                                </div>

                                <table class=" table table-striped table-bordered dt-responsive tablaVentaServicios "
                                    id="tablaVentaServicios">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Servicio</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <div class="card-footer bg-white"></div>

                        </div>



                    </div>
                </div>
            </div>

        </div>
        <div class="row d-none d-lg-block">
            <div class="col-12">

                <!-- TABLA DE PRODUCTOS -->



                <div class="card border border-danger d-none ">
                    <div class="card-header">
                        <!-- card tools -->
                        <div class="card-tools float-left">

                            <button type="button" class="btn btn-danger btn-sm" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body mt-4">
                        <div class="ribbon-wrapper ribbon-lg">
                            <div class="ribbon bg-danger">
                                PRODUCTOS
                            </div>
                        </div>

                        <table class="table table-striped table-bordered dt-responsive tablaVentaProductos"
                            id="tablaVentaProductos">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Descripción</th>

                                    <th>Precio</th>

                                    <th>Stock</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <div class="card-footer bg-white"></div>
                </div>
            </div>
        </div>
        </section>


<!-- /.content -->
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