<?php

if($_SESSION["perfil"] != "Administrador"){
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
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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
                <button class="btn btn-primary btnAgregarUsuario" data-toggle="modal"
                    data-target="#modalAgregarUsuario">Agregar Usuario</button>
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered tablas dt-responsive nowrap" width="100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <?php
                            if($_SESSION["perfil"] == "Administrador"){
                                echo '<th>Estado</th>';}?>
                            <th>Último login</th>
                            <?php
                            if($_SESSION["perfil"] == "Administrador"){
                    echo '<th>Acciones</th>';}?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);



            foreach($usuarios as $key => $value){
              

              echo '
              <tr>
                <td>'.($key+1).'</td>
                <td class="text-capitalize">'.$value['nombre'].'</td>
                <td>'.$value['usuario'].'</td>';

                if($value['foto'] != ""){
                  echo '<td><img src="'.$value['foto'].'" class="img-thumbnail" width="40px"</td>';
                } else {
                  echo '<td><img src="vistas\img\usuarios\anonymous.png" class="img-thumbnail" width="40px"</td>';
                }

                
                echo '<td>'.$value['perfil'].'</td>';
                if($_SESSION["perfil"] == "Administrador"){
                    
                    if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btn-activar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                    }else{

                    echo '<td><button class="btn btn-danger btn-xs btn-activar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

                    } 
                }

                echo '<td>'.$value['ultimo_login'].'</td>';
                if($_SESSION["perfil"] == "Administrador"){
                    echo '<td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value['id'].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil-alt"></i></button>
                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>
    
                    </div>
                  </td>';
                };
                
             
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


<!-- Modal Agregar Usuario -->

<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Agregar Usuario</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar nombre"
                                    required autofocus="autofocus">

                            </div>

                        </div>

                        <!-- Entrada para el usuario -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                                </div>

                                <input class="form-control" type="text" name="nuevoUsuario" id="nuevoUsuario"
                                    placeholder="Ingresar usuario" required>

                            </div>

                        </div>

                        <!-- Entrada para la contraseña -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                </div>

                                <input class="form-control" type="password" name="nuevoPassword"
                                    placeholder="Ingresar contraseña" required>

                            </div>

                        </div>

                        <!-- Entrada para los permisos -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
                                </div>

                                <select class="form-control input-lg" name="nuevoPerfil" required>
                                    <option value="">Seleccione un perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>

                                </select>

                            </div>

                        </div>

                        <!-- Entrada para la foto -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" width="20%"><i class="fa fa-camera"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input nuevaFoto" name="nuevaFoto">
                                    <label class="custom-file-label" for="nuevaFoto">Seleccionar foto</label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <img class="img-thumbnail rounded mx-auto d-block previsualizarNueva"
                                src="vistas\img\usuarios\anonymous.png" alt="Foto de perfil actual" width="200px ">
                            <p class="text-center text-muted">Foto de perfil actual</p>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();

      ?>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario -->

<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-header bg-dark">

                    <h5 class="modal-title">Editar Usuario</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- Entrada para el nombre -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>

                                <input class="form-control" type="text" id="editarNombre" name="editarNombre" value=""
                                    required>

                            </div>

                        </div>

                        <!-- Entrada para el usuario -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                                </div>

                                <input class="form-control" type="text" name="editarUsuario" id="editarUsuario" value=""
                                    readonly>

                            </div>

                        </div>

                        <!-- Entrada para la contraseña -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                </div>

                                <input class="form-control" type="password" name="editarPassword" id="editarPassword-1"
                                    placeholder="Ingresar nueva contraseña">

                                <input type="hidden" id="passwordActual" name="passwordActual">

                            </div>

                        </div>

                        <!-- Entrada para los permisos -->
                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
                                </div>

                                <select class="form-control input-lg" name="editarPerfil" required>
                                    <option value="" id="editarPerfil"></option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>

                                </select>

                            </div>

                        </div>

                        <!-- Entrada para la foto -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" width="20%"><i class="fa fa-camera"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input editarFoto" name="editarFoto">
                                    <label class="custom-file-label" for="editarFoto">Seleccionar foto</label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <img class="img-thumbnail rounded mx-auto d-block previsualizarActual"
                                src="vistas\img\usuarios\anonymous.png" alt="Foto de perfil actual" width="200px ">
                            <p class="text-center text-muted">Foto de perfil actual</p>
                            <input type="hidden" id="fotoActual" name="fotoActual">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php
                    $editarUsuario = new ControladorUsuarios();
                    $editarUsuario -> ctrEditarUsuario();

            ?>

            </form>
        </div>
    </div>
</div>

<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario -> ctrBorrarUsuario();

?>