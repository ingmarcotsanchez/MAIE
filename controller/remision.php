<?php
    require_once("../config/conexion.php");
    require_once("../models/Remision.php");
    $remision = new Remision();
    require_once("../models/Usuarios.php");
    $usuario = new Usuario();
    require_once("../models/Documento.php");
    $documento = new Documento();
    $usu_rol = $_SESSION["usu_rol"];
    $usu_id = $_SESSION["usu_id"];
    

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["remision_id"])){
                $remision->insert_remision($_POST["est_id"],$_POST["mod_id"],$_POST["jor_id"],$_POST["cen_id"],$_POST["prog_id"],$_POST["seme_id"],$_POST["tipaco_id"],$_POST["asig_id"],$_POST["nec_id"],$_POST["prof_id"],$_POST["remision_mens"],$usu_id);
                if (is_array($remision)==true and count($remision)>0){
                    foreach ($remision as $row){
                        $output["tick_id"] = $row["remision_id"];
                        if (empty($_FILES['files']['name'])){
    
                        }else{
                            $countfiles = count($_FILES['files']['name']);
                            $ruta = "../document/seguimientos/".$output["remision_id"]."/";
                            $files_arr = array();
    
                            if (!file_exists($ruta)) {
                                mkdir($ruta, 0777, true);
                            }
    
                            for ($index = 0; $index < $countfiles; $index++) {
                                $doc1 = $_FILES['files']['tmp_name'][$index];
                                $destino = $ruta.$_FILES['files']['name'][$index];
                                $documento->insert_documento( $output["tick_id"],$_FILES['files']['name'][$index]);
                                move_uploaded_file($doc1,$destino);
                            }
                        }
                    }
                }
                echo json_encode($remision);
            }else{
                $remision->update_remision($_POST["remision_id"],$_POST["est_id"],$_POST["mod_id"],$_POST["jor_id"],$_POST["cen_id"],$_POST["prog_id"],$_POST["seme_id"],$_POST["tipaco_id"],$_POST["asig_id"],$_POST["nec_id"],$_POST["prof_id"],$_POST["remision_mens"]);
            }
            break;
        case "insertdetalle":
            $remision->insert_ticketdetalle($_POST["remision_id"],$_POST["usu_id"],$_POST["seg_descripcion"]);
            break;
        case "mostrar":
            
            $datos = $remision->remisiones_id($_POST["remision_id"]);
            //var_dump($datos);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["remision_id"] = $row["remision_id"];
                    $output["est_id"] = $row["est_id"];
                    $output["mod_id"] = $row["mod_id"];
                    $output["jor_id"] = $row["jor_id"];
                    $output["cen_id"] = $row["cen_id"];
                    $output["prog_id"] = $row["prog_id"];
                    $output["seme_id"] = $row["seme_id"];
                    $output["tipaco_id"] = $row["tipaco_id"];
                    $output["asig_id"] = $row["asig_id"];
                    $output["nec_id"] = $row["nec_id"];
                    $output["prof_id"] = $row["prof_id"];
                    $output["remision_mens"] = $row["remision_mens"];
                    $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    if ($row["estado"]=="Abierto"){
                        $output["estado"] = '<span class="btn btn-sm btn-success">Abierto</span>';
                    }else{
                        $output["estado"] = '<span class="btn btn-sm btn-danger">Cerrado</span>';
                    }

                    $output["tick_estado_texto"] = $row["estado"];

                    if ($row["fech_cierre"]==NULL){
                        $output["fech_cierre"] = "Sin cerrar";
                    }else{
                        $output["fech_cierre"] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                    }
                    //
                    //$output["usu_nom"] = $row["usu_nom"];
                    //$output["usu_ape"] = $row["usu_ape"];
                }
                echo json_encode($output);
            }
            break;
        case "listardetalle":
            $datos=$remision->listar_ticketdetalle_x_ticket($_POST["remision_id"]);
            ?>
            <?php foreach($datos as $row): ?>
                <div class="timeline" id="DtlleTicket">
        
                    <div class="time-label">
                        <span class="bg-dark"><?php echo date("d/m/Y", strtotime($row["fech_crea"]));?></span>
                    </div>
    
                    <div>
                        <?php if ($row['usu_rol']=="P"): ?>
                        <i class="fas fa-user bg-blue"></i>
                        <?php else: ?>
                        <i class="fas fa-user bg-info"></i>
                        <?php endif; ?>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> <?php echo date("H:i:s", strtotime($row["fech_crea"]));?></span>
                            <h3 class="timeline-header"><a href="#"><?php 
                                        if ($row['usu_rol']=="P"){
                                        echo 'Profesor';
                                    }else{
                                        echo 'Gestor MAIE';
                                    } 
                                ?>:</a> <?php echo $row['usu_nom'].' '.$row['usu_ape'];?></h3>

                            <div class="timeline-body">
                                <?php echo $row["seg_descripcion"];?>
                            </div>

                        </div>
                    </div>
                
                <div>     
            <?php endforeach;?>
            <?php
            break;
        case "eliminar":
            $remision->delete_remision($_POST["remision_id"]);
            break;
        case "update":
            $remision->update_ticket($_POST["remision_id"]);
            $remision->insert_ticketdetalle_cerrar($_POST["remision_id"],$_POST["usu_id"]);
            break;
        case "listar":
                $datos=$remision->remisiones();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_dni"]."-". $row["est_nom"]." ". $row["est_ape"];
                 
                    $sub_array[] = $row["asig_nom"];
                    $sub_array[] = $row["tipaco_nombre"];
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));

                    if ($row["estado"]=="Abierto"){
                        $sub_array[] = '<strong class="text-success">Abierto</strong>';
                    }else{
                        $sub_array[] = '<a class="btn btn-sm btn-danger" onClick="CambiarEstado('.$row["remision_id"].')">Cerrado</a>';
                    }
                    if($row["fech_cierre"]==null){
                        $sub_array[] = '<strong class="text-dark">Sin Cerrar</strong>';
                    }else{
                        $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                    }
                
                    if($usu_rol == 'GM'){
                        $sub_array[] = '<button disabled type="button" onClick="editar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-warning btn-sm btn-icon"><i class="fa fa-edit"></i></button>';
                        $sub_array[] = '<button disabled type="button" onClick="eliminar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-danger btn-sm btn-iconn"><i class="fa fa-trash"></i></button>';
                        $sub_array[] = '<button type="button" onClick="seguimiento('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-success btn-icon btn-sm"><div><i class="fa fa-eye"></i></div></button>';
                    }elseif($usu_rol == 'C'){
                        $sub_array[] = '<button type="button" onClick="editar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-warning btn-sm btn-icon"><i class="fa fa-edit"></i></button>';
                        $sub_array[] = '<button type="button" onClick="eliminar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-danger btn-sm btn-iconn"><i class="fa fa-trash"></i></button>';
                        $sub_array[] = '<button type="button" onClick="seguimiento('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-success btn-icon btn-sm"><div><i class="fa fa-eye"></i></div></button>';
                    }else { 
                        $sub_array[] = '<button type="button" onClick="editar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-warning btn-sm btn-icon"><i class="fa fa-edit"></i></button>';
                        $sub_array[] = '<button disabled type="button" onClick="eliminar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-danger btn-sm btn-iconn"><i class="fa fa-trash"></i></button>';
                        $sub_array[] = '<button type="button" onClick="seguimiento('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-success btn-icon btn-sm"><div><i class="fa fa-eye"></i></div></button>';
                    } 
                    
                    
                    
                    $data[] = $sub_array;
                }
                /*Formato del datatable, se usa siempre*/
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
        case "mostrar":
            
            $datos = $remision->remisiones_id($_POST["remision_id"]);
            //var_dump($datos);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["remision_id"] = $row["remision_id"];
                    $output["est_id"] = $row["est_id"];
                    $output["mod_id"] = $row["mod_id"];
                    $output["jor_id"] = $row["jor_id"];
                    $output["cen_id"] = $row["cen_id"];
                    $output["prog_id"] = $row["prog_id"];
                    $output["seme_id"] = $row["seme_id"];
                    $output["tipaco_id"] = $row["tipaco_id"];
                    $output["asig_id"] = $row["asig_id"];
                    $output["nec_id"] = $row["nec_id"];
                    $output["prof_id"] = $row["prof_id"];
                    $output["remision_mens"] = $row["remision_mens"];
                    $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    if ($row["estado"]=="Abierto"){
                        $output["estado"] = '<span class="btn btn-sm btn-success">Abierto</span>';
                    }else{
                        $output["estado"] = '<span class="btn btn-sm btn-danger">Cerrado</span>';
                    }

                    $output["tick_estado_texto"] = $row["estado"];

                    if ($row["fech_cierre"]==NULL){
                        $output["fech_cierre"] = "Sin cerrar";
                    }else{
                        $output["fech_cierre"] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                    }
                    //
                    //$output["usu_nom"] = $row["usu_nom"];
                    //$output["usu_ape"] = $row["usu_ape"];
                }
                echo json_encode($output);
            }
            break;

            case "mostrarDetalles":
            
                $datos = $remision->remisiones_idDetalles($_POST["remision_id"]);
                //var_dump($datos);
                if(is_array($datos)==true and count($datos)<>0){                    
                    echo json_encode($datos);
                    //echo json_encode($output);
                }
                break;
    }
?>