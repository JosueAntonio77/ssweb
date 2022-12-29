<?php 
	require_once("Models/TCategoria.php");
	require_once("Models/TProducto.php");
	require_once("Models/TCliente.php");
    require_once("Models/LoginModel.php");

	class Tienda extends Controllers{
		use TCategoria, TProducto, TCliente;
        public $login;
		public function __construct()
		{
			parent::__construct();
            session_start();
            $this->login = new LoginModel();
		}

		public function tienda()
		{
			$data['page_tag'] = NOMBRE_EMPRESA;
			$data['page_title'] = NOMBRE_EMPRESA;
			$data['page_name'] = "mg_dakava";
			$data['productos'] = $this->getProductosT();
			$this->views->getView($this,"tienda",$data);
		}

        public function categoria($params)
        {
            if(empty($params))
            {
                header("Location:".base_url());
            }
            else
            {
                $arrParams = explode(",", $params);
                $idcategoria = intval($arrParams[0]);
                $ruta = strClean($arrParams[1]);
                $infoCategoria = $this->getProductosCategoriaT($idcategoria, $ruta);
                //dep($infoCategoria); exit;
                $categoria = strClean($params);
                //dep($this->getProductosCategoriaT($categoria));
                $data['page_tag'] = NOMBRE_EMPRESA." | ".$infoCategoria['categoria'];
			    $data['page_title'] = $infoCategoria['categoria'];
			    $data['page_name'] = "categoria";
                $data['productos'] = $infoCategoria['productos'];
			    $this->views->getView($this,"categoria",$data);
            }
        }

        public function producto($params){
            if(empty($params)){
                header("Location:".base_url());
            }else{
                $arrParams = explode(",", $params);
                $idproducto = intval($arrParams[0]);
                $ruta = strClean($arrParams[1]);
                $infoProducto = $this->getProductoT($idproducto, $ruta);
                if(empty($infoProducto)){
                    header("Location:".base_url());
                }  
                //$arrProducto = $this->getProductoT($producto);
                //dep($this->getProductosRandom($arrProducto['categoriaid'], 8, "r"));
                $data['page_tag'] = NOMBRE_EMPRESA." | ".$infoProducto['nombre'];
			    $data['page_title'] = $infoProducto['nombre'];
			    $data['page_name'] = "producto";
                $data['producto'] = $infoProducto;
                $data['productos'] = $this->getProductosRandom($infoProducto['categoriaid'], 8, "r");
			    $this->views->getView($this,"producto",$data);
            }
        }

        public function addCarrito(){
            if($_POST){
                //unset($_SESSION['arrCarrito']);exit;
                $arrCarrito = array();
                $cantCarrito = 0;   
                $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
                $cantidad = $_POST['cant'];
                if(is_numeric($idproducto) and is_numeric($cantidad)){
                    $arrInfoProducto = $this->getProductoIDT($idproducto);
                    if(!empty($arrInfoProducto)){
                        $arrProducto = array('idproducto' => $idproducto,
                                            'producto' => $arrInfoProducto['nombre'],
                                            'cantidad' => $cantidad,
                                            'precio' => $arrInfoProducto['precio'],
                                            'imagen' => $arrInfoProducto['images'][0]['url_image']
                                        );

                        if(isset($_SESSION['arrCarrito'])){
                            $on = true;
                            $arrCarrito = $_SESSION['arrCarrito'];
                            for ($pr=0; $pr < count($arrCarrito); $pr++) {
                                if($arrCarrito[$pr]['idproducto'] == $idproducto){
                                    $arrCarrito[$pr]['cantidad'] += $cantidad;
                                    $on = false;
                                }
                            }
                            if($on){
                                array_push($arrCarrito,$arrProducto);
                            }
                            $_SESSION['arrCarrito'] = $arrCarrito;   
                        }else{
                            array_push($arrCarrito, $arrProducto);
                            $_SESSION['arrCarrito'] = $arrCarrito;
                        }

                        foreach ($_SESSION['arrCarrito'] as $pro) {
                            $cantCarrito += $pro['cantidad'];
                        }

                        $htmlCarrito ="";
                        $htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
                        $arrResponse = array("status" => true, 
                                            "msg" => '¡Agregado exitosamente!',
                                            "cantCarrito" => $cantCarrito,
                                            "htmlCarrito" => $htmlCarrito
                                        );
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'Producto no existente.');
                    }
                }else{
                    $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);  
            }
            die();
        }

        public function delCarrito(){
			if($_POST){
				$arrCarrito = array();
				$cantCarrito = 0;
				$subtotal = 0;
				$idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
				$option = $_POST['option'];
				if(is_numeric($idproducto) and ($option == 1 or $option == 2)){
					$arrCarrito = $_SESSION['arrCarrito'];
					for ($pr=0; $pr < count($arrCarrito); $pr++) {
						if($arrCarrito[$pr]['idproducto'] == $idproducto){
							unset($arrCarrito[$pr]);
						}
					}
					sort($arrCarrito);
					$_SESSION['arrCarrito'] = $arrCarrito;
					foreach ($_SESSION['arrCarrito'] as $pro) {
						$cantCarrito += $pro['cantidad'];
						$subtotal += $pro['cantidad'] * $pro['precio'];
					}
					$htmlCarrito = "";
					if($option == 1){
						$htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
					}
					$arrResponse = array("status" => true, 
											"msg" => '¡Producto eliminado!',
											"cantCarrito" => $cantCarrito,
											"htmlCarrito" => $htmlCarrito,
											"subTotal" => SMONEY.formatMoney($subtotal),
											"total" => SMONEY.formatMoney($subtotal + COSTOENVIO)
										);
				}else{
					$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

        public function updCarrito(){
			if($_POST){
				$arrCarrito = array();
				$totalProducto = 0;
				$subtotal = 0;
				$total = 0;
				$idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
				$cantidad = intval($_POST['cantidad']);
				if(is_numeric($idproducto) and $cantidad > 0){
					$arrCarrito = $_SESSION['arrCarrito'];
					for ($p=0; $p < count($arrCarrito); $p++) { 
						if($arrCarrito[$p]['idproducto'] == $idproducto){
							$arrCarrito[$p]['cantidad'] = $cantidad;
							$totalProducto = $arrCarrito[$p]['precio'] * $cantidad;
							break;
						}
					}
					$_SESSION['arrCarrito'] = $arrCarrito;
					foreach ($_SESSION['arrCarrito'] as $pro) {
						$subtotal += $pro['cantidad'] * $pro['precio']; 
					}
					$arrResponse = array("status" => true, 
										"msg" => '¡Producto actualizado!',
										"totalProducto" => SMONEY.formatMoney($totalProducto),
										"subTotal" => SMONEY.formatMoney($subtotal),
										"total" => SMONEY.formatMoney($subtotal + COSTOENVIO)
									);

				}else{
					$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

        public function registro(){
			error_reporting(0);
			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmailCliente']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmailCliente']));
					$intTipoId = 7; 
					$request_user = "";
					
					$strPassword = passGenerator();
					$strPasswordEncript = hash("SHA256",$strPassword);
					$request_user = $this->insertCliente($strNombre, 
														$strApellido, 
														$intTelefono, 
														$strEmail,
														$strPasswordEncript,
														$intTipoId );
					if($request_user > 0 )
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						$nombreUsuario = $strNombre.' '.$strApellido;
						$dataUsuario = array('nombreUsuario' => $nombreUsuario,
											 'email' => $strEmail,
											 'password' => $strPassword,
											 'asunto' => 'Bienvenido a tu tienda en línea');
						$_SESSION['idUser'] = $request_user;
						$_SESSION['login'] = true;
						$this->login->sessionLogin($request_user);
						//Esta comentado por que estamos de forma local. Esto sirve para enviar a su correo credenciales. 
                        //sendEmail($dataUsuario,'email_bienvenida');

					}else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function suscripcion()
        {
            if($_POST)
            {
                $nombre = ucwords(strtolower(strClean($_POST['nombreSuscripcion'])));
                $email = strtolower(strClean($_POST['emailSuscripcion']));
                
                $suscripcion = $this->setSuscripcion($nombre,$email);
                
                if($suscripcion > 0)
                {
                    $arrResponse = array('status' => true, 'msg' => "Gracias por tu suscripción");
                    //Enviar correo
                    $dataUsuario = array('asunto' => "Nueva suscripción",
                                         'email' => EMAIL_REMITENTE,
                                         'nombreSuscriptor' => $nombre,
                                         'emailSuscriptor' => $email);
                    //sendEmail($dataUsuario,"email_suscripcion");
                }
                else
                {
                    $arrResponse = array('status' => false, 'msg' => "El email ya fue registrado");
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function contacto()
        {
            if($_POST)
            {
                //dep($_POST);
                $nombre = ucwords(strtolower(strClean($_POST['nombreContacto'])));
                $email = strtolower(strClean($_POST['emailContacto']));
                $mensaje = strClean($_POST['mensaje']);
                $useragent = $_SERVER['HTTP_USER_AGENT'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $dispositivo = "PC";

                if(preg_match("/mobile/i", $useragent))
                {
                    $dispositivo = "Móvil";
                }
                else if(preg_match("/tablet/i", $useragent))
                {
                    $dispositivo = "Tablet";
                }
                else if(preg_match("/iPhone/i", $useragent))
                {
                    $dispositivo = "iPhone";
                }
                else if(preg_match("/iPad/i", $useragent))
                {
                    $dispositivo = "iPad";
                }

                $userContact = $this->setContacto($nombre,$email,$mensaje,$ip,$dispositivo,$useragent);
                
                if($userContact > 0)
                {
                    $arrResponse = array('status' => true, 'msg' => "Gracias por su mensaje, en breve será respondido.");
                    //Enviar correo
                    $dataUsuario = array('asunto' => "Nuevo mensaje de contacto",
                                         'email' => EMAIL_REMITENTE,
                                         'nombreContacto' => $nombre,
                                         'emailContacto' => $email,
                                         'mensaje' => $mensaje);
                    //sendEmail($dataUsuario,"email_contacto");
                }
                else
                {
                    $arrResponse = array('status' => false, 'msg' => "No es posible enviar el mensaje.");
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

	}
 ?>