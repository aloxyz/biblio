<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../database.php';
include_once '../models/readlist.php';
 
$database = new Database();
$db = $database->getConnection();
 
$readlist = new Readlist($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$readlist->book_olid = $_GET["book_olid"];
 
if ($readlist->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Book $readlist->book_olid has been deleted from readlist."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Could not delete book."));
}
?>