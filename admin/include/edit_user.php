<?php

if(isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);

    if (!$select_users_query) {
        die('ERREUR REQUETE' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }


if(isset($_POST['edit_user'])){
    $the_user_id = $_GET['edit_user'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
//  $user_image = $_FILES['user_image']['name'];
//  $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_username = $_POST['user_username'];
//  $user_date = date('d-m-Y');

//    $query = "SELECT user_randSalt FROM users";
//    $select_randsalt_query = mysqli_query($connection, $query);
//
//    if(!$select_randsalt_query){
//        die("ERREUR REQUETE" . mysqli_error($connection));
//    }

//    $row = mysqli_fetch_array($select_randsalt_query);
//    $salt = $row['user_randSalt'];
//    $hashed_password = crypt($user_password, $salt);

//  move_uploaded_file($post_image_temp,"./images/$post_image");

    if(!empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $get_user_query = mysqli_query($connection,$query_password);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];

        if ($db_user_password !== $user_password){
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }

        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="user_username = '{$user_username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$hashed_password}', ";
        $query .="user_image = '{$user_image}' "; // I removed comma separator
        $query .="WHERE user_id = {$the_user_id} ";

        $edit_user_query = mysqli_query($connection, $query);

        confirmQuery($edit_user_query);

        echo "<div class='alert alert-success' style='text-align: center;'><h3>Utilisateur modifié </h3><br><button><a href='users.php' style='text-decoration: none;'>Retour au menu des utilisateurs</a></button></div>";

    }
}

}else{
    header('Location: index.php');
}
?>

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
        <label for="user_role">Rôle</label><br>
        <select name="user_role" id="">

            echo '<option value="<?= $user_role ?>"><?= $user_role ?></option>';
            <?php
            if($user_role === 'admin'){
                echo '<option value="utilisateur">Utilisateur</option>';
            }else{
                echo '<option value="admin">Admin</option>';
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="user_password">Mot de passe</label>
        <input autocomplete="off" type="text" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Modifier profil">
    </div>
</form>

