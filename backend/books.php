<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$url = "https://openlibrary.org/books/".$_GET["olid"].".json?";
$data = json_decode(file_get_contents($url));

$response = array(
    'title' => $data->title,
    'author_name' => $data->authors[0]->key,
    'cover_i' => $data->covers[0]
); 

echo json_encode($response);
?>