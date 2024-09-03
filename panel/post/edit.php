<?php
session_start();
require_once '../../functions/helpers.php';
require_once '../../functions/dbconfig.php';
if(!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}

// Find the Post
$query = "SELECT * FROM `php-blog`.`posts` WHERE `id` = ?;";
$stmt = $conn->prepare($query);
$stmt->execute([$_GET['id']]);
$post = $stmt->fetch();


if($post == false) {
    redirect('panel/post');
}

if(isset($_POST['title']) && !empty($_POST['title'])
&& isset($_POST['category_id']) && !empty($_POST['category_id'])
&& isset($_POST['body']) && !empty($_POST['body'])
) {

    // Search that category id exist in database
    $query = "SELECT * FROM `php-blog`.`categories` WHERE `id` = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_POST['category_id']]);
    $category = $stmt->fetch();



    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

        // Upload image validation
        $fileMimes = ['png', 'jpg', 'jpeg', 'gif'];
        $imageExtention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (!in_array($imageExtention, $fileMimes)) {
            redirect('panel/post');
        }

        $basePath = dirname(dirname(__DIR__));
        // Delete old image
        if (file_exists($basePath . $post->image)) {
            unlink($basePath . $post->image);
        }
        // Create image
        $image = '/assets/images/posts/' . date('Y_m_d_H_i_s') . '.' . $imageExtention;
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

    } else {
        $image = $post->image;
    }

    // Update post
    if ($category !== false) {
        $query = "UPDATE `php-blog`.`posts` SET `title` = ?,`body` = ?, `category_id` = ?, `image` = ?, `updated_at` = NOW() WHERE `id` = ?;";
        $stmt = $conn->prepare($query);
        $stmt->execute([$_POST['title'], $_POST['body'], $_POST['category_id'], $image, $post->id]);
    }

    redirect('panel/post');
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

                    <form action="" method="post" enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="title ..." value="<?= $post->title ?>">
                        </section>
                        <section class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <img style="width: 90px;" src="<?= asset(preg_replace('/\/assets(?!.*?\/assets)/', '', $post->image)) ?>">
                        </section>
                        <section class="form-group">
                            <?php
                                $query = "SELECT * FROM `php-blog`.`categories`";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                            ?>
                            <label for="category_id">Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                            <?php foreach($categories as $category) { ?>
                                <option <?= $post->category_id == $category->id ? 'selected' : '' ?> value="<?= $category->id ?>" class="form-control"><?= $category->name ?></option>
                            <?php } ?>
                            </select>
                        </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."><?= $post->body ?></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </section>
                    </form>

                </section>
            </section>
        </section>

    </section>

    <?php require_once '../layouts/scripts.php' ?>
</body>

</html>