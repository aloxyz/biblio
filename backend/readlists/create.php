<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../database.php';
include_once '../models/readlist.php';
 
$database = new Database();
$db = $database->getConnection();
$readlist = new Readlist($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->book_olid)) {
    $readlist->user_id = $data->user_id;
    $readlist->book_olid = $data->book_olid;
 
    
    if ($readlist->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Book $readlist->book_olid inserted."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Couldn't insert book."));
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Malformed data."));
}
