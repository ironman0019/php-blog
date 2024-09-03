<?php
    session_start();
    require_once '../../functions/helpers.php';
    require_once '../../functions/dbconfig.php';
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
    <?php require_once '../layouts/styles.php' ?>
</head>
<body>
<section id="app">

    <?php require_once '../layouts/partials/top-nav.php' ?>


    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?php require_once '../layouts/partials/sidebar.php' ?>
            </section>
            <section class="col-md-10 pt-3">

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="h4">Articles</h2>
                    <a href="<?= url('panel/post/create.php') ?>" class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>title</th>
                            <th>category_name</th>
                            <th>body</th>
                            <th>status</th>
                            <th>setting</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT `php-blog`.`posts`.*, `php-blog`.`categories`.`name` AS `name` FROM `php-blog`.`posts` INNER JOIN `php-blog`.`categories` ON `posts`.`category_id` = `categories`.`id`;";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $posts = $stmt->fetchAll();


                                foreach($posts as $post) {
                            ?>
                            <tr>
                                <td><?= $post->id ?></td>
                                <td>
                                    <img style="width: 90px;" src="<?= asset(preg_replace('/\/assets(?!.*?\/assets)/', '', $post->image)) ?>">
                                </td>
                                <td><?= $post->title ?></td>
                                <td><?= $post->name ?></td>
                                <td><?= mb_strimwidth($post->body, 0, 10, "...") ?></td>
                                <td><?= $post->status == 0 ? '<span class="text-danger">disable</span>' : '<span class="text-success">enable</span>' ?>
                                </td>
                                <td>
                                    <a href="<?= url('panel/post/change-status.php?id=') . $post->id ?>" class="btn btn-warning btn-sm">Change status</a>
                                    <a href="<?= url('panel/post/edit.php?id=') . $post->id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= url('panel/post/delete.php?id=') . $post->id ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>


            </section>
        </section>
    </section>





</section>

<?php require_once '../layouts/scripts.php' ?>
</body>
</html>