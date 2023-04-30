<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$baseUrl = "https://openlibrary.org/search.json?";
$query = http_build_query(array('q' => $_GET["query"]));

$data = json_decode(file_get_contents($baseUrl.$query));

// function book_test($book) {
//     return
//     $book->title != "undefined" ||
//     $book->author_name != "undefined" ||
//     $book->cover_i != "undefined";
// }

// array_filter($data->docs, "book_test");

echo json_encode($data->docs);
?>