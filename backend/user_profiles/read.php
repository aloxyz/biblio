<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/user_profile.php';

$database = new Database();
$db = $database->getConnection();

$user = new UserProfile($db);

$stmt = $user->read();

if($stmt->rowCount() > 0) {
    $arr = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $record = array(
            "user_id" => $user_id,
            "readlist_id" => $readlist_id,
            "name" => $name
        );
        array_push($arr, $record);
    }

    http_response_code(200);
    echo json_encode($arr);

    }

else {
    echo json_encode(array("message" => "No records found."));
    http_response_code(404);
}
?>