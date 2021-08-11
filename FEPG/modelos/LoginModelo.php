<?php  
if ($peticionAjax) {
	require_once "../core/MainModel.php";
}else{
	require_once "./core/MainModel.php";
}

class LoginModelo extends MainModel{
	protected function iniciarSesionModelo($datos){
		$sql=MainModel::conectar()->prepare("SELECT A.CuentaCodigo, A.CuentaPrivilegio, A.CuentaUsuario, A.CuentaEmail, A.CuentaFoto, B.AdminNombre, B.AdminApellido, A.CuentaTipo FROM cuenta A JOIN admin B ON A.CuentaCodigo = B.CuentaCodigo WHERE A.CuentaUsuario=:Usuario AND A.CuentaClave=:Clave AND A.CuentaEstado='Activo'");
		$sql->bindParam(':Usuario', $datos['Usuario']);
		$sql->bindParam(':Clave', $datos['Clave']);
		$sql->execute();
		return $sql;
	} 

	protected function cerrarSesionModelo($datos){
		if ($datos['Usuario'] != "" && $datos['Token_S'] == $datos['Token']) {
			$Abitacora=MainModel::actualizarBitacora($datos['Codigo'], $datos['Hora']);
			if ($Abitacora->rowCount()>=1) {
				session_unset();
				session_destroy();
				$respuesta="true";
				return header("Location: ".SERVERURL."login/");
			}else{
				$respuesta = "false no se gurado en la la bitacora";
			}
			
		}else{
			$respuesta="false";
		}
		return $respuesta;
	}

}