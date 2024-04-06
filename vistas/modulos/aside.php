
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="vistas/assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         <img src="vistas/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="perfil" class="d-block"><?php echo $_SESSION['nombres'] ?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Catalogos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="productos" class="nav-link " >
                <i class="fas fa-dolly"></i>
                  <p>Articulos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="categorias" class="nav-link " >
                  <i class="fas fa-tasks"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="clientes" class="nav-link " >
                  <i class="far fa-id-badge"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="proovedores" class="nav-link " >
                  <i class="fas fa-shipping-fast nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Cajas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="administrar.aperturas" class="nav-link " >
                  <i class="fas fa-book nav-icon"></i>
                  <p>Administrar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cajas" class="nav-link " >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="administrar.compras" class="nav-link " >
                  <i class="fas fa-book nav-icon"></i>
                  <p>Administrar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="compra" class="nav-link " >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="administrar.ventas" class="nav-link ">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Administrar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="venta" class="nav-link">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>Punto de Venta</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configuracion
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="usuarios" class="nav-link ">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="empresa" class="nav-link ">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Datos Generales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
                <a href="salida" class="nav-link ">
                  <i class="fas fa-door-open"></i>
                  <p>Salir</p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- <script>
    $(".nav-link").on('click', function () {
        $(".nav-link").removeClass('active')
    })
  </script> -->