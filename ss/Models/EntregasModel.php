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
				$where = "WHERE personaid =".$idpersona;
			}
					$sql = "SELECT m.idmantenimiento,
					m.equipo,
					d.direccion as direcciones,
					m.diagnostico,
					CONCAT(pd.nombres,' ',pd.apellidos) AS persona, /* solicitante */
					CONCAT(pt.nombres,' ',pt.apellidos) AS personatecnico, /* tecnico */
					DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
					m.status
					FROM mantenimiento as m 
					INNER JOIN persona pd ON m.personaid = pd.idpersona
					INNER JOIN persona pt ON m.personat = pt.idpersona
					INNER JOIN direcciones d ON pd.direccionid = d.iddireccion $where AND m.status = 2";
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
							d.direccion as persona,
							m.diagnostico,p.nombres as persona,
							m.datefinish,
							m.status
							FROM mantenimiento as m 
							INNER JOIN persona as p ON m.personaid = p.idpersona
							INNER JOIN direcciones as d ON p.direccionid = d.iddireccion".$busqueda;
			$requestMantenimiento = $this->select($sql);
			if(!empty($requestMantenimiento)){
				$idpersona = $requestMantenimiento['personaid'];
				$sql_solicitante = "SELECT p.idpersona,
											CONCAT(p.nombres,' ',p.apellidos) AS persona, /* solicitante */
											CONCAT(pt.nombres,' ',pt.apellidos) AS personatecnico, /* tecnico */
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
										INNER JOIN persona pt ON m.personat = pt.idpersona
									INNER JOIN direcciones d ON p.direccionid = d.iddireccion
									WHERE m.idmantenimiento = $idmantenimiento AND m.status = 2";
					$requestsolicitante = $this->select($sql_solicitante);
					$sql_detalle = "SELECT m.idmantenimiento,
											m.equipo,
											d.direccion as direcciones,
											m.diagnostico,
											m.personaid,
											CONCAT(pd.nombres,' ',pd.apellidos) AS persona, /* solicitante */
											CONCAT(pt.nombres,' ',pt.apellidos) AS personatecnico, /* tecnico */
											DATE_FORMAT(m.datefinish, '%d/%m/%Y') as datefinish,
											m.status
									FROM mantenimiento as m
									INNER JOIN persona pd ON m.personaid = pd.idpersona
									INNER JOIN persona pt ON m.personat = pt.idpersona
									INNER JOIN direcciones d ON pd.direccionid = d.iddireccion
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