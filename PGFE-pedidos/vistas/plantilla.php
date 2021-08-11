<!DOCTYPE html>
<html class="full-height" lang="en-US">
  <head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
	<title><?php echo COMPANY;  ?></title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- site icons -->
  <link rel="icon" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/images/fevicon/fevicon.png" type="image/gif" />
<!-- bootstrap css -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/bootstrap.min.css" />
  <!-- Site css -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/style.css" />
  <!-- responsive css -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/responsive.css" />
  <!-- colors css -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/colors1.css" />
  <!-- custom css -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/custom.css" />
  <!-- wow Animation css -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/animate.css" />
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/animate.css" />
  <!-- revolution slider css -->
  <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/revolution/css/settings.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/revolution/css/layers.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/revolution/css/navigation.css" />
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/contenidos/assets/css/font-awesome.min.css">
   <link rel='stylesheet' href='<?php echo SERVERURL; ?>vistas/contenidos/assets/css/hizoom.css'>
</head>
<body id="default_theme" class="it_service">
	<?php  
	$peticionAjax=false;

	require_once "./controladores/VistasControlador.php";
	//Instancias la clase VistasControlador
		$vt = new VistasControlador();
		$vistasR=$vt->obtenerVistasControlador();
        include "./vistas/modulos/navbar.php";
		if($vistasR == "inicio" || $vistasR == "404"):
			if ($vistasR=="inicio") {
				require_once "./vistas/contenidos/inicio-view.php";
			}else{
				require_once "./vistas/contenidos/404-view.php";
			}
		else:
			if (!isset($_SESSION['token_sss']) || !isset( $_SESSION['usuario_sss'])) {
			}
	 ?>
	<!-- Content page-->
	<section>
<?php require_once $vistasR; ?>

	</section>
	<?php 
	 endif; ?>

<?php include "./vistas/modulos/script.php"; ?>


</body>
</html>
