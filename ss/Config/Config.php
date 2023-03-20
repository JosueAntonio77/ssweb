<?php 
	
	const BASE_URL = "http://localhost/ssweb/ss";
	//const BASE_URL = "http://scpi.progreso.tecnm.mx/scpi";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_ss";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "H. AYUNTAMIENTO DE PROGRESO";
	const EMAIL_REMITENTE = "no-reply@abelosh.com";
	const NOMBRE_EMPRESA = "H. AYUNTAMIENTO DE PROGRESO";
	const WEB_EMPRESA = "http://www.ayuntamientodeprogreso.gob.mx";
	const DESCRIPCION = "Un socio de confianza en temas de gestión de la energía, mantenimiento y automatización.";
	const SHAREDHASH = "H. AYUNTAMIENTO DE PROGRESO";
	const CALLE = "CALLE 25 POR 80 CENTRO CP 97320, PROGRESO, YUCATÁN.";
	const TEL_EMPRESA = "969 103 6000";
	
	//Constantes de las Categorías para el Slider
	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";

	//Datos para Encriptar / Desencriptar
	const KEY = 'hayuntamiento';
	const METHODENCRIPT = "AES-128-ECB";

	//Módulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MSOLICITANTES = 3;
	const MRECEPCIONES = 4;
	const MENTREGAS = 5;
	const MCATEGORIAS = 6;
	const MCONTACTOS = 7;
	

	//Roles
	const RADMINISTRADOR = 1;
	const RTECNICO = 2;
	const RSOLICITANTE = 3;
 ?>