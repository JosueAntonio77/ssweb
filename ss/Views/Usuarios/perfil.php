<?php
  headerAdmin($data);
  getModal('modalPerfil',$data);
 ?>
<main class="app-content">
  <div class="row user">
    <div class="col-md-12">
      <div class="profile">
        <div class="info"><img class="user-img" src="<?= media();?>/images/avatar.png">
          <h4><?= $_SESSION['userData']['nombres'].' '.$_SESSION['userData']['apellidos']; ?></h4>
          <p><?= $_SESSION['userData']['nombrerol']; ?></p>
        </div>
        <div class="cover-image"></div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
          <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Datos Personales</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Datos Empresa</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane active" id="user-timeline">
          <div class="timeline-post">
            <div class="post-media">
              <div class="content">
                <h5>DATOS PERSONALES <button class="btn btn-sm btn-info" type="button" onclick="openModalPerfil();"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button></h5>
              </div>
            </div>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:150px;">Identificación:</td>
                  <td><?= $_SESSION['userData']['identificacion']; ?></td>
                </tr>
                <tr>
                  <td>Nombres:</td>
                  <td><?= $_SESSION['userData']['nombres']; ?></td>
                </tr>
                <tr>
                  <td>Apellidos:</td>
                  <td><?= $_SESSION['userData']['apellidos']; ?></td>
                </tr>
                <tr>
                  <td>Teléfono:</td>
                  <td><?= $_SESSION['userData']['telefono']; ?></td>
                </tr>
                <tr>
                  <td>Email (Usuario):</td>
                  <td><?= $_SESSION['userData']['email_user']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="user-settings">
          <div class="tile user-settings">
            <h4 class="line-head">Datos Empresa</h4>
            <form id="formDataEmpresa" name="formDataEmpresa">
              <div class="row mb-4">
                <div class="col-md-6">
                  <label for="listDireccionid">Dirección</label>
                  <select class="form-control" data-live-search="true" id="listDireccionid" name="listDireccionid" required ></select>
                </div>
                <div class="col-md-6">
                  <label>Cargo</label>
                  <input class="form-control" type="text" id="txtCargo" name="txtCargo" value="<?= $_SESSION['userData']['cargo']; ?>" >
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label>Área</label>
                  <input class="form-control" type="text" id="txtArea" name="txtArea" value="<?= $_SESSION['userData']['area']; ?>">
                </div>
              </div>
              <div class="row mb-10">
                <div class="col-md-12">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>