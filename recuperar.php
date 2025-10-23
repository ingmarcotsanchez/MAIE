<?php
  /*TODO: Llamando Cadena de Conexion */
  require_once("config/conexion.php");

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuarios.php");
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
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="public/css/login.css">
      <title>::MAIE::</title>
   </head>
   <body>
      <div class="container">
        <div class="form-box login">
            <form method="POST">
               <?php
                  if(isset($_GET["m"])){
                     switch($_GET["m"]){
                        case "1":
                           ?>
                           <div class="alert text-danger" role="alert">
                           El correo ingresado NO Existe!
                           </div>
                           <?php
                           break;
                        case "2":
                           ?>
                           <div class="alert alert-success" role="alert" id="pass">
                           Su clave temporal es <strong id="usu_pass"><?php echo $_GET["nc"]; ?></strong>
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
               <h1>Login</h1>
               <div class="input-box">
                  <input type="text" id="correo" name="correo" placeholder="ingrese su correo electrónico"></input>
                  <i class='bx bx-envelope'></i>
               </div>
               
               <div class="forgot-link">
                  <a href="index.php">Iniciar Sesión</a>
               </div>
               <input type="hidden" name="enviar" value="si">
               <button type="submit" class="btn miBtn" id="btnRecuperar">Recuperar contraseña</button>
            </form>
         </div>
         <div class="form-box register">
               
         </div>
         <div class="toggle-box">
            <div class="toggle-panel toggle-left">
               <h3>Bienvenido a MAIE</h3>
               <p>Esta herramienta esta diseñada para apoyar el seguimiento de estudiantes con bajo rendimiento o dificultades financieras y psicosociales. Tu aporte como docente es clave para identificar y acompañar oportunamente a queines más lo necesitan.
                  Con MAIE, juntos fortalecemos el camino académico de nuestros estudiantes.
               </p>
               <img src="public/img/logo-para-web-2024.png" alt="">
            </div>
         </div>
      </div>
      <script src="views/js/reset.js"></script>
   </body>
</html>