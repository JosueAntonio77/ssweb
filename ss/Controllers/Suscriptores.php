<?php 

	class Suscriptores extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(10);
		}

		public function Suscriptores()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Suscriptores - Mgdakava";
			$data['page_title'] = "Suscriptores <small>Ayuntamiento de Progreso</small>";
			$data['page_name'] = "suscriptores";
			$data['page_functions_js'] = "functions_suscriptores.js";
			$this->views->getView($this,"suscriptores",$data);
		}

        public function getSuscriptores()
        {
            if($_SESSION['permisosMod']['r'])
            {
                $arrData = $this->model->selectSuscriptores();
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>