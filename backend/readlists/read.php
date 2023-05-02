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

if($stmt->rowCount() > 0) {
    $arr = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $record = array(
            "user_id" => $user_id,
            "book_olid" => $book_olid
        );
        array_push($arr, $record);
    }

    http_response_code(200);
    echo json_encode($arr);

} else if($stmt->rowCount() == 0) {
    http_response_code(404);
    echo json_encode(array("message" => "No records found."));

} else {
    http_response_code(500);
    echo json_encode(array("message" => "Failed to retrieve records."));
}

?>