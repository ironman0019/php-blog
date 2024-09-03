<?php

$server = 'localhost';

$dbname = 'php-blog';

$username = 'root';

$password = '';

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $conn;
} 
catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    return false;
}