<?php
include 'functions.php';
//if(empty($_SESSION[login]))
//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="favicon.ico" />

  <title>Source Code Forecasting SES</title>
  <link href="assets/css/united-bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/general.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="?">Forecasting SES TM</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <?php if ($_SESSION['login']) : ?>
            <li><a href="?m=jenis"><span class="glyphicon glyphicon-th-large"></span> Jenis</a></li>
            <li><a href="?m=periode"><span class="glyphicon glyphicon-calendar"></span> Periode</a></li>
            <li><a href="?m=ses"><span class="glyphicon glyphicon-signal"></span> SES</a></li>
            <li><a href="?m=tm"><span class="glyphicon glyphicon-signal"></span> TM</a></li>
            <li><a href="?m=Perbandingan"><span class="glyphicon glyphicon-signal"></span> Perbandingan</a></li>
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          <?php else : ?>
            <li><a href="?m=ses"><span class="glyphicon glyphicon-signal"></span> SES</a></li>
            <li><a href="?m=tm"><span class="glyphicon glyphicon-signal"></span> TM</a></li>
            <li><a href="?m=Perbandingan"><span class="glyphicon glyphicon-signal"></span> Perbandingan</a></li>
            <li><a href="?m=tentang"><span class="glyphicon glyphicon-info-sign"></span> Tentang</a></li>
            <li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php
    if (!$_SESSION['login'] && !in_array($mod, array('', 'home', 'ses', 'tm', 'login', 'tentang')))
      $mod = 'login';

    if (file_exists($mod . '.php'))
      include $mod . '.php';
    else
      include 'home.php';
    ?>
  </div>
  <footer class="footer bg-primary">
    <div class="container">
      <p>Solee.Co Store &copy; <?= date('Y') ?> <em class="pull-right">Updated 28 September 2020</em></p>
    </div>
  </footer>
  <script type="text/javascript">
    $('.form-control').attr('autocomplete', 'off');
  </script>
</body>

</html>
