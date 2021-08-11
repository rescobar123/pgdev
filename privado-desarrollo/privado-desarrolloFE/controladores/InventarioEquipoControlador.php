<?php 
if ($peticionAjax) {
	require_once "../modelos/InventarioEquipoModelo.php";
}else{
	require_once "./modelos/InventarioEquipoModelo.php";
}
class InventarioControlador extends InventarioModelo{
	/*SOLO SELECCIONAR DATOS*/
	public function seleccionarSedeInventarioControlador(){//sede id
		$dato = InventarioModelo::seleccionarSedesModelo();
		$seleccionarSede = '';
		foreach ($dato as $row) {
			$seleccionarSede.= '<option value="'.$row['IdSede'].'">'
			.$row['SedeNombre'].'</option>';
		}
		return $seleccionarSede;
	}
	
	public function seleccionarPersonalDivisionControlador(){
		$dato = InventarioModelo::seleccionarPersonalDivisionModelo();
		$seleccionarParticipante = '';
		foreach ($dato as $row) {
			$seleccionarParticipante.= '<option value="'.$row['IdAgente'].'">'
			.$row['AgenteNombre']." ".$row['AgenteApellido'].'</option>';
		}
		return $seleccionarParticipante;
	}

	public function seleccionarEquipoAgenteControlador(){
		$datos = InventarioModelo::seleccionarEquiposModelo();
		$seleccionarEquipo = '';
		foreach ($datos as $row) {
			$seleccionarEquipo.= '<option value="'.$row['id_equipo'].'">'
			.$row['nombre_equipo']."--".$row['numero_inventario'].'</option>';
		}
		return $seleccionarEquipo;
	}

	public function seleccionarArmasAgenteControlador(){
		$datos=InventarioModelo::seleccionarArmasModelo();
		$seleccionarArmas='';
		foreach ($datos as $row) {
			$seleccionarArmas.='<option value="'.$row['id_arma'].'">'
			.$row['nombre_arma']."-".$row['marca']."-".$row['numero_registro'].'</option>';
		}
		return $seleccionarArmas;
	}
	public function seleccinarEquiposControlador(){

		$datos = InventarioModelo::seleccionarEquiposModelo();
		
		$seleccionarEventos = '<thead>
						<tr>
							
							<th class="text-center">#</th>
							<th class="text-center">NOMBRE</th>
							<th class="text-center">No. INVENTARIO</th>
							<th class="text-center">MARCA</th>
							<th class="text-center">SEDE</th>
							
						</tr>
					</thead>';
						$equipos_asignados = InventarioModelo::seleccionarIdEquipoAsignadoModelo();
						$i='';
						foreach ($equipos_asignados as $key) {
							$i = $key['id_equipo'];
						}
						$numero_equipo = explode(',',$i);
						foreach ($numero_equipo as $key => $value) {
							if (empty($value)) {
								unset($numero_equipo[$key]);
							}
						}
						$num_equipo = array_merge($numero_equipo);
						$id_nuevo='';
						foreach ($num_equipo as $valor) {
							$id_nuevo = $valor;
						}
						

						foreach ($datos as $rows) {
							$id = $rows['id_equipo'];

							var_dump($id);
							$Sede = InventarioModelo::seleccionarSedesNombreModelo($rows['sede_equipo']);
							$nombreSede = $Sede['SedeNombre'];

							
						$seleccionarEventos .= '
							<tr >	
									
									<td >'.$rows[0].'</td>
									<td >'.$rows['nombre_equipo'].'</td>
									<td >'.$rows['numero_inventario'].'</td>
									<td >'.$rows['marca_equipo'].'</td>
									<td >'.$nombreSede.'</td>';
									
									$seleccionarEventos.='</tr>
									';						
						}
		return $seleccionarEventos;

	}

	public function seleccinarEquiposDosControlador(){

		//traemos todos los datos de las personas que tienen asignado equipo y armas
		$datos = InventarioModelo::seleccionarEquiposAsignadoModelo();
		
		

		
		$seleccionarEventos = '<thead>
						<tr>
							<th class="text-center">NOMBRE</th>
							<th class="text-center">EQUIPOS ASIGNADOS</th>
							<th class="text-center">ARMAS ASIGNADAS</th>
							<th class="text-center">ACTUALIZAR</th>
							
						</tr>
					</thead>';
						
						foreach ($datos as $rows) {

							////////////nombres agentes con un id especifico/////////////////
							$nombreAgente =InventarioModelo::seleccionarNombreAgenteModelo($rows['id_agente']);
							$agente='';
							foreach ($nombreAgente as $nombre) {
								$agente.=$nombre['AgenteNombre'].' '.$nombre['AgenteApellido'];
							}
							///////////////fin nombres agentes//////////////
							///
							///inicio nombree equipos////////////////////
							$idEquipos = explode(',',$rows['id_equipo']);//convierto a array el string
							foreach($idEquipos as $clave=>$valor){
								if(empty($valor)){//si el valor es vacio 
									unset($idEquipos[$clave]);//eliminamos la clave
								}
							}
							$idEquipoNuevos = array_merge($idEquipos);//genramos un nuevo array 
							
							////fin mostrar nombre equipos//////
							///
							///inicio mostrar nombres armas
							$idArmas = explode(',',$rows['id_arma']);
							foreach ($idArmas as $key => $value) {
								if (empty($value)) {
									unset($idArmas[$key]);
								}
							}
							$idsArmas = array_merge($idArmas);
							
							
						$seleccionarEventos .= '
							<tr >	
									<td class="text-center">'.$agente.'</td>';
									$idEquipoNombre='';
									foreach ($idEquipoNuevos as $id) {
										$result = InventarioModelo::seleccionarNombresEquipoModelo($id);
										$idEquipoNombre.= $result['nombre_equipo'].',';
											
									}
									
									$seleccionarEventos .= '<td >'.$idEquipoNombre.'</td>';
									$idNombreArmas='';
									foreach ($idsArmas as $i) {
										$resultado = InventarioModelo::seleccionarNombresArmasModelo($i);
										$idNombreArmas.=$resultado['nombre_arma'].', ';
									}
									$seleccionarEventos .= '<td>'.$idNombreArmas.'</td>
									<td class="text-center">
									<a  href="'.SERVERURL.'asignacionedit/'.MainModel::encriptar($rows['id_asignacion']).'/" class="btn btn-success btn-raised btn-xs">
										<i class="zmdi zmdi-refresh"></i></a></td>
									
									</tr>
									';

														
						}
		return $seleccionarEventos;

	}

	public function seleccionarArmasControlador(){
		$datos = InventarioModelo::seleccionarArmasModelo();

		$seleccionarArmas ='<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">NOMBRE</th>
							<th class="text-center">MARCA</th>
							<th class="text-center">No. REGISTRO</th>
							<th class="text-center">MUNICIONES</th>
							<th class="text-center">CARGADORES</th>
							<th class="text-center">CALIBRE</th>
							
						</tr>
					</thead>';
					foreach ($datos as $rows) {


							
						$seleccionarArmas .= '
							<tr >
									<td class="text-center">'.$rows[0].'</td>
									<td class="text-center">'.$rows['nombre_arma'].'</td>
									<td class="text-center">'.$rows['marca'].'</td>
									<td class="text-center">'.$rows['numero_registro'].'</td>
									<td class="text-center">'.$rows['municiones'].'</td>
									<td class="text-center">'.$rows['cargadores'].'</td>
									<td class="text-center">'.$rows['calibre_arma'].'</td>';
									
									$seleccionarArmas.='</tr>
									';			
						}
		return $seleccionarArmas;
	}

	/*PARA TRAER TODA LA INFORMACION DE LA ASIGNACION POR ID*/
	public function seleccionarInformacionAsignacionControlador(){
		$urlActual = $_SERVER["REQUEST_URI"];
		$urlActual=explode("/", $urlActual);
		$idAsignacion = $urlActual[3];
		$idAsignacion = MainModel::desencriptar($idAsignacion);
		$infoAsignacion = InventarioModelo::seleccionarInfoAsignacionModelo($idAsignacion);

		return $infoAsignacion;
	}
	public function seleccionarNombreAgenteIdControlador($id){
		$nombreAgente =InventarioModelo::seleccionarNombreAgenteModelo($id);
		$agente='';
		foreach ($nombreAgente as $nombre) {
			$agente.=$nombre['AgenteNombre'].' '.$nombre['AgenteApellido'];
		}
		return $agente;
	}
	///////////////////////
	public function seleccionarNombreEquiposIdsControlador(){
			$urlActual = $_SERVER["REQUEST_URI"];
		$urlActual=explode("/", $urlActual);
		$idAsignacion = $urlActual[3];
		$idAsignacion = MainModel::desencriptar($idAsignacion);
		$infoAsignacion = InventarioModelo::seleccionarInfoAsignacionModelo($idAsignacion);

		$Ids = explode(',',$infoAsignacion['id_equipo']);
		$nombreEquipo = '';
		foreach ($Ids as $id) {
			$result = InventarioModelo::seleccionarNombresEquipoIdsModelo($id);
			$nombreEquipo .= $result['nombre_equipo'].''.$result['numero_inventario'].",";	
		}
		$participantes = $infoAsignacion['id_equipo'].'/'.$nombreEquipo;
		return $participantes;
	}

	public function seleccionarNombreArmasIdsControlador(){
		$urlActual=$_SERVER["REQUEST_URI"];
		$urlActual = explode("/",$urlActual);
		$id_asignacion = $urlActual[3];
		$id_asignacion = MainModel::desencriptar($id_asignacion);
		$infoArma = InventarioModelo::seleccionarInfoAsignacionModelo($id_asignacion);

		$ids = explode(',',$infoArma['id_arma']);
		$nombreEquipo = '';
		foreach ($ids as $id) {
			$result = InventarioModelo::seleccinarNombresArmasIdsModelo($id);
			$nombreEquipo .= $result['nombre_arma'].' '.$result['numero_registro'].",";	
		}
		$arma = $infoArma['id_arma'].'/'.$nombreEquipo;
		return $arma;

	}

	//////////////AGREGR DATOS equipo //////////////////
	public function agregarEquipoControlador(){
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$numero=MainModel::limpiarCadena($_POST['numero-reg']);
		$marca = MainModel::limpiarCadena($_POST['marca-reg']);
		$sede = MainModel::limpiarCadena($_POST['sede-reg']);
		$cantidad = MainModel::limpiarCadena($_POST['cantidad-reg']);
		$descripcion = MainModel::limpiarCadena($_POST['descripcion-reg']);
		
		

		$estado =1;
		$datos = [
			"nombre" => $nombre,
			"numero" => $numero,
			"marca" => $marca,
			"sede"=> $sede,
			"estado"=>$estado,
			"cantidad" => $cantidad,
			"descripcion" => $descripcion
		];
		

			$guardar = InventarioModelo::agregarEquipoInventarioModelo($datos);
			if ($guardar->rowCount()>=1) {
			 		$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Se agregó el elemento",
					"Texto"=>"El elemento fué agregada correctamente",
					"Tipo"=>"success"
				];
			 }else{
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se agregó el registro",
					"Texto"=>"Error al guardar en base de datos el evento",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);
	}

	////////AGREGAR DATOS ARMA//////
	public function agregarEquipoArmaControlador(){
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$numero=MainModel::limpiarCadena($_POST['numero-reg']);
		$municiones=MainModel::limpiarCadena($_POST['municiones-reg']);
		$cargadores =MainModel::limpiarCadena($_POST['cargadores-reg']);
		$marca = MainModel::limpiarCadena($_POST['marca-reg']);
		$calibre=MainModel::limpiarCadena($_POST['calibre-reg']);
		$sede = MainModel::limpiarCadena($_POST['sede-reg']);
		$cantidad = MainModel::limpiarCadena($_POST['cantidad-reg']);
		$entidad = MainModel::limpiarCadena($_POST['entidad-reg']);
		$descripcion = MainModel::limpiarCadena($_POST['descripcion-reg']);
		
		

		$estado =1;//sino a sido asignada el estado sera 1
		$datos = [
			"nombre" => $nombre,
			"numero" => $numero,
			"municiones"=>$municiones,
			"cargadores"=>$cargadores,
			"marca" => $marca,
			"calibre"=>$calibre,
			"sede"=> $sede,
			"estado"=>$estado,
			"cantidad" => $cantidad,
			"entidad"=>$entidad,
			"descripcion" => $descripcion
		];
		

			$guardar = InventarioModelo::agregarEquipoArmaInventarioModelo($datos);
			if ($guardar->rowCount()>=1) {
			 		$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Se agregó el elemento",
					"Texto"=>"El elemento fué agregada correctamente",
					"Tipo"=>"success"
				];
			 }else{
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se agregó el registro",
					"Texto"=>"Error al guardar en base de datos el evento",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);
	}

	///AGREGAR ASIGNACION DE EQUIPOS///////////
	///
	public function agregarAsignacionControlador(){
		$id_agente=MainModel::limpiarCadena($_POST['persona-reg']);
		$id_equipo = $_POST['equipo-asignar-reg'];
		$id_armas = $_POST['arma-asignar-reg'];
		$descripcion=MainModel::limpiarCadena($_POST['descripcion-reg']);

		$listEquipo='';
		for ($i=0; $i <count($id_equipo); $i++) { 
			$listEquipo .= $id_equipo[$i].',';
		}
		$listArmas='';
		for ($j=0; $j <count($id_armas); $j++) { 
			$listArmas .= $id_armas[$j].',';
		}
		$estado =1;
		$asignacion = [
			"nombre"=>$id_agente,
			"equipo"=>$listEquipo,
			"armas"=>$listArmas,
			"estado"=>$estado,
			"descripcion"=>$descripcion
		];
		
				$guardar = InventarioModelo::agregarAsignacionModelo($asignacion);
			if ($guardar->rowCount()>=1 ) {
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
					"Texto"=>"Error al guardar  en base de datos el evento",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);

	}




	/*ACTUALIZAR DATOS DE LA ASIGNACION DE ARMAS Y EQUIPO*/
	public function actualizarDatosAsignacionesControlador(){
		$id = MainModel::limpiarCadena($_POST['id_asignacion']);
		$nombre = MainModel::limpiarCadena($_POST['id_nombre-reg']);
		$equipos = $_POST['equipo-asignar-reg'];
		$armas = $_POST['arma-asignar-reg'];
		$observacion = MainModel::limpiarCadena($_POST['observacion-reg']);
		$idEquipo ='';
		$idArmas ='';
		for ($i=0; $i <count($equipos); $i++) { 
			$idEquipo .= $equipos[$i].',';
		}
		for($j=0;$j<count($armas);$j++){
			$idArmas .=$armas[$j].',';
		}

		$datos = [
			"id"=>$id,
			"nombre"=>$nombre,
			"idEquipo"=>$idEquipo,
			"idArma"=>$idArmas,
			"observacion"=>$observacion
		];

		$actualizarAsignacion = InventarioModelo::actualizarDatosAsignacionModelo($datos);
			if ($actualizarAsignacion->rowCount()>=1 ) {
					$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Se agregó el Evento",
					"Texto"=>"El Evento fué agregado correctamente",
					"Tipo"=>"success"
					];
			
			 }else{
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se agregó el evento",
					"Texto"=>"Error al guardar  en base de datos el evento",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);


	}

}