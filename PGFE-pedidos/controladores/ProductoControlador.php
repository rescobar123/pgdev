<?php 
if ($peticionAjax) {
	require_once "../modelos/ContenidoModelo.php";
}else{
	require_once "./modelos/ContenidoModelo.php";
}
class ProductoControlador extends ContenidoModelo{
	public function cargarProductosControlador(){
		$url = URL_WEB_SERVICE."p=producto&a=listar";
		$res = file_get_contents($url);
		$data = json_decode($res, true);
		
		$productos = '';
		$datos = MainModel::seleccionarProductos();

		foreach ($datos as $rows) {
			$rebaja = $rows['ProductoPrecioUni'] * $rows['ProductoDescuento'] / 100;
			$rebaja = $rows['ProductoPrecioUni'] - $rebaja;
			$rebaja = round($rebaja,2);

			$productos .= '
				 <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
				        <div class="product_list">
				          <div class="product_img"> <img class="img-responsive" src="'.$rows['ProductoImagen'].'" alt=""> </div>
				          <div class="product_detail_btm">
				            <div class="center">
				              <h4><a href="product/'.$rows['id'].'">'.$rows['ProductoNombre'].'</a></h4>
				            </div>
				            <div class="starratin">
				              <div class="center"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </div>
				            </div>
				            <div class="product_price">
				              <p><span class="old_price">Q.'.$rows['ProductoPrecioUni'].'</span> – <span class="new_price">Q.'.$rebaja.'</span></p>
				            </div>
				          </div>
				        </div>
				      </div>';
		}
		return $productos;
	}

	public function obtenerProductoById($idProducto){
		$idProducto = MainModel::encriptar($idProducto);
		$url = URL_WEB_SERVICE."p=producto&a=buscarPrdById&idProd=".$idProducto;
		$res = file_get_contents($url);
		$res = json_decode($res, true);
		$res = $res[0];
		return $res;
	}

}


	
     
   