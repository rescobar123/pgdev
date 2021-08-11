<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/main.css">

		<!--===== Scripts -->
	<?php include "./vistas/modulos/script.php"; ?>
</head>
<body>
	<?php  
	$peticionAjax=false;

	require_once "./controladores/VistasControlador.php";
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
			session_start(['name' => 'PG']);
			require_once "./controladores/LoginControlador.php";
			$lc = new LoginControlador();

			if (!isset($_SESSION['token_pg']) || !isset( $_SESSION['CuentaUsuario'])) {
				$lc->forzarCierreSessionControlador();
			}
	 ?>
	 
	<!-- SideBar -->
	<?php include "./vistas/modulos/navlateral.php"; ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
			<?php 
				echo $vistasR;
			?>
		<!-- NavBar -->
		<?php include "./vistas/modulos/navbar.php"; ?>
		
		<!-- Content page -->
		<?php require_once $vistasR; ?>

	</section>
	<?php include "./vistas/modulos/logOutScript.php"; 

	 endif; ?>
<script>
	$.material.init();
</script>
</body>
</html>
