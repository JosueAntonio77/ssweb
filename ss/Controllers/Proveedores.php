<?php 

class Proveedores extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(9);
	}

	public function Proveedores()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Proveedores";
		$data['page_title'] = "PROVEEDORES <small>Mgdakava</small>";
		$data['page_name'] = "proveedores";
		$data['page_functions_js'] = "functions_proveedores.js";
		$this->views->getView($this,"proveedores",$data);
	}

    public function setProveedor(){
    	if($_POST){
    		if(empty($_POST['txtNombre']) || empty($_POST['txtEmail']) || empty($_POST['txtTelefono']) || empty($_POST['txtDireccion']) || empty($_POST['listStatus']) )
    		{
    			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
    		}else{
    			$idUsuario = intval($_POST['idUsuario']);
				$strNombre = ucwords(strClean($_POST['txtNombre']));
				$strEmail = strtolower(strClean($_POST['txtEmail']));
				$strDireccion = strClean($_POST['txtDireccion']);
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$intStatus = intval(strClean($_POST['listStatus']));

				if($idUsuario == 0)
					{
						$option = 1;
						$request_user = $this->model->insertProveedor(
																		$strNombre, 
																		$strEmail, 
																		$intTelefono, 
																		$strDireccion,
																		$intStatus );
						if($request_user > 0 ){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');	
						}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
						}
					}
    		}
    		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    		//dep($_POST);
    		//echo "string";
    	}
    	die(); 
    }

    public function getProveedores()
	{
		$arrData = $this->model->selectProveedores();
		for ($i=0; $i < count($arrData); $i++) {

				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if($_SESSION['permisosMod']['u']){
					$btnView = '<button class="btn btn-info btn-sm btnViewProveedor" onClick="fntPermisos('.$arrData[$i]['idproveedor'].')" title="Ver Proveedor"><i class="fas fa-eye"></i></button>';
					$btnEdit = '<button class="btn btn-primary btn-sm btnEditProveedor" onClick="fntEditProveedor('.$arrData[$i]['idproveedor'].')" title="Editar Proveedor"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){
					$btnDelete = '<button class="btn btn-danger btn-sm btnDelProveedor" onClick="fntDelProveedor('.$arrData[$i]['idproveedor'].')" title="Eliminar Proveedor"><i class="far fa-trash-alt"></i></button>
				</div>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
	}

	public function getSelectPersonas(){
			$htmlOptions = "";
			$arrData = $this->model->selectPersonas();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idpersona'].'">'.$arrData[$i]['nombre'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	 
		}

}

?>