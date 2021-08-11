<?php
	session_start(['name' => 'BSS']);
	require_once "./core/configGeneral.php";
	require_once "./controladores/VistasControlador.php";
//Creamos la instancia
	$plantilla = new VistasControlador();
	$plantilla->obtenerPlantillaControlador();
