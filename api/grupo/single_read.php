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

    $item = new GdA_Grupo($db);

    $item->IDGrupo = isset($_GET['IDGrupo']) ? $_GET['IDGrupo'] : die();
  
    $item->getSingleGdA_Grupo();

    if($item->Nombre_grupo != null){
        // create array
        $Grupo_arr = array(
            "IDGrupo" =>  $item->IDGrupo,
            "Nombre_grupo" => $item->Nombre_grupo,
            "RP" => $item->RP
        );
      
        http_response_code(200);
        echo json_encode($Grupo_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Grupo not found.");
    }
?>