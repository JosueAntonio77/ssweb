<?php 
	
	const BASE_URL = "http://localhost/ssweb/ss";
	//const BASE_URL = "https://mantenimientoap.000webhostapp.com/ss";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_ss";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	/*
	const DB_HOST = "localhost";
	const DB_NAME = "id20491174_ssweb";
	const DB_USER = "id20491174_admin";
	const DB_PASSWORD = "w/*P\V)#U}o25c/P";
	const DB_CHARSET = "utf8";
	*/

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "H. AYUNTAMIENTO DE PROGRESO";
	const EMAIL_REMITENTE = "ayuntamientoprogreso@gmail.com";
	const NOMBRE_EMPRESA = "H. AYUNTAMIENTO DE PROGRESO";
	const WEB_EMPRESA = "http://www.ayuntamientodeprogreso.gob.mx";
	const DESCRIPCION = "Un socio de confianza en temas de gestión de la energía, mantenimiento y automatización.";
	const SHAREDHASH = "H. AYUNTAMIENTO DE PROGRESO";
	const CALLE = "CALLE 25 POR 80 CENTRO CP 97320, PROGRESO, YUCATÁN.";
	const TEL_EMPRESA = "  +52 969 103 6000";
	const TEL_OFICINA_EMPRESA = "  +52 9995 098 813";
	
	//Constantes de las Categorías para el Slider
	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";

	//Datos para Encriptar / Desencriptar
	const KEY = 'hayuntamiento';
	const METHODENCRIPT = "AES-128-ECB";

	//Módulos
	const MDASHBOARD 	= 1;
	const MUSUARIOS 	= 2;
	const MSOLICITANTES = 3;
	const MSOLICITUDES 	= 4;
	const MRECEPCIONES 	= 5;
	const MENTREGAS 	= 6;
	const MCONTACTOS 	= 7;
	

	//Roles
	const RADMINISTRADOR = 1;
	const RTECNICO = 2;
	const RSOLICITANTE = 3;
 ?>