<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->id = $_GET["id"];

$stmt = $user->read();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode($row);
    }

else {
    http_response_code(404);
    echo json_encode(array("message" => "No user found with id $user->id."));
}
?>