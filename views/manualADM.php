<?php 
  $titulo="Manual de Usuario";
  define("URL","/saber/views/");
  require_once("../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Software Saber Pro</title>
  <?php require_once("modulos/head.php"); ?>
  <link rel="stylesheet" href="../css/manual.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php require_once("modulos/header.php");?>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../public/img/logo.png" alt="Logo UMD" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SaberPro</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../public/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"]; ?>">
          <a href="#" class="d-block text-orange"><?php echo $_SESSION["nombre"];?></a>
        </div>
      </div>
      
      <nav class="mt-2">
        <?php require_once("modulos/menu.php");?>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 bg-white p-4">
          <div class="col-sm-6">
            <h1><?php echo $titulo; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="text-orange">Inicio</a></li>
              <li class="breadcrumb-item active"><?php echo $titulo; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="box">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid" style="padding: 20px;">
                <div class="box-header with-border">
                  <h3 class="box-title text-title">Rol Administrador</h3>
                </div>
                <div class="box-body">
                  <div class="accordion">
                    <h5 class="text-subtitle">Sección Parametrización</h5>
                    <div class="accordion-item">
                      <button id="accordion-button-1" aria-expanded="false">
                          <span class="accordion-title">Botones generales de la plataforma</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <div style="display:flex; flex-direction:row;">
                            <p>En todas las opciones podemos encontrar botones generales que ayudan al funcionamiento de nuestra plataforma.
                          Entre ellos esta el botón de editar.</p><img class="btn" src="manual/editar.png">
                          </div>
                          <div style="display:flex; flex-direction:row;">
                            <p>Tambien encontramos el botón de eliminar.</p><img class="btn" src="manual/eliminar.png">
                          </div>
                          <div style="display:flex; flex-direction:row;">
                            <p>Tambien encontramos el botón de crear.</p><img class="btn2" src="manual/crear.png">
                          </div>
                          <div style="display:flex; flex-direction:row;">
                            <p>Tambien encontramos ayudas para generar reportes en formato de excel o csv.</p><img class="btn3" src="manual/reporte.png">
                          </div>
                          <div style="display:flex; flex-direction:row;">
                            <p>Tambien encontramos el botón de vista el cual amplia la información.</p><img class="btn" src="manual/vista.png">
                          </div>
                          
                          
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-1" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Usuarios?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Usuarios podemos visualizar la información más importante
                              de los usuarios creados en nuestra plataforma. Cómo lo son nombres, usuario, perifl, programa al que pertenece y su estado.</p>
                          <img src="manual/usuario_index.png">
                          <p>Para crear un usuario nuevo oprimimos el botón ubicado en 
                              la esquina superior izquierda el cual desplegará un formulario con los datos
                                  obligatorios para su creación.</p>
                          <img src="manual/usuario_nuevo.png">
                          <p>Podemos desactivar usuarios oprimiendo el botón verde que se encuentra en cada 
                              registro. Si un usuario no esta activo este no puede ingresar a la plataforma.</p>
                          <img src="manual/usuario_desactivado.png">
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-2" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Centros?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a esta opción podemos visualizar los Centros Regionales que han sido
                              creados en nuestro sistema.</p>
                          <img src="manual/centros_index.png">
                          <p>Para adicionar un Centro Regional oprimimos el botón ubicado en la 
                          esquina superior izquierda el cual desplegará un formulario con los datos
                          obligatorios para su creación.</p>
                          <img src="manual/centros_nuevo.png">
                          <p>Podemos desactivar centros regionales oprimiendo el botón verde que se encuentra en cada 
                              registro. Si un centro no esta activo este no puede relacionarse en las demas opciones en la plataforma.</p>
                          <img src="manual/centros_desactivado.png">
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-3" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Programas?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Programas podemos visualizar la información de los programas
                              registrados en nuestra plataforma, como lo es el codigo, su descripción y el centro educativo al que pertenece.</p>
                          <img src="manual/programas_index.png">
                          <p>Para adicionar un Programa oprimimos el botón ubicado en la 
                          esquina superior izquierda el cual desplegará un formulario con los datos
                          obligatorios para su creación</p>
                          <img src="manual/programas_nuevo.png">
                          
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-4" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Competencias?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Competencias podemos visualizar la información general de la competencia junto a su estado.</p>
                          <img src="manual/competencia_index.png">
                          <p>Para crear un registro nuevo oprimimos el botón ubicado en 
                              la esquina superior izquierda el cual desplegará un formulario con los datos
                                  obligatorios para su creación.</p>
                          <img src="manual/competencia_nuevo.png">
                          <p>Podemos desactivar una competencia oprimiendo el botón verde que se encuentra en cada 
                              registro. Si no esta activo este no puede referenciarse en el resto de opciones de la plataforma.</p>
                          <img src="manual/competencia_desactivado.png">
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-6" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Módulos?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Sub Competencias podemos visualizar la información registrada anteriormente
                          en nnuestra plataforma.</p>
                          <img src="manual/modulos_index.png">
                          <p>Para adicionar un módulo oprimimos el botón ubicado en la 
                          esquina superior izquierda el cual desplegará un formulario con los datos
                          obligatorios para su creación.</p>
                          <img src="manual/modulos_nuevo.png">
                          <p>Podemos desactivar los módulos oprimiendo el botón verde que se encuentra en cada 
                              registro. Si un módulo no esta activo este no puede relacionarse en las demas opciones en la plataforma.</p>
                          <img src="manual/modulos_desactivado.png">
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-6" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Puntaje Módulos?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Sub Competencias podemos visualizar la información registrada anteriormente
                          en nnuestra plataforma.</p>
                          <img src="manual/puntajemodulos_index.png">
                          <p>Para adicionar un módulo oprimimos el botón ubicado en la 
                          esquina superior izquierda el cual desplegará un formulario con los datos
                          obligatorios para su creación.</p>
                          <img src="manual/puntajemodulos_nuevo.png">
                          <p>Podemos ampliar la información oprimiendo el botón de vista el cual abrira una nueva ventana con toda la información.</p>
                          <img src="manual/puntajemodulos_detalle.png">
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-6" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Sub Competencias?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Sub Competencias podemos visualizar la información registrada anteriormente
                          en nnuestra plataforma.</p>
                          <img src="manual/competencias_index.png">
                          <p>Para adicionar una Sub Competencia oprimimos el botón ubicado en la 
                          esquina superior izquierda el cual desplegará un formulario con los datos
                          obligatorios para su creación.</p>
                          <img src="manual/competencias_nuevo.png">
                          <p>Podemos desactivar una competencia oprimiendo el botón verde que se encuentra en cada 
                              registro. Si no esta activo este no puede referenciarse en el resto de opciones de la plataforma.</p>
                          <img src="manual/competencias_desactivado.png">
                      </div>
                    </div>
                    <br>
                    <h5 class="text-subtitle">Sección Ejecución</h5>
                    <div class="accordion-item">
                      <button id="accordion-button-5" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Pruebas?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción de Pruebas podemos visualizar la información registrada anteriormente
                          en nnuestra plataforma.</p>
                          <img src="vistas/img/manual/programas_index.png">
                          <p>Para adicionar una Prueba oprimimos el botón azul ubicado en la 
                          esquina superior izquierda el cual desplegará un formulario con los datos
                          obligatorios para su creación.</p>
                          <img src="vistas/img/manual/programas_nuevo.png">
                          <p>Para crear una prueba debemos seleccionar la competencia a la que pertenece la prueba y
                                  automaticamente la plataforma le otorgará un consecutivo.</p>
                          <img src="vistas/img/manual/programas_nuevo2.png">
                      </div>
                    </div>
                    
                    <div class="accordion-item">
                      <button id="accordion-button-7" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Competencias?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción podemos visualizar la información registrada anteriormente por los profesores
                          en nuestra plataforma.</p>
                          <img src="manual/puntaje_competencia_index.png">
                          <p>Como administradores solo podemos eliminar o modificar los registros previamente adicionados.</p> 
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-7" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Resultados?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción podemos visualizar la información registrada anteriormente por los profesores
                          en nuestra plataforma.</p>
                          <img src="manual/puntaje_resultados_index.png">
                          <p>Como administradores solo podemos eliminar o modificar los registros previamente adicionados.</p> 
                      </div>
                    </div>
                    <div class="accordion-item">
                      <button id="accordion-button-7" aria-expanded="false">
                          <span class="accordion-title">Qué puedo hacer en la opción de Mejoras?</span>
                          <span class="icon" aria-hidden="true"></span>
                      </button>
                      <div class="accordion-content">
                          <p>Al ingresar a la opción podemos visualizar la información registrada anteriormente por los profesores
                          en nuestra plataforma.</p>
                          <img src="manual/puntaje_mejoras_index.png">
                          <p>Como administradores solo podemos eliminar o modificar los registros previamente adicionados.</p> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php require_once("modulos/js.php");?>
<script src="../Js/script.js"></script>
</body>
</html>
<?php
  }else{
    header("Location:".Conectar::ruta()."views/404.php");
  }
?>