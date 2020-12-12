        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview active">
                    <a href="inicio" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>Ventas <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="crear-venta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Venta</p>
                            </a>
                        </li>

                        <?php
                         if($_SESSION["perfil"] != "Vendedor"){
                          echo '
                        <li class="nav-item">
                            <a href="ventas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar Ventas</p>
                            </a>
                        </li>';   
                    }
                         if($_SESSION["perfil"] == "Administrador"){
                          echo '<li class="nav-item">
                          <a href="reportes" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Reporte de Ventas</p>
                          </a>
                      </li>';   
                         }
                         ?>
                        
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="turnos" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Turnos</p>
                    </a>
                </li>
                <?php
                if($_SESSION["perfil"] != "Vendedor"){
                    echo '<li class="nav-item has-treeview">
                    <a href="clientes" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                
                
                <li class="nav-item has-treeview">
                    <a href="productos" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>Productos</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="servicios" class="nav-link">
                        <i class="nav-icon fas fa-gem"></i>
                        <p>Servicios</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="categorias" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Categorias</p>
                    
                    </a>
                </li>';}?>

                <?php
                if($_SESSION["perfil"] == "Administrador"){
                    echo '
                <li class="nav-item has-treeview">
                    <a href="usuarios" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                ';}?>
            </ul>
        </nav>


    </div>
<!-- /.sidebar -->
</aside>