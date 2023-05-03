<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$url = "https://openlibrary.org/books/".$_GET["olid"].".json?";
$data = json_decode(file_get_contents($url));

if (!$data) {
    http_response_code(404);
    echo json_encode(array("message" => "Book not found."));
    exit;
}

$response = array(
    'key' => $data->key,
    'title' => $data->title,
    'author_name' => $data->authors[0]->key,
    'cover_i' => $data->covers[0]
); 

http_response_code(200);
echo json_encode($response);
?>
