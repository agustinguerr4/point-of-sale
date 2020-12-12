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
                        <li class="breadcrumb-item active">Editar Venta</li>
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
                                        <?php

                                                $item = "id";
                                                $valor = $_GET["idVenta"];

                                                $venta = ControladorVentas::ctrMostrarVentas($item,$valor);


                                                $valor2 = $venta["id_vendedor"];
                                                $vendedor = ControladorUsuarios::ctrMostrarUsuarios($item,$valor2);

                                                
                                                $valor3 = $venta["id_cliente"];
                                                $cliente = ControladorClientes::ctrMostrarClientes($item,$valor3);

                                        ?>
                                <!-- VENDEDOR -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                                            value="<?php echo $vendedor['nombre']; ?>" readonly>
                                        <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]?>">
                                    </div>
                                </div>

                                <!-- CODIGO DE LA VENTA -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]?>" readonly>';




                                        
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
                                            <option value="<?php echo $cliente["id"];?>"> <?php echo $cliente["nombre"].' - Dni: '.$cliente["documento"];?></option>
                                            <?php
                                                $item = null;
                                                $valor = null;

                                                $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);

                                                foreach($clientes as $key => $value){
                                                    echo '<option value="'.$value["id"].'">'.$value["nombre"].' - Dni: '.$cliente["documento"].'</option>';
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
                                    <?php 
                                     
                                     $listaServicios = json_decode($venta["servicios"], true);

                                     if(!empty($listaServicios)){
                                         echo '  <div class="row botonNuevoServicio ml-4">
                                                    <div class="col-5"></div>
                                                        <div class="col-2"> <button class="btn btn-sm btn-warning font-italic mb-2" disabled>Servicios</button></div>
                                                        <div class="col-5"></div>
                                                    
                                                </div>';
                                     

                                     foreach($listaServicios as $key => $value){
                                       echo '<div class="row mb-2 ml-1 ">
                                                    <div class="col-6" >
                                        
                                                    <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio="'.$value["id"].'">
                                                    <i class="fa fa-times"></i>
                                                    </button>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control inputAgregarServicio" name="inputAgregarServicio" value="'.$value["descripcion"].'" readonly required>
                                                    <input type="hidden" class="idServicio" value="'.$value["id"].'">
                                        
                                                    </div>
                                        
                                                    </div>
                                        
                                                    <div class="col-6">
                                        
                                                    <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                        
                                                    <i class="fas fa-dollar-sign"></i>
                                        
                                                    </span>
                                                    <input type="number" min="1" class="form-control nuevoPrecioServicio" name="nuevoPrecioServicio"  value="'.$value["precio"].'" readonly required>
                                        
                                        
                                        
                                                    </div>
                                                    </div>
                                        
                                                    </div>
                                        
                                                    </div> ';
                                        
                                                        }

                                                    }
                                   ?>
                                  

                                    <input type="hidden" id="listaServicios" name="listaServicios">
                                    
                                    
                                </div>
                                <div class="form-group nuevoProducto mb-2"> 
                                <?php 
                                     
                                     $listaProductos = json_decode($venta["productos"], true);

                                     if(!empty($listaProductos)){
                                        echo '<div class="row botonNuevoProducto ml-4">
                                                    <div class="col-5"></div>
                                                    <div class="col-2"><button class="btn btn-sm btn-danger font-italic mb-2" disabled>Productos</button></div>
                                                    <div class="col-5"></div>
                                                        
                                                </div>';
                                   

                                    foreach($listaProductos as $key => $value){

                                        $item = "id";
                                        $valor = $value["id"];
                                        $orden = "id";
                                        $respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

                                        echo '<div class="row mb-3 ml-1 mr-1">
                                                <div class="col-12 col-md-7" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'">
                                                                <i class="fa fa-times"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control nuevaDescripcionProducto inputAgregarProducto" idProducto="'.$value["id"].'" value="'.$value["descripcion"].'" name="nuevaDescripcionProducto" readonly required >
                                                    </div>
                                                </div>
                    
                                                <!-- Cantidad del producto -->
                                                <div class="col-6 col-md-2 ingresoCantidad">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <input type="number" class="form-control nuevaCantidadProducto" placeholder="cantidad" name="nuevaCantidadProducto" min="1" 
                                                             value="'.$value["cantidad"].'" stock="'.($respuesta["stock"]+$value["cantidad"]).'" nuevoStock="'.$respuesta["stock"].'" required>
                                                        </div>
                                                    </div>
                                                </div>
                    
                    
                                                <!-- Precio del producto -->
                    
                                                <div class="col-6 col-md-3 ingresoPrecio" id="ingresoPrecio">
                    
                                                    <div class="input-group"> 
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                    
                                                            <i class="fas fa-dollar-sign"></i>
                                    
                                                            </span>
                                                            <input type="number" min="1" class="form-control nuevoPrecioProducto" precioReal="'.$value["precio"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                                    }
                                }
                                    ?>
                                       
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

                                                    <td><button class="btn btn-success btn-lg" id="nuevoTotalVenta" value="<?php echo ($venta["precio_productos"]+$venta["precio_servicios"])?>">
                                                            
                                                    <i class="fas fa-dollar-sign"></i>&nbsp;<?php echo ($venta["precio_productos"]+$venta["precio_servicios"])?>
                                                            
                                                        </button>

                                                        </td>    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <input type="hidden" id="precioFinalProductos" name="precioFinalProductos" value="<?php echo $venta["precio_productos"]?>">
                                <input type="hidden" id="precioFinalServicios" name="precioFinalServicios" value="<?php echo $venta["precio_servicios"]?>">


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
                            <button type="submit" class="btn btn-primary btn-lg">Guardar Cambios</button>
                        </div>
                    </form>
                    <?php

                    $editarVenta = new ControladorVentas();
                    $editarVenta -> ctrEditarVenta();


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