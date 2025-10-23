<?php
$titulo="Seguimiento a Estudiantes";
define("URL","/MAIE/views/");
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión MAIE</title>
    <?php require_once("modulos/head.php"); ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
    <?php require_once("modulos/header.php");?>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../public/img/logo.png" alt="Logo UMD" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MAIE</span>
    </a>
    <div class="sidebar">
      <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"]; ?>">
      <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["usu_rol"]; ?>">
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


    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle del seguimiento: ID-<strong id="remision_id"></strong></h3>
                    <span class="float-right ml-2" id="estado"></span><div class="btn btn-light btn-sm float-right"><span class="" id="fech_crea"></span>&nbsp;<span class="" id="estadospan"></span></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cen_id">Centro de Operaciones</label>
                                <input type="text" class="form-control" name="cen_id" id="cen_id" placeholder="cen_id" readonly>
                            </div>
                        </div>
                    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prog_id">Programa</label>
                                <input type="text" class="form-control" name="prog_id" id="prog_id" placeholder="prog_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="prog_id" id="prog_id" data-placeholder="Seleccione" onchange="combo_estudiantes()">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="est_id">ID Estudiante</label>
                                <input type="text" class="form-control" name="est_id" id="est_id" placeholder="est_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="est_id" id="est_id" data-placeholder="Seleccione">                                
                                    <option label="Seleccione"></option>
                                </select> -->
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mod_id">Modalidad</label>
                                <input type="text" class="form-control" name="mod_id" id="mod_id" placeholder="mod_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="mod_id" id="mod_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        
                   
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jor_id">Jornada</label>
                                <input type="text" class="form-control" name="jor_id" id="jor_id" placeholder="jor_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="jor_id" id="jor_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label for="seme_id">Semestre</label>
                                <input type="text" class="form-control" name="seme_id" id="seme_id" placeholder="seme_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="seme_id" id="seme_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tipaco_id">Tipo de Acompañamiento</label>
                                <input type="text" class="form-control" name="tipaco_id" id="tipaco_id" placeholder="tipaco_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="tipaco_id" id="tipaco_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_id">Asignatura</label>
                                <input type="text" class="form-control" name="asig_id" id="asig_id" placeholder="asig_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="asig_id" id="asig_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nec_id">Necesidades especiales</label>
                                <input type="text" class="form-control" name="nec_id" id="nec_id" placeholder="cen_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="nec_id" id="nec_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_id">Profesor que reporta</label>
                                <input type="text" class="form-control" name="cen_id" id="prof_id" placeholder="prof_id" readonly>
                                <!-- <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="tick_titulo">Documentos Adjuntos</label>
                                <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                    <tr>
                                        <th style="width: 90%;">Nombre</th>
                                        <th class="text-center" style="width: 10%;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="remision_mens">Breve descripción del Acompañamiento</label>
                            <textarea id="remision_mens"name="remision_mens" readonly>
                            
                            </textarea>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" id="Detalle_ticket">
                    
                </div>
            </div>
        </div>
    </section>
    <section class="content" id="panel_detalle">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Enviar una respuesta</h3>
                </div>
                <form method="post" id="ticket_form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <textarea id="seg_descripcion" name="seg_descripcion">
                                
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnEnviarTicket" class="btn btn-info float-right">Enviar</button>
                        <button type="button" id="btnCerrarTicket" class="btn btn-danger float-left">Cerrar Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/admSeguimientos.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
