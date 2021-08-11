<?php 
class PedidoControlador {

	public function obtenerPedidoById($idPedido){
		$url = URL_WEB_SERVICE."p=pedido&a=buscarPedidoPorId&idPed=".$idPedido;
		$res = file_get_contents($url);
		$res = json_decode($res, true);
		$res = $res[0];
		return $res;
	}

	public function obtenerTrackingPedidos(){
		$url = URL_WEB_SERVICE."p=pedido&a=mostrarTraking";
		$res = file_get_contents($url);
		$data = json_decode($res, true);
		$tabla = '';
		$estado ='';
		for($i =0; $i < count($data);$i++){
			$rows = $data[$i];
			if($i > 0){
				$rows2 = $data[$i-1];
				if($rows['id'] != $rows2['id'] ){
					$estado ='';
				}
			}
			if($rows['TrackingEstado'] == 'Solicitado'){
				$estado ='';
				$estado .= '
				<div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
				Solicitado
				</div>';
			}elseif($rows['TrackingEstado'] == 'Iniciado'){
				$estado .= '
				<div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
					Iniciado
				</div>';
			}
			elseif($rows['TrackingEstado'] == 'Empacado'){
				$estado .= '
				<div class="progress-bar bg-info" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
				Empacado
				</div>';
			}elseif($rows['TrackingEstado'] == 'Calidad'){
				$estado .= '
				<div class="progress-bar bg-secondary" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
				Calidad
				</div>';
			}elseif($rows['TrackingEstado'] == 'Enviado'){
				$estado .= '
				<div class="progress-bar bg-primary" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
				Enviado
				</div>';
			}elseif($rows['TrackingEstado'] == 'Entregado'){
				$estado .= '
				<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
				Entregado
				</div>';
			}

			
			$tabla .='
			<tr>
				<td>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#product'.$rows['id'].'">
						<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
					'.$rows['PedidoCodigo'].'
					</a>
				</td>
				<td>
				<label>
				<b>Iniciado:</b> '.$rows['TrackingFechaHoraInicio'].' <br>
				<b>Finalizado:</b> '.$rows['TrackingFechaHoraFin'].'
				</label>
				<div class="progress">
					'.$estado.'
				</div>
				</td>
			
			  
            </tr>
				';
				
		}
		
		return $tabla;
	}

	public function seleccionarPedidosControlador($estado){
		if($_SESSION['s_privilegio'] == 'Administrador'){
		}elseif($_SESSION['s_privilegio'] == 'Sucursal'){
		}elseif($_SESSION['s_privilegio'] == 'Vendedor'){
			//$estado = 'Iniciado';
		}elseif($_SESSION['s_privilegio'] == 'Repartidor'){
			$estado = 'Enviado';
		}
		$url = URL_WEB_SERVICE."p=pedido&a=listar&estado=".$estado;
		$res = file_get_contents($url);
		$data = json_decode($res, true);
		$tabla = '';
	if($data){

		$botones = '';
		foreach ($data as $rows) {
            $cliente ="Nombre: " .$rows['ClienteNombres']." ".$rows['ClienteApellidos']."<br> Telefono: ".$rows['ClienteTelefono'];
            $sucursal ="Sucursal: " .$rows['SucursalNombre'];
            $producto ="Producto: " .$rows['ProductoNombre']." <br> Codigo: ".$rows['ProductoCodigo'];
			$tabla .='
				<tr>
                    <td>
						'.$rows['PedidoCodigo'].'
					</td>
                    <td>'.$cliente.'</td>
                    <td>'.$sucursal.'</td>
                    <td>'.$producto.'</td>
                    <td>'.$rows['PedidoFechaHora'].'</td>
                    <td>'.$rows['PedidoTracking'].'</td>
                    <td>'.$rows['PedidoDireccionCliente'].'</td>
                    ';
                   if($rows['PedidoTracking'] == 'Iniciado'){
					$botones ='
					<form action="'.URL_WEB_SERVICE.'p=pedido&a=actualizarEstado" method="POST" class="FormularioAjax" data-form="update" entype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="idPedido" value="'.MainModel::encriptar($rows['id']).'"/>
						<input type="hidden" name="estado" value="Empacado"/>
						<input type="hidden" name="estadoAnterior" value="'.$rows['PedidoTracking'].'"/>
						<button type="submit" class="btn btn-info btn-circle btn-xs">
						<i title="Iniciar Empacado" class="fas fa-archive"></i></a>
							</button>
						<div class="RespuestaAjax"></div>
					</form>
					';
				   }elseif($rows['PedidoTracking'] == 'Solicitado'){
					$botones ='
					
                        <a href="'.SERVERURL."pedidoAceptar/".MainModel::encriptar($rows['id']).'" class="btn btn-primary btn-circle">
                            <i class="fas fa-check-double" title="Inicar Pedido"></i>
                        </a>
                        <a href="'.SERVERURL."pedidoDenegar/".MainModel::encriptar($rows['id']).'"  class="btn btn-danger btn-circle">
                            <i class="fas fa-ban" title="Denegar Pedido"></i>
                        </a>
                   
					';
				   }elseif($rows['PedidoTracking'] == 'Empacado'){
					$botones ='
					<form action="'.URL_WEB_SERVICE.'p=pedido&a=actualizarEstado" method="POST" class="FormularioAjax" data-form="update" entype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="idPedido" value="'.MainModel::encriptar($rows['id']).'"/>
						<input type="hidden" name="estado" value="Calidad"/>
						<input type="hidden" name="estadoAnterior" value="'.$rows['PedidoTracking'].'"/>
						<button type="submit" class="btn btn-secondary btn-circle btn-xs">
						<i title="Iniciar Revision de calidad" class="fas fa-clipboard"></i></a>
							</button>
						<div class="RespuestaAjax"></div>
					</form>
					';
				   }elseif($rows['PedidoTracking'] == 'Calidad'){
					$botones ='
					<form action="'.URL_WEB_SERVICE.'p=pedido&a=actualizarEstado" method="POST" class="FormularioAjax" data-form="update" entype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="idPedido" value="'.MainModel::encriptar($rows['id']).'"/>
						<input type="hidden" name="estado" value="Enviado"/>
						<input type="hidden" name="estadoAnterior" value="'.$rows['PedidoTracking'].'"/>
						<button type="submit" class="btn btn-primary btn-circle btn-xs">
						<i title="Iniciar Entrega" class="fas fa-truck-loading"></i></a>
							</button>
						<div class="RespuestaAjax"></div>
					</form>
					';
				   }elseif($rows['PedidoTracking'] == 'Enviado'){
					$botones ='
					<form action="'.URL_WEB_SERVICE.'p=pedido&a=actualizarEstado" method="POST" class="FormularioAjax" data-form="update" entype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="idPedido" value="'.MainModel::encriptar($rows['id']).'"/>
						<input type="hidden" name="estado" value="Entregado"/>
						<input type="hidden" name="estadoAnterior" value="'.$rows['PedidoTracking'].'"/>
						<button type="submit" class="btn btn-success btn-circle btn-xs">
						<i title="Marcar como Entregado" class="fas fa-thumbs-up"></i></a>
							</button>
						<div class="RespuestaAjax"></div>
					</form>';
				   }                   
                    $tabla .=' <td>'.$botones.'
					</td>
                </tr>
				';
				$botones ='';
		}
	}
		
		return $tabla;
	}
}