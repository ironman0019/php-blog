<?php 
    require_once 'functions/helpers.php';
    require_once 'functions/dbconfig.php';

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $query = "SELECT * FROM `php-blog`.`posts` WHERE `id` = ?;";
        $stmt = $conn->prepare($query);
        $stmt->execute([$_GET['id']]);
        $post = $stmt->fetch();

        $query = "SELECT * FROM `php-blog`.`categories` WHERE `id` = ?;";
        $stmt = $conn->prepare($query);
        $stmt->execute([$post->category_id]);
        $myCategory = $stmt->fetch();



    } else {
        redirect('/');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

    <?php require_once "layouts/partials/top-nav.php" ?>

    <section class="container my-5">
        <!-- Example row of columns -->
         <?php if(!empty($post)) { ?>
        <section class="row">
            <section class="col-md-12">
                <h1><?= $post->title ?></h1>
                <h5 class="d-flex justify-content-between align-items-center">
                    <a href="<?= url('category.php?id=') . $myCategory->id ?>"><?= $myCategory->name ?></a>
                    <span class="date-time"><?= $post->created_at ?></span>
                </h5>
                <article class="bg-article p-3 h-100"><img class="float-right mb-2 ml-2" style="width: 10rem;" src="<?= asset(preg_replace('/\/assets(?!.*?\/assets)/', '', $post->image)) ?>" alt=""><?=$post->body?></article>
                <?php } else { ?>
                    <section>post not found!</section>
                <?php } ?>
             
            </section>
        </section>
    </section>

</section>
<script src="<?= asset('js/jquery.min.js') ?>"></script>
<script src="<?= asset('js/bootstrap.min.js') ?>"></script>
</body>
</html>