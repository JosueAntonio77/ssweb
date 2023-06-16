# SSWEB

Página Web - Control de Mantenimiento. 

# Pequeño Manual Técnico

## Configuración 

- ### **Sitío**

Para la configuración se debe encontrar el siguiente archivo **ss/Config/Config.php**. Una vez encontrado el archivo, debemos abrirlo con un editor de su preferencia. 

El primer código que encontramos es la dirección, este sirve para que encuentré todo lo que tiene el sitio, por ejemplo, el siguiente código es de manera local con el servidor que nos da XAMPP. 

const BASE_URL = "http://localhost/ss";

Si lo colocará en un servidor sería de la siguiente manera: 

const BASE_URL = "servidor/ss";

- ### **Base de Datos** 

Datos de conexión a Base de Datos en un servidor local: 

	const DB_HOST = "localhost";    Nombre del Hots
	const DB_NAME = "db_ss";        Nombre de la BD
	const DB_USER = "root";         Nombre del usuario
	const DB_PASSWORD = "";         Contraseña de la BD
	const DB_CHARSET = "utf8";      Tipo de Caracter de la BD

- ### **Datos que se mostrarán en el sitío** 

En el mismo documento colocara los datos de su empresa: 

    const NOMBRE_REMITENTE = "NOMBRE DEL REMITENTE"; 
    const EMAIL_REMITENTE = "EMAIL DEL REMITENTE"; 
    const NOMBRE_EMPRESA = "NOMBRE DE LA EMPRESA";
    const WEB_EMPRESA = "SITÍO WEB DE LA EMPRESA";
    const DESCRIPCION = "PEQUEñA DESCRIPCIÓN DE LA EMPRESA";
    const SHAREDHASH = "DAS CONPARTIDO";
    const CALLE = "UBICACIÓN DE LA EMPRESA";
    const TEL_EMPRESA = "NÚMERO DE LA EMPRESA";
    const TEL_OFICINA_EMPRESA = "NÚMERO DE OFICINA";
  
 En este caso se trabajo en una empresa y se colocó de la sigueinte manera: 
 
	const NOMBRE_REMITENTE = "H. AYUNTAMIENTO DE PROGRESO";
	const EMAIL_REMITENTE = "ayuntamientoprogreso@gmail.com";
	const NOMBRE_EMPRESA = "H. AYUNTAMIENTO DE PROGRESO";
	const WEB_EMPRESA = "http://www.ayuntamientodeprogreso.gob.mx";
	const DESCRIPCION = "Un socio de confianza en temas de gestión de la energía, mantenimiento y automatización.";
	const SHAREDHASH = "H. AYUNTAMIENTO DE PROGRESO";
	const CALLE = "CALLE 25 POR 80 CENTRO CP 97320, PROGRESO, YUCATÁN.";
	const TEL_EMPRESA = "  +52 969 103 6000";
	const TEL_OFICINA_EMPRESA = "  +52 9995 098 813";
 
# Soporte 

## Contactos 

**Josue Antonio Castro Collí** 

- Email: josueantonio785@gmail.com 
- Teléfono: 9993815121

**Leandro Mijaíl González Gómez**

- Email: 
- Teléfono: 
