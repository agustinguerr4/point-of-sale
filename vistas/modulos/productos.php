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
                    <h1>Administrar Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Productos</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">Agregar
                    Producto</button>
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered dt-responsive nowrap tablaProductos " id="tablaProductos"
                    style="width:100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Imagen</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Editado</th>
                            <?php if($_SESSION["perfil"] == "Administrador"){
                    echo '
                            <th>Acciones</th>';}?>
                        </tr>
                    </thead>





                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Agregar Producto -->

<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Agregar Producto</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">


                        <!-- Entrada para seleccionar categoria -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                </div>

                                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" required>
                                    <option value="">Seleccionar Categoria</option>

                                    <?php
                                        $item = null;
                                        $valor = null;

                                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                        foreach($categorias as $key => $value){
                                            echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                                         }

                                    ?>
                               </select>

                            </div>

                        </div>
                                        
                        <!-- Entrada para el código -->
                        <div class="form-group">

                            <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-code"></i></span>
                                    </div>

                                    <input class="form-control" type="text" name="nuevoCodigo" id="nuevoCodigo" placeholder="El código será generado automáticamente" readonly
                                        required>

                            </div>

                        </div>

                        <!-- Entrada para la descripcion -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fab fa-product-hunt"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevaDescripcion"
                                    placeholder="Ingresar descripción" required>

                            </div>

                        </div>





                        <!-- Entrada para el stock -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                                </div>

                                <input class="form-control" type="number" name="nuevoStock" min="0" placeholder="Stock"
                                    required>

                            </div>

                        </div>



                        <div class="form-group row">

                            <!-- Entrada para el precio de compra -->
                            <div class="col-sm-6 col-xs-12">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                                    </div>

                                    <input class="form-control" type="number" name="nuevoPrecioCompra" id="nuevoPrecioCompra" min="0"
                                        placeholder="Precio de Compra" step="any" required>

                                </div>
                            </div>

                            <!-- Entrada para el precio de venta -->
                            <div class="col-sm-6 col-xs-12">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                                    </div>

                                    <input class="form-control" type="number" name="nuevoPrecioVenta" id="nuevoPrecioVenta"  min="0"
                                        placeholder="Precio de Venta" step="any" required>

                                </div>
                            </div>
                        </div>


                        <!-- Checkbox para porcentaje -->
                        <div class="form-group row">
                            <div class="col-6 col-sm-6 col-sx-6">


                                <div class="icheck-secondary d-inline">
                                    <input type="checkbox" class="icheckbox" id="checkboxPorcentaje" checked>
                                    <label for="checkboxPorcentaje" checked>Utilizar Porcentaje
                                    </label>
                                </div>


                            </div>
                            <!-- Entrada para porcentaje -->
                            <div class="col-6 col-sm-6 col-sx-6">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-percent"></i></span>

                                    </div>
                                    <input type="number" class="form-control input-lg nuevoPorcentaje " min="0"
                                        value="70" required>
                                </div>
                            </div>
                        </div>








                        <!-- Entrada para la imagen -->                    
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" width="20%"><i class="fa fa-camera"></i></span>
                                    </div>


                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input nuevaImagen" name="nuevaImagen">
                                        <label class="custom-file-label" for="nuevaImagen">Seleccionar foto</label>
                                    </div>


                                </div>
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-12">
                                <img class="img-thumbnail rounded mx-auto d-block previsualizarImagen"
                                    src="vistas/img/productos/anonymous.png" alt="Foto de perfil actual" width="200px ">
                                <p class="text-center text-muted">Imagen del producto</p>
                                
                            </div>
                        </div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                 
                    </div>
               </div>
           </form>

            <?php
            
            $crearProducto = new ControladorProductos();
            $crearProducto -> ctrCrearProducto();
            
            ?>

        </div>
    </div>
</div>



<!-- Modal Editar Producto -->

<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"

    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Editar Producto</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">


                        <!-- Entrada para seleccionar categoria -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                </div>

                                <select class="form-control input-lg" name="editarCategoria" readonly required>
                                    <option id="editarCategoria" ></option>
                               </select>

                            </div>

                        </div>
                        <!-- Entrada para el código -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-code"></i></span>
                                </div>

                                <input class="form-control" type="text" name="editarCodigo" id="editarCodigo" readonly
                                    required>

                            </div>

                        </div>

                        <!-- Entrada para la descripcion -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fab fa-product-hunt"></i></span>
                                </div>

                                <input class="form-control" type="text" name="editarDescripcion" id="editarDescripcion"
                                   required>

                            </div>

                        </div>





                        <!-- Entrada para el stock -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                                </div>

                                <input class="form-control" type="number" name="editarStock" min="0" id="editarStock"
                                    required>

                            </div>

                        </div>



                        <div class="form-group row">

                            <!-- Entrada para el precio de compra -->
                            <div class="col-sm-6 col-xs-12">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                                    </div>

                                    <input class="form-control" type="number" name="editarPrecioCompra" id="editarPrecioCompra" min="0"
                                        step="any" required>

                                </div>
                            </div>

                            <!-- Entrada para el precio de venta -->
                            <div class="col-sm-6 col-xs-12">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                                    </div>

                                    <input class="form-control" type="number" name="editarPrecioVenta" id="editarPrecioVenta"  min="0"
                                         step="any" readonly required>

                                </div>
                            </div>
                        </div>


                        <!-- Checkbox para porcentaje -->
                        <div class="form-group row">
                            <div class="col-6 col-sm-6 col-sx-6">


                                <div class="icheck-secondary d-inline">
                                    <input type="checkbox" class="icheckbox" id="checkboxPorcentajeEditar" checked>
                                    <label for="checkboxPorcentajeEditar">Utilizar Porcentaje
                                    </label>
                                </div>


                            </div>
                            <!-- Entrada para porcentaje -->
                            <div class="col-6 col-sm-6 col-sx-6">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-percent"></i></span>

                                    </div>
                                    <input type="number" class="form-control input-lg editarPorcentaje" min="0"
                                        value="70" required>
                                </div>
                            </div>
                        </div>








                        <!-- Entrada para la imagen -->                    
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" width="20%"><i class="fa fa-camera"></i></span>
                                    </div>


                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input editarImagen" name="editarImagen">
                                        <label class="custom-file-label" for="editarImagen">Seleccionar foto</label>
                                    </div>


                                </div>
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-12">
                                <img class="img-thumbnail rounded mx-auto d-block previsualizarImagenActual"
                                    src="vistas\img\productos\anonymous.png" alt="Foto de perfil actual" width="200px ">
                                <p class="text-center text-muted">Imagen del producto actual</p>
                                <input type="hidden" id="imagenActual" name="imagenActual">
                            </div>
                        </div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
           </form>

            <?php
            
          $editarProducto = new ControladorProductos();
           $editarProducto -> ctrEditarProducto();
            
            ?>

        </div>
    </div>
</div>

<?php
$eliminarProducto = new ControladorProductos();
$eliminarProducto -> ctrEliminarProducto();

?>