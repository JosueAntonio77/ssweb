<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MDASHBOARD);
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - Control de Mantenimiento";
			$data['page_title'] = "Dashboard - Control de Mantenimiento";
			$data['page_name'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";

			$data['usuarios'] = $this->model->cantUsuarios();
			$data['solicitantes'] = $this->model->cantSolicitantes();
			$data['mantenimientos'] = $this->model->cantMantenimientos();
			$data['entregas'] = $this->model->cantEntregas();
			//$data['solicitudes'] = $this->model->cantSolicitudes();
			$data['lastOrders'] = $this->model->lastOrders();
			$data['mantenimientosTen'] = $this->model->mantenimientosTen();

			$anio = date('Y');
			$mes = date('m');
			
			//dep($data['pagosMes']);exit;
			//$data['manteniMes'] = $this->model->selectManteniMes($anio,$mes);
			//dep($data['ventasMDia']);exit;
			$data['manteniMes'] = $this->model->selectMantenimientosMes($anio,$mes);
			//dep($data['pagosMes']);exit;
			$data['manteniAnio'] = $this->model->selectMantenimientosAnio($anio);
			//dep($data['ventasAnio']);exit;
			
			
			if( $_SESSION['userData']['idrol'] == RSOLICITANTE ){
				$this->views->getView($this,"dashboardSolicitante",$data);
			}else{
				$this->views->getView($this,"dashboard",$data);
			}
		}
		/*
		public function entregaMes(){
			if($_POST){
				$grafica = "entregaMes";
				$nFecha = str_replace(" ","",$_POST['fecha']);
				$arrFecha = explode('-',$nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectManteniMes($anio,$mes);
				$script = getFile("Template/Modals/graficas",$pagos);
				echo $script;
				die();
			}
		}*/
		public function mantenimientosMes(){
			if($_POST){
				$grafica = "mantenimientosMes";
				$nFecha = str_replace(" ","",$_POST['fecha']);
				$arrFecha = explode('-',$nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$mantenimientos = $this->model->selectMantenimientosMes($anio,$mes);
				$script = getFile("Template/Modals/graficas",$mantenimientos);
				echo $script;
				die();
			}
		}
		public function mantenimientosAnio(){
			if($_POST){
				$grafica = "mantenimientosAnio";
				$anio = intval($_POST['anio']);
				$mantenimientos = $this->model->selectMantenimientosAnio($anio);
				$script = getFile("Template/Modals/graficas",$mantenimientos);
				echo $script;
				die();
			}
		}
	}
 ?>