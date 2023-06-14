<?php
require_once("Libraries/Core/Mysql.php");
trait ASolicitante
{
	private $con;
	private $strNombre;
	private $strApellido;
	private $intDireccionId;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $intTipoId;

	public function insertSolicitante( string $nombre, string $apellido, int $direccionid, int $telefono, string $email, string $password, int $tipoid)
	{
		$this->con = new Mysql();
		$this->strNombre 			= $nombre;
		$this->strApellido 			= $apellido;
		$this->intDireccionId 		= $direccionid; 
		$this->intTelefono 			= $telefono;
		$this->strEmail 			= $email;
		$this->strPassword 			= $password;
		$this->intTipoId 			= $tipoid;

		$return = 0;
		$sql = "SELECT * FROM persona WHERE 
				email_user = '{$this->strEmail}' ";
		$request = $this->con->select_all($sql);

		if (empty($request)) {
			$query_insert  = "INSERT INTO persona(
				nombres,
				apellidos,
				direccionid,
				telefono,
				email_user,
				password,
				rolid) 
			VALUES(?,?,?,?,?,?,?)";
			$arrData = array(
				$this->strNombre,
				$this->strApellido,
				$this->intDireccionId, 
				$this->intTelefono,
				$this->strEmail,
				$this->strPassword,
				$this->intTipoId
			);
			$request_insert = $this->con->insert($query_insert, $arrData);
			$return = $request_insert;
		} else {
			$return = "exist";
		}
		return $return;
	}

	public function setSuscripcion(string $nombre, string $email)
	{
		$this->con = new Mysql();
		$sql = 	"SELECT * FROM suscripciones WHERE email = '{$email}'";
		$request = $this->con->select_all($sql);
		if (empty($request)) {
			$query_insert  = "INSERT INTO suscripciones(nombre,email) 
							  VALUES(?,?)";
			$arrData = array($nombre, $email);
			$request_insert = $this->con->insert($query_insert, $arrData);
			$return = $request_insert;
		} else {
			$return = false;
		}
		return $return;
	}

	public function setContacto(string $nombre, string $email, string $mensaje, string $ip, string $dispositivo, string $useragent)
	{
		$this->con = new Mysql();
		$nombre  	 = $nombre != "" ? $nombre : "";
		$email 		 = $email != "" ? $email : "";
		$mensaje	 = $mensaje != "" ? $mensaje : "";
		$ip 		 = $ip != "" ? $ip : "";
		$dispositivo = $dispositivo != "" ? $dispositivo : "";
		$useragent 	 = $useragent != "" ? $useragent : "";
		$query_insert  = "INSERT INTO contacto(nombre,email,mensaje,ip,dispositivo,useragent) 
						  VALUES(?,?,?,?,?,?)";
		$arrData = array($nombre, $email, $mensaje, $ip, $dispositivo, $useragent);
		$request_insert = $this->con->insert($query_insert, $arrData);
		return $request_insert;
	}
}
