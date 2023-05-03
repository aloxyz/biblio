<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 3600");
 
// check if the request method is OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
    exit;
}

include_once '../database.php';
include_once '../models/readlist.php';

$database = new Database();
$db = $database->getConnection();

$readlist = new Readlist($db);
$readlist->book_olid = $_GET["book_olid"];
$readlist->user_id = $_GET["user_id"];

$stmt = $readlist->user_has_book();

if($stmt->rowCount() > 0) {   
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode(array("message" => "User has this book."));

} 

else if($stmt->rowCount() == 0) {
    http_response_code(204);
    echo json_encode(array("message" => "User does not have this book."));

} 

else {
    http_response_code(500);
    echo json_encode(array("message" => "Failed to retrieve book."));
}

?>