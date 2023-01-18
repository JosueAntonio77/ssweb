<?php 

	class RecepcionesModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCategoriaId;
		private $intProveedorId;
		private $intIdPrecio;
		private $strModelo;
		private $strDimenciones;
		private $strRuta;
		private $intStatus;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertProducto(int $categoriaid, string $nombre, string $descripcion, string $precio, string $modelo, string $dimenciones, string $ruta, int $status, int $proveedorid){
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strModelo = $modelo;
			$this->intCategoriaId = $categoriaid;
			$this->intProveedorId = $proveedorid;
			$this->strPrecio = $precio;
			$this->strDimenciones = $dimenciones;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(categoriaid,
														nombre,
														descripcion,
														precio,
														modelo,
														dimenciones,
														ruta,
														status,
														proveedorid) 
								  VALUES(?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->strModelo,
        						$this->strDimenciones,
								$this->strRuta,
        						$this->intStatus,
        						$this->intProveedorId);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, int $categoriaid, string $nombre, string $descripcion, string $precio, string $modelo, string $dimenciones, string $ruta, int $status, int $proveedorid){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strModelo = $modelo;
			$this->intCategoriaId = $categoriaid;
			$this->intProveedorId = $proveedorid;
			$this->strPrecio = $precio;
			$this->strDimenciones = $dimenciones;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}' AND idproducto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto 
						SET categoriaid=?,
							nombre=?,
							descripcion=?,
							precio=?,
							modelo=?,
							dimenciones=?,
							ruta=?,
							status=?, 
							proveedorid=? 
						WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->strModelo,
        						$this->strDimenciones,
								$this->strRuta,
        						$this->intStatus,
        						$this->intProveedorId);

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
				$whereAdmin = " and p.idproducto != 1 ";
			}
			$sql = "SELECT p.idproducto,
							p.nombre,
							p.descripcion,
							p.categoriaid,
							p.proveedorid,
							c.nombre as categoria,
							pd.nombre as proveedor,
							p.precio,
							p.modelo,
							p.dimenciones,
							p.status 
					FROM producto p
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					INNER JOIN proveedor pd ON p.proveedorid = pd.idproveedor
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.idproducto,
							p.nombre,
							p.descripcion,
							p.categoriaid,
							p.proveedorid,
							c.nombre as categoria,
							pd.nombre as proveedor,
							p.precio,
							p.modelo,
							p.dimenciones,
							p.status 
					FROM producto p
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					INNER JOIN proveedor pd ON p.proveedorid = pd.idproveedor
					WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
 ?>