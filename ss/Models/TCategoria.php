<?php
    require_once("Libraries/Core/Mysql.php");
    trait TCategoria
    {
        private $con;

        public function getCategoriasT(string $categorias)
        {
            $this->con = new Mysql();
            $sql = "SELECT idcategoria, nombre, descripcion, portada, ruta
                    FROM categoria WHERE status !=0 AND idcategoria IN ($categorias)";
            $request = $this->con->select_all($sql);
            if(count($request) > 0)
            {
                for($c=0; $c<count($request); $c++)
                {
                    $request[$c]['portada'] = BASE_URL.'/Assets/images/uploads/'.$request[$c]['portada'];
                }
            }
            return $request;        
        }
     /*   public function setSuscripcion(string $nombre, string $email){
			$this->con = new Mysql();
			$sql = 	"SELECT * FROM suscripciones WHERE email = '{$email}'";
			$request = $this->con->select_all($sql);
			if(empty($request)){
				$query_insert  = "INSERT INTO suscripciones(nombre,email) 
								VALUES(?,?)";
				$arrData = array($nombre,$email);
				$request_insert = $this->con->insert($query_insert,$arrData);
				$return = $request_insert;
			}else{
				$return = false;
			}
			return $return;
		}

        public function setContacto(string $nombre, string $email, string $mensaje, string $ip, string $dispositivo, string $useragent){
			$this->con = new Mysql();
			$nombre  	 = $nombre != "" ? $nombre : ""; 
			$email 		 = $email != "" ? $email : ""; 
			$mensaje	 = $mensaje != "" ? $mensaje : ""; 
			$ip 		 = $ip != "" ? $ip : ""; 
			$dispositivo = $dispositivo != "" ? $dispositivo : ""; 
			$useragent 	 = $useragent != "" ? $useragent : ""; 
			$query_insert  = "INSERT INTO contacto(nombre,email,mensaje,ip,dispositivo,useragent) 
							VALUES(?,?,?,?,?,?)";
			$arrData = array($nombre,$email,$mensaje,$ip,$dispositivo,$useragent);
			$request_insert = $this->con->insert($query_insert,$arrData);
			return $request_insert;
		}*/
    }

?>