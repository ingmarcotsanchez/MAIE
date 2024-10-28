<?php
   require_once("config/conexion.php");
   if(isset($_POST["enviar"]) and $_POST["enviar"] == "ok"){
      require_once("models/Usuarios.php");
      $usuario = new Usuario();
      $usuario->login();
      print_r($usuario);
   }
?>

<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="public/login/style.css">
      <title>::MAIE::</title>
   </head>
   <body>
      <div class="login">
         <img src="public/img/login-bg.png" alt="login image" class="login__img">
         <form method="POST" class="login__form">
         <input type="hidden" id="usu_rol" name="usu_rol" class="form-control" value="C">
            <?php
               if(isset($_GET["m"])){
                  switch($_GET["m"]){
                     case "1":
                        ?>
                        <div class="alert text-danger" role="alert">
                           Los datos ingresados son incorrectos!
                        </div>
                        <?php
                        break;
                     case "2":
                        ?>
                        <div class="alert text-warning" role="alert">
                           El formulario no puede estar vacio!
                        </div>
                        <?php
                        break;
                  }
               }
            ?>
            <h1 class="login__title">Login</h1>
            <div class="login__content">
               <div class="login__box">
                  <i class='bx bxs-user'></i>
                  <div class="login__box-input">
                     <input type="text" class="login__input" id="login-email" name="correo" placeholder=" ">
                     <label for="login-email" class="login__label">Usuario</label>
                  </div>
               </div>
               <div class="login__box">
                  <i class='bx bxs-key'></i>
                  <div class="login__box-input">
                     <input type="password" class="login__input" id="login-pass" name="passwd" placeholder=" ">
                     <label for="login-pass" class="login__label">Contraseña</label>
                  </div>
               </div>
            </div>
            <input type="hidden" name="enviar" value="ok">
            <button type="submit" class="login__button">Ingresar</button>
            <div class="sec_btn">
              <a href="recuperar.php" class="login__clave">Recuperar contraseña</a> 
            </div>
            
         </form>
         
      </div>
   </body>
</html>