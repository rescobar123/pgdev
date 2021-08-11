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
                <h1 class="h4 text-gray-900 mb-4">Editar <b><?php echo $datosProducto['ProductoNombre']." - ".$datosProducto['ProductoCodigo'] ?></b></h1>
              </div>
              <form autocomplete="off" id="frm-test" class="FormularioAjax" action="<?php echo URL_WEB_SERVICE."p=producto&a=actualizar"; ?>" enctype="multipart/form-data" method="POST" data-form="update"> 
              <div class="form-group row">
              <input type="hidden" value="<?php echo $idProducto ?>" id="id"  name="id">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="">Nombre del producto</label>
                    <input type="text" value="<?php echo $datosProducto['ProductoNombre'] ?>" class="form-control form-control-user" name="nombre" id="exampleFirstName" placeholder="Nombre del producto">
                  </div>
                  <div class="col-sm-6">
                  <label for="">Precio unitario del producto</label>
                    <input type="number" readonly class="form-control form-control-user" value="<?php echo $datosProducto['ProductoPrecioUni'] ?>" name="precioUnitario" id="exampleLastName" placeholder="Precio por unidad">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="">Existencia del producto</label>
                    <input type="text" readonly  class="form-control form-control-user" value="<?php echo $datosProducto['ProductoExistencia'] ?>" name="existencia" placeholder="Existencia">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="">Descuento</label>
                    <input type="number" class="form-control form-control-user" value="<?php echo $datosProducto['ProductoDescuento'] ?>" name="porcentajeDescuento" id="exampleLastName" placeholder="Porcentaje de Descuento">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="custom-file">
                      
                      <input required name="imagen" value="<?php echo $datosProducto['ProductoImagen'] ?>" type="file" class="custom-file-input form-control" id="file">
                      <label class="custom-file-label" for="imagen">Imagen del producto</label>
                    </div>
                    <br>
                    <br>
                    <div class="center" id="preview">
                      <img width="300px" height="300px" src="<?php echo $datosProducto['ProductoImagen'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="">Ubiacion fisica del producto</label>
                    <input value="<?php echo $datosProducto['ProductoUbicaFisica'] ?>" type="text" class="form-control form-control-user" name="ubicacionFisica" id="exampleFirstName" placeholder="Ubiacion fisica">
                  </div>
                </div>
                <h5 class="">Categoria</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="categoria" id="1" value="Cables">
                  <label class="form-check-label" for="1">Cables</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Descktop" name="categoria" id="2" >
                  <label class="form-check-label" for="2">Descktop</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Laptops" name="categoria" id="3" >
                  <label class="form-check-label" for="3">Laptops</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Disco duro" name="categoria" id="4" >
                  <label class="form-check-label" for="4">Disco duro</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="USB" name="categoria" id="5" >
                  <label class="form-check-label" for="5">USB</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Mouse" name="categoria" id="6" >
                  <label class="form-check-label" for="6">Mouse</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Teclados" name="categoria" id="7" >
                  <label class="form-check-label" for="7">Teclados</label>
                </div>
                <br>
                <h5 class="">Marca</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="marca" id="51" value="Lenovo">
                  <label class="form-check-label" for="51">Lenovo</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="HP" name="marca" id="52" >
                  <label class="form-check-label" for="52">HP</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Xerox" name="marca" id="53" >
                  <label class="form-check-label" for="53">Xerox</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  value="Huawei" name="marca" id="54" >
                  <label class="form-check-label" for="54">Huawei</label>
                </div>

                <br>
                <div class="form-group row">
                  <div class="col-sm-12 mb-6 mb-sm-0">
                    <br>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Descripcion</span>
                      </div>
                      <textarea name="descripcion"  class="form-control" aria-label="With textarea">
                      <?php echo $datosProducto['ProductoDescripcion'] ?>
                      </textarea>
                    </div>
                  </div>
                </div>
                <div id="contenedor" ></div>
                <button id="btn-enviar" type="submit" class="btn btn-primary btn-user btn-block">Actualizar Producto</button>
                <div class="RespuestaAjax"></div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  <script type="text/javascript">
    document.getElementById("file").onchange = function(e) {
      // Creamos el objeto de la clase FileReader
      let reader = new FileReader();
      // Leemos el archivo subido y se lo pasamos a nuestro fileReader
      reader.readAsDataURL(e.target.files[0]);
      // Le decimos que cuando este listo ejecute el código interno
      reader.onload = function() {
        var preview = document.getElementById('preview'),
          image = document.createElement('img');
          image.style.width = '300px';
          image.src = reader.result;
          console.log(image.src);
          var contenedor = document.getElementById('contenedor');
          contenedor.innerHTML = '<input type="text" value="'+image.src+'" name="imagen64" />';
        preview.innerHTML = '';
        preview.append(image);
      };
    }
</script>
  <!-- Begin Page Content -->