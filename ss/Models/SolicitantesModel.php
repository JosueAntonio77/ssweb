<?php 
class SolicitantesModel extends Mysql
{
	private $intIdUsuario;
	private $strIdentificacion;
	private $strNombre;
	private $strApellido;
	private $intDireccionId; 
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strNit;
	private $strCargo;
	private $strArea;
	private $strToken;
	private $intTipoId;
	private $intStatus;



	public function __construct()
	{
		parent::__construct();
	}	

	public function insertSolicitante(string $identificacion, string $nombre, string $apellido, int $direccionid, int $telefono, string $email, string $password, string $nit, string $cargo, string $area,  string $token, int $tipoid){

		$this->strIdentificacion 	= $identificacion;
		$this->strNombre 			= $nombre;
		$this->strApellido 			= $apellido;
		$this->intDireccionId 		= $direccionid; 
		$this->intTelefono 			= $telefono;
		$this->strEmail 			= $email;
		$this->strPassword 			= $password;
		$this->strNit				= $nit; 
		$this->strCargo 			= $cargo;
		$this->strArea 				= $area;
		$this->strToken				= $token; 
		$this->intTipoId 			= $tipoid;
		$return = 0;

		$sql = "SELECT * FROM persona WHERE 
				email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO persona(identificacion,
													nombres,
													apellidos,
													direccionid,
													telefono,
													email_user,
													password,
													nit, 
													cargo,
													area,
													token, 
													rolid) 
							VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        	$arrData = array($this->strIdentificacion,
    						$this->strNombre,
    						$this->strApellido,
							$this->intDireccionId, 
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
							$this->strNit,
    						$this->strCargo,
    						$this->strArea,
							$this->strToken, 
							$this->intTipoId);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		}else{
			$return = "exist";
		}
        return $return;
	}

	public function selectSolicitantes()
	{
		$sql = "SELECT p.idpersona,
						p.identificacion,
						p.nombres,
						p.apellidos,
						d.iddireccion, 
						d.direccion,
						p.telefono,
						p.email_user,
						p.cargo, 
						p.area, 
						p.status 
				FROM persona p
				INNER JOIN direcciones d ON p.direccionid = d.iddireccion
				WHERE p.rolid = 3 and p.status != 0 ";
		$request = $this->select_all($sql);
		return $request;
	}

	//Visualizar datos del cliente.
	public function selectSolicitante(int $idpersona){
		$this->intIdUsuario = $idpersona;
		$sql = "SELECT p.idpersona,
						p.identificacion,
						p.nombres,
						p.apellidos,
						d.iddireccion, 
						d.direccion,  
						p.telefono,
						p.email_user,
						p.cargo,
						p.area,
						DATE_FORMAT(p.datecreated, '%d-%m-%Y') AS fechaRegistro,
						p.status
				FROM persona p
				INNER JOIN direcciones d ON p.direccionid = d.iddireccion
				WHERE p.idpersona = $this->intIdUsuario and p.rolid = 3";
		$request = $this->select($sql);
		return $request;
	}

	public function updateSolicitante(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $direccionid, int $telefono, string $email, string $password, string $cargo, string $area){

		$this->intIdUsuario 		= $idUsuario;
		$this->strIdentificacion 	= $identificacion;
		$this->strNombre 			= $nombre;
		$this->strApellido 			= $apellido;
		$this->intDireccionId 		= $direccionid;  
		$this->intTelefono 			= $telefono;
		$this->strEmail 			= $email;
		$this->strPassword 			= $password;
		$this->strCargo 			= $cargo;
		$this->strArea 				= $area;


		$sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
									  OR (identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			if($this->strPassword  != "")
			{
				$sql = "UPDATE persona 
						SET identificacion=?, 
							nombres=?, 
							apellidos=?, 
							direccionid=?, 
							telefono=?, 
							email_user=?, 
							password=?, 
							cargo=?, 
							area=?
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
								$this->intDireccionId, 
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->strCargo,
        						$this->strArea);
			}else{
				$sql = "UPDATE persona 
						SET identificacion=?, 
							nombres=?, 
							apellidos=?, 
							direccionid=?, 
							telefono=?, 
							email_user=?, 
							cargo=?, 
							area=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
								$this->intDireccionId, 
        						$this->strEmail,
        						$this->strCargo,
        						$this->strArea);
			}
			$request = $this->update($sql,$arrData);
		}else{
			$request = "exist";
		}
		return $request;
	}

	public function deleteSolicitante(int $intIdpersona)
	{
		$this->intIdUsuario = $intIdpersona;
		$sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario ";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		return $request;
	}
	
}

 ?>