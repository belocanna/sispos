<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="vistas/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <img src="vistas/assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia Sesion</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="correo" name="correo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="contrasena" name ="contrasena">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
        <?php
                    $login = new usuariosControlador();
                    $login->login();
                    ?>
          <!-- /.col -->
          <div class="col-8">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <a href="" id="btnOlvidoClave">Olvide mi Contraseña</a><br>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="vistas/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/assets/dist/js/adminlte.min.js"></script>
<script src="archivos/js/inicio.js"></script>
<script src="archivos/js/login.js"></script>
</body>
</html>

<div class="modal fade" id="correoRecuperacion">
  <div class="modal-dialog modal-md" role="document"> 
    <div class="modal-content">
      <div class="modal-header bg-info" id="cabeceraArticulo">
        <h5 class="modal-title" id="title">Recuperacion Contraseña</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="btnCerrarModalArticulo"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="">
            <div class="row">
              <div class="col-sm-12">
                <div class="mb-3">
                  <label for="" class="form-label">Ingrese Correo de Recuperacion</label>
                  <input type="email" name="actual" id="correoUsuario" class="form-control">
                </div>
              </div>
            </div> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnCancelarCorreo" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnEnviarCorreo" onclick="restablecerContrasena()">Enviar</button>
      </div>
    </div>
  </div>
</div>
