<?php
    require_once "core/MainModel.php";

    class Producto extends MainModel{
        ///GET
        public static function  listarProductos(){
            $pdo = new MainModel();
            $consulta = 'SELECT * FROM producto';
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }

        public static function  buscarProductoPorId($id){
            $pdo = new MainModel();
            $consulta = 'SELECT * FROM producto WHERE id ='.$id;
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }
        public static function  buscarProductoPorCodigo($codigo){
            $pdo = new MainModel();
            $consulta = 'SELECT * FROM producto WHERE ProductoCodigo ='.$codigo;
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }
        
        //DELETE
        public static function  eliminarProdPorId($id){
            $pdo = new MainModel();
            $consulta = 'DELETE  FROM producto WHERE id ='.$id;
            return $pdo::ejecutarConsultaSimpleDelete($consulta);
        }
        public static function  eliminarProdPorCodigo($codigo){
            $pdo = new MainModel();
            $consulta = 'DELETE  FROM producto WHERE ProductoCodigo ='.$codigo;
            return $pdo::ejecutarConsultaSimpleDelete($consulta);
        }
        //PUT
        public static function  actualizarProdPorId($nombre, $precioUni, $existencia, $categoria, $ubicaFisica, $descuento, $imagen, $id){
            $pdo = new MainModel();
            $consulta = 'UPDATE producto SET 
                                ProductoNombre = "'.$nombre.'", 
                                ProductoPrecioUni = "'.$precioUni.'", 
                                ProductoExistencia =  "'.$existencia.'", 
                                ProductoCategoria =  "'.$categoria.'", 
                                ProductoUbicaFisica =  "'.$ubicaFisica.'", 
                                ProductoDescuento= "'.$descuento.'", 
                                ProductoImagen =  "'.$imagen.'"
                                WHERE id =  "'.$id.'" ';
            //return  $consulta;
             return $pdo::ejecutarConsultaSimplePost($consulta);
        }
        public static function  actualizarExistenciaPrecioPorId($precioUni, $existencia, $id){
            $pdo = new MainModel();
            $consulta = 'UPDATE producto SET 
                                ProductoPrecioUni = "'.$precioUni.'", 
                                ProductoExistencia =  "'.$existencia.'"
                              
                                WHERE id =  "'.$id.'" ';
            //return  $consulta;
             return $pdo::ejecutarConsultaSimplePost($consulta);
        }
        //POST
        public static function agregarProductoSucursal($idProducto, $idSucursal, $cantidadProducto){
            $pdo = new MainModel();
            $consulta = 'INSERT INTO productosucursal 
            VALUES(
                NULL,
                    "'.$idProducto.'",
                    "'.$idSucursal.'",
                    "'.$cantidadProducto.'",
                    CURDATE())'; 
            return $pdo::ejecutarConsultaSimplePost($consulta);
        }
        public static function insertarProducto($nombre, $precioUni, $existencia, $categoria, $ubicaFisica, $descuento, $imagen, $descripcion, $marca){
            $pdo = new MainModel();
            $consulta=$pdo->ejecutarConsultaSimple("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_service_privados' AND TABLE_NAME = 'producto'");
            $idSiguiente=$consulta['AUTO_INCREMENT'];
            $codigo = $pdo->generarCodigoAleatorio("PROD",3, $idSiguiente);
            $consulta = 'INSERT INTO producto 
                            VALUES(
                                NULL,
                                "'.$nombre.'",
                                "'.$descripcion.'",
                                "'.$codigo.'",
                                "'.$precioUni.'",
                                "'.$existencia.'",
                                "'.$categoria.'",
                                "0",
                                "'.$ubicaFisica.'",
                                "'.$descuento.'",
                                "'.$imagen.'",
                                "'.$marca.'",
                                "'.$existencia.'",
                                CURDATE(),
                                1
                                )';
            return $pdo::ejecutarConsultaSimplePost($consulta);
        }

        public static function descontarProducto($id, $cantidadDescontada){
            $pdo = new MainModel();
            $consulta = 'UPDATE producto SET 
                                ProductoExistencia =  ProductoExistencia - "'.$cantidadDescontada.'"
                                WHERE id =  "'.$id.'" ';
            //return  $consulta;
             return $pdo::ejecutarConsultaSimplePut($consulta);
        
        }


    }