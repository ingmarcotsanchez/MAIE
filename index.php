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
               <h1>Login</h1>
               <div class="input-box">
                  <input type="text" id="login-email" name="correo" placeholder="ingrese su correo electrónico"></input>
                  <i class='bx bx-envelope'></i>
               </div>
               <div class="input-box">
                  <input type="password" id="login-pass" name="passwd" placeholder="ingrese su contraseña"></input>
                  <i class='bx bx-lock-alt'></i>
               </div>
               <div class="input-box">
                  <select class="custom-select rounded-0" id="usu_rol" name="usu_rol">
                     <option style="color: #888;font-weight: 300;">Seleccione...</option>
                     <option value="C">Coordinador</option>
                     <option value="P">Profesor</option>
                     <option value="GM">Gestor MAIE</option>
                  </select>
                  <i class='bx bx-user'></i>
               </div>
               <div class="forgot-link">
                  <a href="recuperar.php">Olvidaste tu contraseña?</a>
               </div>
               <input type="hidden" name="enviar" value="ok">
               <button type="submit" class="btn">Iniciar Sesión</button>
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
   </body>
</html>