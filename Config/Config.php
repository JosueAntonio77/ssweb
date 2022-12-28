<?php 
	
	const BASE_URL = "http://localhost/ssweb";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_mgdakava";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "AYUNTAMIENTO PROGRESO";
	const EMAIL_REMITENTE = "no-reply@abelosh.com";
	const NOMBRE_EMPRESA = "MANTENIMIENTO - AYUNTAMIENTO PROGRESO";
	const WEB_EMPRESA = "https://www.progreso.tecnm.mx/";
	const DESCRIPCION = "Mantenimiento a equipos. ";
	const SHAREDHASH = "AyuntamientoProgreso";
	
	//Constantes de las Categorías para el Slider
	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";


	//Datos para Encriptar / Desencriptar
	const KEY = 'ssweb';
	const METHODENCRIPT = "AES-128-ECB";

	//Envio
	const COSTOENVIO = 100;

	//Módulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MCLIENTES = 3;
	const MPRODUCTOS = 4;
	const MPEDIDOS = 5;
	const MCATEGORIAS = 6;
	const MREUNIONES = 7;
	const MCOTIZACIONES = 8;
	const MPROVEEDORES = 9;

	//Roles
	const RADMINISTRADOR = 1;
	const RCLIENTES = 7;
	
 ?>