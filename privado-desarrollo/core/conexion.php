<?php
 class Conexion extends PDO
{
    private $hostBd = 'localhost';
    private $nombreBd = 'web_service_privados';
    private $usuarioBd = 'rescobar';
    private $passwordBD = 'rescobar';

    public function __construct()
    {
        try{
            parent:: __construct('mysql:host='.$this->hostBd.';dbname='.$this->nombreBd.';charset=utf8',$this->usuarioBd, $this->passwordBD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            
        }catch(PDOException $error){
            echo 'Error: '. $error->getMessage();
            exit;
        }
    }


}