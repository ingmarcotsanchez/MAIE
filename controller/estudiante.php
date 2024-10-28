<?php
    require_once("../config/conexion.php");
    require_once("../models/Estudiante.php");
    $estudiante = new Estudiante();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["est_id"])){
                    $estudiante->insert_estudiante($_POST["est_dni"],$_POST["est_tipo"],$_POST["est_cedula"],$_POST["est_nom"],$_POST["est_ape"],$_POST["est_fecnac"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_telf"],$_POST["est_estado"]);
                }else{
                    $estudiante->update_estudiante($_POST["est_id"],$_POST["est_dni"],$_POST["est_tipo"],$_POST["est_cedula"],$_POST["est_nom"],$_POST["est_ape"],$_POST["est_fecnac"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_telf"],$_POST["est_estado"]);
                }
                break;
        case "mostrar":
                $datos = $estudiante->estudiantes_id($_POST["est_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["est_id"] = $row["est_id"];
                        $output["est_dni"] = $row["est_dni"];
                        $output["est_tipo"] = $row["est_tipo"];
                        $output["est_cedula"] = $row["est_cedula"];
                        $output["est_nom"] = $row["est_nom"];
                        $output["est_apep"] = $row["est_apep"];
                        $output["est_apem"] = $row["est_apem"];
                        $output["est_fecnac"] = $row["est_fecnac"];
                        $output["est_correo"] = $row["est_correo"];
                        $output["est_sex"] = $row["est_sex"];
                        $output["est_telf"] = $row["est_telf"];
                        $output["est_estado"] = $row["est_estado"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $estudiante->delete_estudiante($_POST["est_id"]);
                break;
        case "listar":
                $datos=$estudiante->estudiantes();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_dni"];
                    $sub_array[] = $row["est_tipo"] ." ". $row["est_cedula"];
                    $sub_array[] = $row["est_nom"] ." ". $row["est_ape"];
                    $sub_array[] = $row["est_fecnac"];
                    $sub_array[] = $row["est_correo"];
                    if($row["est_sex"] == 'M'){
                        $sub_array[] = "Masculino";
                    }else{
                        $sub_array[] = "Femenino";
                    }
                    $sub_array[] = $row["est_telf"];
                    
                    if($row["est_estado"] == 0){
                        $sub_array[] = "<p style='color:#28a745'>Activo</p>";
                    }else if($row["est_estado"] == 1){
                        $sub_array[] = "<p style='color:#ffc107'>Compromiso</p>";
                    }else if($row["est_estado"] == 2){
                        $sub_array[] = "<p style='color:#007bff'>Perdida Académica</p>";
                    }else{
                        $sub_array[] = "<p style='color:#dc3545'>Desertor</p>";
                    }
                
                    $sub_array[] = '<button type="button" onClick="editar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-warning btn-sm btn-icon"><i class="fa fa-edit"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-danger btn-sm btn-iconn"><i class="fa fa-trash"></i></button>';
                    
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
        case "combo":
            $datos=$estudiante->estudiantes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['est_id']."'>".$row['est_dni']." - ".$row['est_nom']." ".$row['est_ape']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $estudiante->insert_estudiante($_POST["est_dni"],$_POST["est_tipo"],$_POST["est_cedula"],$_POST["est_nom"],$_POST["est_ape"],$_POST["est_fecnac"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_telf"],$_POST["est_estado"]);
            break;
        
        
            
     
    }
?>