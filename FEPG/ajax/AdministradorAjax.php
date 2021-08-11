<?php 
	$peticionAjax=true;
	require_once "../core/configGeneral.php";
	if (isset($_POST['tipoFormulario'])) {

		switch ($_POST['tipoFormulario']) {
			case 'newProduct':
				if (isset($_POST['nombre'])) {
					require_once "../controladores/ProductoControlador.php";
				$insProducto=new ProductoControlador();
				echo $insProducto->agregarProductoControlador();
				}
				break;
			case 'newAdmin':
				require_once "../controladores/AdministradorControlador.php";
				$insAdmin=new AdministradorControlador();
				if (isset($_POST['dni-reg']) && $_POST['nombre-reg']) {
					
					echo $insAdmin->agregarAdministradorControlador();
				}
				break;
			case 'delAdmin':
				require_once "../controladores/AdministradorControlador.php";
				$delAdmin=new AdministradorControlador();
				if (isset($_POST['privilegio-admin']) && isset($_POST['codigo-del']) ) {
					echo $delAdmin->eliminarAdministradorControlador();
				}
				break;
			default:
				# code...
				break;
		}
		
	}else{
		session_start(['name'=>'SBP']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}
	