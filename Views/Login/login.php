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
        <h1>Gestión de la Innovación</h1>
      </div>
        <div><img style="align-items: center;" src="https://www.atlanticaagricola.com/layout/frontend/themes/atlanticaagricola/images/logo.png" alt=""></div>  
      <div class="login-box">
      <div id="divLoading">
        <div>
          <img src="<?=base_url();?>Assets/images/loading.svg" alt="Loading">
        </div>
      </div>
        <form class="login-form" name="formLogin" id="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Iniciar Sesión</h3>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="text" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input id="txtPassword" name="txtPassword" class="form-control" autocomplete = "new-password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
            </div>
          </div>
          <div id="alertlogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>INICIAR SESIÓN</button>
          </div>
        </form>

        <form id="formResetPass" name="formResetPass" class="forget-form" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste tu contraseña?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type= "submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
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