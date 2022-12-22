<?php headerAdmin($data);?>
    <main class="app-content">
            <div class="app-title">
                <div>
                <h1><i class="fa fa-file-text-o"></i> Reporte de Compra</h1>
                         
                </div>
                <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>/compras">Compras</a></li>
                </ul>
            </div>
            <div class="row"><?php //dep($data['arrVenta']);?></div>
            <div class="row">
                <div class="col-md-12">
                <div class="tile">
                    <?php $data['arrCompra']; 
                    
                    if(empty($data['arrCompra'])){

                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{ 
                        //$venta = $data['arrVenta']['venta'];
                        ?>
                        <section id="sCompra" class="invoice">
                            <div class="row mb-4">
                                <div class="col-6">
                                <h2>  <img width = 200 src="<?= media();?>/images/LOGO_MG_dark.png" alt="User Image"></h2>
                                </div>
                                <div class="col-5">
                                <br><h5 class="text-right">Fecha: <?= $data['arrCompra']['ordenCompras']['datecreated'] ?></h5>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-4">
                                <address><strong><?= NOMBRE_EMPESA  ?></strong><br><?= WEB_EMPRESA?><br>
                                <?= DESCRIPCION?></address>
                                </div>
                                <div class="col-4">
                                <address>Cliente: <strong> <?= $data['arrCompra']['cliente']['nombres'].' '.$data['arrCompra']['cliente']['apellidos'] ?> </strong><br>Identificación: <strong><?= $data['arrCompra']['cliente']['identificacion'] ?></strong>
                                <br>Teléfono: <strong><?= $data['arrCompra']['cliente']['telefono'] ?></strong><br>
                                Email: <strong><?= $data['arrCompra']['cliente']['email_user'] ?></strong><br>
                                NIT: <strong><?= $data['arrCompra']['cliente']['nit'] ?></strong><br>
                                Nombre Fiscal: <strong><?= $data['arrCompra']['cliente']['nombrefiscal'] ?></strong><br>
                                Dirección Fiscal: <strong><?= $data['arrCompra']['cliente']['direccionfiscal'] ?></strong><br></address>
                                </div>
                                <div class="col-4">Venta: No. <strong><?= $data['arrCompra']['ordenCompras']['idcompra'] ?></strong><br>
                                Folio: <strong><?= $data['arrCompra']['ordenCompras']['folio'] ?></strong><br>
                                <!--Monto: <strong><?= SMONEY.' '. formatMoney($data['arrCompra']['ordenCompras']['monto']) ?></strong><br>-->
                                Tipo de Pago: <strong><?= $data['arrCompra']['ordenCompras']['tipopago'] ?></strong></div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $subtotal = 0;
                                            if(count($data['arrCompra']['detalle']) > 0){
                                                foreach($data['arrCompra']['detalle'] as $producto){
                                                    $subtotal += $producto['cantidad'] * $producto['precio'];                                            
                                        ?>
                                        <strong>
                                        <tr>
                                            <td><?= $producto['nombre'] ?></td>
                                            <td><?= SMONEY.' '. formatMoney($producto['precio']) ?></td>
                                            <td><?= $producto['cantidad'] ?></td>
                                            <td><?= SMONEY.' '. formatMoney( $producto['cantidad'] * $producto['precio']) ?></td>
                                        </tr>
                                        </strong>
                                        <?php
                                                    
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <td class="text-right"><?= SMONEY.' '. formatMoney($subtotal) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sCompra');"><i class="fa fa-print"></i> Imprimir </a></div>
                            </div>
                        </section>
                    <?php } ?>
                </div>
                </div>
            </div>
           
    </main>
<?php footerAdmin($data); ?>