<?php
    require_once("../config/conexion.php");
    require_once("../models/Remision.php");
    $remision = new Remision();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["remision_id"])){
                    $remision->insert_remision($_POST["est_id"],$_POST["mod_id"],$_POST["jor_id"],$_POST["cen_id"],$_POST["prog_id"],$_POST["seme_id"],$_POST["tipaco_id"],$_POST["asig_id"],$_POST["nec_id"],$_POST["prof_id"],$_POST["remsion_mens"]);
                }else{
                    $remision->update_remision($_POST["remision_id"],$_POST["est_id"],$_POST["mod_id"],$_POST["jor_id"],$_POST["cen_id"],$_POST["prog_id"],$_POST["seme_id"],$_POST["tipaco_id"],$_POST["asig_id"],$_POST["nec_id"],$_POST["prof_id"],$_POST["remsion_mens"]);
                }
                break;
        case "mostrar":
                $datos = $remision->remisiones_id($_POST["remision_id"]);
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
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $remision->delete_remision($_POST["remision_id"]);
                break;
        case "listar":
                $datos=$remision->remisiones();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_dni"]."-". $row["est_nom"]." ". $row["est_ape"];
                    $sub_array[] = $row["mod_nombre"];
                    $sub_array[] = $row["est_telf"];
                    $sub_array[] = $row["cen_nombre"];
                    $sub_array[] = $row["descripcion"];
                    $sub_array[] = $row["asig_nom"];
                    $sub_array[] = $row["tipaco_nombre"];
                    
                    $sub_array[] = '<button type="button" onClick="editar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-warning btn-sm btn-icon"><i class="fa fa-edit"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["remision_id"].');"  id="'.$row["remision_id"].'" class="btn btn-outline-danger btn-sm btn-iconn"><i class="fa fa-trash"></i></button>';
                    
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
    }
?>