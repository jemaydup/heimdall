<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/grupo.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new GdA_Grupo($db);

    $stmt = $items->getGdA_Grupos();
    $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $GdA_GrupoArr = array();
        $GdA_GrupoArr["body"] = array();
        #$GdA_GrupoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "IDGrupo" => $IDGrupo,
                "Nombre_grupo" => $Nombre_grupo,
                "RP" => $RP,
                "Activo" => $Activo
            );

            array_push($GdA_GrupoArr["body"], $e);
        }
        echo json_encode($GdA_GrupoArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>