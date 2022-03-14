<?php include "include/admin_header.php"; ?>

<?php

    if(isset($_SESSION['username'])){

        $user_username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE user_username = '$user_username' ";
        $select_user_profile_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile_query)){

            $user_id = $row['user_id'];
            $user_username = $row['user_username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    }

    if(isset($_POST['edit_user'])) {
        //$the_user_id = $_GET['edit_user'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        //    $user_image = $_FILES['user_image']['name'];
        //    $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_password = $_POST['user_password'];
        //$user_role = $_POST['user_role'];
        $user_username = $_POST['user_username'];

        //    $user_date = date('d-m-Y');


        //    move_uploaded_file($post_image_temp,"./images/$post_image");

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        //$query .= "user_role = '{$user_role}', ";
        $query .= "user_username = '{$user_username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        //$query .= "user_image = '{$user_image}' "; // I removed comma separator
        $query .= "WHERE user_username = '$user_username' ";

        $edit_user_query = mysqli_query($connection, $query);

        confirmQuery($edit_user_query);
        header("Location: profile.php");
    }


?>

<div id="wrapper">

    <?php include "include/admin_navigation.php"?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Mon Compte
                        <small></small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_firstname">Prénom</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?= $user_firstname ?>">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Nom</label><br>
                            <input name="user_lastname" class="form-control" value="<?= $user_lastname ?>">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control" name="user_email" value="<?= $user_email ?>">
                        </div>
                        <div class="form-group">
                            <label for="user_username">Pseudo</label>
                            <input type="text" class="form-control" name="user_username" value="<?= $user_username ?>">
                        </div>
                        <!--    <div class="form-group">-->
                        <!--        <label for="title">Image de l'article</label>-->
                        <!--        <input type="file" name="image">-->
                        <!--    </div>-->
                        <div class="form-group">
                            <label for="user_password">Mot de passe</label>
                            <input type="text" class="form-control" name="user_password" value="<?= $user_password ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Modifier profil">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"?>


