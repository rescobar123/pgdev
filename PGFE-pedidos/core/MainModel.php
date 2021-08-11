<?php 
	if ($peticionAjax) {
		require_once "../core/configAPP.php";
	}else{
		require_once "./core/configAPP.php";
	}
	class MainModel{

		protected static function conectar(){
			$enlace = new PDO(SGBD, USER, PASS);//estas constantes vienen de configAPP
			return $enlace;
		}

		protected function seleccionarProductos(){
			$sql=self::conectar()->query("SELECT * FROM producto");
			$sql=$sql->fetchAll();
			return $sql;
		}
		protected function luhn($number){
			$odd = true;
			$sum = 0;
			foreach ( array_reverse(str_split($number)) as $num){
				$sum += array_sum( str_split(($odd = !$odd) ? $num*2 : $num) );
			}
			return (($sum % 10 == 0) and  ($sum != 0));
		}

		protected function ejecutarConsultaSimple($consulta){
			$respuesta=self::conectar()->prepare($consulta);
			$respuesta->execute();
			return $respuesta;
		} 

		public function encriptar($string){
			$output = FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key,0,$iv);
			$output=base64_encode($output);
			return $output;
		}

		protected function desencriptar($string){
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

		public static function titulo($titulo){
        $titulo  = urlencode(strtolower($titulo));
        $newtitulo = str_replace('+', '-', $titulo);
        return $newtitulo;
    	}

    	/*public function titulo($string){
		    $slug = preg_replace('/[^A-Za-z0-9-]+/','-',$string);
		    $slug = strtolower($slug);
		    return $slug;
		}*/

		//limpiar cadena y evitar ijection sql
		protected function limpiarCadena($cadena){
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
			<div class="alert alert-dismissible alert-'.$datos['Tipo'].'">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <h4>'.$datos['Titulo'].'</h4>

                          <p><b>'.$datos['Texto'].'</b></p>
                        </div>
             ';				
			}elseif ($datos['Alerta'] == "recargar") {
				$alerta = '
				<div class="alert alert-dismissible alert-'.$datos['Tipo'].'">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <h4>'.$datos['Titulo'].'</h4>

                          <p><b>'.$datos['Texto'].'</b></p>
                        </div>
				</div></div><script>location.reload();</script>';	
			}elseif ($datos['Alerta'] == "limpiar") {
				$alerta = '
				<div class="alert alert-dismissible alert-'.$datos['Tipo'].'">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <h4>'.$datos['Titulo'].'</h4>

                          <p><b>'.$datos['Texto'].'</b></p>
                        </div>
				</div><script>$(".FormularioAjax")[0].reset();</script>';	
			}
			elseif ($datos['Alerta'] == "recargarComentario") {
				$alerta = '
				<div class="alert alert-dismissible alert-'.$datos['Tipo'].'">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <h4>'.$datos['Titulo'].'</h4>
                          <p><b>'.$datos['Texto'].'</b></p>IdDiv
                        </div>
				</div
				><script>$("#'.$datos['IdDiv'].'").load(" #'.$datos['IdDiv'].'");
				$(".'.$datos['Formulario'].'")[0].reset();
				$(".FormularioAjax")[0].reset();</script>';	
			}
			return $alerta;
		}
	}
