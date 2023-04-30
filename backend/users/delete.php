<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../database.php';
include_once '../models/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$user->id = $_GET["id"];
 
if ($user->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "User with id $user->id has been deleted."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Could not delete user."));
}
?>