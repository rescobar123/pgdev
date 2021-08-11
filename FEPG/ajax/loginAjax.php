<?php 
	$peticionAjax=true;
	require_once "../core/configGeneral.php";
	if (isset($_GET['Token'])) {
		require_once "../controladores/LoginControlador.php";
		$logout= new LoginControlador();
		echo $logout->cerrarSesionControlador();
	}else{
		session_start(['name'=>'BM']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}