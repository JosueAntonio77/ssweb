<?php 
	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function cantUsuarios(){
			$sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantSolicitantes(){
			$sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0 AND rolid = ".RSOLICITANTE;
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		
		public function cantMantenimientos(){
			$sql = "SELECT COUNT(*) as total FROM mantenimiento WHERE status != 0 ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		
		public function cantEntregas(){
			$rolid = $_SESSION['userData']['idrol'];
			$idUser = $_SESSION['userData']['idpersona'];
			$where = "";
			if($rolid == RSOLICITANTE ){
				$where = " WHERE personaid = ".$idUser;
			}

			$sql = "SELECT COUNT(*) as total FROM mantenimiento ".$where;
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		
		public function lastOrders(){
			$rolid = $_SESSION['userData']['idrol'];
			$idUser = $_SESSION['userData']['idpersona'];
			$where = "";
			if($rolid == RSOLICITANTE ){
				$where = " WHERE p.personaid = ".$idUser;
			}

			$sql = "SELECT p.idmantenimiento, 
							CONCAT(pr.nombres,' ',pr.apellidos) AS nombre,
							c.nombre AS categoria,  
							p.status 
					FROM mantenimiento p
					INNER JOIN persona pr ON p.personaid = pr.idpersona
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					$where
					ORDER BY p.idmantenimiento DESC LIMIT 10 ";
			$request = $this->select_all($sql);
			return $request;
		}	

		public function mantenimientosTen(){
			/*
			$sql = "SELECT * FROM mantenimiento WHERE status = 1 ORDER BY idmantenimiento DESC ";
			$request = $this->select_all($sql);
			return $request;
			*/
			$rolid = $_SESSION['userData']['idrol'];
			$idUser = $_SESSION['userData']['idpersona'];
			$where = "";
			if($rolid == RSOLICITANTE ){
				$where = " WHERE p.personaid = ".$idUser;
			}

			$sql = "SELECT p.idmantenimiento, 
							p.nombre,
							c.nombre AS categoria,  
							p.status 
					FROM mantenimiento p
					INNER JOIN persona pr ON p.personaid = pr.idpersona
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					$where
					ORDER BY p.idmantenimiento DESC LIMIT 10 ";
			$request = $this->select_all($sql);
			return $request;
		}
		/*
		public function selectManteniMes(int $anio, int $mes){

            $sql = "SELECT m.idmantenimiento,
							DAY(m.datecreated) AS dia, 
							COUNT(m.idmantenimiento) AS cantidad, 
                FROM mantenimientos m 
                WHERE MONTH(m.datecreated)=$mes AND YEAR(m.datecreated) = $anio GROUP BY mantenimientoid";
            $mantenimientos = $this->select_all($sql);
            $meses = Meses();
            $arrData = array('anio'=> $anio, 'mes' => $meses[intval($mes-1)], 'mantenimientos' => $mantenimientos);
            return $arrData;
        }*/
		public function selectMantenimientosMes(int $anio, int $mes){
			$rolid = $_SESSION['userData']['idrol'];
			$idUser = $_SESSION['userData']['idpersona'];
			$where = "";
			if($rolid == RSOLICITANTE ){
				$where = " AND personaid = ".$idUser;
			}

			$arrMantenimientoDias = array();
			$dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
			$n_dia = 1;
			$totalCantidadMes = 0;
			for ($i=0; $i < $dias ; $i++) { 
				$date = date_create($anio."-".$mes."-".$n_dia);
				$fechaMantenimiento = date_format($date,"Y-m-d");
				$sql = "SELECT 
						DAY(datecreated) AS dia, 
						COUNT(idmantenimiento) AS cantidad
					FROM mantenimiento 
					WHERE DATE(datecreated) = '$fechaMantenimiento' AND status = '2' ".$where;
				$mantenimientoDia = $this->select($sql);
				$mantenimientoDia['dia'] = $n_dia;
				$n_dia++;
				$mantenimientoDia['cantidad'] = $mantenimientoDia['cantidad'] == "" ? 0 : $mantenimientoDia['cantidad'] ;
				$totalCantidadMes += $mantenimientoDia['cantidad'];

				array_push($arrMantenimientoDias, $mantenimientoDia);
				//dep($fechaMantenimiento);
			}
			$meses = Meses();
			$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalCantidadMes, 'mantenimientos' => $arrMantenimientoDias );
			return $arrData;
		}

		public function selectMantenimientosAnio(int $anio){
			$arrMMantenimientos = array();
			$arrMeses = Meses();
			for ($i=1; $i <= 12; $i++) { 
				$arrData = array('anio'=>'','no_mes'=>'','mes'=>'','venta'=>'');
				$sql = "SELECT 
						$anio AS anio, 
						$i AS mes, 
						COUNT(idmantenimiento) AS cantidad
					FROM mantenimiento 
					WHERE MONTH(datecreated)= $i AND YEAR(datecreated) = $anio AND status = '2' 
					GROUP BY MONTH(datecreated) ";
				$mantenimientosMes = $this->select($sql);
				$arrData['mes'] = $arrMeses[$i-1];
				if(empty($mantenimientosMes)){
					$arrData['anio'] = $anio;
					$arrData['no_mes'] = $i;
					$arrData['cantidad'] = 0;
				}else{
					$arrData['anio'] = $mantenimientosMes['anio'];
					$arrData['no_mes'] = $mantenimientosMes['mes'];
					$arrData['cantidad'] = $mantenimientosMes['cantidad'];
				}
				array_push($arrMMantenimientos, $arrData);
				# code...
			}
			$arrMMantenimientos = array('anio' => $anio, 'meses' => $arrMMantenimientos);
			return $arrMMantenimientos;
		}
	}
 ?>
