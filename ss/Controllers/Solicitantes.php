<?php 

class Solicitantes extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(MSOLICITANTES);
	}

	public function Solicitantes()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Solicitantes";
		$data['page_title'] = "SOLICITANTES <small>Ayuntamiento de Progreso</small>";
		$data['page_name'] = "solicitantes";
		$data['page_functions_js'] = "functions_solicitantes.js";
		$this->views->getView($this,"solicitantes",$data);
	}

	public function setSolicitante(){

		//error_reporting(0);
		if($_POST){
			//dep($_POST);exit;
			if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['listDireccionid']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['txtCargo']) || empty($_POST['txtArea']) )
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{ 

				$idUsuario 			= intval($_POST['idUsuario']);
				$strIdentificacion 	= strClean($_POST['txtIdentificacion']);
				$strNombre	 		= ucwords(strClean($_POST['txtNombre']));
				$strApellido 		= ucwords(strClean($_POST['txtApellido']));
				$intDireccionId 	= intval(strClean($_POST['listDireccionid']));
				$intTelefono 		= intval(strClean($_POST['txtTelefono']));
				$strEmail 			= strtolower(strClean($_POST['txtEmail']));
				$strCargo 			= ucwords(strClean($_POST['txtCargo']));
				$strArea 			= ucwords(strClean($_POST['txtArea']));
				$intTipoId = RSOLICITANTE;  

				//$request_user = "";
				if($idUsuario == 0)
				{
					$option = 1;
					/*
					$strPassword =  empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
					$strPasswordEncript = hash("SHA256",$strPassword);
					*/
					$strPasswordEncript =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
					//if($_SESSION['permisosMod']['w']){
						$request_user = $this->model->insertSolicitante($strIdentificacion,
																			$strNombre, 
																			$strApellido,
																			$intDireccionId,  
																			$intTelefono, 
																			$strEmail,
																			$strPasswordEncript,
																			$strCargo,
																			$strArea,
																			$intTipoId);
					//}
				}else{
					$option = 2;
					$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
					//if($_SESSION['permisosMod']['u']){
						$request_user = $this->model->updateSolicitante($strIdentificacion,
																		$strNombre, 
																		$strApellido,
																		$intDireccionId,  
																		$intTelefono, 
																		$strEmail,
																		$strPassword,
																		$strCargo,
																		$strArea);
					//}
				}
			}

			if($request_user > 0 )
			{
				if($option == 1){
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					$nombreUsuario = $strNombre.' '.$strApellido;
					$dataUsuario = array('nombreUsuario' => $nombreUsuario,
										 'email' => $strEmail,
										 'password' => $strPassword,
										 'asunto' => 'Bienvenido a tu tienda en línea');
					sendEmail($dataUsuario,'email_bienvenida');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente.');
				}
			}else if($request_user == 'exist'){
				$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}	
		die();
	}

	public function getSolicitantes()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectSolicitantes();
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				if($_SESSION['permisosMod']['r']){
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idpersona'].')" title="Ver solicitante"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idpersona'].')" title="Editar solicitante"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idpersona'].')" title="Eliminar solicitante"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

// Método para visualizar los datos del solicitante
	public function getSolicitante($idpersona){
		if($_SESSION['permisosMod']['r']){
			$idusuario = intval($idpersona);
			if($idusuario > 0)
			{
				$arrData = $this->model->selectSolicitante($idusuario);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delSolicitante()
	{
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdpersona = intval($_POST['idUsuario']);
				$requestDelete = $this->model->deleteSolicitante($intIdpersona);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el solicitante');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar al solicitante.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}



}

?>