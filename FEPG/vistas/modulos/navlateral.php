    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURL; ?>home/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Product++<sup>v.1</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->

      <!-- Heading -->
      <div class="sidebar-heading">
        CONTENIDO
      </div>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo SERVERURL; ?>home/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
      <?php
      	require_once "./controladores/UsuarioControlador.php";
        $menu = new UsuarioControlador();
      echo  $menu->obtenerMenuUsuario();
      ?>
    </ul>
    <!-- End of Sidebar -->