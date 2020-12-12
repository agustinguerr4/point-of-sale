<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-success">
          <h2 class="card-title">Bienvenid@</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <h3>Estos son los datos de tu cuenta:</h3>
<hr>  
          <h5 class="d-inline ">Nombre: </h5><p class="d-inline "><?php echo $_SESSION['nombre']?></p><hr>
          <h5 class="d-inline ">Usuario: </h5><p class="d-inline "><?php echo $_SESSION['usuario']?></p><hr>
          <h5 class="d-inline ">Perfil: </h5><p class="d-inline "><?php echo $_SESSION['perfil']?></p><hr>
          <h5>Foto: </h5><p class="d-inline "><?php 
          if($_SESSION['foto'] != ""){
            echo '<td><img src="'.$_SESSION['foto'].'" class="img-thumbnail" width="200px"</td>';
          } else {
            echo '<td><img src="vistas\img\usuarios\anonymous.png" class="img-thumbnail" width="40px"</td>';
          }
          ?></p><hr>
          
        </div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>