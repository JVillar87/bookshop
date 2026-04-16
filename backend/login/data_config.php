<?php

function getDataBooks() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_books";

    $connection = new mysqli($host, $username, $password, $dbname);
    
    if ($connection->connect_error) {
        throw new RuntimeException("Conexió fallida");
    }

    $connection->set_charset("utf8mb4");

}