<?php

if(isset($_POST['create_post'])){
    global $connection;
    $post_title= mysqli_real_escape_string($connection, $_POST['title']);
    $post_user= mysqli_real_escape_string($connection, $_POST['post_user']);
    $post_category_id= $_POST['post_category'];
    $post_status= mysqli_real_escape_string($connection, $_POST['post_status']);
    $post_image= $_FILES['image']['name'];
    $post_image_temp= $_FILES['image']['tmp_name'];
    $post_tags= mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content= mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_date= date('d-m-y');

    if(empty($post_tags)){
        $post_tags = "Divers";
    }
    if(empty($post_image)){
        $post_image = '';
    }else{
        move_uploaded_file($post_image_temp,"./images/$post_image");
    }


    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);
    echo "<div class='alert alert-success' style='text-align: center;'><h3>Article crée </h3><br><button><a href='posts.php' style='text-decoration: none;'>Retour au menu des articles</a></button></div>";
    header("Refresh:3; url='posts.php' ");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Catégorie de l'article</label><br>
        <select name="post_category" id="post_category">
            <?php
            global $connection;
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>

        </select>

    </div>
    <div class="form-group">
        <label for="post_user">Auteur de l'article</label><br>
        <select name="post_user" id="post_user">
            <?php
            $query = "SELECT * FROM users";
            $select_post_authors = mysqli_query($connection, $query);
            confirmQuery($select_post_authors);

            while($row = mysqli_fetch_assoc($select_post_authors)) {
                $user_id = $row['user_id'];
                $username = $row['user_username'];

                echo "<option value='$username'>$username</option>";
            }
            ?>

        </select>

    </div>
<!--    <div class="form-group">-->
<!--        <label for="title">Auteur de l'article</label>-->
<!--        <input type="text" class="form-control" name="author">-->
<!--    </div>-->
    <div class="form-group">
        <label for="title">Statut de l'article</label>
            <select name="post_status" id="">
                <option value="draft">Choisissez le statut</option>
                <option value="publié">publié</option>
                <option value="draft">non publié</option>
            </select>
    </div>
    <div class="form-group">
        <label for="title">Image de l'article</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="title">Mots-clés de l'article</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group" >
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10">
      </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Créer article">
    </div>
</form>
