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
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Agregar Producto a sucural:
                            <?php echo $datosProducto['ProductoNombre'].' - '.$datosProducto['ProductoCodigo']?> </h1>
                    </div>
                    <h3>Existencia: <?php echo $datosProducto['ProductoExistencia'] ?></h3>
                    <div id="table-regis" class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 60%;">Sucursal</th>
                                        <th>Cantidad a agregar</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th style="width: 60%;">Sucursal</th>
                                        <th>Cantidad a agregar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        echo $producto->seleccionarSucursalControlador($idProducto); 
                                        ?>
                                        <div class="RespuestaAjax"></div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>