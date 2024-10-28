<?php
    require_once("../config/conexion.php");
    require_once("../models/Tipos.php");
    $tipoAcompanamiento = new Tipos();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["tipaco_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $tipoAcompanamiento->insert_tipoAcompanamiento($_POST["tipaco_nombre"]);
                }else{
                    $tipoAcompanamiento->update_tipoAcompanamiento($_POST["tipaco_id"], $_POST["tipaco_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $tipoAcompanamiento->tipoAcompanamiento_id($_POST["tipaco_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["tipaco_id"] = $row["tipaco_id"];
                        $output["tipaco_nombre"] = $row["tipaco_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $tipoAcompanamiento->delete_tipoAcompanamiento($_POST["tipaco_id"]);
                break;
        case "listar":
                $datos=$tipoAcompanamiento->tipoAcompanamiento();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["tipaco_nombre"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["tipaco_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["tipaco_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-sm btn-icon" onClick="editar('.$row["tipaco_id"].')" id="'.$row["tipaco_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-sm btn-icon" onClick="eliminar('.$row["tipaco_id"].')" id="'.$row["tipaco_id"].'"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$tipoAcompanamiento->tipoAcompanamiento();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['tipaco_id']."'>".$row['tipaco_nombre']."</option>";
                }
                echo $html;
            }
            break;
            case "activo":
                $tipoAcompanamiento->update_estadoActivo($_POST["tipaco_id"]);
                break;
            case "inactivo":
                $tipoAcompanamiento->update_estadoInactivo($_POST["tipaco_id"]);
                break; 
            
     
    }
?>