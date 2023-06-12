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
			if ($_SESSION['userData']['idrol'] == RSOLICITANTE){
				$idpersona = $_SESSION['userData']['idpersona'];
			}
			$arrData = $this->model->selectEntregas($idpersona);

			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if($_SESSION['permisosMod']['r']){
					$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/entregas/orden/'.$arrData[$i]['idmantenimiento'].'" target="_blanck"	class="btn btn-info btn-sm"> <i class="far fa-eye"></i></a>';
					
					
					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Pendiente</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-success">Entregado</span>';
					}
				}

				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idmantenimiento'].')" title="Eliminar recepción"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}

			
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();	
	}

	public function delMantenimiento(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdmantenimiento = intval($_POST['idMantenimiento']);
				$requestDelete = $this->model->deleteMantenimiento($intIdmantenimiento);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la recepción');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la recepción.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function getMantenimiento($idmantenimiento){
		if($_SESSION['permisosMod']['r']){
			$idmantenimiento = intval($idmantenimiento);
			if($idmantenimiento > 0){
				$arrData = $this->model->selectMantenimiento($idmantenimiento);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrImg = $this->model->selectImages($idmantenimiento);
					if(count($arrImg) > 0){
						for ($i=0; $i < count($arrImg); $i++) { 
							$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
						}
					}
					$arrData['images'] = $arrImg;
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function orden(int $idmantenimiento){
		/*Validar si el usuario tiene permisos de lectura,
			de lo contrario redirecciona al dashboard*/
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}

		$idpersona = "";
			if ($_SESSION['userData']['idrol'] == RSOLICITANTE){
				$idpersona = $_SESSION['userData']['idpersona'];
			}

		$data['page_tag'] = "Detalle";
		$data['page_title'] = "ENTREGA <small>H. Ayuntamiento de Progreso</small>";
		$data['page_name'] = "entrega";
		$data['arrMantenimiento'] = $this->model->selectEntrega($idmantenimiento,$idpersona);
		$this->views->getView($this,"orden",$data);
	}
}
?>