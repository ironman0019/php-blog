<?php
session_start();
require_once '../../functions/helpers.php';
require_once '../../functions/dbconfig.php';
if(!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}
if(isset($_GET['id']) && !empty($_GET['id'])) {

    // Check if the id of post exist in database
    $query = "SELECT * FROM `php-blog`.`posts` WHERE `id` = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();


    if($post !== false) {
        if($post->status == 0) {
            $query = "UPDATE `php-blog`.`posts` SET `status` = 1 WHERE `id` = ?;";
            $stmt = $conn->prepare($query);
            $stmt->execute([$_GET['id']]);
        } elseif($post->status == 1) {
            $query = "UPDATE `php-blog`.`posts` SET `status` = 0 WHERE `id` = ?;";
            $stmt = $conn->prepare($query);
            $stmt->execute([$_GET['id']]);
        }
    }

    redirect('panel/post');
}