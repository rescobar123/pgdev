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
	
		if ($data) {
			$data = $data[0];
			$datos = $data['id'];
			$datos=$mainModel->encriptar($datos);
			if ($data['CuentaPrivilegio'] == "Administrador") {
				$url=SERVERURL."home/".$datos;
			}else{
				$url=SERVERURL."home/".$datos;
			}
			return '<script>
				window.location="'.$url.'"
			</script>';
	
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"El usuario o contrasenia con incorrectos, favor revise",
					"Tipo"=>"danger"
				];
				return $mainModel->alert($alerta);
			}
		
	}


	public function cerrarSesionControlador(){
		$mainModel = new MainModel();
		session_start(['name' => 'PG']);
		$token=$mainModel->desencriptar($_GET['Token']);
		if ($token == $_SESSION['s_token']){
			session_unset();
			session_destroy();
			return header("Location: ".SERVERURL."login/");
		}else{
			return header("Location: ".SERVERURL."home/");
		}
		
	}

	public function forzarCierreSessionControlador(){
		session_unset();
		session_destroy();
		return header("Location: ".SERVERURL."login/");
	}
	
}