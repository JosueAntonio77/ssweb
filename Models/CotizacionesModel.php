<?php 
	class CotizacionesModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();		
		}	
		public function selectCotizaciones($idpersona = null){
			$where = "";
			if($idpersona != null){
				$where = "WHERE personaid = ".$idpersona;
			}
					$sql = "SELECT idpedido,
        	                DATE_FORMAT(fecha, '%d/%m/%Y') as fecha,
                            monto,
                            status
                    FROM pedido 
					$where";
            $request = $this ->select_all($sql);
            return $request;

		}

		public function selectCotizacion(int $idpedido, $idpersona = NULL){
			$busqueda = "";
			if($idpersona != NULL){
				$busqueda = "AND personaid =".$idpersona;
			}
		$request = array();
		$sql = "SELECT idpedido,
							personaid,
							DATE_FORMAT(fecha, '%d/%m/%Y') as fecha,
							costo_envio,
							monto,
							direccion_envio,
							status
					FROM pedido
					WHERE idpedido = $idpedido".$busqueda;
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idpersona = $requestPedido['personaid'];
				$sql_cliente = "SELECT idpersona,nombres,apellidos,telefono,email_user,nit,nombrefiscal,direccionfiscal
					FROM persona WHERE idpersona = $idpersona";
					$requestcliente = $this->select($sql_cliente);
					$sql_detalle = "SELECT p.idproducto,
											p.nombre as producto,
											d.precio,
											d.cantidad
									FROM detalle_pedido d
									INNER JOIN producto p
									ON d.productoid = p.idproducto
									WHERE d.pedidoid = $idpedido";
					$requestProductos = $this->select_all($sql_detalle);
					$request = array('cliente' =>$requestcliente,
									'orden' => $requestPedido,
									'detalle' => $requestProductos);
			}
			return $request;
		}
	}
 ?>