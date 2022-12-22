<?php
    class Ventas extends Controllers{
        public function __construct()
        {
            parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
				die();
            } getPermisos(13);
        }

        public function Ventas()
        {
           
            if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
             

            $data['page_tag'] = "Ventas";
            $data['page_title'] = "VENTAS <small> MgDakava</small>";
            $data['page_name'] = "ventas";
            $data['page_functions_js'] = "functions_ventas.js";
            $this->views->getView($this,"ventas",$data);
        }

        public function getVentas(){
            if($_SESSION['permisosMod']['r']){
				
				$arrData = $this->model->selectVentas();
				//dep($arrData);
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

                    $arrData[$i]['monto'] = SMONEY.formatMoney($arrData[$i]['monto']);

                    if($_SESSION['permisosMod']['r']){
						$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/ventas/orden/'.$arrData[$i]['idventa'].'" 
							class="btn btn-info btn-sm"> <i class="far fa-eye"></i></a>';
					}

					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo('.$arrData[$i]['idventa'].')" title="Editar venta"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idventa'].')" title="Eliminar venta"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();	
        }

		public function orden(int $idventa){
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}

			$idpersona = "";
			if($_SESSION['userData']['idrol']==7){
				$idpersona=$_SESSION['userData']['idpersona'];
			}

			$data['page_tag'] = "Venta";
            $data['page_title'] = "Venta <small> MgDakava </small>";
            $data['page_name'] = "venta";
			$data['arrVenta'] = $venta = $this->model->selectVenta($idventa,$idpersona);
			
            $this->views->getView($this,"orden",$data);
		}
		/*public function getVenta(string $ventas){
			if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != 7){
				if($ventas == ""){
					$arrResponse = array("status" => false, "msg" => 'Datos Incorrectos.');
				}else{	
					$requestVenta = $this->model->selectVenta($ventas,"");
					if(empty($requestVenta)){
						$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
					}else{
						$htmlModal = getFile("Template/Modals/modalVentas",$requestVenta);
						$arrResponse = array("status" => true, "html" => $htmlModal);
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}*/

		public function getSelectTipoPago()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectTipoPago();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					//if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idtipopago'].'">'.$arrData[$i]['tipopago'].'</option>';
					//}
				}
			}
			echo $htmlOptions;
			die();		
		}
    }
?>