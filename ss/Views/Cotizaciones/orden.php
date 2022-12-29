<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/cotizaciones"> Cotizaciones</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="title">
        <?php dep($data['arrPedido']); ?>
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><i class="fa fa-globe"></i> <img src="<?= media(); ?> /images/LOGO_MG_dark.png" width="100px" heigh="100px"> </h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha:</h5>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-4">From
              <address><strong>MG DAKAVA</strong><br>
                Avenue pemex<br>
                DAKAVA<br>
                goku@gmail.com<br>
                www.hola.com
              </address>
            </div>
            <div class="col-4">To
              <address><strong>MG DAKAVA</strong><br>
                Envío: <br>
                Tel: <br>
                Email: 
               </address>
            </div>
            <div class="col-4">Invoice</b><br> 
                <b>Estado: <br>
                <b>Monto:</b> 
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th >Producto</th>
                    <th >Serial</th>
                    <th >Descripción</th>
                    <th >Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Juego de mesa</td>
                    <td>455-211-431</td>
                    <td>$49.99</td>
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
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>