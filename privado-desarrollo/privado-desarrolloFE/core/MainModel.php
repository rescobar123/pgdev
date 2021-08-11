<?php 
	if ($peticionAjax) {
		require_once "../core/configAPP.php";
	}else{
		require_once "./core/configAPP.php";
	}
	class MainModel{
		protected function conectar(){
			$enlace = new PDO(SGBD, USER, PASS);//estas constantes vienen de configAPP
			return $enlace;
		}

		protected function ejecutarConsultaSimple($consulta){
			$respuesta=self::conectar()->prepare($consulta);
			$respuesta->execute();
			return $respuesta;
		} 

		protected function agregarCuenta($datos){
			$sql=self::conectar()->prepare("INSERT INTO cuenta(CuentaCodigo, CuentaPrivilegio, CuentaUsuario, CuentaClave, CuentaEmail, CuentaEstado, CuentaTipo, CuentaGenero, CuentaFoto) VALUES(:Codigo, :Privilegio, :Usuario, :Clave, :Email, :Estado, :Tipo, :Genero, :Foto)");//Usamos marcadores
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->bindParam(":Privilegio",$datos['Privilegio']);
			$sql->bindParam(":Usuario",$datos['Usuario']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Email",$datos['Email']);
			$sql->bindParam(":Estado",$datos['Estado']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Genero",$datos['Genero']);
			$sql->bindParam(":Foto",$datos['Foto']);
			$sql->execute();
			return $sql;
		}

		protected function eliminarCuenta($codigo){
			$sql=self::conectar()->prepare("DELETE FROM cuenta WHERE CuentaCodigo=:Codigo");
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;
		}

		protected function guardarBitacora($datos){
			$sql=self::conectar()->prepare("INSERT INTO bitacora(BitacoraCodigo, BitacoraFecha, BitacoraHoraInicio, BitacoraHoraFinal, BitacoraTipo, BitacoraYear, CuentaCodigo) VALUES(:Codigo, :Fecha, :HoraInicio, :HoraFinal, :Tipo, :Year, :CuentaCodigo)");
			$sql->bindParam(":Codigo", $datos['Codigo']);
			$sql->bindParam(":Fecha", $datos['Fecha']);
			$sql->bindParam(":HoraInicio", $datos['HoraInicio']);
			$sql->bindParam(":HoraFinal", $datos['HoraFinal']);
			$sql->bindParam(":Tipo", $datos['Tipo']);
			$sql->bindParam(":Year", $datos['Year']);
			$sql->bindParam(":CuentaCodigo", $datos['CuentaCodigo']);
			$sql->execute();
			return $sql;
		}
		protected function actualizarBitacora($codigo, $horaSalida){
			$sql=self::conectar()->prepare("UPDATE bitacora SET BitacoraHoraFinal=:Hora WHERE BitacoraCodigo=:Codigo");
			$sql->bindParam(":Hora", $horaSalida);
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;
		}

		protected function eliminarBitacora($codigo){
			$sql=self::conectar()->prepare("DELETE FROM bitacora WHERE CuentaCodigo = :Codigo");
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;
		}
		public function encriptar($string){
			$output = FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key,0,$iv);
			$output=base64_encode($output);
			return $output;
		}

		public function desencriptar($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0,16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key,0, $iv);
			return $output;
		}

		protected function generarCodigoAleatorio($letra, $longitud, $num){
			for ($i=1; $i <= $longitud ; $i++) { 
				$numero=rand(0,9);
				$letra .= $numero;
			}
			return $letra.'-'.$num;
		}

		//limpiar cadena y evitar ijection sql
		public static function limpiarCadena($cadena){
			//limpiar la cadena para que no contenga palabras que no queramos la DB
			$cadena=trim($cadena);//trim elimina espacios en blancoal finial o inicia de la cadena
			$cadena=stripcslashes($cadena);//stripcslashes, quita barras invertidas
			$cadena=str_ireplace("<script>", "", $cadena);//que remplace <script> por vacio
			$cadena=str_ireplace("<script src>", "", $cadena);
			$cadena=str_ireplace("<script type>", "", $cadena);
			$cadena=str_ireplace("SELECT * FROM", "", $cadena);
			$cadena=str_ireplace("DELETE FROM", "", $cadena);
			$cadena=str_ireplace("INSERT INTO", "", $cadena);
			$cadena=str_ireplace("--", "", $cadena);
			$cadena=str_ireplace("[", "", $cadena);
			$cadena=str_ireplace("]", "", $cadena);
			$cadena=str_ireplace("==", "", $cadena);
			return $cadena;

		}
		public static function sweetAlert($datos){
			if ($datos['Alerta'] == "simple") {
				$alerta ="
					<script>
						swal(
						  '".$datos['Titulo']."',
						  '".$datos['Texto']."',
						  '".$datos['Tipo']."'
						);
					</script>
				";
			}elseif ($datos['Alerta'] == "recargar") {
				$alerta = "
					<script>
						swal({
						  title: '".$datos['Titulo']."',
						  text: '".$datos['Texto']."',
						  type: '".$datos['Tipo']."',
						  confirmButtonText: 'Aceptar'
						}).then(function() {
							location.reload();	
						});
					</script>
				";
			}elseif ($datos['Alerta'] == "limpiar") {
				$alerta = "
					<script>
						swal({
						  title: '".$datos['Titulo']."',
						  text: '".$datos['Texto']."',
						  type: '".$datos['Tipo']."',
						  confirmButtonText: 'Aceptar'
						}).then(function() {
							$('.FormularioAjax')[0].reset();
						});
					</script>
				";
			}elseif ($datos['Alerta'] == "limpiar_redirect") {
				$pagina = $datos['Pagina'];
				$alerta = "
					<script>
						swal({
						  title: '".$datos['Titulo']."',
						  text: '".$pagina."',
						  type: '".$datos['Tipo']."',
						  confirmButtonText: 'Aceptar'
						}).then(function() {
						window.location('".$pagina."');
						});
					</script>
				";
			}elseif ($datos['Alerta'] == "recargardiv") {
				$alerta = "
					<script>
						swal({
						  title: '".$datos['Titulo']."',
						  text: '".$datos['Texto']."',
						  type: '".$datos['Tipo']."',
						  confirmButtonText: 'Aceptar'
						}).then(function() {
							$('.FormularioAjax')[0].reset();
						});
						
					</script>
				";
			}
			return $alerta;
		}

		protected function seleccionarSedes(){
			$sql=self::conectar()->query("SELECT * FROM sede");
			$sql=$sql->fetchAll();
			return $sql;
		}
		protected function seleccionarPuestos(){
			$sql=self::conectar()->query("SELECT * FROM puesto");
			$sql=$sql->fetchAll();
			return $sql;
		}
		protected function seleccionarEstados(){
			$sql=self::conectar()->query("SELECT * FROM estado");
			$sql=$sql->fetchAll();
			return $sql;
		}
		protected function seleccionarTipoSangre(){
			$sql=self::conectar()->query("SELECT * FROM tipoSangre");
			$sql=$sql->fetchAll();
			return $sql;
		}
	}
