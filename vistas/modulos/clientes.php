<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">Agregar Clientes</button>
        </div>
        <div class="card-body">
          
          <table class="table table-striped table-bordered dt-responsive nowrap tablaClientes " id="tablaClientes" style="width:100%"> 
          
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Total Compras</th>
                
                <th>Fecha Registro</th>
                <?php
                if($_SESSION["perfil"] == "Administrador"){
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


<!-- Modal Agregar Cliente -->

<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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

                        <input class="form-control" type="text" name="nuevoCliente" placeholder="Ingresar nombre" required>

                      </div>
                    
                   </div>

                   <!-- Entrada para el DNI-->
                   <div class="form-group">

                  <div class="input-group">
                    
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card"></i></span>
                    </div>

                    <input class="form-control" type="text" min="0" name="nuevoDocumento" id="nuevoDocumento" placeholder="Ingresar DNI" required>

                  </div>

                  </div>

                  <!-- Entrada para el mail-->
                  <div class="form-group">

                  <div class="input-group">
                    
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-mail-bulk"></i></span>
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

                        <input class="form-control" type="text" name="nuevoTelefono" id="nuevoTelefono" placeholder="Ingresar teléfono">
                        
                      </div>

                  </div>

                   <!-- Entrada para LA DIRECCÍON-->
                   <div class="form-group">

                      <div class="input-group">
                        
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                        </div>

                        <input class="form-control d-inline" type="text" name="nuevaDireccion" placeholder="Ingresar dirección">
                        
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

<!-- Modal Editar Cliente -->

<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

    <form role="form" method="post" action="">

                <div class="modal-header bg-dark">

                  <h5 class="modal-title">Editar Cliente</h5>

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

                        <input class="form-control" type="text" name="editarCliente" id="editarCliente" required>
                        <input type="hidden" id="idCliente" name="idCliente">
                      </div>
                    
                   </div>

                   <!-- Entrada para el DNI-->
                   <div class="form-group">

                  <div class="input-group">
                    
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card"></i></span>
                    </div>

                    <input class="form-control" type="text" min="0" name="editarDocumento" id="editarDocumento"
                    required>

                  </div>

                  </div>

                  <!-- Entrada para el mail-->
                  <div class="form-group">

                  <div class="input-group">
                    
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-mail-bulk"></i></span>
                    </div>

                    <input class="form-control" type="email" name="editarEmail" id="editarEmail">

                  </div>

                  </div>

                  <!-- Entrada para el teléfono-->
                  <div class="form-group">

                      <div class="input-group">
                        
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                        </div>

                        <input class="form-control" type="text" name="editarTelefono" id="editarTelefono"  
                        >
                        
                      </div>

                  </div>

                   <!-- Entrada para LA DIRECCÍON-->
                   <div class="form-group">

                      <div class="input-group">
                        
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                        </div>

                        <input class="form-control d-inline" type="text" name="editarDireccion" id="editarDireccion">
                        
                      </div>

                   </div>


                 </div>
                </div>

              
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

           

                    

      </form>
      <?php
                      $editarCliente = new ControladorClientes();
                      $editarCliente -> ctrEditarCliente();

                    ?>

    </div>
  </div>
</div>


<?php
                      $eliminarCliente = new ControladorClientes();
                      $eliminarCliente -> ctrEliminarCliente();

                    ?>