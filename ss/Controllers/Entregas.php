<?php
class Entregas extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(MENTREGAS);
	}

	public function Entregas()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Entregas";
		$data['page_title'] = "Entregas <small>Ayuntamiento de Progreso</small>";
		$data['page_name'] = "entregas";
		$data['page_functions_js'] = "functions_entregas.js";
		$this->views->getView($this,"entregas",$data); 
	} 
	public function getEntregas(){
					if($_SESSION['permisosMod']['r']){
						$idpersona = "";
						if ($_SESSION['userData']['idrol'] == RCLIENTES){
							$idpersona = $_SESSION['userData']['idpersona'];
					}
					$arrData = $this->model->selectEntregas($idpersona);
					//dep($arrData);
					//exit();
					for ($i=0; $i < count($arrData); $i++) {
						$btnView = '';
						$btnEdit = '';
						$btnDelete = '';

						$arrData[$i]['monto'] = SMONEY.formatMoney($arrData[$i]['monto']);

						if($_SESSION['permisosMod']['r']){
							$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/entregas/orden/'.$arrData[$i]['idpedido'].'" target="_blanck"
								class="btn btn-info btn-sm"> <i class="far fa-eye"></i></a>

								<button class="btn btn-danger btn-sm" onClick="fntViewDPF('.$arrData[$i]['idpedido'].')"
									title="Generar PDF"><i class="fas fa-file-pdf"></i></button>';
						}
						if($_SESSION['permisosMod']['u']){
							$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idpedido'].')" title="Editar cotización"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d']){	
							$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idpedido'].')" title="Eliminar cotización"><i class="far fa-trash-alt"></i></button>';
						}
						$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
					}
					echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				}
				die();	
	}
	public function orden(int $idpedido){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}

		$idpersona = "";
			if ($_SESSION['userData']['idrol'] == RCLIENTES){
				$idpersona = $_SESSION['userData']['idpersona'];
			}

		$data['page_tag'] = "Entrega";
		$data['page_title'] = "ENTREGA <small>H. Ayuntamiento de Progreso</small>";
		$data['page_name'] = "entrega";
		$data['arrPedido'] = $this->model->selectEntrega($idpedido,$idpersona);
		$this->views->getView($this,"orden",$data);
	}
}
?>