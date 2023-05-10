<?php 

	class SolicitudesModel extends Mysql
	{
		private $intIdMantenimiento;
		private $strNombre;
		private $strDescripcion;
		private $strDiagnostico;
		private $intCategoriaId;
		private $intPersonaId;
		private $strEquipo;
		private $intStatus;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertMantenimiento(string $nombre, string $descripcion, string $diagnostico, int $categoriaid, int $personaid, string $equipo, int $status){

			$this->strNombre 		= $nombre;
			$this->strDescripcion 	= $descripcion;
			$this->strDiagnostico 	= $diagnostico;
			$this->intCategoriaId 	= $categoriaid;
			$this->intPersonaId 	= $personaid;
			$this->strEquipo 		= $equipo;
			$this->intStatus 		= $status;
			$return = 0;

			$sql = "SELECT * FROM mantenimiento WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO mantenimiento(nombre, 
														descripcion,
														diagnostico, 
														categoriaid,
														personaid, 
														equipo,
														status) 
								  VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array($this->strNombre,
        						$this->strDescripcion,
        						$this->strDiagnostico,
        						$this->intCategoriaId,
        						$this->intPersonaId,
								$this->strEquipo,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateMantenimiento(int $idmantenimiento, string $nombre, string $descripcion, string $diagnostico, int $categoriaid, int $personaid, string $equipo, int $status){
			
			$this->intIdMantenimiento 	= $idmantenimiento;
			$this->strNombre 			= $nombre;
			$this->strDescripcion 		= $descripcion;
			$this->strDiagnostico 		= $diagnostico;
			$this->intCategoriaId 		= $categoriaid;
			$this->intPersonaId 		= $personaid;
			$this->strEquipo 			= $equipo;
			$this->intStatus 			= $status;
			$return = 0;
			
			$sql = "SELECT * FROM mantenimiento WHERE nombre = '{$this->strNombre}' AND idmantenimiento != $this->intIdMantenimiento ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE mantenimiento 
						SET nombre=?,
							descripcion=?,
							diagnostico=?,
							categoriaid=?,
							personaid=?,
							equipo=?,
							status=?
						WHERE idmantenimiento = $this->intIdMantenimiento";
				$arrData = array($this->strNombre,
								$this->strDescripcion,
								$this->strDiagnostico,
								$this->intCategoriaId,
								$this->intPersonaId,
								$this->strEquipo,
								$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateEntregaMantenimiento(int $idmantenimiento, string $diagnostico, int $status){
			
			$this->intIdMantenimiento 	= $idmantenimiento;
			$this->strDiagnostico 		= $diagnostico;
			$this->intStatus 			= $status;
			$return = 0;
			
			$sql = "SELECT * FROM mantenimiento WHERE idmantenimiento != $this->intIdMantenimiento ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE mantenimiento 
						SET diagnostico=?,
							status=?
						WHERE idmantenimiento = $this->intIdMantenimiento";
				$arrData = array($this->strDiagnostico,
								$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}


		public function selectRecepciones()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " AND p.idmantenimiento != 1 ";
			}
			$sql = "SELECT p.idmantenimiento,
							p.nombre,
							p.personaid, 
							CONCAT(pd.nombres,' ',pd.apellidos) AS persona,
							d.iddireccion AS direcionid,   
							d.direccion AS direcciones,
							p.categoriaid, 
							c.nombre AS categoria,
							p.descripcion,
							p.diagnostico,
							p.equipo,
							p.status 
					FROM mantenimiento p
					INNER JOIN persona pd ON p.personaid = pd.idpersona
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					INNER JOIN direcciones d ON pd.direccionid = d.iddireccion
					WHERE p.status != 0".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectMantenimiento(int $idmantenimiento){
			$this->intIdMantenimiento = $idmantenimiento;
			$sql = "SELECT p.idmantenimiento,
							p.nombre,
							p.personaid,
							CONCAT(pd.nombres,' ',pd.apellidos) AS persona,
							d.direccion AS direcciones, 
							p.categoriaid, 
							c.nombre AS categoria, 
							p.descripcion,
							p.diagnostico,  
							p.equipo,  
							p.status 
					FROM mantenimiento p
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					INNER JOIN persona pd ON p.personaid = pd.idpersona
					INNER JOIN direcciones d ON pd.direccionid = d.iddireccion
					WHERE idmantenimiento = $this->intIdMantenimiento";
			$request = $this->select($sql);
			return $request;
		}

		public function selectEntregaMantenimiento(int $idmantenimiento){
			$this->intIdMantenimiento = $idmantenimiento;
			$sql = "SELECT p.idmantenimiento,
							p.diagnostico,
							p.status 
					FROM mantenimiento p
					WHERE idmantenimiento = $this->intIdMantenimiento";
			$request = $this->select($sql);
			return $request;
		}
		
		public function selectPersonas()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.idpersona != 1 ";
			}
			$sql = "SELECT p.idpersona,
						CONCAT(p.nombres,' ',p.apellidos) AS nombre,
						p.email_user,
						p.direccionid, 
						p.telefono,
						p.area, 
						p.status 
					FROM persona p 
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		public function insertImage(int $idmantenimiento, string $imagen){
			$this->intIdMantenimiento = $idmantenimiento;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(mantenimientoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdMantenimiento,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idmantenimiento){
			$this->intIdMantenimiento = $idmantenimiento;
			$sql = "SELECT mantenimientoid,img
					FROM imagen
					WHERE mantenimientoid = $this->intIdMantenimiento";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idmantenimiento, string $imagen){
			$this->intIdMantenimiento = $idmantenimiento;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE mantenimientoid = $this->intIdMantenimiento 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteMantenimiento(int $idmantenimiento){
			$this->intIdMantenimiento = $idmantenimiento;
			$sql = "UPDATE mantenimiento SET status = ? WHERE idmantenimiento = $this->intIdMantenimiento ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
 ?>