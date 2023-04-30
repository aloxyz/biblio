<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/readlist.php';

$database = new Database();
$db = $database->getConnection();

$readlist = new Readlist($db);
$readlist->user_id = $_GET["user_id"];

$stmt = $readlist->read();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode($row);
    }

else {
    echo json_encode(array("message" => "No book found for user $readlist->user_id."));
    http_response_code(404);
}
