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
    <section class="content">

        <div class="row">


            <!-- FORMULARIO DE VENTA -->
            <div class="col-lg-5 col-xs-12">
                <div class="card border border-success">
                    <form method="post" role="form">
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
                                            value="Usuario Administrador" readonly>
                                    </div>
                                </div>

                                <!-- CODIGO DE LA VENTA -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta"
                                            value="123213" readonly>
                                    </div>
                                </div>

                                <!-- CLIENTE -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                                        </div>
                                        <select type="text" class="form-control" id="agregarCliente"
                                            name="agregarCliente" required>
                                            <option value="">Seleccionar Cliente</option>
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
                                <div class="form-group row nuevoProducto">


                                    <!-- Descripcion del producto -->
                                    <div class="col-6" style="padding-right:0px">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <button type="button" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="agregarProducto"
                                                name="agregarProducto" placeholder="Descripcion del producto" required>

                                        </div>

                                    </div>

                                    <!-- Cantidad del producto -->
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="number" class="form-control" id="nuevaCantidadProducto"
                                                    name="nuevaCantidadProducto" min="1" placeholder="Cantidad"
                                                    required>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Precio del producto -->

                                    <div class="col-3" style="padding-left:0px">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">

                                                    <i class="fas fa-dollar-sign"></i>

                                                </span>
                                                <input type="number" min="1" class="form-control"
                                                    id="nuevoPrecioProducto" name="nuevoPrecioProducto"
                                                    placeholder="Precio" readonly required>



                                            </div>
                                        </div>

                                    </div>




                                </div>

                                <!-- Boton Agregar Producto -->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-default d-lg-none">Agregar
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

                                                    <td><button class="btn btn-success btn-lg">
                                                            <i class="fas fa-dollar-sign"></i>

                                                            1000</h3>
                                                        </button>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <!-- METODO DE PAGO -->
                                <div class="row ml-1">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="nuevoMetodoPago"
                                                        id="nuevoMetodoPago" required>
                                                        <option value="">Seleccione método de pago</option>
                                                        <option value="efectivo">Efectivo</option>
                                                        <option value="tarjetaCredito">Tarjeta de Crédito</option>
                                                        <option value="tarjetaDebito">Tarjeta de Débito</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">

                                                        <i class="fas fa-key"></i>

                                                    </span>
                                                    <input type="text" class="form-control"
                                                        name="nuevoCodigoTransaccion" id="nuevoCodigoTransaccion"
                                                        placeholder="Código Transacción" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                        <div class="card-footer bg-white float-right">
                            <button type="submit" class="btn btn-primary btn-lg">Guardar Venta</button>
                        </div>
                    </form>



                </div>
            </div>


            <!-- TABLA DE SERVICIOS -->
            <div class="col-lg-3 d-none d-lg-block">

                <div class="card border border-warning">
                    <div class="card-body mt-4">
                        <div class="ribbon-wrapper ribbon-lg">
                            <div class="ribbon bg-warning">
                                SERVICIOS
                            </div>
                        </div>

                        <table class="table table-striped table-bordered dt-responsive tablaVentaServicios"
                            id="tablaVentaServicios">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Corte y Barba</td>

                                    <td>$320</td>


                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info">Agregar</button>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white"></div>
                    
                </div>

            </div>
            <!-- TABLA DE PRODUCTOS -->
            <div class="col-lg-4 d-none d-lg-block">


                <div class="card border border-danger">
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
                                    <th>Imagen</th>

                                    <th>Descripción</th>

                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="vistas\dist\img\prod-1.jpg" class="img-thumbnail" width="40px"></td>

                                    <td>Cera</td>

                                    <td>20</td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info">Agregar</button>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
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