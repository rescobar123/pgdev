<?php 
	$peticionAjax=true;
	require_once "../core/configGeneral.php";
	if (isset($_POST['tipoFormulario'])) {
		switch ($_POST['tipoFormulario']) {
			case 'newMail':
				require_once "../controladores/ContenidoControlador.php";
				$insEmail=new ContenidoControlador();
				if (isset($_POST['nombre-reg']) && isset($_POST['mail-reg'])) {
					echo $insEmail->agregarNuevoMailControlador();
				}
				break;
			case 'newComment':
				require_once "../controladores/ContenidoControlador.php";
				$insComentario=new ContenidoControlador();
				if (isset($_POST['nombre-reg']) && isset($_POST['mail-reg'])) {//si tiene id de comentario es del blog,
					echo $insComentario->agregarComentarioControlador();
				}
				break;
			case 'newCommentComment':
				require_once "../controladores/ContenidoControlador.php";
				$insComentario=new ContenidoControlador();
				if (isset($_POST['idComentario-reg']) && isset($_POST['mail-reg'])) {//si tiene id de comentario es del blog,
					echo $insComentario->agregarComentarioControlador();
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
	