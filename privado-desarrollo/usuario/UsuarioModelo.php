<?php
    require_once "core/MainModel.php";

    class Usuario extends MainModel{
        private $cuentaCodigo;
        private $cuentaNombreCompleto;
        private $cuentaPrivilegio;
        private $cuentaUsuario;
        private $cuentaClave;
        private $cuentaEmail;
        private $cuentaEstado;
        private $cuentaGenero;
        private $cuentaFoto;
        
       /* public function __construct($codigo, $nombreCompleto, $privilegio, $usuario, $clave, $email, $estado, $genero, $foto){
            $this->cuentaCodigo=$codigo;
            $this->cuentaNombreCompleto=$nombreCompleto;
            $this->cuentaPrivilegio=$privilegio;
            $this->cuentaUsuario=$usuario;
            $this->cuentaClave=$clave;
            $this->cuentaEmail=$email;
            $this->cuentaEstado=$estado;
            $this->cuentaGenero=$genero;
            $this->cuentaFoto=$foto;
        }*/

        ///GET
        public static function  listarUsuarios(){
            $pdo = new MainModel();
            $consulta = 'SELECT * FROM cuenta';
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }

        public static function  buscarUsuarioPorId($id){
            $pdo = new MainModel();
            $consulta = 'SELECT * FROM cuenta WHERE id ='.$id;
            return $pdo::ejecutarConsultaSimpleGet($consulta);
        }

        //DELETE
        public static function  eliminarUsuarioPorId($id){
            $pdo = new MainModel();
            $consulta = 'DELETE  FROM cuenta WHERE id ='.$id;
            return $pdo::ejecutarConsultaSimpleDelete($consulta);
        }

        //PUT
        public static function  actualizarUsuarioPorId($codigo, $nombreCompleto, $privilegio, $usuario, $clave, $email, $estado, $genero, $foto, $id){
            $pdo = new MainModel();
            $consulta = 'UPDATE cuenta SET CuentaCodigo = "'.$codigo.'", CuentaNombreCompleto = "'.$nombreCompleto.'", CuentaPrivilegio =  "'.$privilegio.'", CuentaUsuario =  "'.$usuario.'", CuentaClave= "'.$clave.'", CuentaEmail =  "'.$email.'", CuentaEstado= "'.$estado.'", CuentaGenero =  "'.$genero.'", CuentaFoto = "'.$foto.'" WHERE id =  "'.$id.'" ';
            //return  $consulta;
             return $pdo::ejecutarConsultaSimplePut($consulta);
        }

        //POST
        public static function insertarUsuario($nombreCompleto, $privilegio, $usuario, $clave, $email, $genero, $foto){
            $pdo = new MainModel();
            $consulta=$pdo->ejecutarConsultaSimple("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_service_privados' AND TABLE_NAME = 'cuenta'");
            $idSiguiente=$consulta['AUTO_INCREMENT'];
            $codigo = $pdo->generarCodigoAleatorio("USR",2, $idSiguiente);
            $consulta = 'INSERT INTO cuenta 
                            VALUES(
                                NULL,
                                "'.$codigo.'",
                                "'.$nombreCompleto.'",
                                "'.$privilegio.'",
                                "'.$usuario.'",
                                "'.$clave.'",
                                "'.$email.'",
                                "1",
                                "'.$genero.'",
                                "'.$foto.'"
                                )';
            return $pdo::ejecutarConsultaSimplePost($consulta);
        }

        public static function hacerLogin($usuario, $password){
            $pdo = new MainModel();
            $password = $pdo::encriptar($password);
            $consulta = 'SELECT id FROM cuenta WHERE CuentaUsuario ="'.$usuario.'" AND CuentaClave = "'.$password.'"';
            if ($id = $pdo::ejecutarConsultaSimple($consulta)){
                return self::buscarUsuarioPorId($id['id']);
            }else{
                return 'No login';
            }
        }
    }