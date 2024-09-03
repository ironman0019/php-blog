<?php
    require_once 'functions/helpers.php';
    require_once 'functions/dbconfig.php';

    if(isset($_GET['id'])) {
        $query = "SELECT * FROM `php-blog`.`posts` WHERE `category_id` = ? AND `status` = 1;";
        $stmt = $conn->prepare($query);
        $stmt->execute([$_GET['id']]);
        $posts = $stmt->fetchAll();
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
    <?php require_once 'layouts/styles.php' ?>
</head>
<body>
<section id="app">

    <?php require_once "layouts/partials/top-nav.php" ?>

    <section class="container my-5">
      
            <section class="row">
                <section class="col-12">
                    <h1><?php foreach($categories as $category) {if($category->id == $_GET['id']) echo $category->name;}  ?></h1>
                    <hr>
                </section>
            </section>
            <section class="row">
                    <?php if(!empty($posts)) { foreach($posts as $post) { ?>
                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid w-25" src="<?= asset(preg_replace('/\/assets(?!.*?\/assets)/', '', $post->image)) ?>" alt="pic"></section>
                        <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                        <p><?= $post->body ?></p>
                        <p><a class="btn btn-primary" href="<?= url('detail.php?id=') . $post->id ?>" role="button">View details »</a></p>
                    </section>
                    <?php }} else { ?>
            </section>
            <section class="row">
                <section class="col-12">
                    <h1>Category not found</h1>
                </section>
            </section>
            <?php } ?>
        </section>
    </section>

</section>
<?php require_once 'layouts/scripts.php' ?>
</body>
</html>