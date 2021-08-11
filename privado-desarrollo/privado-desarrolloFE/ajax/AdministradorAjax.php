<?php 
	$peticionAjax=true;
	require_once "../core/configGeneral.php";
	if (isset($_POST['tipoFormulario'])) {

		switch ($_POST['tipoFormulario']) {
			case 'newAgent':
				if (isset($_POST['dpi-reg']) && isset($_POST['nombre-reg'])) {
					require_once "../controladores/AgenteControlador.php";
				$insAgente=new AgenteControlador();
				echo $insAgente->agregarAgenteControlador();
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
			case 'upAgent':
				if (isset($_POST['dpi-reg']) && isset($_POST['nombre-reg'])) {
					require_once "../controladores/AgenteControlador.php";
				$insAgente=new AgenteControlador();
				echo $insAgente->editarAgenteControlador();
				}
				break;
			case 'deleteAgent':
				if (isset($_POST['codigo-del']) && isset($_POST['privilegio-admin'])) {
					require_once "../controladores/AgenteControlador.php";
				$delAgente=new AgenteControlador();
				echo $delAgente->eliminarAgenteControlador();
				}
				break;
			case 'newretinue':
				if (isset($_POST['comitiva-reg']) && isset($_POST['nombre-reg'])) {
					require_once "../controladores/ComitivaControlador.php";
				$agregarComitiva=new ComitivaControlador();
				echo $agregarComitiva->agregarComitivaControlador();
				}
				break;
			case 'newevent':
				if(isset($_POST['nombre-reg']) && isset($_POST['lugar-reg'])){
					require_once "../controladores/EventoControlador.php";
					$agregarEvento = new EventoControlador();
					echo $agregarEvento->agregarEventoControlador();
				}
				break;
			case 'updateEvento':
				if(isset($_POST['nombre-reg'])&& isset($_POST['lugar-reg'])){
					require_once "../controladores/EventoControlador.php";
					$actualizarEvento = new EventoControlador();
					echo $actualizarEvento->actualizarEventoControlador();
				}
				break;
			case 'eliminarEvento':
				if (isset($_POST['idEvento'])) {
					require_once "../controladores/EventoControlador.php";
					$eliminarEvento = new EventoControlador();
					echo $eliminarEvento->eliminarEventoControlador();
				}
				break;
			case 'finalEvento':
				if (isset($_POST['idEventoEstado'])) {
					require_once "../controladores/EventoControlador.php";
					$actualizarEstado = new EventoControlador();
					echo $actualizarEstado->actualizaEstadoEventoControlador();
				}
				break;
			case 'newEquipo':
				if(isset($_POST['nombre-reg']) && isset($_POST['numero-reg'])){
					require_once "../controladores/InventarioEquipoControlador.php";
					$agregar = new InventarioControlador();
					echo $agregar->agregarEquipoControlador();
				}
				break;
			case 'newarma':
				if(isset($_POST['nombre-reg']) && isset($_POST['numero-reg'])){
					require_once "../controladores/InventarioEquipoControlador.php";
					$agregar = new  InventarioControlador();
					echo $agregar->agregarEquipoArmaControlador();
				}
				break;
			case 'newasignacion':
				if(isset($_POST['persona-reg']) && isset($_POST['equipo-asignar-reg'])){
					require_once "../controladores/InventarioEquipoControlador.php";
					$agregar = new  InventarioControlador();
					echo $agregar->agregarAsignacionControlador();
				}
				break;
			case 'updateasignacion':
			if (isset($_POST['nombre-reg'])) {
				require_once "../controladores/InventarioEquipoControlador.php";
				$actualizar = new  InventarioControlador();
				echo $actualizar->actualizarDatosAsignacionesControlador();
			}
			break;
			default:
				# code...newretinue
				break;
		}
		
	}else{
		session_start(['name'=>'SBP']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}
	