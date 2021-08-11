<?php
include 'config.php';
include 'conexion.php';
class MainModel{
    public static function ejecutarConsultaSimpleGet($consulta){
        $pdo = new Conexion();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $sql = $pdo->prepare($consulta);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit;
        }else{
            echo "Utilice el motdo HTTP adecuado";
        }
    }

    public static function ejecutarConsultaSimple2($consulta){
        $pdo = new Conexion();
            $sql = $pdo->prepare($consulta);
            $sql->execute();
           // $sql=$sql->fetch(PDO::FETCH_ASSOC);
        
        return $sql;
    }

    public static function ejecutarConsultaSimple($consulta){
        $pdo = new Conexion();
            $sql = $pdo->prepare($consulta);
            $sql->execute();
            $sql=$sql->fetch(PDO::FETCH_ASSOC);
        
        return $sql;
    }
    public static function ejecutarConsultaSimplePost($consulta){
        $pdo = new Conexion();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $sql = $pdo->prepare($consulta);
            $sql->execute();
            if($sql){
                echo header("HTTP/1.1 200 OK");
                echo 'OK';
                exit;
            }
        }else{
            echo "Utilice el motdo HTTP adecuado";
        }
    }
    public static function ejecutarConsultaSimpleDelete($consulta){
        $pdo = new Conexion();
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $sql = $pdo->prepare($consulta);
            $sql->execute();
            if($sql){
                echo header("HTTP/1.1 200 OK");
                echo 'OK';
                exit;
            }
        }else{
            echo "Utilice el motdo HTTP adecuado";
        }
    }

    public static function ejecutarConsultaSimplePut($consulta){
        $pdo = new Conexion();
        if($_SERVER['REQUEST_METHOD'] == 'PUT' OR $_SERVER['REQUEST_METHOD'] == 'POST'){
            $sql = $pdo->prepare($consulta);
            $sql->execute();
            if($sql){
                echo header("HTTP/1.1 200 OK");
                echo 'OK';
                
                exit;
            }else{
                echo 'Error en sql';
            }
        }else{
            echo "Utilice el motdo HTTP adecuado";
        }
    }

    public static function encriptar($string){
        $output = FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, METHOD, $key,0,$iv);
        $output=base64_encode($output);
        return $output;
    }
    public static function desencriptar($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0,16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key,0, $iv);
        return $output;
    }
    protected function generarCodigoAleatorio($letra, $longitud, $num){
        for ($i=1; $i <= $longitud ; $i++) { 
            $numero=rand(0,9);
            $letra .= $numero;
        }
        return $letra.'-'.$num;
    }
    public  function limpiarCadena($cadena){
        //limpiar la cadena para que no contenga palabras que no queramos la DB
        $cadena=trim($cadena);//trim elimina espacios en blancoal finial o inicia de la cadena
        $cadena=stripcslashes($cadena);//stripcslashes, quita barras invertidas
        $cadena=str_ireplace("<script>", "", $cadena);//que remplace <script> por vacio
        $cadena=str_ireplace("<script src>", "", $cadena);
        $cadena=str_ireplace("<script type>", "", $cadena);
        $cadena=str_ireplace("SELECT * FROM", "", $cadena);
        $cadena=str_ireplace("DELETE FROM", "", $cadena);
        $cadena=str_ireplace("INSERT INTO", "", $cadena);
        $cadena=str_ireplace("--", "", $cadena);
        $cadena=str_ireplace("[", "", $cadena);
        $cadena=str_ireplace("]", "", $cadena);
        $cadena=str_ireplace("==", "", $cadena);
        return $cadena;

    }

    protected function alert($datos){
        if ($datos['Alerta'] == "simple"){
        $alerta = '
        <div class="container-fluid">
        <div id="message">
            <div id="inner-message">
                <div class="alert alert-'.$datos['Tipo'].' alert-dismissible fade show" role="alert">
                    <strong>'.$datos['Titulo'].'</strong> '.$datos['Texto'].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div></div>';				
        }elseif ($datos['Alerta'] == "recargar") {
            $alerta = '
            <div class="container-fluid">
            <div id="message">
            <div id="inner-message">
            <div class="alert alert-'.$datos['Tipo'].' alert-dismissible fade show" role="alert">
                      <strong>'.$datos['Titulo'].'</strong> '.$datos['Texto'].'
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
            </div></div><script>location.reload();</script>';	
            
        }elseif ($datos['Alerta'] == "limpiar") {
            $alerta = '
            <div class="container-fluid">
            <div id="message">
            <div id="inner-message">
            <div class="alert alert-'.$datos['Tipo'].' alert-dismissible fade show" role="alert">
                      <strong>'.$datos['Titulo'].'</strong> '.$datos['Texto'].'
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
            </div>
            </div><script>$(".FormularioAjax")[0].reset();</script>';	
        }
        return $alerta;
    }



    
}