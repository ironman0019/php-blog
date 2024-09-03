<?php 
    require_once 'functions/helpers.php';
    require_once 'functions/dbconfig.php';

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
        <section class="row">
            <?php 
                $query = "SELECT * FROM `php-blog`.`posts` WHERE `status` = 1;";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $posts = $stmt->fetchAll();
                foreach($posts as $post) {
            ?>
                <section class="col-md-4">
                    <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid w-50 h-25" src="<?= asset(preg_replace('/\/assets(?!.*?\/assets)/', '', $post->image)) ?>" alt="image"></section>
                    <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                    <p><?= mb_strimwidth($post->body, 0, 10, "...") ?></p>
                    <p><a class="btn btn-primary" href="<?= url('detail.php?id='). $post->id ?>" role="button">View details »</a></p>
                </section>
            <?php } ?>
        </section>
    </section>

</section>
<script src="<?= asset('js/jquery.min.js') ?>"></script>
<script src="<?= asset('js/bootstrap.min.js') ?>"></script>
</body>
</html>