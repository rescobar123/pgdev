<?php 
class UsuarioControlador {

	public function obtenerUsuarioById($idUsuario){
		$url = URL_WEB_SERVICE."p=usuario&a=buscarPorId&idUsuario=".$idUsuario;
		$res = file_get_contents($url);
		$res = json_decode($res, true);
		$res = $res[0];
		return $res;
	}

	public function seleccionarUsuariosControlador(){
		$url = URL_WEB_SERVICE."p=usuario&a=listar";
		$res = file_get_contents($url);
		$data = json_decode($res, true);
		$tabla = '';

		foreach ($data as $rows) {
			$tabla .='
				<tr>
                    <td>
						'.$rows['CuentaUsuario'].'
					</td>
                    <td>'.$rows['CuentaNombreCompleto'].'</td>
                    <td>'.$rows['CuentaPrivilegio'].'</td>
                    <td>'.$rows['CuentaEmail'].'</td>
                    <td><img src="'.$rows['CuentaFoto'].'" width="100"></td>
                    ';
                   
                    $tabla .='
					<td>
                        <a href="'.SERVERURL."pedidoAceptar/".MainModel::encriptar($rows['id']).'" class="btn btn-warning btn-circle">
                            <i class="fas fa-ban" title=""></i>
                        </a>
						<form action="'.URL_WEB_SERVICE."p=usuario&a=eliminar&idUsuario=".MainModel::encriptar($rows['id']).'" method="DELETE" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
                    		<input type="hidden" name="tipoFormulario" value="publicBlog">
							<input type="hidden" name="idBlog-act" value="'.MainModel::encriptar($rows['id']).'"/>
							<button type="submit" class="btn btn-danger btn-circle btn-xs">
							<i class="fas fa-trash"></i></a>
								</button>
							<div class="RespuestaAjax"></div>
						</form>
                    </td>
					';
                    $tabla .=' 
                    
                </tr>
				';
		}
		
		return $tabla;
	}

	public function obtenerMenuUsuario(){
		$menu = '';
		if($_SESSION['s_privilegio'] == 'Administrador'){ 
			$menu = '      
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventario" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-folder"></i>
			  <span>Inventario</span>
			</a>
			<div id="inventario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Mod. Inventario:</h6>
				<a class="collapse-item" href="'.SERVERURL.'product/">Agregar Producto</a>
				<a class="collapse-item" href="'.SERVERURL.'productUp/">Gestionar Inventario</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#segPedido" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-shopping-bag"></i>
			  <span>Pedidos</span>
			</a>
			<div id="segPedido" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Mod. Seguimiento de pedidos:</h6>
				<a class="collapse-item" href="'.SERVERURL.'pedidos/">Solicitudes de pedidos</a>
				<a class="collapse-item" href="'.SERVERURL.'pedidosGes/">Tracking pedidos</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#history" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-history"></i>
			  <span>Historial Compras</span>
			</a>
			<div id="history" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo historial compras:</h6>
				<a class="collapse-item" href="'.SERVERURL.'shopping/">Ver Compras</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shopping" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-shopping-cart"></i>
			  <span> Mis Pedidos</span>
			</a>
			<div id="shopping" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo mis pedidos:</h6>
				<a class="collapse-item" href="'.SERVERURL.'shopping/">Mis pedidos</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sucursal" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-store-alt"></i>
			  <span>Sucursal</span>
			</a>
			<div id="sucursal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo :</h6>
				<a class="collapse-item" href="'.SERVERURL.'sucursal/">Mis productos</a>
				<a class="collapse-item" href="'.SERVERURL.'surcursalVenta/">Mis Ventas</a>
			  </div>
			</div>
			
		  </li>
		  <!-- Divider -->
		  
		  <!-- Divider -->
		  <hr class="sidebar-divider">
	
		  <!-- Heading -->
		  <div class="sidebar-heading">
			Administracion
		  </div>
	
		  <!-- Nav Item - Pages Collapse Menu -->
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#marca" aria-expanded="true" aria-controls="collapsePages">
			  <i class="fas fa-fw fa-wallet"></i>
			  <span>Sucursales</span>
			</a>
			<div id="marca" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo sucursal:</h6>
				<a class="collapse-item" href="'.SERVERURL.'marca/">Agregar sucursal</a>
				<a class="collapse-item" href="'.SERVERURL.'Marcas/">Gestionar sucursal</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#marca" aria-expanded="true" aria-controls="collapsePages">
			  <i class="fas fa-fw fa-wallet"></i>
			  <span>Marcas</span>
			</a>
			<div id="marca" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo marcas:</h6>
				<a class="collapse-item" href="'.SERVERURL.'marca/">Agregar Marca</a>
				<a class="collapse-item" href="'.SERVERURL.'Marcas/">Gestionar Marcas</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="collapsePages">
			  <i class="fas fa-fw fa-users"></i>
			  <span>Usuarios</span>
			</a>
			<div id="users" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo Admin:</h6>
				<a class="collapse-item" href="'.SERVERURL.'user/">Gestionar usuarios</a>
	
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#respaldo" aria-expanded="true" aria-controls="collapsePages">
			  <i class="fas fa-fw fa-database"></i>
			  <span>Respaldo</span>
			</a>
			<div id="respaldo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo Respaldo:</h6>
				<a class="collapse-item" href="'.SERVERURL.'backup/">Realizar Backup</a>
				<a class="collapse-item" href="'.SERVERURL.'Backup Automatico/">Backup Automatico</a>
			  </div>
			</div>
		  </li>';
		}elseif($_SESSION['s_privilegio'] == 'Sucursal'){
			$menu = '
			<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#segPedido" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-shopping-bag"></i>
			  <span>Pedidos</span>
			</a>
			<div id="segPedido" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Mod. Seguimiento de pedidos:</h6>
				<a class="collapse-item" href="'.SERVERURL.'pedidos/">Solicitudes de pedidos</a>
				<a class="collapse-item" href="'.SERVERURL.'pedidosGes/">Tracking pedidos</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#history" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-history"></i>
			  <span>Historial Compras</span>
			</a>
			<div id="history" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo historial compras:</h6>
				<a class="collapse-item" href="'.SERVERURL.'shopping/">Ver Compras</a>
			  </div>
			</div>
		  </li>
			';
		}elseif($_SESSION['s_privilegio'] == 'Vendedor'){
		  $menu = '
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#segPedido" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-shopping-bag"></i>
			  <span>Pedidos</span>
			</a>
			<div id="segPedido" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Mod. Seguimiento de pedidos:</h6>
				<a class="collapse-item" href="'.SERVERURL.'pedidosAsig/">Pedidos Asignados</a>
				<a class="collapse-item" href="'.SERVERURL.'pedidosGes/">Tracking pedidos</a>
			  </div>
			</div>
		  </li>
		  <li class="nav-item">
		  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#history" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-history"></i>
			<span>Historial Compras</span>
		  </a>
		  <div id="history" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
			  <h6 class="collapse-header">Modulo historial compras y ventas:</h6>
			  <a class="collapse-item" href="'.SERVERURL.'shopping/">Ver Compras</a>
			  <a class="collapse-item" href="'.SERVERURL.'sales/">Ver Ventas</a>
			</div>
		  </div>
		</li>
		  ';
		}elseif($_SESSION['s_privilegio'] == 'Cliente'){
		  $menu = '
		  <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shopping" aria-expanded="true" aria-controls="collapseTwo">
			  <i class="fas fa-fw fa-shopping-cart"></i>
			  <span> Mis Pedidos</span>
			</a>
			<div id="shopping" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			  <div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modulo mis pedidos:</h6>
				<a class="collapse-item" href="'.SERVERURL.'shopping/">Mis pedidos</a>
			  </div>
			</div>
		  </li>
		  ';
		}
		elseif($_SESSION['s_privilegio'] == 'Repartidor'){
			$menu = '
			<li class="nav-item">
			  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shopping" aria-expanded="true" aria-controls="collapseTwo">
				<i class="fas fa-fw fa-shopping-cart"></i>
				<span> Pedidos Asignados</span>
			  </a>
			  <div id="shopping" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
				  <h6 class="collapse-header">Modulo mis pedidos:</h6>
				  <a class="collapse-item" href="'.SERVERURL.'pedidosAsig/">Pedidos asignados</a>
				</div>
			  </div>
			</li>
			';
		  }
		return $menu;
	}
}