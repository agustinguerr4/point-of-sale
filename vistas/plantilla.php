<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sistema de Gestión Integral para Pymes 1.0</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="vistas/img/logos/logo_solo.png">
    <!-- PLUGINS DE CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="vistas\dist\css\ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="vistas\dist\css\css.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vistas\dist\css\responsive.dataTables.min.css">
    <link rel="stylesheet" href="vistas\dist\css\rowReorder.dataTables.min.css">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="vistas\plugins\sweetalert2\sweetalert2.css">
    <script src="vistas\dist\js\promise.min.js"></script>
    <!-- iCheck -->
    <link rel="stylesheet" href="vistas\plugins\icheck-bootstrap\icheck-bootstrap.min.css">

<!-- Time Picker -->
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>



<!-- iCheck -->
<link rel="stylesheet" href="vistas\plugins\icheck-bootstrap\icheck-bootstrap.min.css">

<!-- DateRangePicker -->
<link rel="stylesheet" href="vistas\plugins\daterangepicker\daterangepicker.css">

<!-- fullCalendar -->
<link rel="stylesheet" href="vistas/plugins/fullcalendar/main.min.css">
<link rel="stylesheet" href="vistas/plugins/fullcalendar-daygrid/main.min.css">
<link rel="stylesheet" href="vistas/plugins/fullcalendar-timegrid/main.min.css">
<link rel="stylesheet" href="vistas/plugins/fullcalendar-bootstrap/main.min.css">

<!-- Graficos MorrisJS -->
<link rel="stylesheet" href="vistas\plugins\morris.js-0.5.1\morris.css">






<!-- PLUGINS DE JAVASCRIPT -->
  <!-- Moment -->
  

  
  <script src="vistas/plugins/moment/moment.min.js"></script>
  
    
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  

  <script src="vistas/plugins/inputmask/jquery.inputmask.bundle.js"></script>



    <!-- Bootstrap 4 -->
    <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vistas/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="vistas/dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
    <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="vistas\dist\js\dataTables.responsive.min.js"></script>
    <script src="vistas\dist\js\dataTables.rowReorder.min.js"></script>

    <!-- Sweetalert2 -->
    <script src="vistas\plugins\sweetalert2\sweetalert2.all.js"></script>
    <script src="vistas\plugins\sweetalert2\sweetalert2.js"></script>

    <!-- JQuery Number Format -->
    <script src="vistas\plugins\jquery-number\jquery.number.js"></script>
<!-- DateRangePicker -->
<script src="vistas\plugins\daterangepicker\daterangepicker.js"></script>

<!-- fullCalendar -->
<script src="vistas/plugins/fullcalendar/main.js"></script>
<script src="vistas/plugins/fullcalendar-interaction/main.js"></script>
<script src="vistas/plugins/fullcalendar-daygrid/main.js"></script>
<script src="vistas/plugins/fullcalendar-timegrid/main.js"></script>
<script src="vistas/plugins/fullcalendar-bootstrap/main.js"></script>
<script src="vistas/plugins/fullcalendar/locales-all.min.js"></script>
<script src="vistas\plugins\fullcalendar\locales\es.js"></script>

<!-- Graficos ChartJS -->
<script src="vistas\plugins\chart.js\Chart.min.js"></script>

<!-- Graficos MorrisJS -->
<script src="vistas\plugins\morris.js-0.5.1\morris.js"></script>
<script src="vistas\plugins\raphael\raphael.js"></script>

  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
      
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

</head>

<body class="hold-transition sidebar-fixed sidebar-mini sidebar-collapse login-page">
<!-- Site wrapper -->


<?php

// Si se inicio sesion
if( isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok" ){
    
    
    
    echo '<div class="wrapper">';
    
    /*================================================
    HEADER
    ================================================*/
    include "modulos/header.php";
    
    
    /*================================================
    MENU
    ================================================*/
    include "modulos/menu.php";
    
    
    /*================================================
    CONTENIDO
    ================================================*/
    if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "perfil" ||
        $_GET["ruta"] == "crear-venta" ||
        $_GET["ruta"] == "editar-venta" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "reportes" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "salir" ||
        $_GET["ruta"] == "servicios" ||
        $_GET["ruta"] == "turnos" ||
        $_GET["ruta"] == "configuracion")
        
        {
            include "modulos/".$_GET['ruta'].'.php';
        } else {
            include "modulos/404.php";
        }
    }
    
    
    
    /*================================================
    FOOTER
    ================================================*/
    include "modulos/footer.php";
    
    
    echo " </div>";
    // End Wrapper
    
} else {
    include "modulos/login.php";
}
?>



<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/servicios.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/productos.js"></script>  
<script src="vistas/js/clientes.js"></script> 
<script src="vistas/js/ventas.js"></script> 
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/turnos.js"></script>

</body>

</html>