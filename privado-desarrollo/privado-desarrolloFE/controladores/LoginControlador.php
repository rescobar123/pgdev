<?php  
if ($peticionAjax) {
	require_once "../core/MainModel.php";
}else{
	require_once "./core/MainModel.php";
}
class LoginControlador{
	public function iniciarSesionControlador(){
		$mainModel = new MainModel();
		$usuario=$mainModel->limpiarCadena($_POST['usuario']);
		$clave=$mainModel->limpiarCadena($_POST['clave']);
		//$clave = $mainModel->encriptar($clave);
		$url = URL_WEB_SERVICE."p=usuario&a=login&usuario=".$usuario."&password=".$clave;
		$res = file_get_contents(URL_WEB_SERVICE."p=usuario&a=login&usuario=".$usuario."&password=".$clave);
		$data = json_decode($res, true);
		$data = $data[0];
		if ($data) {
			session_start(['name' => 'PG']);
			$_SESSION['CuentaCodigo'] = $data['CuentaCodigo'];
			$_SESSION['CuentaNombreCompleto'] = $data['CuentaNombreCompleto'];
			$_SESSION['CuentaPrivilegio'] = $data['CuentaPrivilegio'];
			$_SESSION['CuentaUsuario'] = $data['CuentaUsuario'];
			$_SESSION['CuentaClave'] = $data['CuentaClave'];
			$_SESSION['CuentaEmail'] = $data['CuentaEmail'];
			$_SESSION['CuentaGenero'] = $data['CuentaGenero'];
			$_SESSION['token_pg'] = $mainModel->encriptar((md5(uniqid(mt_rand(), true))));
			$_SESSION['CuentaFoto'] = $data['CuentaFoto'];
			if ($data['CuentaPrivilegio'] == 1) {
				$url=SERVERURL."home/";
			}else{
				$url=SERVERURL."home/";
			}
			return $urlLocation='<script>
				window.location="'.$url.'"
			</script>';
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"El usuario o contrasenia con incorrectos, favor revise",
					"Tipo"=>"error"
				];
				return $mainModel->sweetAlert($alerta);
			}
		
	}


	public function cerrarSesionControlador(){
		$mainModel = new MainModel();
		session_start(['name' => 'PG']);
		$token=$mainModel->desencriptar($_GET['token_pg']);

		session_unset();
		session_destroy();
		//file_put_contents()//guardar bitacora.
	}

	public function forzarCierreSessionControlador(){
		session_destroy();
		return header("Location: ".SERVERURL."login/");
	}
	
}