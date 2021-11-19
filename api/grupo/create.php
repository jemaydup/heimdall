<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/grupo.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Grupo($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->Nombre_grupo = $data->Nombre_grupo;
    $item->RP = $data->RP;
    $item->Activo = $data->Activo;
    $item->IDGrupo = $data->deIDGruposignation;
  
    
    if($item->createGdA_Grupo()){
        echo 'Grupo created successfully.';
    } else{
        echo 'Grupo could not be created.';
    }
?>