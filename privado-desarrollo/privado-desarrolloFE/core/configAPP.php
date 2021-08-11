<?php
	const SERVER ="localhost";
	const DB="store";
	const USER="root";
	const PASS="admin";

	const SGBD="mysql:host=".SERVER.";dbname=".DB;

	const METHOD="AES-256-CBC";
	const SECRET_IV='4232020';//Contiene un numero unico cualquiera
	const SECRET_KEY='YYYEEESSS@2020';//esto se puede cambiar antes de que allan registro en la DB
	const URL_WEB_SERVICE = 'http://localhost:8044/privado-desarrollo/web-service-privado.php?';