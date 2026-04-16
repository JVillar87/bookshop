<?php
$conn = new mysqli("localhost", "root", "", "books_db");
if ($conn->connect_error) die("Error connexió");

// COMPLETE CODE
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$title = $data['title'];
$author = $data['author'];
$year = $data['year'];

$sql = "UPDATE books 
SET title='$title', author='$author', 
year=$year WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "OK"]);
} else {
    echo json_encode(["status" => "KO"]);
}

$conn->close();
