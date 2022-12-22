<?php 
    class VentasModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function selectVentas($idpersona = null){
            $where = "";
            if($idpersona != null){
                $where = "WHERE v.personaid = ".$idpersona;
            }
            $sql = "SELECT v.idventa,
                            v.folio,
                            v.monto,
                            pe.nombres,
                            pe.apellidos,
                            tp.idtipopago,
                            tp.tipopago,
                            DATE_FORMAT(v.datecreated,'%d/%m/%Y') as datecreated,
                            v.status
                    FROM ventas v
                    INNER JOIN tipopago tp
                    ON v.tipopagoid = tp.idtipopago
                    INNER JOIN persona pe
                    ON v.personaid = pe.idpersona
                    WHERE v.status != 0 ";
            $request = $this->select_all($sql);
            return $request;
        }	

        public function selectVenta(int $idventa, $idpersona = NULL){
            $busqueda = "";
			if($idpersona != NULL){
				$busqueda = "AND v.personaid =".$idpersona;
			}
            $request = array();
            $sql = "SELECT v.idventa,
                            v.folio,
                            v.monto,
                            v.personaid,
                            pe.nombres,
                            pe.apellidos,
                            tp.idtipopago,
                            tp.tipopago,
                            DATE_FORMAT(v.datecreated,'%d/%m/%Y') as datecreated,
                            v.status
                    FROM ventas v
                    INNER JOIN tipopago tp
                    ON v.tipopagoid = tp.idtipopago
                    INNER JOIN persona pe
                    ON v.personaid = pe.idpersona WHERE v.idventa = $idventa ".$busqueda;
            $requestVenta = $this->select($sql);
            if(!empty($requestVenta)){
                $idcliente = $requestVenta['personaid'];
                //--------------------ARREGLO DE ESTUDIANTES----------------------
                $sql_cliente = "SELECT identificacion,
                                            nombres,
                                            apellidos,
                                            telefono,
                                            email_user,
                                            nit,
                                            nombrefiscal,
                                            direccionfiscal
                FROM persona WHERE idpersona = $idcliente";
                $requestcliente = $this->select($sql_cliente);
                $sql_detalle = "SELECT pr.idproducto,
                                        pr.nombre,
                                        pr.precio,
                                        d.cantidad
                                FROM detalle_venta as d
                                INNER JOIN producto pr
                                ON d.productoid = pr.idproducto
                                WHERE d.ventaid = $idventa";
                $requestProductos = $this->select_all($sql_detalle);
                $request = array('cliente' => $requestcliente,
                'orden' => $requestVenta,
                'detalle' => $requestProductos);     
                //--------------------------------------------------------------------------   
            }
            return $request;
        }

        public function selectTipoPago()
        {
            //EXTRAE TIPOS DE PAGO
            $sql = "SELECT * FROM tipopago"; //WHERE status != 0";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>