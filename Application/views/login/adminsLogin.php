<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=PLUGINS_PATH?>/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=PLUGINS_PATH?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=CSS_PATH?>/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->

  <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg">Giriş yapmak için lütfen email ve şifrenizi giriniz.</p>
        <form action="<?=SITE_URL?>/login/adminLogin" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Şifre" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-12">
            <a href="<?=SITE_URL?>/forgetPassword/adminForget"><button type="submit" class="btn btn-danger btn-block">Şifremi Unuttum</button></a>
        </div>
        </div>
    </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=PLUGINS_PATH?>/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=PLUGINS_PATH?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=JS_PATH?>/js/adminlte.min.js"></script>
</body>
</html>
