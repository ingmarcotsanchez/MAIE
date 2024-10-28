<?php
   require_once("config/conexion.php");
   if(isset($_POST["enviar"]) and $_POST["enviar"] == "ok"){
      require_once("models/Usuarios.php");
      $usuario = new Usuario();
      $usuario->recuperar();
      $usu_cor = $usuario->usuario_correo($_POST['cedula']);
   }
?>

<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="public/login/style.css">
      <title>Saber Pro</title>
   </head>
   <body>
      <div class="login">
         <img src="public/img/login-bg.png" alt="login image" class="login__img">
         <form method="POST" class="login__form">
         <?php
          if(isset($_GET["m"])){
            switch($_GET["m"]){
                case "1";
                    ?>
                    <div class="alert alert-danger" role="alert">
                    La cédula ingresada NO Existe!
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
                    No ha ingresado una cédula!
                    </div>
                    <?php
                    break;
            }
          }
        ?>
            <h1 class="login__title">Recuperar Contraseña</h1>
            <div class="login__content">
               <div class="login__box">
                  <i class='bx bxs-user'></i>
                  <div class="login__box-input">
                     <input type="text" class="login__input" id="login-email" name="email" placeholder="">
                     <label for="login-email" class="login__label">Cédula</label>
                  </div>
               </div>
            </div>
            <input type="hidden" name="enviar" value="ok">
            <button type="submit" class="login__button miBtn" id="btnRecuperar">Recuperar clave</button>
            <div class="sec_btn">
              <a href="index.php" class="login__clave">Iniciar sesión</a> 
            </div>
            
         </form>
         
      </div>
   </body>
</html>