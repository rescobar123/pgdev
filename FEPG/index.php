<?php
	require_once "./core/configGeneral.php";
	require_once "./controladores/vistasControlador.php";
//Creamos la instancia
	$plantilla = new VistasControlador();
	$plantilla->obtenerPlantillaControlador();
