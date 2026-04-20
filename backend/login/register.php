<?php
require "data_config.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode(["success" => false, "message" => "Usuari i contrasenya han de ser omplerts"]);
    exit();
}

try {
    $connection = getDataBooks();
    $safeUsername = $connection->real_escape_string($username);
    $safePassword = $connection->real_escape_string($password);

    $checkSql = "SELECT id FROM users WHERE username = '{$safeUsername}' LIMIT 1";
    $checkResult = $connection->query($checkSql);
    $existingUser = $checkResult ? $checkResult->fetch_assoc() : null;

    if ($existingUser) {
        echo json_encode(["success" => false, "message" => "L'usuari ja existeix"]);
        $connection->close();
        exit;
    }

    $insertSql = "INSERT INTO users (username, password) VALUES ('{$safeUsername}', '{$safePassword}')";
    if (!$connection->query($insertSql)) {
        throw new RuntimeException("Error d'alta");
    }

    $connection->close();

    echo json_encode(["success" => true, "message" => "Usuari registrat amb éxit"]);
} catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => "Usuari no registrat"]);
}