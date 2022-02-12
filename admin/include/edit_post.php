<?php

    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)) {

    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];

}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="title">Numéro de la catégorie de l'article</label>
        <input value="<?php echo $post_category; ?>" type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="title">Auteur de l'article</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="title">Statut de l'article</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="title">Image de l'article</label>
        <input value="<?php echo $post_image; ?>" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="title">Mots-clés de l'article</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control" name="post_content" id="" cols="30" rows="10">
            <?php echo $post_content; ?>
      </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Créer article">
    </div>
</form>