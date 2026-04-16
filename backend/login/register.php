<?php
require "data_config.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode(["success" => false, "message" => "Usuari and contrasenya han de ser omplerts"]);
    exit();
}

try {
    $connection = getDataBooks() or die("Error connexió");
    $safeUsername = $connection->real_escape_string($username);
    $sql = "SELECT username FROM users WHERE username='{$safeUsername}' LIMIT 1";
    $result = $connection->query($sql);
    $existingUser = $result->fetch_assoc();

    if ($existingUser) {
        echo json_encode(["success" => false, "message" => "Usuari ja existeix"]);
        exit();
    }

    $sqlInsert = "INSERT INTO users (username, password) VALUES ('{$safeUsername}', '{$password}')";
    if ($connection->query($sqlInsert) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar usuari"]);
    }

    $connection->close();
} catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => "Error de connexió a la base de dades"]);
}
