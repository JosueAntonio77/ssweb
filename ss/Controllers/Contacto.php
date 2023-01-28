<?php 
	class Contacto extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function contacto()
		{
			$data['page_tag'] = NOMBRE_EMPRESA;
			$data['page_title'] = NOMBRE_EMPRESA;
			$data['page_name'] = "Ayuntamiento de Progreso";
			$this->views->getView($this,"contacto",$data);
		}
	}
 ?>