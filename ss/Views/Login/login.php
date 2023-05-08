<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Josue Castro, Leandro Gónzalez">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media(); ?>/images/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">

    <title><?= $data['page_tag']; ?></title>
  </head>

  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1><?= $data['page_title']; ?></h1>
      </div>
      <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Iniciar Sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="false">Crear cuenta</a>
          </li>
        </ul>
      </div>
      <div class="login-box">
        <div id="divLoading">
          <div>
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
              <div>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    <!--
                    <form id="formLogin">
                        <div class="form-group">
                          <label for="txtEmail">Usuario</label>
                          <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                        </div>
                        <div class="form-group">
                          <label for="txtPassword">Contraseña</label>
                          <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>
                    -->
                    <form class="login-form" name="formLogin" id="formLogin" action="">
                        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
                        <div class="form-group">
                          <label class="control-label">USUARIO</label>
                          <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus>
                        </div>
                        <div class="form-group">
                          <label class="control-label">CONTRASEÑA</label>
                          <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                          <div class="utility">
                            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
                          </div>
                        </div>
                        <div id="alertLogin" class="text-center"></div>
                        <div class="form-group btn-container">
                          <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN</button>
                        </div>
                    </form>
                    <form  id="formRecetPass" name="formRecetPass" class="forget-form" action="">
                      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste contraseña?</h3>
                      <div class="form-group">
                        <label class="control-label">EMAIL</label>
                        <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
                      </div>
                      <div class="form-group btn-container">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
                      </div>
                      <div class="form-group mt-3">
                        <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                    <form class="login-form" id="formRegister" >
                      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>REGISTRO</h3>
                      <div class="row">
                        <div class="col col-md-6 form-group">
                          <label for="txtNombre">Nombres</label>
                          <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                        </div>
                        <div class="col col-md-6 form-group">
                          <label for="txtApellido">Apellidos</label>
                          <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col col-md-6 form-group">
                          <label for="txtTelefono">Teléfono</label>
                          <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                        </div>
                        <div class="col col-md-6 form-group">
                          <label for="txtEmailSolicitante">Email</label>
                          <input type="email" class="form-control valid validEmail" id="txtEmailSolicitante" name="txtEmailSolicitante" required="">
                        </div>
                      </div>
                      <!--
                      <div class="row">
                        <div class="form-group col-md-6">
                            <label for="listDireccionid">¿Qué dirección perteneces?</label>
                            <select class="form-control" data-live-search="true" id="listDireccionid" name="listDireccionid" required>
                            </select>
                        </div>
                      </div>
                      -->
                      <button type="submit" class="btn btn-primary btn-block">REGISTRARSE</button>
                      <br>
                      <div class="form-group">
                        <div>
                          <p class="semibold-text mb-2">Se enviará un email a su cuenta de correo</p>
                        </div>
                        <div class="utility">
                          <!--
                          <p class="semibold-text mb-2"><a href="<?= base_url(); ?>/contacto"  target="_blanck">Contactate con nosotros aquí.</a></p>
                          -->
                          <p class="semibold-text mb-2"><a href="<?= base_url(); ?>/contacto"  target="">Contactate con nosotros</a></p>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
      const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
  </body>

</html>