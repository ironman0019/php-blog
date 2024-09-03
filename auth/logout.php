<?php
session_start();
require_once '../functions/helpers.php';

if(!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}

session_destroy();
redirect('/');

