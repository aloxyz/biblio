<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 3600");

// Check if the request method is OPTIONS
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

// Check if form is filled
if (!empty($data->email) && !empty($data->password) && !empty($data->name)) {

    // Check if password matches pattern
    if (preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,24}$/', $data->password) != 1) {
        http_response_code(400);
        echo json_encode(array("message" => "Password must be between 8-16 characters, at least one letter and one number."));
        exit;
    }

    // Check if username matches pattern
    if (preg_match('/^[a-zA-Z][a-zA-Z0-9_]{1,14}[a-zA-Z0-9]$/', $data->name) != 1) {
        http_response_code(400);
        echo json_encode(array("message" => "Username must be between 3-16 characters, alphanumeric, must start with a letter and can't end with an underscore."));
        exit;
    }

    // Check if email matches pattern
    if (preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $data->email) != 1) {
        http_response_code(400);
        echo json_encode(array("message" => "Email address must be valid."));
        exit;
    }

    // Initialize User object with hashed password
    $user->email = $data->email;
    $user->password = password_hash($data->password, PASSWORD_DEFAULT);
    $user->name = $data->name;

    // Check if user email already exists
    if ($user->get_by_email()->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(array("message" => "User with email $user->email already exists."));
    }

    // Success
    else if ($user->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "User $user->email created."));
    
    } 
    
    // If everything else fails
    else {
        http_response_code(500);
        echo json_encode(array("message" => "Internal server error."));
    }
} 

// If form is not filled in
else {
    http_response_code(406);
    echo json_encode(
        array(
            "message" => "Bad request.",
            "data" => $data
        )
    );
}


?>