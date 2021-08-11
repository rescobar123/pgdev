<?php 
class ProductoControlador {
	//Para agregar al administrador
	public function agregarProductoControlador(){
		$nombre=MainModel::limpiarCadena($_POST['nombre']);
		$precioUnitario=MainModel::limpiarCadena($_POST['precioUnitario']);
		$existencia=MainModel::limpiarCadena($_POST['existencia']);
		$categoria=MainModel::limpiarCadena($_POST['categoria']);
		$ubicacionFisica=MainModel::limpiarCadena($_POST['ubicacionFisica']);
		$porcentajeDescuento=MainModel::limpiarCadena($_POST['porcentajeDescuento']);
		$imagen=MainModel::limpiarCadena($_POST['imagen']);
		$descripcion=MainModel::limpiarCadena($_POST['descripcion']);

		$url = URL_WEB_SERVICE."p=producto&a=insertar&nombre=".$nombre."&precioUni=".$precioUnitario."&existencia=".$existencia."&categoria=".$categoria."&ubicaFisica=".$ubicacionFisica."&descuento=".$porcentajeDescuento."&imagen=".$imagen."&descripcion=".$descripcion;
		$res = file_get_contents($url);
		//$res = file_get_contents(URL_WEB_SERVICE."p=usuario&a=login&usuario=".$usuario."&password=".$clave);
		//$data = $res;

		if($res){
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>$url,
				"Texto"=>"Se agrego el registro",
				"Tipo"=>"success"
			];
		}else{
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Error",
				"Texto"=>"No se guardoron los datos",
				"Tipo"=>"success"
			];
		}
		
		return MainModel::alert($alerta);
	}
	public function obtenerProductoById($idProducto){
		$url = URL_WEB_SERVICE."p=producto&a=buscarPrdById&idProd=".$idProducto;
		$res = file_get_contents($url);
		$res = json_decode($res, true);
		$res = $res[0];
		return $res;
	}
	public function seleccionarSucursalControlador($idProducto){
		$url = URL_WEB_SERVICE."p=sucursal&a=listar";
		$res = file_get_contents($url);
		$data = json_decode($res, true);
		$contenido = '';
		foreach($data as $rows){
			$contenido.='
			<tr>
				<td>
			<form action="'.URL_WEB_SERVICE.'p=producto&a=agregarProdSucursal" method="POST" class="FormularioAjax" data-form="save" entype="multipart/form-data" autocomplete="off">
			<input name="idProducto" type="hidden" value='.$idProducto.'>
			<input name="idSucursal" type="hidden" value='.$rows['id'].'>
			<div class="card">
				<h5 class="card-header">Sucursal:</h5>
				<div class="card-body">
					<h5 class="card-title">'.$rows['SucursalNombre'].'</h5>
					<p class="card-text">Direccion: <b>'.$rows['SucursalDireccion'].'</b>
					Gerente: <b>'.$rows['SucursalGerente'].'</b></p>
			</td>
			<td
				<div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="">Cantidad a agregar</label>
                    <input type="number" class="form-control form-control-user" required name="cantidadProducto"  placeholder="Porcentaje de Descuento">
                  </div>
				  <br>
				  <button id="btn-enviar" type="submit" class="btn btn-primary btn-user btn-block">Agregar Producto</button>
				  <div class="RespuestaAjax"></div>
				  </div>
	    	</div>
			</form>
			</td>
			
			</tr>
			';		}
		return $contenido;
	}
	public function seleccionarProductosControlador(){
		$url = URL_WEB_SERVICE."p=producto&a=listar";
		$res = file_get_contents($url);
		$data = json_decode($res, true);
		$tabla = '';
		$clase = '';
		foreach ($data as $rows) {

			if($rows['ProductoExistencia'] ==0){
				$boton = '<b class="text-danger">No hay Existencia</b>';
			}else{
				$boton = '<a  href="'.SERVERURL."productAddSucursal/".MainModel::encriptar($rows['id']).'" class="btn btn-primary btn-circle">
				<i class="fas fa-shipping-fast"></i></a>';
			}
			$tabla .='
				<tr>
                    <td>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#product'.$rows['id'].'">
						<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
						'.$rows['ProductoCodigo'].'
					</a>
					
					</td>
                    <td>'.$rows['ProductoNombre'].'</td>
                    <td>'.$rows['ProductoExistencia'].'</td>
                    <td>Q.'.$rows['ProductoPrecioUni'].'</td>
					<td>
						'.$boton.'
                    </td>
                    ';
                    if($rows['ProductoEstado'] == 1){
                    	$tabla.='<td><b class="text-success">Publicado</b></td>
                    
                    ';
                     }else{
                     	$tabla.= '<td style="color: green">No hay en Existencia</td>';
                     }
                    $tabla .='
					<td><a href="'.SERVERURL."productEdit/".MainModel::encriptar($rows['id']).'" class="btn btn-info btn-circle">
                    <i class="fas fa-edit"></i>
                    </td>
					<td><a href="'.SERVERURL."productActExi/".MainModel::encriptar($rows['id']).'" class="btn btn-warning btn-circle">
                    <i class="fas fa-redo"></i>
                    </td>
					<td><form action="'.URL_WEB_SERVICE."p=producto&a=eliminar&idProd=".MainModel::encriptar($rows['id']).'" method="DELETE" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
                    		<input type="hidden" name="tipoFormulario" value="publicBlog">
							<input type="hidden" name="idBlog-act" value="'.MainModel::encriptar($rows['id']).'"/>
							<button type="submit" class="btn btn-danger btn-circle btn-xs">
							<i class="fas fa-trash"></i></a>
								</button>
							<div class="RespuestaAjax"></div>
						</form>
                    </td>';
                    $tabla .=' 
                    
                </tr>
				<div class="modal fade" id="product'.$rows['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel"> Ficha del Producto</h3>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						</div>
						<div class="modal-body">
						<div class="card" style="width: 100%;">
							<img class="img-responsive"  src="'.$rows['ProductoImagen'].'">
							<div class="card-body">
							<h5 class="card-title">'.$rows['ProductoNombre'].'</h5>
							<p class="card-text">'.$rows['ProductoDescripcion'].'</p>
							</div>
							
							<ul class="list-group list-group-flush">
							<li class="list-group-item">Código: <b>'.$rows['ProductoCodigo'].'</b></li>
							<li class="list-group-item">Precio Unitario: <b> Q. '.$rows['ProductoPrecioUni'].'</b></li>
							<li class="list-group-item">Existencia: <b>'.$rows['ProductoExistencia'].'</b></li>
							<li class="list-group-item">Vendido: a la fecha: <b>'.$rows['ProductoCantVenta'].'</b></li>
							<li class="list-group-item">Descuento: <b>'.$rows['ProductoDescuento'].'</b></li>
							<li class="list-group-item">Categoria: <b>'.$rows['ProductoCategoria'].'</b></li>
							<li class="list-group-item">Ubicacion fisica: <b>'.$rows['ProductoUbicaFisica'].'</b></li>
							<li class="list-group-item">Estado: <b>'.$rows['ProductoEstado'].'</b></li>
							</ul>
							<div class="card-body">
							<a href="#" class="card-link">Creado el <b>'.$rows['ProductoFechaCreado'].'</b></a>
							</div>
						</div>
						</div>
						<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
						</div>
					</div>
					</div>
				</div>
				';
		}
		
		return $tabla;
	}
}