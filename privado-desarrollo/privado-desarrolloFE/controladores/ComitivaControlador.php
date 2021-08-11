<?php 
if ($peticionAjax) {
	require_once "../modelos/ComitivaModelo.php";
}else{
	require_once "./modelos/ComitivaModelo.php";
}
class ComitivaControlador extends ComitivaModelo{
	public function agregarComitivaControlador(){
		$tipoComitiva=MainModel::limpiarCadena($_POST['comitiva-reg']);
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$descripcion=MainModel::limpiarCadena($_POST['descripcion-reg']);
				$datosComitiva = [
					"TipoComitiva" => $tipoComitiva,
					"Nombre" => $nombre,
					"Descripcion" => $descripcion
				];

			$guardarComitiva = ComitivaModelo::agregarComitivaModelo($datosComitiva);
			if ($guardarComitiva->rowCount()>=1) {
			 		$alerta=[
					"Alerta"=>"limpiar",
					"Titulo"=>"Se agregó la comitiva",
					"Texto"=>"La comitiva fué agregada correctamente",
					"Tipo"=>"success"
				];
			 }else{
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"No se agregó la comitiva",
					"Texto"=>"Error al guardar en base de datos la comitiva",
					"Tipo"=>"error"
				];
			 } 
		return MainModel::sweetAlert($alerta);
	}

	public function seleccionarTipoComitivaControlador(){
		$datos = ComitivaModelo::seleccionarTipoComitivaModelo();
		$tipoComitiva = '';
		foreach ($datos as $rows) {
			$tipoComitiva .= '<option value="'.$rows['IdTipoComitiva'].'">'.$rows['TipoComitivaNombre'].'</option>';
		}
		return $tipoComitiva;
	}

	public function paginadorComitivaControlador($pagina, $registros, $privilegio, $busqueda){
		$pagina=MainModel::limpiarCadena($pagina);
		$registros=MainModel::limpiarCadena($registros);
		$privilegio=MainModel::limpiarCadena($privilegio);
		$busqueda=MainModel::limpiarCadena($busqueda);
		$tabla="";

		$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina:1;//si la variables $pagina viene definida y si es mayor a cero, lo pasamos a entero, sino se cumple la condicion que muestre 1
		$inicio=($pagina>0)? (($pagina*$registros-$registros)) : 0;//calcular desde que registro de la base de datos vamos a comenzar a mostrar

		if (isset($busqueda) && $busqueda != "") {
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM comitiva WHERE (ComitivaNombre LIKE '%$busqueda%' OR ComitivaDescripcion LIKE '%$busqueda%') ORDER BY ComitivaNombre ASC LIMIT $inicio,$registros";
			$paginaUrl="agentsearch";
		}else{
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM comitiva ORDER BY ComitivaNombre ASC LIMIT $inicio,$registros";
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
							<th class="text-center">TIPO COMITIVA</th>
							<th class="text-center">NOMBRE</th>
							<th class="text-center">DESCRIPCION</th>';

							if ($privilegio<=2) {
								$tabla.=
							'<th class="text-center">Act. DATOS</th>
							<th class="text-center">AGREGAR AGENTES</th>';
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
					<td>'.$rows['IdTipoComitiva'].'</td>
					<td>'.$rows['ComitivaNombre'].'</td>
					<td>'.$rows['ComitivaDescripcion'].'</td>'
					;
					if ($privilegio<=2) {
						$tabla.='
						<td>
							<a href="'.SERVERURL.'agentedit/'.MainModel::encriptar($rows['IdComitiva']).'/" class="btn btn-success btn-raised btn-xs">
								<i class="zmdi zmdi-refresh"></i>
							</a>
						</td>
						<td>
							<a href="'.SERVERURL.'agentedit/'.MainModel::encriptar($rows['IdComitiva']).'/" class="btn btn-success btn-raised btn-xs">
								<i class="zmdi zmdi-refresh"></i>
							</a>
						</td>';
					}
					if ($privilegio ==1) {
						$tabla.='
						<td>
							<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
								<input type="hidden" name="tipoFormulario" value="deleteComitiva">
								<input type="hidden" name="codigo-del" value="'.MainModel::encriptar($rows['IdComitiva']).'"/>
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
}
