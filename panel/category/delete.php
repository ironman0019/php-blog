<?php
session_start();
require_once '../../functions/helpers.php'; 
require_once '../../functions/dbconfig.php';
if(!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}
if(isset($_GET['id'])) {
    $query = "DELETE FROM `php-blog`.`categories` WHERE `id` = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
}

redirect('panel/category');