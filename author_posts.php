<?php include_once "includes/header.php" ?>
<?php include_once "includes/navigation.php" ?>
<?php include_once "admin/include/db.php" ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $the_post_author = mysqli_real_escape_string($connection, $_GET['author']);
            }

            $query = "SELECT * FROM posts WHERE post_user = '$the_post_author' ";
            $select_all_posts_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_title = $row['post_title'];
                $post_content = $row['post_content'];
                $post_author = mysqli_real_escape_string($connection, $row['post_user']);
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small><?php echo $post_tags; ?></small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    Tous les articles de :  <?php echo stripcslashes($post_author) ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" width="430px" src="admin/images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

            <?php } ?>

        </div>
        <?php include_once "includes/side_nav.php" ?>
    </div>
    <hr>
    <?php include_once "includes/footer.php" ?>
