<?php
	class VistasModelo
	{
		protected function obtenerVistasModelo($vistas ){
		if ($vistas =="index" || $vistas == "login") {
			$contenido = "login";
		}else{
			$listaBlanca=["adminlist","adminsearch", "admin", "home", "agentficha", "event", "catalog", "retinue", "retinuelist","agenttimeline", "eventlist", "eventEdit","asignacionedit", "clientsearch","eventEdit", "bookarma", "book", "asignarequipo", "agent", "agentlist", "agentsearch", "agentedit", "myaccount", "mydata", "confidencetest", "confidencetestlist","confidencetestsearch" ,"search" ];
		if (in_array($vistas, $listaBlanca)) {
			if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
				$contenido = "./vistas/contenidos/".$vistas."-view.php";
				}else{
				$contenido = "login";
			}

			}else{
				$contenido="404";
			}
	}	

		return $contenido;
	}
				
}	

		
