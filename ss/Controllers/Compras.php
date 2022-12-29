<?php
    class Compras extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
                die();
            } getPermisos(12);
        }

        public function Compras()
        {
           
            if(empty($_SESSION['permisosMod']['r'])){
                header("Location:".base_url().'/dashboard');
            }
             

            $data['page_tag'] = "Compras";
            $data['page_title'] = "COMPRAS <small> MgDakava</small>";
            $data['page_name'] = "compras";
            $data['page_functions_js'] = "functions_compras.js";
            $this->views->getView($this,"compras",$data);
        }

        public function getCompras(){
            if($_SESSION['permisosMod']['r']){
                
                $arrData = $this->model->selectCompras();
                //dep($arrData);
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    $arrData[$i]['monto'] = SMONEY.formatMoney($arrData[$i]['monto']);

                    if($_SESSION['permisosMod']['r']){
                        $btnView .= ' <a title="Ver Detalle" href="'.base_url().'/compras/ordenCompras/'.$arrData[$i]['idcompra'].'" 
                            class="btn btn-info btn-sm"> <i class="far fa-eye"></i></a>';
                    }

                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo('.$arrData[$i]['idcompra'].')" title="Editar compra"><i class="fas fa-pencil-alt"></i></button>';
                    }
                    if($_SESSION['permisosMod']['d']){  
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idcompra'].')" title="Eliminar compra"><i class="far fa-trash-alt"></i></button>';
                    }
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            }
            die();  
        }
        // CONTROLADOR PARA EL OJITO DE LA TABLA
        public function ordenCompras(int $idcompra){
            if(empty($_SESSION['permisosMod']['r'])){
                header("Location:".base_url().'/dashboard');
            }

            $idpersona = "";
            if($_SESSION['userData']['idrol']==7){
                $idpersona=$_SESSION['userData']['idpersona'];
            }

            $data['page_tag'] = "Compra";
            $data['page_title'] = "Compra <small> MgDakava </small>";
            $data['page_name'] = "compra";
            $data['arrCompra'] = $compra = $this->model->selectCompra($idventa,$idpersona);
            
            $this->views->getView($this,"ordenCompras",$data);
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

        public function delCompra()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdcompra = intval($_POST['idCompra']);
					$requestDelete = $this->model->deleteCompra($intIdcompra);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la compra');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una compra.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la compra.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

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