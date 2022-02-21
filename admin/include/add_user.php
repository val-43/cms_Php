<?php

if(isset($_POST['create_user'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
//    $user_image = $_FILES['user_image']['name'];
//    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_username = $_POST['user_username'];
//    $user_date = date('d-m-Y');


//    move_uploaded_file($post_image_temp,"./images/$post_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_email,user_password,user_role,user_username) ";
    $query .= "VALUES('$user_firstname','$user_lastname','$user_email','$user_password','$user_role','$user_username') ";

    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Prénom</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Nom</label><br>
        <input name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_username">Pseudo</label>
        <input type="text" class="form-control" name="user_username">
    </div>
<!--    <div class="form-group">-->
<!--        <label for="title">Image de l'article</label>-->
<!--        <input type="file" name="image">-->
<!--    </div>-->
    <div class="form-group">
        <label for="user_role">Rôle</label><br>
        <select name="user_role" id="">
            <option value="utilisateur">Sélectionnez le rôle</option>
            <option value="admin">Admin</option>
            <option value="utilisateur">Utilisateur</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_password">Mot de passe</label>
            <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Créer profil">
    </div>
</form>

