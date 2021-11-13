<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/persona.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Persona($db);

    $stmt = $items->getPersona();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $PersonaArr = array();
        $PersonaArr["body"] = array();
        $PersonaArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "Legajo" => $Legajo,
                "Nombre" => $Nombre,
                "Apellido" => $Apellido,
                "ANI" => $ANI,
                "Guardia" => $Guardia,
                "Password" => $Password,
                "Status" => $Status
            );

            array_push($PersonaArr["body"], $e);
        }
        echo json_encode($PersonaArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Sin Registros.")
        );
    }
?>