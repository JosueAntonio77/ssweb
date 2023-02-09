<?php 

	class RecepcionesModel extends Mysql
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
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strDiagnostico = $diagnostico;
			$this->intCategoriaId = $categoriaid;
			$this->intPersonaId = $personaid;
			$this->strEquipo = $equipo;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM Mantenimiento WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO Mantenimiento(nombre, 
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

		public function updateMantenimiento(int $idMantenimiento, string $nombre, string $descripcion, string $diagnostico, int $categoriaid, int $personaid, string $equipo, int $status){
			
			$this->intIdMantenimiento = $idMantenimiento;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strDiagnostico = $diagnostico;
			$this->intCategoriaId = $categoriaid;
			$this->intPersonaId = $personaid;
			$this->strEquipo = $equipo;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM Mantenimiento WHERE nombre = '{$this->strNombre}' AND idMantenimiento != $this->intIdMantenimiento ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE Mantenimiento 
						SET nombre=?,
							descripcion=?,
							diagnostico=?,
							categoriaid=?,
							personaid=?,
							equipo=?,
							status=?
						WHERE idMantenimiento = $this->intIdMantenimiento ";
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


		public function selectRecepciones()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.idMantenimiento != 1 ";
			}
			$sql = "SELECT p.idMantenimiento,
							p.nombre,
							p.personaid,
							p.categoriaid,
							c.nombre as categoria,
							CONCAT(pd.nombres,' ',pd.apellidos) AS persona,
							p.descripcion,
							p.equipo,
							p.status 
					FROM Mantenimientos p
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					INNER JOIN persona pd ON p.personaid = pd.idpersona
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectMantenimiento(int $idMantenimiento){
			$this->intIdMantenimiento = $idMantenimiento;
			$sql = "SELECT p.idMantenimiento,
							p.nombre,
							p.personaid, 
							p.categoriaid,
							c.nombre as categoria,
							CONCAT(pd.nombres,' ',pd.apellidos) AS persona,
							p.equipo,
							p.status, 
							p.descripcion,
							p.diagnostico 
					FROM Mantenimiento p
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					INNER JOIN persona pd ON p.personaid = pd.idpersona
					WHERE idMantenimiento = $this->intIdMantenimiento";
			$request = $this->select($sql);
			return $request;

		}

		public function insertImage(int $idMantenimiento, string $imagen){
			$this->intIdMantenimiento = $idMantenimiento;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(Mantenimientoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdMantenimiento,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idMantenimiento){
			$this->intIdMantenimiento = $idMantenimiento;
			$sql = "SELECT Mantenimientoid,img
					FROM imagen
					WHERE Mantenimientoid = $this->intIdMantenimiento";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idMantenimiento, string $imagen){
			$this->intIdMantenimiento = $idMantenimiento;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE Mantenimientoid = $this->intIdMantenimiento 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteMantenimiento(int $idMantenimiento){
			$this->intIdMantenimiento = $idMantenimiento;
			$sql = "UPDATE Mantenimiento SET status = ? WHERE idMantenimiento = $this->intIdMantenimiento ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
 ?>