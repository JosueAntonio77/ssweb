<?php 

class Recepciones extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		//session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(4);
	}

	public function Recepciones()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Recepciones";
		$data['page_title'] = "Recepciones <small>Ayuntamiento de Progreso</small>";
		$data['page_name'] = "proveedores";
		$data['page_functions_js'] = "functions_recepciones.js";
		$this->views->getView($this,"recepciones",$data); 
	} 

   public function setMantenimiento(){
			if($_POST){

				if(empty($_POST['txtNombre'])||empty($_POST['listCategoria']) || empty($_POST['txtEquipo']) || empty($_POST['txtDescripcion']) || empty($_POST['listPersona']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Llene todos los campos.');
				}else{
					/*
					$idMantenimiento = intval($_POST['idMantenimiento']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strDiagnostico = strClean($_POST['txtDiagnostico']);
					$intCategoriaId = intval($_POST['listCategoria']);
					$intPersonaId = intval($_POST['listPersona']);
					$strEquipo = strClean($_POST['txtEquipo']);
					$intStatus = intval($_POST['listStatus']);

					$ruta = strtolower(clear_cadena($strNombre));
					$ruta = str_replace(" ","-",$ruta);
					*/
					$idMantenimiento 	= intval($_POST['idMantenimiento']);
					$strNombre 			= ucwords(strClean($_POST['txtNombre']));
					$strDescripcion 	= ucwords(strClean($_POST['txtDescripcion']));
					//$strDiagnostico 	= ucwords(strClean($_POST['txtDiagnostico']));
					$strDiagnostico 	= ' ';
					$intCategoriaId 	= intval(strClean($_POST['listCategoria']));
					$intPersonaId 		= intval(strClean($_POST['listPersona']));
					$strEquipo 			= ucwords(strClean($_POST['txtEquipo']));
					//$intStatus 		= 1;
					$intStatus 			= intval(strClean($_POST['listStatus']));

					if($idMantenimiento == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_mantenimiento = $this->model->insertMantenimiento($strNombre, 
																		$strDescripcion,
																		$strDiagnostico,
																		$intCategoriaId,
																		$intPersonaId,
																		$strEquipo, 
																		$intStatus);
						}
					}else{
						$option = 2;
						if($_SESSION['permisosMod']['u']){
							$request_mantenimiento = $this->model->updateMantenimiento($idMantenimiento,
																		$strNombre, 
																		$strDescripcion, 
																		$strDiagnostico, 
																		$intCategoriaId,
																		$intPersonaId,   
																		$strEquipo,
																		$intStatus);	
						}
					}

					if($request_mantenimiento > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'idmantenimiento' => $request_mantenimiento, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'idmantenimiento' => $idMantenimiento, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_mantenimiento == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe la recepción con ese nombre.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

    public function getRecepciones()
	{
		if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectRecepciones();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Entregado</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Pendiente</span>';
					}

					//$arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idmantenimiento'].')" title="Ver recepción"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idmantenimiento'].')" title="Editar recepción"><i class="fas fa-pencil-alt"></i></button>';
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

	public function getMantenimiento($idMantenimiento){
		if($_SESSION['permisosMod']['r']){
			$idmantenimiento = intval($idMantenimiento);
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

	public function setImage(){
			if($_POST){
				if(empty($_POST['idmantenimiento'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de dato.');
				}else{
					$idMantenimiento = intval($_POST['idmantenimiento']);
					$foto      = $_FILES['foto'];
					$imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.jpg';
					$request_image = $this->model->insertImage($idMantenimiento,$imgNombre);
					if($request_image){
						$uploadImage = uploadImage($foto,$imgNombre);
						$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	
		public function delFile(){
			if($_POST){
				if(empty($_POST['idmantenimiento']) || empty($_POST['file'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					//Eliminar de la DB
					$idMantenimiento = intval($_POST['idmantenimiento']);
					$imgNombre  = strClean($_POST['file']);
					$request_image = $this->model->deleteImage($idMantenimiento,$imgNombre);

					if($request_image){
						$deleteFile =  deleteFile($imgNombre);
						$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
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

		public function getSelectPersonas(){
			$htmlOptions = "";
			$arrData = $this->model->selectPersonas();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idpersona'].'">'.$arrData[$i]['nombres'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	 
		}

}

?>