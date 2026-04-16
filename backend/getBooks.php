<?php
$conn = new mysqli("localhost", "root", "", "books_db");
if ($conn->connect_error) die("Error connexió");

// COMPLETE CODE
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($books);
$conn->close();
