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
 
$user_profile->user_id = $data->user_id;
$user_profile->readlist_id = $data->readlist_id;
$user_profile->name = $data->name;
 
if($user_profile->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Updated user profile $user_profile->user_id"));
}else{
    http_response_code(503);
    echo json_encode(array("message" => "Could not update user profile"));
}
?>