<?php
include 'core/MainModel.php';
$pagina = $_GET['p'];
$accion = $_GET['a'];
$mainModel = new MainModel();
switch($pagina){
    case 'pedido':
        include 'pedido/PedidoModelo.php';
        $pedido = new Pedido();
        switch($accion){
            case 'buscarPedidoPorId':
                $idPedido=$mainModel->limpiarCadena($_GET['idPed']);
                $idPedido=MainModel::desencriptar($idPedido);
                $idPedido=MainModel::limpiarCadena($idPedido);
                $pedido::buscarPedidoPorId($idPedido);
                break;
            case 'listar':
                if(!isset($_GET['estado'])){
                    $estado='';
                }else{
                    $estado=$mainModel->limpiarCadena($_GET['estado']);
                }
                $pedido::listarPedido($estado);
                break;
            case 'insertar':
                $sucursalId = $mainModel->limpiarCadena($_POST['sucursalId']);
                $productoId = $mainModel->limpiarCadena($_POST['productoId']);
                $idCliente = $mainModel->limpiarCadena($_POST['idCliente']);
                $tipoPago = $mainModel->limpiarCadena($_POST['tipoPago']);
                $tipoMensaje = $mainModel->limpiarCadena($_POST['tipoMensaje']);
                $direccionCliente = $mainModel->limpiarCadena($_POST['direccionCliente']);
                $consulta=$mainModel->ejecutarConsultaSimple("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_service_privados' AND TABLE_NAME = 'pedido'");
                $idSiguiente=$consulta['AUTO_INCREMENT'];
                $pedido::insertarTracking($idSiguiente, 'Solicitado');
                $pedido::insertarPedido($sucursalId, $productoId, $idCliente, $tipoPago, $tipoMensaje, $direccionCliente);
            break;
            case 'iniciarPedido':
                $idPedido = $mainModel->limpiarCadena($_POST['idPedido']);
                $idPedido=MainModel::desencriptar($idPedido);
                $idPedido=MainModel::limpiarCadena($idPedido);
                $repartidor = $mainModel->limpiarCadena($_POST['repartidor']);
                $pedido::insertarTracking($idPedido, 'Iniciado');
                $pedido::inciarPedido($idPedido, $repartidor);

            break;
            case 'mostrarTraking':
                $pedido::mostrarTrakingPedido();
            break;
            case 'actualizarEstado':
                $idPedido = $mainModel->limpiarCadena($_POST['idPedido']);
                $estado = $mainModel->limpiarCadena($_POST['estado']);
                $estadoAnterior = $mainModel->limpiarCadena($_POST['estadoAnterior']);
                $idPedido=MainModel::desencriptar($idPedido);
                $idPedido=MainModel::limpiarCadena($idPedido);
                $pedido::insertarTracking($idPedido, $estado);
                $pedido::actualizarTrackingAnterior($idPedido, $estadoAnterior);
                $pedido::actualizarEstadoPed($idPedido,$estado);
                break;
        }
        break;
    case 'sucursal':
        include 'sucursal/SucursalModelo.php';
        $sucursal = new Sucursal();
        switch($accion){
            case 'listar':
                $sucursal::listarSucursal();
                break;
        }
        break;
    case 'usuario':
        include 'usuario/UsuarioModelo.php';
        $objUsuario = new Usuario();
        
        switch ($accion){
            case 'login':
                $usuario = $_GET['usuario'];
                $password = $_GET['password'];
                $usuario = $mainModel->limpiarCadena($usuario);
                $password = $mainModel->limpiarCadena($password);
                $objUsuario::hacerLogin($usuario, $password);
                break;
            case 'listar':
                $objUsuario::listarUsuarios();
                break;
            case 'insertar': 
                $nombreCompleto = $mainModel->limpiarCadena($_POST['nombreCompleto']);
                $privilegio = $mainModel->limpiarCadena($_POST['privilegio']);
                $usuario = $mainModel->limpiarCadena($_POST['usuario']);
                $clave = $mainModel->limpiarCadena($_POST['clave']);
                $clave = $mainModel->encriptar($clave);
                $email = $mainModel->limpiarCadena($_POST['email']);
                $genero = $mainModel->limpiarCadena($_POST['genero']);
                $foto = $mainModel->limpiarCadena($_POST['foto']);
                $objUsuario::insertarUsuario($nombreCompleto, $privilegio, $usuario, $clave, $email, $genero, $foto);
                break;
            case 'eliminar': 
                $idUsuario=$mainModel->limpiarCadena($_GET['idUsuario']);
                $idUsuario=MainModel::desencriptar($idUsuario);
                $idUsuario=MainModel::limpiarCadena($idUsuario);
                $objUsuario::eliminarUsuarioPorId($idUsuario);
                break;
            case 'buscarPorId': 
                    $idUsuario=$mainModel->limpiarCadena($_GET['idUsuario']);
                    $idUsuario=$mainModel->desencriptar($idUsuario);
                    $objUsuario::buscarUsuarioPorId($idUsuario);
                    break;
            case 'actualizar':
                $nombreCompleto = $mainModel->limpiarCadena($_POST['nombreCompleto']);
                $privilegio = $mainModel->limpiarCadena($_POST['privilegio']);
                $usuario = $mainModel->limpiarCadena($_POST['usuario']);
                $clave = $mainModel->limpiarCadena($_POST['clave']);
                $clave = $mainModel->encriptar($clave);
                $email = $mainModel->limpiarCadena($_POST['email']);
                $genero = $mainModel->limpiarCadena($_POST['genero']);
                $foto = $mainModel->limpiarCadena($_POST['foto']);
                $objUsuario::actualizarUsuarioPorId($codigo, $nombreCompleto, $privilegio, $usuario, $clave, $email, $estado, $genero, $foto, $id);
                break;
        }
        break;
    case 'producto':
        include 'producto/ProductoModelo.php';
        $prod = new Producto();
        switch($accion){
            case 'descontarInventario':
                $cantDescontar=$mainModel->limpiarCadena($_GET['cantDescontar']);
                $idProd=$mainModel->limpiarCadena($_GET['idProd']);
                $prod::descontarProducto($idProd, $cantDescontar);
                break;
            case 'agregarProdSucursal':
                $idProducto=MainModel::limpiarCadena($_POST['idProducto']);
                $idProducto=MainModel::desencriptar($idProducto);
                $idProducto=MainModel::limpiarCadena($idProducto);
                $idSucursal=MainModel::limpiarCadena($_POST['idSucursal']);
                $cantidadProducto=MainModel::limpiarCadena($_POST['cantidadProducto']);
                $prod::descontarProducto($idProducto, $cantidadProducto);
                $resultado = $prod::agregarProductoSucursal($idProducto, $idSucursal, $cantidadProducto);
                
                break;
            case 'actualizar':
                $nombre=MainModel::limpiarCadena($_POST['nombre']);
                $precioUni=MainModel::limpiarCadena($_POST['precioUnitario']);
                $existencia=MainModel::limpiarCadena($_POST['existencia']);
                $categoria=MainModel::limpiarCadena($_POST['categoria']);
                $ubicaFisica=MainModel::limpiarCadena($_POST['ubicacionFisica']);
                $descuento=MainModel::limpiarCadena($_POST['porcentajeDescuento']);
                if(isset($_POST['imagen64'])){
                    $imagen=MainModel::limpiarCadena($_POST['imagen64']);
                }else{
                    $imagen = "vacia";
                }
                $descripcion=MainModel::limpiarCadena($_POST['descripcion']);
                $idProd=MainModel::limpiarCadena($_POST['id']);
                $idProd=MainModel::desencriptar($idProd);
                $idProd=MainModel::limpiarCadena($idProd);
                $prod::actualizarProdPorId($nombre,$precioUni, $existencia, $categoria, $descuento, $descuento, $imagen, $idProd);
                break;
            case 'actualizarExis':
                $precio=MainModel::limpiarCadena($_POST['precioUnitario']);
                $existencia=MainModel::limpiarCadena($_POST['existencia']);
                $motivaActualiza=MainModel::limpiarCadena($_POST['motivaActualiza']);
                $idProd=MainModel::limpiarCadena($_POST['id']);
                $idProd=MainModel::desencriptar($idProd);
                $idProd=MainModel::limpiarCadena($idProd);
                $prod::actualizarExistenciaPrecioPorId($precio,$existencia, $idProd);
                break;
            case 'listar':
                $prod::listarProductos();
                break;
            case 'buscarPrdById':
                    $idProd=MainModel::limpiarCadena($_GET['idProd']);
                    $idProd=MainModel::desencriptar($idProd);
                    $idProd=MainModel::limpiarCadena($idProd);
                    $prod::buscarProductoPorId($idProd);
                break;
            case 'insertar':
                $nombre=MainModel::limpiarCadena($_POST['nombre']);
                $marca=MainModel::limpiarCadena($_POST['marca']);
                $precioUni=MainModel::limpiarCadena($_POST['precioUnitario']);
                $existencia=MainModel::limpiarCadena($_POST['existencia']);
                $categoria=MainModel::limpiarCadena($_POST['categoria']);
                $ubicaFisica=MainModel::limpiarCadena($_POST['ubicacionFisica']);
                $descuento=MainModel::limpiarCadena($_POST['porcentajeDescuento']);
                if(isset($_POST['imagen64'])){
                    $imagen=MainModel::limpiarCadena($_POST['imagen64']);
                }else{
                    $imagen = "vacia";
                }
                
                $descripcion=MainModel::limpiarCadena($_POST['descripcion']);
                $prod::insertarProducto($nombre, $precioUni, $existencia, $categoria, $ubicaFisica, $descuento, $imagen, $descripcion, $marca);
                break;
            case 'eliminar':
                    $idProd=MainModel::limpiarCadena($_GET['idProd']);
                    $idProd=MainModel::desencriptar($idProd);
                    $idProd=MainModel::limpiarCadena($idProd);
                    $prod::eliminarProdPorId($idProd);
                    break;
        }
        break;
    default: 
        echo "Error 404";
        break;
}