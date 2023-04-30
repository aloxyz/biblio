<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$stmt = $user->read_all();

if($stmt->rowCount() > 0) {
    $arr = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $record = array(
            "id" => $id,
            "email" => $email,
            "password" => $password
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