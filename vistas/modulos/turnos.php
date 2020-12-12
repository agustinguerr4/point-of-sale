<script src="vistas\plugins\fullcalendar\locales\es.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Turnos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Turnos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">

          <div class="col-12">
            <div class=" mb-3">                
              <div class="card">
               
              
                
              <!-- /SELECCIONAR CLIENTE -->
                <div class="card-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <div class="row">
                     <div class="col-12 col-sm-6">
                        <!-- /btn-group -->
                        <div class="input-group mb-2">

                            <?php

                              $item = null;
                              $valor = null;
                              $orden = "id";

                              $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                              $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
                              $servicios = ControladorServicios::ctrMostrarServicios($item,$valor,$orden);
                            ?>
                            
                            <select id="new-event" type="text" class="form-control" required>


                            <?php
                                echo '<option value="">Seleccionar Cliente</option>';
                              foreach($clientes as $key => $value){
                                echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                              }
                            ?>
                            </select>
                           
                            
                        </div>
                        <div class="input-group mb-2">
                        <select type="text" class="form-control text-secondary mb-3" id="barbero">
                            <?php
                                echo "<option value='' >Seleccionar barbero (opcional)</option>";
                              foreach($usuarios as $key => $value){
                                
                                  echo '<option value="'.$value["id"].'" class="opcion-barbero">'.$value["nombre"].'</option>';
                                
                                
                              }
                            ?></select>
                            </div>
                            <div class="input-group mb-2">
                             <select type="text" class="form-control text-secondary mt-3" id="servicio">
                            <?php
                                echo "<option value='' >Seleccionar Servicio</option>";
                              foreach($servicios as $key => $value){
                                
                                  echo '<option value="'.$value["servicio"].'" class="opcion-servicio">'.$value["servicio"].'</option>';
                                
                                
                              }
                            ?></select>
                             
                            
                             <button id="add-new-event" type="button" class="btn btn-primary">Agregar</button>
                             <input type="hidden" id="barbero-event">
                             <input type="hidden" id="servicio-event">
                        </div>
                      <form>
                                  <div class="card mt-3">
                                  <div><span  class="btn btn-xl btn-success btn-block guardarCalendario">Aplicar Cambios</span></div>
                                      <input type="hidden" id="turnos" name="turnos">
                                    
                                  </div>

                                  <div class="card">
                                 
                        </form>
                </div>
                    </div>
                    
              

 <!-- /btn-group -->

                  <div class="col-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Clientes en Espera</h4>
                        </div>
                                
                        <div class="card-body">
                            <!-- the events -->
                            <div id="external-events">
                            
                            
                            </div>
                          </div>
                          <!-- /.card-body -->
                       </div>
                        <!-- /.card -->
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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