
<?php
  /*TODO: Llamando Cadena de Conexion */
  require_once("config/conexion.php");

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    /*TODO: Inicializando Clase */
    
    /* var_dump($usu_cor['usu_pass']); */
    $usuario = new Usuario();
    $usuario->recuperar();
    $usu_cor = $usuario->usuario_correo($_POST['correo']);
   
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMON | RESET</title>
  <link rel="icon" href="/ISUM/public/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="html/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="html/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="html/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>ADMINISTRACION</b></a>
    </div>
    <div class="card-body">
      <form method="post">
      
        <?php
          if(isset($_GET["m"])){
            switch($_GET["m"]){
                case "1";
                    ?>
                    <div class="alert alert-danger" role="alert">
                    El correo ingresado NO Existe!
                    </div>
                    <?php
                    break;
                case "2";
                    ?>
                    
                    <div class="alert alert-success" role="alert" id="pass">
                    Su clave temporal es <strong id="usu_pass"><?php echo $_GET["nc"]; ?></strong> <!-- 756342908 -->
                    </div>
                    
                    <?php
                    break;
                case "3";
                    ?>
                    <div class="alert alert-warning" role="alert">
                    No ha ingresado un correo!
                    </div>
                    <?php
                    break;
            }
          }
        ?>
        <div class="input-group mb-3">
          <input type="email" name="correo" id="correo" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="hidden" name="enviar" class="form-control" value="si">
            <button type="submit" class="btn btn-primary btn-block miBtn" id="btnRecuperar">Recuperar clave</button>
          </div>
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="index.php">Ingresar</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="html/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="html/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="html/dist/js/adminlte.min.js"></script>

 <script src="views/js/reset.js"></script>
</body>
</html>
