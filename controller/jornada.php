<?php
    require_once("../config/conexion.php");
    require_once("../models/Jornada.php");
    $jornada = new Jornada();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["jor_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $jornada->insert_jornada($_POST["jor_nombre"]);
                }else{
                    $jornada->update_jornada($_POST["jor_id"], $_POST["jor_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $jornada->jornada_id($_POST["jor_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["jor_id"] = $row["jor_id"];
                        $output["jor_nombre"] = $row["jor_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $jornada->delete_jornada($_POST["jor_id"]);
                break;
        case "listar":
                $datos=$jornada->jornada();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["jor_nombre"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["jor_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["jor_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-sm btn-icon" onClick="editar('.$row["jor_id"].')" id="'.$row["jor_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-sm btn-icon" onClick="eliminar('.$row["jor_id"].')" id="'.$row["jor_id"].'"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$jornada->jornada();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['jor_id']."'>".$row['jor_nombre']."</option>";
                }
                echo $html;
            }
            break;
            case "activo":
                $jornada->update_estadoActivo($_POST["jor_id"]);
                break;
            case "inactivo":
                $jornada->update_estadoInactivo($_POST["jor_id"]);
                break; 
            
     
    }
?>