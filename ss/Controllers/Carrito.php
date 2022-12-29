<?php 
	require_once("Models/TCategoria.php");
	require_once("Models/TProducto.php");
	//require_once("Models/TTipoPago.php");
	require_once("Models/TCliente.php");
	class Carrito extends Controllers{
		use TCategoria, TProducto, TCliente;
		public function __construct()
		{
			parent::__construct();
			session_start();
		}

		public function carrito()
		{
			$data['page_tag'] = NOMBRE_EMPRESA.' - Cotizar';
			$data['page_title'] = 'Cotizaciones';
			$data['page_name'] = "cotización";
			$this->views->getView($this,"carrito",$data); 
		}
		public function procesarpago()
		{
			if(empty($_SESSION['arrCarrito'])){ 
				header("Location: ".base_url());
				die();
			}
			if (isset($_SESSION['login'])) {
				$this->setDetalleTemp();
			}
			$data['page_tag'] = NOMBRE_EMPRESA.' - Procesar Cotización';
			$data['page_title'] = 'Cotizar';
			$data['page_name'] = "procesarcotización";
			//$data['tiposPago'] = $this->getTiposPagoT();
			$this->views->getView($this,"procesarpago",$data); 
		}

		public function setDetalleTemp(){
			$sid = session_id();
			$arrPedido = array('idcliente' => $_SESSION['idUser'],
								'idtransaccion' => $sid,
								'productos' => $_SESSION['arrCarrito']
							);
			$this->insertDetalleTemp($arrPedido);
		}

	}
 ?>      