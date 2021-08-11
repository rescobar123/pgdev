<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	  <!-- Custom fonts for this template-->
	  <link href="<?php echo SERVERURL; ?>vistas/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	  <!-- Custom styles for this template-->
	  <link href="<?php echo SERVERURL; ?>vistas/css/sb-admin-2.min.css" rel="stylesheet">


	  <?php $pagina = explode("/",$_GET['views'] );//views es el que esta en htacces 

	  if ($pagina[0] == "manual"|| $pagina[0] == "blog" || $pagina[0] == "new" ){ ?>

	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src="<?php echo SERVERURL; ?>vistas/js/jquery-3.1.1.min.js"></script>

	  <script src="<?php echo SERVERURL; ?>vistas/src/jquery.richtext.js"></script>
	  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/src/richtext.min.css">

	   <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/src/editor.css">
	  <script src="<?php echo SERVERURL; ?>vistas/src/editor.js"></script>
	  <?php }else{ ?>

	  <script src="<?php echo SERVERURL; ?>vistas/vendor/jquery/jquery.min.js"></script>

	  <?php } ?>
<style type="text/css">
  #message{
  position: fixed;
  top: 0;
  right: 0;
  margin: 0;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
}
#inner-message{
  margin: 0 auto;
}
</style>		
</head>
<body id="page-top">
	<?php  
	$peticionAjax=false;
	require_once "./core/MainModel.php";
	require_once "./controladores/VistasControlador.php";
	session_start(['name' => 'PG']);
	
	$mainModel = new MainModel();
	//Instancias la clase VistasControlador
		$vt = new VistasControlador();
		$vistasR=$vt->obtenerVistasControlador();
		if($vistasR == "login" || $vistasR == "404"):
			if ($vistasR=="login") {
				require_once "./vistas/contenidos/login-view.php";
			}else{
				require_once "./vistas/contenidos/404-view.php";
			}
		else:
			
			if(isset($_SESSION) & !isset($_SESSION['s_codigo'])){
				require_once "./controladores/UsuarioControlador.php";
				$user = new UsuarioControlador();
				
				$url_actual = $_SERVER["REQUEST_URI"];
				$urlArray = explode("/",$url_actual);
				$idUsuario = $urlArray[3];
				$datos = $user->obtenerUsuarioById($idUsuario);
				
				$_SESSION['s_codigo'] = $datos['CuentaCodigo']; 
				$_SESSION['s_nombre'] = $datos['CuentaNombreCompleto']; 
				$_SESSION['s_privilegio'] = $datos['CuentaPrivilegio']; 
				$_SESSION['s_usuario'] = $datos['CuentaUsuario']; 
				$_SESSION['s_email'] = $datos['CuentaEmail']; 
				$_SESSION['s_genero'] = $datos['CuentaGenero'];
				$_SESSION['s_foto'] = $datos['CuentaFoto']; 
				$_SESSION['s_token'] = $mainModel->encriptar(md5(uniqid(mt_rand(), true)));
			}
			require_once "./controladores/LoginControlador.php";
			$lc = new LoginControlador();
			/*if (!isset($_SESSION['s_token']) || !isset( $_SESSION['s_usuario'])) {
				$lc->forzarCierreSessionControlador();
			}*/
	 ?>
  <!-- Page Wrapper -->
  <div id="wrapper">
      <!-- SideBar -->
  <?php include "./vistas/modulos/navlateral.php"; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <!-- NavBar -->
      <?php include "./vistas/modulos/navbar.php"; ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">

		
		<!-- Content page -->
		<?php require_once $vistasR; ?>

	</section>
	  </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; PRODUCTO++  2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


	<?php include "./vistas/modulos/logOutScript.php"; 

	 endif; ?>
<script>
	$.material.init();
</script>
<!--===== Scripts -->
	<?php include "./vistas/modulos/script.php"; ?>
</body>
</html>
