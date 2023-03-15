<?php 
class SolicitantesModel extends Mysql
{
	private $intIdUsuario;
	private $strIdentificacion;
	private $strNombre;
	private $strApellido;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strToken;
	private $intTipoId;
	private $intStatus;
	private $strNit;
	private $strCargo;
	private $strArea;



	public function __construct()
	{
		parent::__construct();
	}	

	public function insertSolicitante(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, string $nit, string $cargo, string $area){

		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->intTipoId = $tipoid;
		$this->strNit = $nit;
		$this->strCargo = $cargo;
		$this->strArea = $area;

		$return = 0;
		$sql = "SELECT * FROM persona WHERE 
				email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO persona(identificacion,nombres,apellidos,telefono,email_user,password,rolid,nit,cargo,area) 
							  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        	$arrData = array($this->strIdentificacion,
    						$this->strNombre,
    						$this->strApellido,
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
    						$this->intTipoId,
    						$this->strNit,
    						$this->strCargo,
    						$this->strArea);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		}else{
			$return = "exist";
		}
        return $return;
	}

	public function selectSolicitantes()
	{
		$sql = "SELECT idpersona,identificacion,nombres,apellidos,telefono,email_user,status 
				FROM persona 
				WHERE rolid = 3; and status != 0 ";
		$request = $this->select_all($sql);
		return $request;
	}
//Visualizar datos del cliente.
	public function selectSolicitante(int $idpersona){
		$this->intIdUsuario = $idpersona;
		$sql = "SELECT idpersona,identificacion,nombres,apellidos,telefono,email_user,nit,cargo,area,status, DATE_FORMAT(datecreated, '%d-%m-%Y') as fechaRegistro 
				FROM persona
				WHERE idpersona = $this->intIdUsuario and rolid = 3";
		$request = $this->select($sql);
		return $request;
	}

	public function updateSolicitante(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, string $nit, string $cargo, string $area){

		$this->intIdUsuario = $idUsuario;
		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->strNit = $nit;
		$this->strCargo = $cargo;
		$this->strArea = $area;


		$sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
									  OR (identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			if($this->strPassword  != "")
			{
				$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?, nit=?, cargo=?, area=?
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->strNit,
        						$this->strCargo,
        						$this->strArea);
			}else{
				$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, nit=?, cargo=?, area=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strNit,
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