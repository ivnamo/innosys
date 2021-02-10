<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Sistema de Innovación de Atlántica Agrícola">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Iván Navarro">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= base_url()?>Assets/images/favicon.ico" type="image/x-icon">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/css/style.css">
    <title><?php echo  $data['page_tag'] ?></title>
  </head>

  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Sistema de Innovación de Atlántica Agrícola</h1>
      </div>
      <div class="login-box flipped">
      <div id="divLoading">
        <div>
          <img src="<?=base_url();?>Assets/images/loading.svg" alt="Loading">
        </div>
      </div>
        <form id="formCambiarPass" name="formCambiarPass" class="forget-form" autocomplete="off" action="">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $data['idpersona'];?>" required>
            <input type="hidden" id="txtEmail" name="txtEmail" value="<?= $data['email'];?>" required>
          <h3 class="login-head"><i class="fa fa-key"></i>Cambiar contraseña</h3>
          <div class="form-group">
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Nueva contraseña" autocomplete="new-password" required>
          </div>
          <div class="form-group">
            <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="Confirmar contraseña" required>
          </div>
          <div class="form-group btn-container">
            <button type= "submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
         
        </form>
      </div>
    </section>

    <script>
      const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?=base_url();?>Assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url();?>Assets/js/popper.min.js"></script>
    <script src="<?=base_url();?>Assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>Assets/js/main.js"></script>
    <script src="<?=base_url();?>Assets/js/fontawesome.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url();?>Assets/js/plugins/pace.min.js"></script>
    <script src="<?=base_url();?>Assets/js/plugins/sweetalert.min.js"></script>
    <script src="<?=base_url();?>Assets/js/<?= $data['page_functions_js'] ?>"></script>
  </body>
</html>