<?php
session_start();
require_once '../../functions/helpers.php'; 
require_once '../../functions/dbconfig.php';
if(!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}
if(isset($_GET['id'])) {
    // Find the Post
    $query = "SELECT * FROM `php-blog`.`posts` WHERE `id` = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();

    $basePath = dirname(dirname(__DIR__));
    // Delete image
    if (file_exists($basePath . $post->image)) {
        unlink($basePath . $post->image);
    }

    // Delete post
    $query = "DELETE FROM `php-blog`.`posts` WHERE `id` = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
}

redirect('panel/post');