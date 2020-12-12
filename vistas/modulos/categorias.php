<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Categorias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar
                    Categoria</button>
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered tablas dt-responsive nowrap" id="tablaCategorias" style="width:100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th class="col-xs-8 col-sm-8 col-lg-11">Categoria</th>
                           <?php if($_SESSION["perfil"] == "Administrador"){
                    echo '<th class="col-xs-4 col-sm-4 col-lg-1">Acciones</th>';}?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
              $item = null;
              $valor = null;

              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

              foreach($categorias as $key => $value){
                echo '
                <tr>
                <td>'.($key+1).'</td>
                <td class="text-capitalize">'.$value['categoria'].'</td>';
                if($_SESSION["perfil"] == "Administrador"){
                    echo '
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value['id'].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil-alt"></i></button>
                    <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value['id'].'"><i class="fa fa-times"></i></button>
                    
                  </div>
                </td>';}
               
              echo '</tr>
                ';
              }
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


<!-- Modal Agregar Categoria -->

<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Agregar Categoria</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre de la categoria-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevaCategoria"
                                    placeholder="Ingresar categoria" required>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>




                <?php 
                  $crearCategoria = new ControladorCategorias();
                  $crearCategoria -> ctrCrearCategoria();
                ?>


            </form>
        </div>
    </div>
</div>


<!-- Modal Editar Categoria -->

<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Editar Categoria</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre de la categoria-->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                </div>

                                <input class="form-control" type="text" name="editarCategoria" id="editarCategoria"
                                    required>
                                <input class="form-control" type="hidden" name="idCategoria" id="idCategoria">

                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>




                <?php 
              $editarCategoria = new ControladorCategorias();
              $editarCategoria -> ctrEditarCategoria();
                ?>


            </form>
        </div>
    </div>
</div>

<?php 
                  $borrarCategoria = new ControladorCategorias();
                  $borrarCategoria -> ctrBorrarCategoria();
                ?>