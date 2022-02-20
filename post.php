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
            }

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
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
                <img class="img-responsive" width="430px" src="admin/images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

            <?php } ?>
                <hr>
            <!-- Blog Comments -->
            <?php

            if(isset($_POST['create_comment'])){

                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                $query .= "VALUES ($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'Non accepté', now())";

                $create_comment_query = mysqli_query($connection, $query);

                if(!$create_comment_query){

                    die('Erreur Requete : ' . mysqli_error($connection));
                }

                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $the_post_id ";
                $update_comment_count = mysqli_query($connection, $query);

            }

            ?>

            <!-- Comments Form -->

            <div class="well">
                <h4>Laissez votre commentaire:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Votre nom et prénom
                            <input type="text" name="comment_author" class="form-control" placeholder="Veuillez saisir votre nom">
                            (requis)
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Votre mail
                            <input type="email" name="comment_email" class="form-control" placeholder="Veuillez saisir votre mail">
                            (requis)
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Votre commentaire</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Commenter</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
            $query .= "AND comment_status = 'accepté' ";
            $query .= "ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);

            if(!$select_comment_query){
                die('ERREUR REQUETE : '. mysqli_error($connection));
            }

            while($row = mysqli_fetch_array($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

                ?>



            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="https://via.placeholder.com/64" alt=""">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author ?>
                        <small><?php echo $comment_date ?></small>
                    </h4>
                    <?php echo $comment_content ?>
                </div>
            </div>
        <hr>
                <?php } ?>
        </div>
        <?php include_once "includes/side_nav.php" ?>
    </div>
    <hr>
    <?php include_once "includes/footer.php" ?>
