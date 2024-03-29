<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intDireccionId; 
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strCargo;
		private $strArea;
		private $strToken;
		private $intTipoId;
		private $intStatus;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $direccionid, int $telefono, string $email, string $password, int $tipoid, int $status){

			$this->strIdentificacion 	= $identificacion;
			$this->strNombre 			= $nombre;
			$this->strApellido 			= $apellido;
			$this->intDireccionId 		= $direccionid;  
			$this->intTelefono 			= $telefono;
			$this->strEmail 			= $email;
			$this->strPassword 			= $password;
			$this->intTipoId 			= $tipoid;
			$this->intStatus 			= $status;
			$return = 0;

			$sql = "SELECT * FROM persona WHERE 
					email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO persona (identificacion,
														nombres,
														apellidos,
														direccionid,
														telefono,
														email_user,
														password,
														rolid,
														status) 
								  VALUES (?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
								$this->intDireccionId, 
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->intTipoId,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectUsuarios(){
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " AND p.idpersona != 1 ";
			}
			$sql = "SELECT p.idpersona,
							p.identificacion,
							p.nombres,
							p.apellidos,
							d.iddireccion, 
							d.direccion, 
							p.telefono,
							p.email_user,
							p.status,
							r.idrol,
							r.nombrerol 
					FROM persona p 
					INNER JOIN rol r ON p.rolid = r.idrol
					INNER JOIN direcciones d ON p.direccionid = d.iddireccion
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectUsuario(int $idpersona){
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
							r.idrol,
							r.nombrerol,
							p.status, 
							DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM persona p
					INNER JOIN rol r ON p.rolid = r.idrol
					INNER JOIN direcciones d ON p.direccionid = d.iddireccion
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}
		
		public function selectDirecciones()
		{
			$sql = "SELECT * FROM direcciones";
			$request = $this->select_all($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $direccionid, int $telefono, string $email, string $password, int $tipoid, int $status){

			$this->intIdUsuario 		= $idUsuario;
			$this->strIdentificacion 	= $identificacion;
			$this->strNombre 			= $nombre;
			$this->strApellido 			= $apellido;
			$this->intDireccionId 		= $direccionid; 
			$this->intTelefono 			= $telefono;
			$this->strEmail 			= $email;
			$this->strPassword 			= $password;
			$this->intTipoId 			= $tipoid;
			$this->intStatus 			= $status;

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
								rolid=?, 
								status=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
									$this->intDireccionId, 
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
	        						$this->intTipoId,
	        						$this->intStatus);
				}else{
					$sql = "UPDATE persona 
							SET identificacion=?, 
								nombres=?, 
								apellidos=?, 
								direccionid=?, 
								telefono=?, 
								email_user=?, 
								rolid=?, 
								status=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
									$this->intDireccionId, 
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intTipoId,
	        						$this->intStatus);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}

		public function deleteUsuario(int $intIdpersona){
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;

			if($this->strPassword != "")
			{
				$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, password=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono,
								$this->strPassword);
			}else{
				$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono);
			}
			$request = $this->update($sql,$arrData);
		    return $request;
		}

		public function updateDataEmpresa(int $idUsuario, int $direccionid, string $strCargo, string $strArea){
			$this->intIdUsuario = $idUsuario;
			$this->intDireccionId = $direccionid;
			$this->strCargo = $strCargo;
			$this->strArea = $strArea;
			$sql = "UPDATE persona SET direccionid=?, cargo=?, area=? 
						WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->intDireccionId,
							$this->strCargo,
							$this->strArea);
			$request = $this->update($sql,$arrData);
		    return $request;
		}

	}
 ?>