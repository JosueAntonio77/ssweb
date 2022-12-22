<?php 

	class ProveedoresModel extends Mysql
	{
		private $intIdUsuario;
		private $strNombre;
		private $strEmail;
		private $intTelefono;
		private $strDireccion;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertProveedor(string $nombre, string $email, int $telefono, string $direccion, int $status){

			$this->strNombre = $nombre;
			$this->strEmail = $email;
			$this->intTelefono = $telefono;
			$this->strDireccion = $direccion;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM proveedor WHERE email = '{$this->strEmail}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO proveedor(nombre,email,telefono,direccion,status) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array(
        						$this->strNombre,
        						$this->strEmail,
        						$this->intTelefono,
        						$this->strDireccion,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectProveedores()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.idproveedor != 1 ";
			}
			$sql = "SELECT p.idproveedor,p.nombre,p.email,p.telefono,p.direccion,p.status 
					FROM proveedor p 
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

	}
 ?>