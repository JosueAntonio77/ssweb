<?php 
	class EntregasModel extends Mysql
	{
		private $objEntrega;
		public function __construct()
		{
			parent::__construct();		
		}	
		public function selectEntregas($idpersona = null){
			$where = "";
			if($idpersona != null){
				$where = "WHERE personaid = ".$idpersona;
			}
					$sql = "SELECT m.idmantenimiento,
									m.equipo,
									d.direccion as direcciones,
									m.diagnostico,
									p.nombres as persona,
									DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
									m.status
							FROM mantenimiento as m
							INNER JOIN direcciones as d ON m.direccionid = d.iddireccion
							INNER JOIN persona  as p ON m.personaid = p.idpersona $where";
            $request = $this ->select_all($sql);
            return $request;

		}

		public function selectEntrega(int $idmantenimiento, $idpersona = NULL){
			$busqueda = "";
			if($idpersona != NULL){
				$busqueda = "AND personaid =".$idpersona;
			}
		$request = array();
		$sql = "SELECT m.idmantenimiento,
						m.equipo,
						d.direccion as direcciones,
						m.diagnostico,
						p.nombres as persona,
						DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
						m.status
				FROM mantenimiento as m
				INNER JOIN direcciones as d ON m.direccionid = d.iddireccion
				INNER JOIN persona  as p ON m.personaid = p.idpersona".$busqueda;
			$requestMantenimiento = $this->select($sql);
			if(!empty($requestMantenimiento)){
				$idpersona = $requestMantenimiento['personaid'];
				$sql_cliente = "SELECT p.idpersona,
										p.nombres,
										p.apellidos,
										p.telefono,
										p.email_user,
										p.nit,
										p.cargo,
										p.area
					FROM persona  as p WHERE idpersona = $idpersona";
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