<?php 
session_start();
require_once '../functions/helpers.php';
if(!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <?php require_once './layouts/styles.php' ?>
</head>

<body>
    <section id="app">

        <?php require_once 'layouts/partials/top-nav.php' ?>


        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require_once 'layouts/partials/sidebar.php' ?>
                </section>
                <section class="col-md-10 pb-3">

                    <section style="min-height: 80vh;" class="d-flex justify-content-center align-items-center">
                        <section>
                            <h1>PHP Tutorial</h1>
                            <ul class="mt-2 li">
                                <li>
                                    <h3>PDO Connection</h3>
                                </li>
                                <li>
                                    <h3>File upload</h3>
                                </li>
                                <li>
                                    <h3>Blog (categories and posts)</h3>
                                </li>
                            </ul>
                        </section>
                    </section>

                </section>
            </section>
        </section>


    </section>
    
    <?php require_once './layouts/scripts.php' ?>

</body>

</html>