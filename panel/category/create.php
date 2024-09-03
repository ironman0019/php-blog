<?php 
    session_start();
    require_once '../../functions/helpers.php';
    require_once '../../functions/dbconfig.php';
    if(!isset($_SESSION['user'])) {
        redirect('auth/login.php');
    }
    // Check if user make a post req & not sending empty data
    if(isset($_POST) && !empty($_POST['name'])) {
        // Create category
        $query = "INSERT INTO `php-blog`.`categories` (name) VALUES (:name);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->execute();
        redirect('panel/category');
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

                    <form action="" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ...">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </section>

                    </form>

                </section>
            </section>
        </section>

    </section>

    <?php require_once '../layouts/scripts.php' ?>
</body>

</html>