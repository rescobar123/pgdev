<?php
    require_once "core/MainModel.php";

    class Pedido extends MainModel{
        ///GET
        public static function  listarPedido($estado){
            $pdo = new MainModel();
            if($estado == ''){
                $filtro = '';
            }else{  
                $filtro = ' WHERE A.PedidoTracking = "'.$estado.'"';
            }
            $consulta = 'SELECT A.id, A.PedidoCodigo, A.PedidoTracking, A.PedidoFechaHora, A.PedidoTipoPago, A.PedidoDireccionCliente, B.ClienteNombres, B.ClienteApellidos, B.ClienteTelefono, C.SucursalNombre, D.ProductoNombre, D.ProductoCodigo   FROM pedido A JOIN cliente B ON A.PedidoClienteId = B.id JOIN sucursal C ON A.PedidoSucursalId = C.id JOIN producto D ON A.PedidoProductoId = D.id'.$filtro;
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }

        public static function inciarPedido($idPedido, $repartidor){
            $pdo = new MainModel();
            $consulta = 'UPDATE pedido SET 
                                PedidoRepartidor =  "'.$repartidor.'",
                                PedidoTracking =  "Iniciado"
                                WHERE id =  "'.$idPedido.'" ';
            //return  $consulta;
             return $pdo::ejecutarConsultaSimplePost($consulta);
        }
        public static function actualizarEstadoPed($idPedido, $estado){
            $pdo = new MainModel();
            $consulta = 'UPDATE pedido SET 
                                PedidoTracking =  "'.$estado.'"
                                WHERE id =  "'.$idPedido.'" ';
            //return  $consulta;
             return $pdo::ejecutarConsultaSimplePost($consulta);
        }
        public static function actualizarTrackingAnterior($idPedido, $estadoAnterior){
            $pdo = new MainModel();
            $consulta = 'UPDATE trakingpedido SET
                                TrackingFechaHoraFin = NOW()
                                WHERE TrackingPedidoId =  "'.$idPedido.'" AND
                                      TrackingEstado = "'.$estadoAnterior.'" ';
                                
            return $pdo::ejecutarConsultaSimple2($consulta);
        }
        public static function insertarTracking($idPedido, $estado){
            $pdo = new MainModel();
            $consulta = 'INSERT INTO trakingpedido 
                            VALUES(
                                NULL,
                                "'.$idPedido.'",
                                "'.$estado.'",
                                NOW(),
                                NULL
                                )';
            return $pdo::ejecutarConsultaSimple2($consulta);
        }

        public static function mostrarTrakingPedido(){
            $pdo = new MainModel();
            $consulta = 'SELECT B.PedidoCodigo, B.id,A.TrackingEstado, A.TrackingFechaHoraInicio, A.TrackingFechaHoraFin, B.PedidoCodigo, B.PedidoTipoMensajeria, B.PedidoTipoPago FROM trakingpedido A JOIN pedido B ON A.TrackingPedidoId = B.id ORDER BY B.id, A.TrackingFechaHoraInicio ASC';
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }

        public static function insertarPedido($sucursalId, $productoId, $idCliente, $tipoPago, $tipoMensaje, $direccionCliente){
            $pdo = new MainModel();
            $consulta=$pdo->ejecutarConsultaSimple("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_service_privados' AND TABLE_NAME = 'pedido'");
            $idSiguiente=$consulta['AUTO_INCREMENT'];
            $codigo = $pdo->generarCodigoAleatorio("PEDI",4, $idSiguiente);
            $consulta = 'INSERT INTO pedido 
                            VALUES(
                                NULL,
                                "'.$codigo.'",
                                "'.$sucursalId.'",
                                "'.$productoId.'",
                                "'.$idCliente.'",
                                NOW(),
                                "'.$tipoPago.'",
                                "Solicitado",
                                "'.$tipoMensaje.'",
                                "'.$direccionCliente.'",
                                "Creado",
                                "Aun no se ha iniciado"
                                )';
            return $pdo::ejecutarConsultaSimplePost($consulta);
        }

        public static function buscarPedidoPorId($id){
            $pdo = new MainModel();
            $consulta = 'SELECT A.id, A.PedidoCodigo, A.PedidoTracking, A.PedidoFechaHora, A.PedidoTipoPago, A.PedidoDireccionCliente, B.ClienteNombres, B.ClienteApellidos, B.ClienteTelefono, C.SucursalNombre, D.ProductoNombre, D.ProductoCodigo   FROM pedido A JOIN cliente B ON A.PedidoClienteId = B.id JOIN sucursal C ON A.PedidoSucursalId = C.id JOIN producto D ON A.PedidoProductoId = D.id WHERE A.id ='.$id;
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }


    }