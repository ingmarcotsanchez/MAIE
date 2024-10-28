<?php
    require_once("../config/conexion.php");
    require_once("../models/Necesidades.php");
    $necesidades = new Necesidades();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["nec_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $necesidades->insert_necesidades($_POST["nec_nombre"]);
                }else{
                    $necesidades->update_necesidades($_POST["nec_id"], $_POST["nec_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $necesidades->necesidades_id($_POST["nec_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["nec_id"] = $row["nec_id"];
                        $output["nec_nombre"] = $row["nec_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $necesidades->delete_necesidades($_POST["nec_id"]);
                break;
        case "listar":
                $datos=$necesidades->necesidades();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["nec_nombre"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["nec_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["nec_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-sm btn-icon" onClick="editar('.$row["nec_id"].')" id="'.$row["nec_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-sm btn-icon" onClick="eliminar('.$row["nec_id"].')" id="'.$row["nec_id"].'"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$necesidades->necesidades();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['nec_id']."'>".$row['nec_nombre']."</option>";
                }
                echo $html;
            }
            break;
            case "activo":
                $necesidades->update_estadoActivo($_POST["nec_id"]);
                break;
            case "inactivo":
                $necesidades->update_estadoInactivo($_POST["nec_id"]);
                break; 
            
     
    }
?>