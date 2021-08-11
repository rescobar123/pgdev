<?php 
if ($peticionAjax) {
	require_once "../modelos/AdministradorModelo.php";
}else{
	require_once "./modelos/AdministradorModelo.php";
}

class AdministradorControlador extends AdministradorModelo{

	//Controlador para agregar administrador

	public function agregarAdministradorControlador(){
		$dni=MainModel::limpiarCadena($_POST['dni-reg']);
		$nombre=MainModel::limpiarCadena($_POST['nombre-reg']);
		$apellido=MainModel::limpiarCadena($_POST['apellido-reg']);
		$telefono=MainModel::limpiarCadena($_POST['telefono-reg']);
		$direccion=MainModel::limpiarCadena($_POST['direccion-reg']);
		$usuario=MainModel::limpiarCadena($_POST['usuario-reg']);
		$password1=MainModel::limpiarCadena($_POST['password1-reg']);
		$password2=MainModel::limpiarCadena($_POST['password2-reg']);
		$email=MainModel::limpiarCadena($_POST['email-reg']);
		$genero=MainModel::limpiarCadena($_POST['optionsGenero']);
		$privilegio=MainModel::desencriptar($_POST['optionsPrivilegio']);
		$privilegio=MainModel::limpiarCadena($privilegio);


		if ($genero=="Masculino") {
			$foto="Male1Avatar.png";	
		}else{
			$foto="Female1Avatar.png";
		}

		if($privilegio < 1 || $privilegio > 3) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error inesperado",
				"Texto"=>"El nivel de privilegio que intenta asignar es incorrecto",
				"Tipo"=>"error"
			];
		}else{
			if ($password1 != $password2) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error inesperado",
				"Texto"=>"Las contraseñas que acabas de ingresar no coinciden, Por favor intente nuevamente",
				"Tipo"=>"error"
			];
		}else{
			$consulta1=MainModel::ejecutarConsultaSimple("SELECT AdminDNI FROM admin WHERE AdminDNI='$dni'");
			if ($consulta1->rowCount()>=1) {
				$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error inesperado",
				"Texto"=>"El DNI que acaba de ingresar ya se encuentra registrado en el sistema",
				"Tipo"=>"error"
			];
			}else{
				if ($email!="") {
					$consulta2=MainModel::ejecutarConsultaSimple("SELECT CuentaEmail FROM cuenta WHERE CuentaEmail='$email'");
					$ec=$consulta2->rowCount();
				}else{
					$ec=0;
				}
				if ($ec>=1) {
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"El Email que acabas de ingresar ya se encuentra registrado en el sistema",
					"Tipo"=>"error"
				];
				}else{
					$consulta3=MainModel::ejecutarConsultaSimple("SELECT CuentaUsuario FROM cuenta WHERE CuentaUsuario='$usuario'");
					if ($consulta3->rowCount()>=1) {
						$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error inesperado",
						"Texto"=>"El Usuario que acabas de ingresar ya se encuentra registrado en el sistema",
						"Tipo"=>"error"
					];
					}else{
						$consulta4=MainModel::ejecutarConsultaSimple("SELECT id FROM cuenta ");
						$numero=($consulta4->rowCount())+1;

						$codigo=mainModel::generarCodigoAleatorio("AC", 7,$numero);
						$clave=mainModel::encriptar($password1);
						//Array para insertar la cuenta
						$dataAccount=[
							"Codigo"=>$codigo,
							"Privilegio"=>$privilegio,
							"Usuario"=>$usuario,
							"Clave"=>$clave,
							"Email"=>$email,
							"Estado"=>"Activo",
							"Tipo"=>"Administrador",
							"Genero"=>$genero,
							"Foto"=>$foto
						];
						$guardarCuenta=mainModel::agregarCuenta($dataAccount);

						if ($guardarCuenta->rowCount()>=1) {
							$dataAD=[
								"DNI"=>$dni,
								"Nombre"=>$nombre,
								"Apellido"=>$apellido,
								"Telefono"=>$telefono,
								"Direccion"=>$direccion,
								"Codigo"=>$codigo
							];
							$guardarAdmin=AdministradorModelo::agregarAdministradorModelo($dataAD);
							if ($guardarAdmin->rowCount()>=1) {
								$alerta=[
								"Alerta"=>"limpiar",
								"Titulo"=>"Administrador Registrado",
								"Texto"=>"El Administrador se registro con exito en el sistema",
								"Tipo"=>"success"
							];
								
							}else{
								$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Ocurrio un error inesperado",
								"Texto"=>"No hemos podido registrar el administrador",
								"Tipo"=>"error"
							];
							}
						}else{
							MainModel::eliminarCuenta($codigo);
							$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrio un error inesperado",
							"Texto"=>"No hemos podido registrar el administrador",
							"Tipo"=>"error"
						];
						}
					}
				}
			}
		}
		}

		return MainModel::sweetAlert($alerta);
	}

	//Controador para paginar administrador
	public function paginadorAdministradorControlador($pagina, $registros, $privilegio, $codigo, $busqueda){
		$pagina=MainModel::limpiarCadena($pagina);
		$registros=MainModel::limpiarCadena($registros);
		$privilegio=MainModel::limpiarCadena($privilegio);
		$codigo=MainModel::limpiarCadena($codigo);
		$busqueda=MainModel::limpiarCadena($busqueda);
		$tabla="";

		$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina:1;//si la variables $pagina viene definida y si es mayor a cero, lo pasamos a entero, sino se cumple la condicion que muestre 1
		$inicio=($pagina>0)? (($pagina*$registros-$registros)) : 0;//calcular desde que registro de la base de datos vamos a comenzar a mostrar

		if (isset($busqueda) && $busqueda != "") {
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE ((CuentaCodigo != '$codigo' AND id != '1')AND (AdminNombre LIKE '%$busqueda%' OR AdminApellido LIKE '%$busqueda%' OR AdminDNI LIKE '%$busqueda%'OR AdminTelefono LIKE '%$busqueda%')) ORDER BY AdminNombre ASC LIMIT $inicio,$registros";
			$paginaUrl="adminsearch";
		}else{
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE CuentaCodigo != '$codigo' AND id != '1' ORDER BY AdminNombre ASC LIMIT $inicio,$registros";
			$paginaUrl="adminlist";
		}
		$conexion = MainModel::conectar();

		$datos = $conexion->query($consulta);
		$datos=$datos->fetchAll();//todo el array de datos
		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total=(int) $total->fetchColumn();

		//calcular total de paginas
		$Npaginas=ceil($total/$registros);//toma el entero de la siguiente operacion 100/15=6.666666 la funcion ceil toma el entero 7 lo redondea

		//que sea diferente a uno para que nadie pueda editar la informacion del super administrador.
		$tabla.='<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">DNI</th>
							<th class="text-center">NOMBRES</th>
							<th class="text-center">APELLIDOS</th>
							<th class="text-center">TELÉFONO</th>';
							if ($privilegio<=2) {
								$tabla.=
							'<th class="text-center">Act. CUENTA</th>
							<th class="text-center">Act. DATOS</th>';
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
					<td>'.$rows['AdminDNI'].'</td>
					<td>'.$rows['AdminNombre'].'</td>
					<td>'.$rows['AdminApellido'].'</td>
					<td>'.$rows['AdminTelefono'].'</td>';
					if ($privilegio<=2) {
						$tabla.='
						<td>
							<a href="'.SERVERURL.'myaccount/admin/'.MainModel::encriptar($rows['CuentaCodigo']).'/" class="btn btn-success btn-raised btn-xs">
								<i class="zmdi zmdi-refresh"></i>
							</a>
						</td>
						<td>
							<a href="'.SERVERURL.'mydata/admin/'.MainModel::encriptar($rows['CuentaCodigo']).'/" class="btn btn-success btn-raised btn-xs">
								<i class="zmdi zmdi-refresh"></i>
							</a>
						</td>';
					}
					if ($privilegio ==1) {
						$tabla.='
						<td>
							<form action="'.SERVERURL.'ajax/AdministradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
								<input type="hidden" name="codigo-del" value="'.MainModel::encriptar($rows['CuentaCodigo']).'"/>
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
	//controlador para eliminar Administrador
	public function eliminarAdministradorControlador(){
		$codigo=MainModel::desencriptar($_POST['codigo-del']);
		$adminPrivilegio=MainModel::desencriptar($_POST['privilegio-admin']);
		$codigo=MainModel::limpiarCadena($codigo);
		$adminPrivilegio=MainModel::limpiarCadena($adminPrivilegio);
		if ($adminPrivilegio == 1) {
			$query1=MainModel::ejecutarConsultaSimple("SELECT id FROM admin WHERE CuentaCodigo = '$codigo'");
			$datosAdmin=$query1->fetch();
			if ($datosAdmin['id'] !=1 ){//Para que no eliminemos el adminsitrador principal
				$delAdmin=AdministradorModelo::eliminarAdministradorModelo($codigo);
				MainModel::eliminarBitacora($codigo);
				if ($delAdmin->rowCount() == 1) {
					$delCuenta=MainModel::eliminarCuenta($codigo);
					if ($delCuenta->rowCount()>=1) {
						$alerta=[
							"Alerta"=>"recargar",
							"Titulo"=>"Administrador eliminado",
							"Texto"=>"El administrador fue eliminado con exito del sistema",
							"Tipo"=>"success"
							];
							}else{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrio un error inesperado",
							"Texto"=>"No podemos eliminar esta cuenta en este momento",
							"Tipo"=>"error"
					];
					}
					
				}else{
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"No podemos eliminar este administrador en este momento",
					"Tipo"=>"error"
				];
				}
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"No podemos eliminar el administrador principal del sistema",
					"Tipo"=>"error"
			];
			}

		}else{
			$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"Tu no tienes los permisos necesarios para realizar esta operacion".$codigo,
					"Tipo"=>"error"
			];
		}
		return MainModel::sweetAlert($alerta);
	}

}