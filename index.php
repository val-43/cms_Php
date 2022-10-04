<?php include_once "includes/header.php" ?>
<?php include_once "includes/navigation.php" ?>
<?php include_once "admin/include/db.php" ?>

    <!-- Page Content -->

    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                if(isset($_GET['page'])){

                    $posts_by_page = 5;
                    $page = $_GET['page'];

                }else{
                    $page = "";
                }
                if ($page === "" || $page === 1){
                    $page_1 = 0;
                }else{
                    $page_1 = ($page * $posts_by_page) - $posts_by_page;
                }

                $posts_by_page = 5;
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'publié' ";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);
                if($count<1){
                    echo "<h1 class='text-center'>Aucun article pour le moment ...</h1>";
                }else {
                $count = ceil($count / $posts_by_page);

                $query = "SELECT * FROM posts WHERE post_status = 'publié' LIMIT $page_1,$posts_by_page";
                $select_all_posts_query = mysqli_query($connection, $query);



                while($row = mysqli_fetch_assoc($select_all_posts_query)) {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_content = $row['post_content'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = substr($row['post_content'], 0, 320);
                    $post_status = $row['post_status'];


                ?>

                    <h2 class="page-header" style="display: none">
                    <small><?php echo $post_tags; ?></small>
                </h2>
                <!-- First Blog Post -->
                <h1>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h1>
                <p class="lead">
                    par <a href="author_posts.php?author=<?= $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $post_date ?></p>
                <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" width="430px" src="admin/images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?> ...</p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Lire la suite... <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
        <?php  } } ?>
            </div>
            <?php include_once "includes/side_nav.php" ?>
        </div>

        <!-- /.row -->


        <ul class="pager">

            <?php

//            if($page !== 1 && $page !== ''){
//
//                $prev_page = $page--;
//
//                echo "<li><a href='index.php?page={$prev_page}'>PREV</a></li>";
//
//            }

            for($i = 1; $i <= $count ; $i++){

                if($i === $page || ($i === 1 && $page === 1)){

                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

                } else {

                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

                }

            }

//            if($page !== $count){
//
//                $next_page = $page++;
//
//                echo "<li><a href='index.php?page={$next_page}'>NEXT</a></li>";
//
//            }
//                for($i=1;$i <=$count; $i++){
//
//                    if($i == $page){
//                        echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
//                    }else{
//                        echo "<li><a href='index.php?page=$i'>$i</a></li>";
//                    }
//
//                }
            ?>

        </ul>
        <?php include_once "includes/footer.php" ?>
