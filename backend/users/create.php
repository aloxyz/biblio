<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 3600");
 
// check if the request method is OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
    exit;
}

include_once '../database.php';
include_once '../models/user.php';
 
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password) && !empty($data->name)) {
    $user->email = $data->email;
    $user->password = $data->password;
    $user->name = $data->name;

    // Check if user email already exists
    if ($user->get_by_email()->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(array("message" => "User with email $user->email already exists."));
    }

    else if ($user->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "User $user->email created."));
    
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Internal server error."));
    }
} else {
    http_response_code(400);
    echo json_encode(
        array(
            "message" => "Bad request.",
            "data" => $data
        )
    );
}
