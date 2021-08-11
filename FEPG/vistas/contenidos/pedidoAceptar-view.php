<?php require_once "./controladores/PedidoControlador.php";
  $pedido = new PedidoControlador();
    $url_actual = $_SERVER["REQUEST_URI"];
	$urlArray = explode("/",$url_actual);
	$idPedido = $urlArray[3];
   $datosPedido = $pedido->obtenerPedidoById($idPedido);
  ?>
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-1">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-1">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Iniciar pedido</h1>
                        </div>
                        <form autocomplete="off" id="frm-test" class="FormularioAjax"
                            action="<?php echo URL_WEB_SERVICE."p=pedido&a=iniciarPedido"; ?>"
                            enctype="multipart/form-data" method="POST" data-form="update">
                            <div class="card">
                                <h5 class="card-header">Pedido:</h5>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <b>Codigo del pedido:</b> <?php echo $datosPedido['PedidoCodigo'] ?>
                                        <br>
                                        <b>Fecha y hora del pedido:</b> <?php echo $datosPedido['PedidoFechaHora'] ?><br>
                                        <b>Tipo de pago:</b> <?php echo $datosPedido['PedidoTipoPago'] ?>
                                    </h5>
                                    <hr class="sidebar-divider">
                                    
                                    <p class="card-text">
                                    <h5>Datos del Cliente</h5>

                                    <b>Nombre del Cliente:</b>
                                    <?php echo $datosPedido['ClienteNombres'].' '.$datosPedido['ClienteApellidos'] ?></b><br>
                                    <b>Direccion:</b> <?php echo $datosPedido['PedidoDireccionCliente'] ?></b><br>
                                    <b>Telefono del Cliente:</b> <?php echo $datosPedido['ClienteTelefono'] ?></b><br>

                                    <br>
                                    <h5>Datos de la Sucursal</h5>
                                    <b>Nombre de la Sucursal:</b> <?php echo $datosPedido['SucursalNombre'] ?></b><br>
                                    <br><br>
                                    <label for="">Asignar Responsable</label>
                                    <input required type="text" class="form-control form-control-user" required
                                        name="repartidor" placeholder="Asignar responsable">
                                    <input required type="hidden" value="<?php echo $idPedido ?>" class="form-control form-control-user" required
                                        name="idPedido">

                                </div>
                                <br>
                            </div>
                    <button id="btn-enviar" type="submit" class="btn btn-primary btn-user btn-block">Iniciar
                        Pedido</button>
                    <div class="RespuestaAjax"></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Begin Page Content -->