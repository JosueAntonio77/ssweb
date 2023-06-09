<?php headerAdmin($data);?>
    <main class="app-content">
            <div class="app-title">
                <div>
                <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>/entregas">Entregas</a></li>
                </ul>
            </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        
    <!--  <?php dep($data['arrMantenimiento']); ?> -->
     
        <?php $data['arrMantenimiento']; 
                    
                    if(empty($data['arrMantenimiento'])){

                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{ 
                 //       $estudiante = $data['arrPedido']['estudiante']; 
                        $pago = $data['arrMantenimiento']['orden'];
                        ?>
      
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><i ></i> <img src="<?= media(); ?> /images/logo.png" width="150px" heigh="200px"> </h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha Entrega: <?= $pago['datefinish'] ?>
                 </h5>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-4"><strong>Solicita:</strong>
              <address><?=$pago['persona']?> <br>
              <strong>Dirección: </strong><?=$pago['direccion']?><br>
              <strong>Área: </strong><?=$pago['area']?><br>
              <strong>Cargo: </strong><?=$pago['cargo']?><br>
              <strong>Email: </strong><?=$pago['email_user']?><br>
              </address>
            </div>
            <div class="col-4">
            <strong>Para:</strong>
              <address><strong><?= NOMBRE_EMPRESA ?></strong><br>
              <strong>Web: </strong> <?= WEB_EMPRESA ?><br>
              <strong>Ubicación: </strong> <?= CALLE ?>
               </address>
            </div>
            <div class="col-4">Contactos</b><br> 
            <strong>Tel: </strong> <?= TEL_EMPRESA ?><br>
                <b>Email: </b> 
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th >Equipo</th>
                    <th >Descripción</th>
                    <th >Diagnóstico</th>
                    <th >Fecha Solicitado</th>
                    <th >Atendió</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $pago['idmantenimiento'] ?></td>
                    <td><?= $pago['equipo'] ?></td>
                    <td><?= $pago['descripcion'] ?></td>
                    <td><?= $pago['diagnostico'] ?></td>
                    <td><?= $pago['datecreated'] ?></td>
                    <td><?=$pago['personatecnico']?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blanck">
                <i class="fa fa-print"></i> Imprimir</a></div>
          </div>
        </section>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>