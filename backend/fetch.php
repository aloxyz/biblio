<?php 
header('Content-Type: application/json');
$searchString = "lord of the rings";
$baseUrl = "https://openlibrary.org/search.json?";

$query = http_build_query(array('q' => $searchString));

echo file_get_contents($baseUrl.$query);
?>