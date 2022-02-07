<?php include_once "includes/header.php" ?>
<?php include_once "includes/navigation.php" ?>
<?php include_once "includes/db.php" ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                $query = "SELECT * FROM posts";
                $select_all_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row['post_title'];
                    $post_content = $row['post_content'];
                    $post_author = $row['post_author'];
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
                    par <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="admin/images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Lire la suite... <span class="glyphicon glyphicon-chevron-right"></span></a>


        <?php } ?>


            </div>
        <?php include_once "includes/side_nav.php" ?>
        </div>
        <!-- /.row -->
        <hr>
        <?php include_once "includes/footer.php" ?>
