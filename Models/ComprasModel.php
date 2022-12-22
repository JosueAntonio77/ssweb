<?php 
    class ComprasModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function selectCompras($idproveedor = null){
            $where = "";
            if($idproveedor != null){
                $where = "WHERE c.proveedorid = ".$idproveedor;
            }
            $sql = "SELECT c.idcompra,
                            c.folio,
                            c.monto,
                            p.nombre,
                            c.productoid,
                            DATE_FORMAT(c.datecreated,'%d/%m/%Y') as datecreated,
                            tp.idtipopago,
                            tp.tipopago,
                            c.unidades,
                            c.status
                    FROM compras c
                    INNER JOIN proveedor p
                    ON c.proveedorid = p.idproveedor
                    INNER JOIN tipopago tp
                    ON c.tipopagoid = tp.idtipopago
                    WHERE c.status != 0 ";
            $request = $this->select_all($sql);
            return $request;
        }   
        // CONSULTA PARA EL OJITO DE LA TABLA
        public function selectCompra(int $idcompra, $idproveedor = NULL){
            $busqueda = "";
            if($idproveedor != NULL){
                $busqueda = "AND c.proveedorid =".$idproveedor;
            }
            $request = array();
            $sql = "SELECT c.idcompra,
                            c.folio,
                            c.monto,
                            p.nombre,
                            c.productoid
                            DATE_FORMAT(v.datecreated,'%d/%m/%Y') as datecreated,
                            tp.idtipopago,
                            tp.tipopago,
                            c.status
                    FROM compras c
                    INNER JOIN tipopago tp
                    ON c.tipopagoid = tp.idtipopago
                    INNER JOIN proveedor p
                    ON c.proveedorid = p.idproveedor WHERE c.idcompra = $idcompra ".$busqueda;
            $requestCompra = $this->select($sql);
            if(!empty($requestCompra)){
                $idcliente = $requestCompra['proveedorid'];
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
                'ordenCompras' => $requestCompra,
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