<?php require_once "./controladores/ProductoControlador.php";
  $producto = new ProductoControlador();
    $url_actual = $_SERVER["REQUEST_URI"];
	$urlArray = explode("/",$url_actual);
	$idProducto = $urlArray[3];
   $datosProducto = $producto->obtenerProductoById($idProducto);
  ?>
  <div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-1">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-1">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Actualizar Existencia de:  <b><?php echo $datosProducto['ProductoNombre']." - ".$datosProducto['ProductoCodigo'] ?></b></h1>
              </div>
              <form autocomplete="off" id="frm-test" class="FormularioAjax" action="<?php echo URL_WEB_SERVICE."p=producto&a=actualizarExis"; ?>" enctype="multipart/form-data" method="POST" data-form="update"> 
              <div class="form-group row">
              <input type="hidden" value="<?php echo $idProducto ?>" id="id"  name="id">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" readonly value="<?php echo $datosProducto['ProductoNombre'] ?>" class="form-control form-control-user" name="nombre" id="nombre" placeholder="Nombre del producto">
                  </div>
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="nombre">Codigo del producto</label>
                    <input type="text" readonly class="form-control form-control-user" value="<?php echo $datosProducto['ProductoCodigo'] ?>" name="porcentajeDescuento" id="porcentajeDescuento" placeholder="Porcentaje de Descuento">
                  </div>
                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="nombre">Existencia del producto</label>
                    <input type="text"   class="form-control form-control-user" value="<?php echo $datosProducto['ProductoExistencia'] ?>" name="existencia" placeholder="Existencia">
                  </div>
                  <div class="col-sm-6">
                  <label for="nombre">Precio unitario del producto</label>
                    <input type="text"  class="form-control form-control-user" value="<?php echo $datosProducto['ProductoPrecioUni'] ?>" name="precioUnitario" id="precioUnitario" placeholder="Precio por unidad">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 mb-6 mb-sm-0">
                    <br>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Porque se actualizo?</span>
                      </div>
                      <textarea name="motivaActualiza" required  class="form-control" aria-label="With textarea">
                      <?php echo $datosProducto['ProductoDescripcion'] ?>
                      </textarea>
                    </div>
                  </div>
                </div>
                <button id="btn-enviar" type="submit" class="btn btn-primary btn-user btn-block">Actualizar Existencia</button>
                <div class="RespuestaAjax"></div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>