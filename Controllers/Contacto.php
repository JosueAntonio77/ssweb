<?php 
	class Contacto extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function contacto()
		{
			$data['page_tag'] = NOMBRE_EMPESA;
			$data['page_title'] = NOMBRE_EMPESA;
			$data['page_name'] = "mg_dakava";
			$this->views->getView($this,"contacto",$data);
		}
	}
 ?>