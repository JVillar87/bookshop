<?php
session_start();
require "./data_config.php";

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

if ($username === '' || $password === '') {
    echo json_encode(["success" => false, "message" => "Usuari and contrasenya han de ser omplerts"]);
    exit();
}

try {
    $connection = getDataBooks();
    $safeUsername = $connection->real_escape_string($username);
    $sql = "SELECT username, password FROM users WHERE username='{$safeUsername}' LIMIT 1";
    $result = $connection->query($sql);
    $user = $result->fetch_assoc() ?: null;

    if ($user && $password === $user['password']) {
        $_SESSION['username'] = $user['username'];
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Usuari o contrasenya incorrectes"]);
    }
} catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => "Error de connexió a la base de dades"]);
}
