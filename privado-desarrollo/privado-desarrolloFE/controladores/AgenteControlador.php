<?php
if ($peticionAjax) {
	require_once "../modelos/AgenteModelo.php";
}else{
	require_once "./modelos/AgenteModelo.php";
}
class AgenteControlador extends AgenteModelo{
	//Para agregar al administrador
	public function agregarAgenteControlador(){
		$dpi=MainModel::limpiarCadena($_POST['dpi-reg']);
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$apellido=MainModel::limpiarCadena($_POST['apellido-reg']);
		$nacimiento=MainModel::limpiarCadena($_POST['nacimiento-reg']);
		$gradoAcademico=MainModel::limpiarCadena($_POST['gradoAcademico-reg']);
		$sede=MainModel::limpiarCadena($_POST['sede-reg']);
		$grupo=MainModel::limpiarCadena($_POST['grupo-reg']);
		$turno=MainModel::limpiarCadena($_POST['turno-reg']);
		$estado=MainModel::limpiarCadena($_POST['estado-reg']);
		$idPuesto = MainModel::limpiarCadena($_POST['idPuesto-reg']);
		$direccion = MainModel::limpiarCadena($_POST['direccion-reg']);
		$contactoPersonal = MainModel::limpiarCadena($_POST['contactoPersonal-reg']);
		$contactoEmergencia = MainModel::limpiarCadena($_POST['contactoEmergencia-reg']);
		$tatuajes = MainModel::limpiarCadena($_POST['tatuajes-reg']);
		$tipoSangre = MainModel::limpiarCadena($_POST['tipoSangre-reg']);

		$peso=MainModel::limpiarCadena($_POST['peso-reg']);
		$estatura=MainModel::limpiarCadena($_POST['estatura-reg']);
		$pesoIdeal=MainModel::limpiarCadena($_POST['pesoIdeal-reg']);
		$problemasMedicos=MainModel::limpiarCadena($_POST['problemasMedicos-reg']);
		$alergias=MainModel::limpiarCadena($_POST['alergias-reg']);


		$consulta=MainModel::ejecutarConsultaSimple("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".DB."' AND TABLE_NAME = 'agente'");
		$sigIdAgente=$consulta->fetch(PDO::FETCH_ASSOC);
		$sigIdAgente=$sigIdAgente['AUTO_INCREMENT'];

		$codigo=mainModel::generarCodigoAleatorio("AG", 7,$sigIdAgente);

		$extensionFotoAgente = '';
		$ruta = 'adjuntos/fotoAgentes/';
		$archivo = $_FILES['foto']['tmp_name'];
		$nombre_archivo = $_FILES['foto']['name'];
		$info = pathinfo($nombre_archivo);
		if ($archivo != '') {
			$extensionFotoAgente = $info['extension'];
			if ($extensionFotoAgente == "png" || $extensionFotoAgente == "PNG" || $extensionFotoAgente == "JPG" || $extensionFotoAgente == "jpg" || $extensionFotoAgente == "JPEG" || $extensionFotoAgente == "jpeg") {
				move_uploaded_file($archivo, '../adjuntos/fotoAgentes/'.$codigo.'.'.$extensionFotoAgente);
				$ruta = $ruta.$codigo.'.'.$extensionFotoAgente;
				$datosAgente = [
					"Dpi" => $dpi,
					"Nombre" => $nombre,
					"Apellido" => $apellido,
					"Nacimiento" => $nacimiento,
					"Grupo" => $grupo,
					"Foto" => $ruta,
					"GradoAcademico" => $gradoAcademico,
					"Sede" => $sede,
					"Turno" => $turno,
					"Estado" => $estado,
					"IdPuesto" => $idPuesto,
					"direccion" => $direccion,
					"contactoPersonal" => $contactoPersonal,
					"contactoEmergencia" => $contactoEmergencia,
					"tatuajes" => $tatuajes,
					"tipoSangre" => $tipoSangre
				];

				$guardarAgente = AgenteModelo::agregarAgenteModelo($datosAgente);

				if ($guardarAgente->rowCount()>=1) {

					$extensionFichaMedica = '';
					$rutaFichaMedica = 'adjuntos/fichaMedicaAgentes/';
					$archivo = $_FILES['fichaMedica']['tmp_name'];
					$nombre_archivo = $_FILES['fichaMedica']['name'];
					$info = pathinfo($nombre_archivo);
					if ($archivo != '') {
						$extensionFichaMedica = $info['extension'];
						if ($extensionFichaMedica == "png" || $extensionFichaMedica == "PNG" || $extensionFichaMedica == "JPG" || $extensionFichaMedica == "jpg" || $extensionFichaMedica == "JPEG" || $extensionFichaMedica == "jpeg" || $extensionFichaMedica == "PDF" || $extensionFichaMedica == "pdf") {
							move_uploaded_file($archivo, '../adjuntos/fichaMedicaAgentes/'.$codigo.'.'.$extensionFichaMedica);
							$rutaFichaMedica = $rutaFichaMedica.$codigo.'.'.$extensionFichaMedica;
							$datosAntecedentes=[
								"IdAgente" => $sigIdAgente,
								"Peso"=> $peso,
								"Estatura"=> $estatura,
								"PesoIdeal"=> $pesoIdeal,
								"ProblemasMedicos"=> $problemasMedicos,
								"Alergias"=> $alergias,
								"FichaMedica"=> $rutaFichaMedica
									];
							$guardarAntecedentesMedicos = AgenteModelo::agregarAntecedenteMedicosModelo($datosAntecedentes);
							if ($guardarAntecedentesMedicos->rowCount()>=1) {
								$alerta=[
									"Alerta"=>"limpiar",
									"Titulo"=>"Agente Registrado",
									"Texto"=>"El agente se registro con éxito",
									"Tipo"=>"success"
								];
							}else{
								$alerta=[
									"Alerta"=>"simple",
									"Titulo"=>"Ocurrio un error inesperado",
									"Texto"=>"No hemos podido registrar el agente, no se registro la información médica",
									"Tipo"=>"error"
								];
								//eliminar agente,
								$eliminarAgente = AgenteModelo::eliminarAgenteModelo($sigIdAgente);
								//eliminar ficha medica
								unlink("../adjuntos/fichaMedicaAgentes/".$codigo.'.'.$extensionFichaMedica);
								//eliminar foto agente
								unlink("../adjuntos/fotoAgentes/".$codigo.'.'.$extensionFotoAgente);
							}
						}else{
							$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Ocurrio un error inesperado",
								"Texto"=>"El tipo de documento de la ficha médica no es correcto",
								"Tipo"=>"error"
							];
							//eliminar agente,
							$eliminarAgente = AgenteModelo::eliminarAgenteModelo($sigIdAgente);
							//eliminar foto agente
							unlink("../adjuntos/fotoAgentes/".$codigo.'.'.$extensionFotoAgente);
						}
					}else{
						$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Ocurrio un error inesperado",
								"Texto"=>"No se adjunto ningun documento o imagen en la Ficha Médica",
								"Tipo"=>"warning"
							];
							//eliminar agente,
							$eliminarAgente = AgenteModelo::eliminarAgenteModelo($sigIdAgente);
							//eliminar foto agente
							unlink("../adjuntos/fotoAgentes/".$codigo.'.'.$extensionFotoAgente);
					}
				}else{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error inesperado",
						"Texto"=>"No hemos podido registrar el agente",
						"Tipo"=>"error"
					];
					//eliminar foto agente
					sunlink("../adjuntos/fotoAgentes/".$codigo.'.'.$extensionFotoAgente);
				}


			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"El Formato de la fotografía no es valida",
					"Tipo"=>"error"
				];
			}
		}else{
			$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"No adjunto ninguna fotografía",
					"Tipo"=>"error"
				];
		}
		return MainModel::sweetAlert($alerta);
	}
	public function editarAgenteControlador(){
		$dpi=MainModel::limpiarCadena($_POST['dpi-reg']);
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$apellido=MainModel::limpiarCadena($_POST['apellido-reg']);
		$nacimiento=MainModel::limpiarCadena($_POST['nacimiento-reg']);
		$gradoAcademico=MainModel::limpiarCadena($_POST['gradoAcademico-reg']);
		$sede=MainModel::limpiarCadena($_POST['sede-reg']);
		$grupo=MainModel::limpiarCadena($_POST['grupo-reg']);
		$turno=MainModel::limpiarCadena($_POST['turno-reg']);
		$estado=MainModel::limpiarCadena($_POST['estado-reg']);
		$idPuesto = MainModel::limpiarCadena($_POST['idPuesto-reg']);

		$peso=MainModel::limpiarCadena($_POST['peso-reg']);
		$estatura=MainModel::limpiarCadena($_POST['estatura-reg']);
		$pesoIdeal=MainModel::limpiarCadena($_POST['pesoIdeal-reg']);
		$problemasMedicos=MainModel::limpiarCadena($_POST['problemasMedicos-reg']);
		$alergias=MainModel::limpiarCadena($_POST['alergias-reg']);
		$fotoVieja=MainModel::limpiarCadena($_POST['fotoVieja']);
		$fichaMedicaVieja=MainModel::limpiarCadena($_POST['fichaMedicaVieja']);
		$idAgente=MainModel::limpiarCadena($_POST['idAgente']);

		$ruta = '';
		$rutaFichaMedica = '';
		$archivo = $_FILES['foto']['tmp_name'];
		$extensionFotoAgente = '';
		$nombre_archivo = $_FILES['foto']['name'];
		$info = pathinfo($nombre_archivo);
		if ($archivo != '') {

			$ruta = 'adjuntos/fotoAgentes/';
			$extensionFotoAgente = $info['extension'];
			if ($extensionFotoAgente == "png" || $extensionFotoAgente == "PNG" || $extensionFotoAgente == "JPG" || $extensionFotoAgente == "jpg" || $extensionFotoAgente == "JPEG" || $extensionFotoAgente == "jpeg") {
				$codigo=mainModel::generarCodigoAleatorio("AG", 7,$sigIdAgente);
				move_uploaded_file($archivo, '../adjuntos/fotoAgentes/'.$codigo.'.'.$extensionFotoAgente);
				$ruta = $ruta.$codigo.'.'.$extensionFotoAgente;
			}else{
				$ruta = $fotoVieja;
			}
		}else{
			$ruta = $fotoVieja;
		}
		$extensionFichaMedica = '';
		$archivo = $_FILES['fichaMedica']['tmp_name'];
		$nombre_archivo = $_FILES['fichaMedica']['name'];
		$info = pathinfo($nombre_archivo);
		if ($archivo != '') {
			$rutaFichaMedica = 'adjuntos/fichaMedicaAgentes/';
			$extensionFichaMedica = $info['extension'];
			if ($extensionFichaMedica == "png" || $extensionFichaMedica == "PNG" || $extensionFichaMedica == "JPG" || $extensionFichaMedica == "jpg" || $extensionFichaMedica == "JPEG" || $extensionFichaMedica == "jpeg" || $extensionFichaMedica == "PDF" || $extensionFichaMedica == "pdf") {
				$codigo=mainModel::generarCodigoAleatorio("AG", 7,$sigIdAgente);
				move_uploaded_file($archivo, '../adjuntos/fichaMedicaAgentes/'.$codigo.'.'.$extensionFichaMedica);
				$rutaFichaMedica = $rutaFichaMedica.$codigo.'.'.$extensionFichaMedica;
			}else{
				$rutaFichaMedica = $fichaMedicaVieja;
			}
		}else{
			$rutaFichaMedica = $fichaMedicaVieja;
		}

		$datosAgente = [
					"Dpi" => $dpi,
					"Nombre" => $nombre,
					"Apellido" => $apellido,
					"Nacimiento" => $nacimiento,
					"Grupo" => $grupo,
					"Foto" => $ruta,
					"GradoAcademico" => $gradoAcademico,
					"Sede" => $sede,
					"Turno" => $turno,
					"Estado" => $estado,
					"IdPuesto" => $idPuesto
				];

				$guardarAgente = AgenteModelo::agregarAgenteModelo($datosAgente);

				if ($guardarAgente->rowCount()>=1) {
					//hasta aca me quede
				}


	}
	public function eliminarAgenteControlador(){
		$privilegioAdmin=MainModel::desencriptar($_POST['privilegio-admin']);
		$codigoAgente=MainModel::desencriptar($_POST['codigo-del']);
		$codigoAgente=MainModel::limpiarCadena($codigoAgente);
		$privilegioAdmin=MainModel::limpiarCadena($privilegioAdmin);
			if ($privilegioAdmin == 1) {
				$eliminarAgente = AgenteModelo::eliminarAgenteModelo($codigoAgente);
				if ($eliminarAgente->rowCount()>=1) {
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Agente eliminado",
						"Texto"=>"El agente se eliminó con éxito",
						"Tipo"=>"success"
					];
				}else{
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se elimino el agente",
					"Texto"=>"No se logró eliminar el agente, contactese con informática",
					"Tipo"=>"error"
				];
				}
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se elimino el agente",
					"Texto"=>"No tiene permiso suficiente para eliminar el agente",
					"Tipo"=>"error"
				];
			}
		return MainModel::sweetAlert($alerta);
	}
	public function seleccionarSedesControlador(){
		$datos = MainModel::seleccionarSedes();
		$sedes = '';
		foreach ($datos as $rows) {
			$sedes .= '<option value="'.$rows['IdSede'].'">'.$rows['SedeNombre'].'</option>';
		}
		return $sedes;
	}
	public function seleccionarPuestosControlador(){
		$datos = MainModel::seleccionarPuestos();
		$sedes = '';
		foreach ($datos as $rows) {
			$sedes .= '<option value="'.$rows['IdPuesto'].'">Puesto: '.$rows['PuestoNombre'].',  Funciones: '.$rows['PuestoFunciones'].'</option>';
		}
		return $sedes;
	}
	public function seleccionarSangreControlador(){
		$datos = MainModel::seleccionarTipoSangre();
		$sedes = '';
		foreach ($datos as $rows) {
			$sedes .= '<option value="'.$rows['IdTipoSangre'].'"> '.$rows['TipoSangreNombre'].'</option>';
		}
		return $sedes;
	}
	public function seleccionarEstadosControlador(){
		$datos = MainModel::seleccionarEstados();
		$sedes = '';
		foreach ($datos as $rows) {
			$sedes .= '<option value="'.$rows['IdEstado'].'">'.$rows['EstadoNombre'].'</option>';
		}
		return $sedes;
	}

	public function seleccionarInformacionAgenteControlador(){
		$urlActual = $_SERVER["REQUEST_URI"];
		$urlActual=explode("/", $urlActual);
		$idAgente = $urlActual[3];
		$idAgente = MainModel::desencriptar($idAgente);
		$infoAgente = AgenteModelo::seleccionarInformacionAgenteModelo($idAgente);
		return $infoAgente;
	}

	public function paginadorAgenteControlador($pagina, $registros, $privilegio, $busqueda){
		$pagina=MainModel::limpiarCadena($pagina);
		$registros=MainModel::limpiarCadena($registros);
		$privilegio=MainModel::limpiarCadena($privilegio);
		$busqueda=MainModel::limpiarCadena($busqueda);
		$tabla="";

		$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina:1;//si la variables $pagina viene definida y si es mayor a cero, lo pasamos a entero, sino se cumple la condicion que muestre 1
		$inicio=($pagina>0)? (($pagina*$registros-$registros)) : 0;//calcular desde que registro de la base de datos vamos a comenzar a mostrar

		if (isset($busqueda) && $busqueda != "") {
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM agente WHERE (AgenteDpi LIKE '%$busqueda%' OR AgenteNombre LIKE '%$busqueda%' OR AgenteApellido LIKE '%$busqueda%' OR AgenteGrupo LIKE '%$busqueda%' OR AgenteGradoAcademico LIKE '%$busqueda%' OR AgenteEstado LIKE '%$busqueda%') ORDER BY AgenteNombre, AgenteApellido ASC LIMIT $inicio,$registros";
			$paginaUrl="agentsearch";
		}else{
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM agente ORDER BY AgenteNombre, AgenteApellido ASC LIMIT $inicio,$registros";
			$consulta2=MainModel::ejecutarConsultaSimple("SELECT COUNT(idAgente) AS grupoA FROM agente WHERE AgenteGrupo='A'");
			$consulta3=MainModel::ejecutarConsultaSimple("SELECT COUNT(idAgente) AS grupoB FROM agente WHERE AgenteGrupo='B'");
			$grupoA=$consulta2->fetch(PDO::FETCH_ASSOC);
			$grupoA=$grupoA['grupoA'];
			$grupoB=$consulta3->fetch(PDO::FETCH_ASSOC);
			$grupoB=$grupoB['grupoB'];
			$paginaUrl="agentlist";
		}
		$conexion = MainModel::conectar();
		$datos = $conexion->query($consulta);
		$datos=$datos->fetchAll();//todo el array de datos
		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total=(int) $total->fetchColumn();

		//calcular total de paginas
		$Npaginas=ceil($total/$registros);//toma el entero de la siguiente operacion 100/15=6.666666 la funcion ceil toma el entero 7 lo redondea
		if (!isset($busqueda) || $busqueda == "") {
		$tabla .= '<div class="container-fluid">
			<div class="panel panel-success">
				<div class="full-box text-center" style="padding: 30px 10px;">
						<article class="full-box tile">
							<div class="full-box tile-title text-center text-titles text-uppercase">
								TOTAL DE AGENTES
							</div>
							<div class="full-box tile-icon text-center">
								<i class="zmdi zmdi-accounts"></i>
							</div>
							<div class="full-box tile-number text-titles">
								<p class="full-box">'.$total.'</p>
								<small>Register</small>
							</div>
						</article>
						<article class="full-box tile">
							<div class="full-box tile-title text-center text-titles text-uppercase">
								GRUPO A
							</div>
							<div class="full-box tile-icon text-center">
								<i class="zmdi zmdi-male-alt"></i>
							</div>
							<div class="full-box tile-number text-titles">
								<p class="full-box">'.$grupoA.'</p>
								<small>Register</small>
							</div>
						</article>
						<article class="full-box tile">
							<div class="full-box tile-title text-center text-titles text-uppercase">
								GRUPO B
							</div>
							<div class="full-box tile-icon text-center">
								<i class="zmdi zmdi-male-alt"></i>
							</div>
							<div class="full-box tile-number stext-titles">
								<p class="full-box">'.$grupoB.'</p>
								<small>Register</small>
							</div>
						</article>
					</div>
			</div>
		</div>';
		}
		//que sea diferente a uno para que nadie pueda editar la informacion del super administrador.
		$tabla.='<div class="container-fluid">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE AGENTES</h3>
			</div>
			<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">DPI</th>
							<th class="text-center">NOMBRES</th>
							<th class="text-center">APELLIDOS</th>
							<th class="text-center">FECHA NACIMIENTO</th>
							<th class="text-center">GRUPO</th>';

							if ($privilegio<=2) {
								$tabla.=
							'<th class="text-center">FICHA DEL AGENTE</th>
							 <th class="text-center">Act. DATOS</th>
							 <th class="text-center">LINEA DE TIEMPO</th>'
							 ;
							}
							if ($privilegio ==1) {
								$tabla.=
							'<th class="text-center">ELIMINAR</th>';
							}

		$tabla.='
						</tr>
					</thead>
					<tbody>';

		if ($total>=1 && $pagina <= $Npaginas) {
			$contador = $inicio + 1;
			foreach ($datos as $rows) {
				$tabla.='
				<tr>
					<td>'.$contador.'</td>
					<td>'.$rows['AgenteDpi'].'</td>
					<td>'.$rows['AgenteNombre'].'</td>
					<td>'.$rows['AgenteApellido'].'</td>
					<td>'.$rows['AgenteNacimiento'].'</td>
					<td>'.$rows['AgenteGrupo'].'</td>'
					;
					if ($privilegio<=2) {
						$tabla.='
						<td>
							<a href="'.SERVERURL.'agentficha/'.MainModel::encriptar($rows['IdAgente']).'/" class="btn btn-primary btn-raised btn-xs">
								<i class="zmdi zmdi-account-box"></i>
							</a>
						</td>
						<td>
							<a href="'.SERVERURL.'agentedit/'.MainModel::encriptar($rows['IdAgente']).'/" class="btn btn-success btn-raised btn-xs">
								<i class="zmdi zmdi-refresh"></i>
							</a>
						</td>
						<td>
							<a href="'.SERVERURL.'agenttimeline/'.MainModel::encriptar($rows['IdAgente']).'/" class="btn btn-secundary btn-raised btn-xs">
								<i class="zmdi zmdi-calendar"></i>
							</a>
						</td>';
					}
					if ($privilegio ==1) {
						$tabla.='
						<td>
							<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
								<input type="hidden" name="tipoFormulario" value="deleteAgent">
								<input type="hidden" name="codigo-del" value="'.MainModel::encriptar($rows['IdAgente']).'"/>
								<input type="hidden" name="privilegio-admin" value="'.MainModel::encriptar($privilegio).'"/>
								<button type="submit" class="btn btn-danger btn-raised btn-xs">
									<i class="zmdi zmdi-delete"></i>
								</button>
								<div class="RespuestaAjax"></div>
							</form>
						</td>';
					}
				$tabla.='
				</tr>
				';
				$contador++;
			}
		}else{
			if ($total>=1) {
				$tabla.='
				<tr>
					<td colspan="5">
						<a href="'.SERVERURL.$paginaUrl.'/" class="btn-sm btn-info btn-raised">
							Haga clic aca para recargar el listado
						</a>
					</td>
				</tr>
			';
			}else{
				$tabla.='
				<tr>
					<td colspan="5">No hay registros en el sistema</td>
				</tr>
			';
			}
		}
		$tabla .= "</tbody>
				</table>
			</div>
		</div>
	</div>
</div>";
		if ($total>=1 && $pagina <= $Npaginas) {
			$tabla.='
				<nav class="text-center">
				<ul class="pagination pagination-sm">';
			if ($pagina==1) {
				$tabla.='<li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>';
			}else{
				$tabla.='<li class=""><a href="'.SERVERURL.$paginaUrl.'/'.($pagina - 1).'/"><i class="zmdi zmdi-arrow-left"></i></a></li>';
			}
			for ($i=1; $i <= $Npaginas ; $i++) {
				if ($pagina==$i) {
					$tabla.='<li class="active"><a href="'.SERVERURL.$paginaUrl.'/'.$i.'/">'.$i.'</a></li>';
				}else{
					$tabla.='<li class=""><a href="'.SERVERURL.$paginaUrl.'/'.$i.'/">'.$i.'</a></li>';
				}
				$tabla.='';
			}

			if ($pagina==$Npaginas) {
				$tabla.='<li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>';
			}else{
				$tabla.='<li class=""><a href="'.SERVERURL.$paginaUrl.'/'.($pagina + 1).'/"><i class="zmdi zmdi-arrow-right"></i></a></li>';
			}
			$tabla.='</ul></nav>';
		}
		return $tabla;
	}

}
