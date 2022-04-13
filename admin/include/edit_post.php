<?php

    if(isset($_GET['p_id'])){
        $the_post_id = escape($_GET['p_id']);
    }

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)) {

    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];

}

    if(isset($_POST['update_post'])){

        $post_user = mysqli_real_escape_string($connection, $_POST['post_user']);
        $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
        $post_category_id = $_POST['post_category'];
        $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        move_uploaded_file($post_image_temp,"./images/$post_image");

        if(empty($post_image)){

            $query = "SELECT * FROM posts WHERE post_id =  $the_post_id ";

            $select_image = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_image))
            {

                $post_image = $row['post_image'];

            }

        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '$post_title', ";
        $query .= "post_category_id = '$post_category_id', ";
        $query .= "post_date = now(), ";
        $query .= "post_user = '$post_user', ";
        $query .= "post_status = '$post_status', ";
        $query .= "post_content = '$post_content', ";
        $query .= "post_tags = '$post_tags', ";
        $query .= "post_image = '$post_image' ";
        $query .= "WHERE post_id = $the_post_id ";

        $update_post = mysqli_query($connection, $query);
        confirmQuery($update_post);

        echo "<div class='alert alert-success' style='text-align: center;'><h3>Article modifié</h3><br><button><a href='posts.php?p_id=$the_post_id' style='text-decoration: none;'>Retour au menu des articles</a></button><button><a href='../post.php?p_id=$the_post_id' style='text-decoration: none;'>Voir le post</a></button></div>";
        //header("Refresh:3; url='posts.php' ");
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Titre de l'article</label>
        <input value="<?php echo stripcslashes($post_title); ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Catégorie de l'article</label><br>
        <select name="post_category" id="post_category">
            <?php
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

            <?php echo "<option value='$post_user'>$post_user</option>"; ?>
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
    <div class="form-group">
        <label for="post_status">Statut de l'article</label>
            <select name="post_status" id="">

                <option value='<?= stripcslashes($post_status); ?>'><?= stripcslashes($post_status) ?></option>
                <?php
                if($post_status === 'publié') {
                    echo '<option value="non-publié">Non publié</option>';

                }else{
                    echo '<option value="publié">Publié</option>';
                }

                ?>

            </select>
        <p> => Choisir "publié" pour le faire apparaitre sur la page d'accueil</p>
    </div>
<!--    <div class="form-group">-->
<!--        <label for="post_status">Statut de l'article</br>Pour que l'article soit affiché, le statut doit être : publié</label>-->
<!--        <input value="--><?php //echo $post_status; ?><!--" type="text" class="form-control" name="post_status">-->
<!--    </div>-->
    <div class="form-group">
        <label for="post_image">Image de l'article</label><br>
        <img width="100" src="./images/<?= $post_image;?>" alt="Image de l'article">
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Mots-clés de l'article</label>
        <input value="<?php echo stripcslashes($post_tags); ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Texte Article</label>
        <textarea  class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo stripcslashes($post_content); ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Modifier l'article">
    </div>
</form>