<?php require_once '../../functions/helpers.php' ?>
<?php require_once '../../functions/dbconfig.php' ?>
<?php
session_start();
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
                    <h2 class="h4">Categories</h2>
                    <a href="<?= url('panel/category/create.php') ?>" class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM `php-blog`.`categories`";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                foreach($categories as $category) {
                            ?>
                     
                            <tr>
                                <td><?= $category->id ?></td>
                                <td><?= $category->name ?></td>
                                <td>
                                    <a href="<?= url('panel/category/edit.php?id=') . $category->id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= url('panel/category/delete.php?id=') . $category->id ?>" class="btn btn-danger btn-sm">Delete</a>
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