<?php 
if ($peticionAjax) {
	require_once "../modelos/EventoModelo.php";
}else{
	require_once "./modelos/EventoModelo.php";
}
class EventoControlador extends EventoModelo{
	public function agregarEventoControlador(){
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$lugar=MainModel::limpiarCadena($_POST['lugar-reg']);
		$tipoEvento = MainModel::limpiarCadena($_POST['tipoEvento-reg']);
		$participantes = $_POST['participantes-reg'];
		$fecha = MainModel::limpiarCadena($_POST['fecha-reg']);
		$hora = MainModel::limpiarCadena($_POST['hora-reg']);
		$descripcion=MainModel::limpiarCadena($_POST['descripcion-reg']);
		$listParticipantes='';
		for ($i=0; $i <count($participantes); $i++) { 
			$listParticipantes .= $participantes[$i].',';
		}

		

		$estado =1;
		$datosEvento = [
			"nombre" => $nombre,
			"lugar" => $lugar,
			"tipoEvento" => $tipoEvento,
			"estado"=>$estado,
			"participantes"=> $listParticipantes,
			"fecha" => $fecha,
			"hora" => $hora,
			"Descripcion" => $descripcion
		];
		

			$guardarEvento = EventoModelo::agregarEventoModelo($datosEvento);
			if ($guardarEvento->rowCount()>=1) {
			 		$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Se agregó el Evento",
					"Texto"=>"El Evento fué agregada correctamente",
					"Tipo"=>"success"
				];
			 }else{
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se agregó el evento",
					"Texto"=>"Error al guardar en base de datos el evento",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);
	}
	public function seleccionarTipoEventoControlador(){
		$datos = EventoModelo::seleccionarTipoEventoModelo();
		$tipoEvento = '';
		foreach ($datos as $rows) {
			$tipoEvento .= '<option value="'.$rows['IdEvento'].'">'.$rows['nombreEvento'].'</option>';
		}
		return $tipoEvento;
	}
	public function selectParticipanteEventoControlador(){
		$dato = EventoModelo::seleccionarParticipantesEventoModelo();
		$seleccionarParticipante = '';
		foreach ($dato as $row) {
			$seleccionarParticipante.= '<option value="'.$row['IdAgente'].'">'
			.$row['AgenteNombre']." ".$row['AgenteApellido'].'</option>';
		}
		return $seleccionarParticipante;
	}

	
	/***********************************************************************
	*****************Controladores Mostrar todos los eventos en lista******
	************************************************************************/
	//////Seleccionar evento por id//////
	
	

	public function seleccionarEventosControlador(){

		$datos = EventoModelo::seleccionarEventosModelo();
		
		$seleccionarEventos = '<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">NOMBRE DEL EVENTO</th>
							<th class="text-center">TIPO DE EVENTO:</th>
							<th class="text-center">LUGAR</th>
							<th class="text-center">PARTICIPANTES</th>
							<th class="text-center">FECHA EVENTO</th>
							<th class="text-center">HORA DEL EVENTO</th>
							<th class="text-center">Act. DATOS</th>
							<th class="text-center">Finalizar Evento</th>
							<th class="text-center">ELIMINAR</th>
						</tr>
					</thead>';
						
						foreach ($datos as $rows) {
							
							
							$datodos = explode(',', $rows['participantes']);

							foreach($datodos as $clave=>$valor){
								if(empty($valor)){
									unset($datodos[$clave]);
								}
							}
							$dato = array_merge($datodos);
							//var_dump($dato);
						$seleccionarEventos .= '
							<tr >
									<td >'.$rows[0].'</td>
									<td >'.$rows['nombre'].'</td>
									<td >'.$rows['nombreEvento'].'</td>
									<td >'.$rows['lugar'].'</td>
									';
									
									$participantes = '';
									$agente ='';
									foreach ($dato as $id) {
									$result = EventoModelo::seleccionarAgenteEventoModelo($id);
									$participantes .= $result['AgenteNombre']." ".$result['AgenteApellido'].', ';
									
									}
									
									$seleccionarEventos .= '<td >'.$participantes.'</td>';
									$seleccionarEventos.='
									<td >'.$rows['fecha_evento'].'</td>
									<td >'.$rows['hora_evento'].'</td>';
									if ($rows['estado']!=2) {
										$seleccionarEventos.='<td>
									<a href="'.SERVERURL.'eventEdit/'.MainModel::encriptar($rows['id']).'/" class="btn btn-success btn-raised btn-xs">
										<i class="zmdi zmdi-refresh"></i></a></td>
									<td>
									<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="post" class="FormularioAjax" data-form="update" entype="multipart/form-data" >
											<input type="hidden" name="tipoFormulario" value="finalEvento">
											<input type="hidden" name="idEventoEstado" value="'.MainModel::encriptar($rows['id']).'"/>
											<button type="submit" class="btn btn-warning btn-raised btn-xs">
												<i class="zmdi zmdi-chart zmdi-hc-lg"></i>
											</button>
											<div class="RespuestaAjax"></div>
										</form>
									</td>

									<td>
										<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" >
											<input type="hidden" name="tipoFormulario" value="eliminarEvento">
											<input type="hidden" name="idEvento" value="'.MainModel::encriptar($rows['id']).'"/>
											<button type="submit" class="btn btn-danger btn-raised btn-xs">
												<i class="zmdi zmdi-delete"></i>
											</button>
											<div class="RespuestaAjax"></div>
										</form>
									</td>
								</tr>';	
									}else{
										$seleccionarEventos.='<td ></td>
									<td>
									<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="post" class="FormularioAjax" data-form="update" entype="multipart/form-data" >
											<input type="hidden" name="tipoFormulario" value="finalEvento">
											<input type="hidden" name="idEventoEstado" value="'.MainModel::encriptar($rows['id']).'"/>
											<button type="submit" class="btn btn-warning btn-raised btn-xs">
												<i class="zmdi zmdi-chart zmdi-hc-lg"></i>
											</button>
											<div class="RespuestaAjax"></div>
										</form>
									</td>

									<td>
										<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" >
											<input type="hidden" name="tipoFormulario" value="eliminarEvento">
											<input type="hidden" name="idEvento" value="'.MainModel::encriptar($rows['id']).'"/>
											<button type="submit" class="btn btn-danger btn-raised btn-xs">
												<i class="zmdi zmdi-delete"></i>
											</button>
											<div class="RespuestaAjax"></div>
										</form>
									</td>
								</tr>';
									}
								
									
						}
		return $seleccionarEventos;
	}

	public function actualizarEventoControlador(){
		$idEvento = MainModel::limpiarCadena($_POST['idEvento']);
		$punteoNombres = MainModel::limpiarCadena($_POST['agentes']);
		$punteoAgentes = MainModel::limpiarCadena($_POST['idAgentes']);

/*Traemos los inputs dinamicos, antes mandamos la variable idAgentes*/
		$separador=',';
		$cadenaNombres = str_replace(' ,', $separador, $punteoAgentes);
		$id = explode(',',$cadenaNombres);
		foreach($id as $clave=>$valor){
		    if(empty($valor)){
		        unset($id[$clave]);
		    }
		}
		$g = array_merge($id);



		$punteosIds='';
		$descripcionIds='';
		for($i=0; $i<count($g);$i++){
			$punteosIds .= MainModel::limpiarCadena($_POST['input'.$g[$i]]).',';
			$descripcionIds .= MainModel::limpiarCadena($_POST['observacion'.$g[$i]]).',';
		}


		$datosEvento = [
			"id" =>$idEvento,
			"punteo"=>$punteosIds,
			"observacion"=>$descripcionIds
		];

			$actualizarEvento = EventoModelo::actualizarEventoModelo($datosEvento);
			if ($actualizarEvento->rowCount()>=1) {
			 		$alerta=[
					"Alerta"=>"limpiar_redirect",
					"Titulo"=>"Se actualizo el Evento",
					"Texto"=>"El Evento fué agregada correctamente",
					"Tipo"=>"success",
					"Pagina"=>SERVERURL."eventlist.php"
				];
				
			 }else{
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se actualizo el evento",
					"Texto"=>"Error al guardar en base de datos el evento",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);
	}
	public function eliminarEventoControlador(){
		$codigoEvento = MainModel::desencriptar($_POST['idEvento']);
		$codigoEvento = MainModel::limpiarCadena($codigoEvento);
	
		$eliminarEvento = EventoModelo::eliminarEventoModelo($codigoEvento);

		if ($eliminarEvento->rowCount()>=1) {
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Agente eliminado",
						"Texto"=>"El evento se eliminó con éxito",
						"Tipo"=>"success"];
		}else{
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se elimino el agente",
					"Texto"=>"No se logró eliminar el evento, contactese con informática",
					"Tipo"=>"error"];
		}
		return MainModel::sweetAlert($alerta);
	}
	public function seleccionarInformacionEventosControlador(){
		$urlActual = $_SERVER["REQUEST_URI"];
		$urlActual=explode("/", $urlActual);
		$idEvento = $urlActual[3];
		$idEvento = MainModel::desencriptar($idEvento);
		$infoEvento = EventoModelo::seleccionarInfoEventoModelo($idEvento);

		return $infoEvento;
	}
	public function seleccionarNombreParticipanteControlador(){
		$urlActual = $_SERVER["REQUEST_URI"];
		$urlActual=explode("/", $urlActual);
		$idEvento = $urlActual[3];
		$idEvento = MainModel::desencriptar($idEvento);
		$infoEvento = EventoModelo::seleccionarInfoEventoModelo($idEvento);//traemos los datos del evento

		$Ids = explode(',',$infoEvento['participantes']);
		$participantesNombre = '';
		foreach ($Ids as $id) {
			$result = EventoModelo::seleccionarAgenteEventoModelo($id);
			$participantesNombre .= $result['AgenteNombre']." ".$result['AgenteApellido'].",";	
		}
		$participantes = $infoEvento['participantes'].'/'.$participantesNombre;
		return $participantes;
	}

	public function seleccionarNombreTipoEventoControlador(){
		$urlActual = $_SERVER["REQUEST_URI"];
		$urlActual=explode("/", $urlActual);
		$idEvento = $urlActual[3];
		$idEvento = MainModel::desencriptar($idEvento);
		$infoEvento = EventoModelo::seleccionarInfoEventoModelo($idEvento);
		
		$i = $infoEvento['tipo_evento'];
		$selectEvento='';
		$result = EventoModelo::seleccionarInfoTipoEventoModelo($i);
		$selectEvento .=$result['IdEvento'].",". $result['nombreEvento'];
		$evento = explode(',',$selectEvento);
		
		return $evento;
	}

	public function actualizaEstadoEventoControlador(){
		$codigoEvento = MainModel::desencriptar($_POST['idEventoEstado']);
		$Evento = MainModel::limpiarCadena($codigoEvento);
		
		$actualizarEventoEstado = EventoModelo::actualizarEstadoEventoModelo($Evento);

		if ($actualizarEventoEstado->rowCount()>=1) {
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Estado Actualizado",
						"Texto"=>"El Estado se  actualizo con éxito",
						"Tipo"=>"success"];
		}else{
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se actualizo el estado",
					"Texto"=>"No se logró actualizar el estado, contactese con informática",
					"Tipo"=>"error"];
		}
		return MainModel::sweetAlert($alerta);
	}
	 
}
