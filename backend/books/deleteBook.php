<?php
//CODE HERE
$conn = new mysqli("localhost", "root", "", "books_db");
if ($conn->connect_error) {
    echo json_encode(["status" => "KO"]);
    exit();
}

$id = $_POST['id'];
$sql = "DELETE FROM books WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "OK"]);
} else {
    echo json_encode(["status" => "KO"]);
}
$conn->close();
