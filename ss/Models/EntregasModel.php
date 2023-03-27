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
							INNER JOIN persona as p ON m.personaid = p.idpersona $where AND m.status = 0";
            $request = $this ->select_all($sql);
            return $request;

		}
		
		//Para la parte de la vista de detalles entrega
		public function selectEntrega(int $idmantenimiento, $idpersona = NULL){
			$busqueda = "";
			if($idpersona != NULL){
				$busqueda = "AND m.personaid =".$idpersona;
			}
		$request = array();
		$sql = "SELECT m.idmantenimiento,
						m.equipo,
						d.direccion as direcciones,
						m.diagnostico,
						m.personaid,
						p.nombres as persona,
						DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
						m.status
				FROM mantenimiento as m
				INNER JOIN direcciones as d ON m.direccionid = d.iddireccion
				INNER JOIN persona  as p ON m.personaid = p.idpersona".$busqueda;
			$requestMantenimiento = $this->select($sql);
			if(!empty($requestMantenimiento)){
				$idpersona = $requestMantenimiento['personaid'];
				$sql_solicitante = "SELECT p.idpersona,
										p.nombres,
										p.apellidos,
										p.telefono,
										p.email_user,
										p.nit,
										p.cargo,
										p.area,
										m.idmantenimiento,
										m.equipo,
										d.direccion,
										m.diagnostico,
										m.personaid,
										DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
										m.status
									FROM persona as p
									INNER JOIN mantenimiento as m ON p.idpersona = m.personaid
									INNER JOIN direcciones as d ON m.direccionid = d.iddireccion
									WHERE m.idmantenimiento = $idmantenimiento AND m.status = 1";
					$requestsolicitante = $this->select($sql_solicitante);
					$sql_detalle = "SELECT m.idmantenimiento,
											m.equipo,
											d.direccion as direcciones,
											m.diagnostico,
											m.personaid,
											p.nombres,
											p.apellidos,
											DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
											m.status
									FROM mantenimiento as m
									INNER JOIN direcciones as d ON m.direccionid = d.iddireccion
									INNER JOIN persona as p ON m.personaid = p.idpersona
									WHERE m.idmantenimiento = $idmantenimiento
									/*WHERE d.pedidoid = $idmantenimiento*/";
					$requestEntregas = $this->select_all($sql_detalle);
					$request = array('solicitante' =>$requestMantenimiento,
									'orden' => $requestsolicitante,
									'detalle' => $requestEntregas);
			}
			return $request;
		}
	}
 ?>