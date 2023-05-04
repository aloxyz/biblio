<?php
session_start();

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

if (!empty($data->email) && !empty($data->password)) {
    $user->email = $data->email;
    $stmt = $user->get_by_email();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($data->password, $row['password'])) {
            http_response_code(200);
            echo json_encode(array(
                "id" => "$row[id]",
                "email" => "$row[email]",
                "name" => "$row[name]"
            ));
        } 
        
        else {
            http_response_code(401);
            echo json_encode(array("message" => "Invalid email or password password."));
        }
    }
} 

else {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid request. Email and password are required."));
}
