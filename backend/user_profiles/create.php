<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../database.php';
include_once '../models/user_profile.php';
 
$database = new Database();
$db = $database->getConnection();
$user_profile = new UserProfile($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->readlist_id) && !empty($data->name)) {
    $user_profile->user_id = $data->user_id;
    $user_profile->readlist_id = $data->readlist_id;
    $user_profile->name = $data->name;

    
    if ($user_profile->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "User profile $user_profile->user_id created."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Couldn't create user profile."));
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Malformed data."));
}
