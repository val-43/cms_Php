<?php include_once "./admin/include/db.php"; ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Accueil</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php

                $query= "SELECT * FROM categories";
                $select_categories_sidebar = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    $category_class = '';
                    $registration_class = '';

                    $page_name = basename($_SERVER['PHP_SELF']);
                    $registration = 'registration.php';
                    if(isset($_GET['category']) && $_GET['category'] === $cat_id ){
                        $category_class = 'active';
                    } elseif ($page_name === $registration){
                        $registration_class = 'active';
                    }

                    echo "<li class='$category_class' '><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                }
                ?>
                <?php if(!isset($_SESSION['username'])){

                echo "<li class='$registration_class'>
                    <a href='registration.php'>Devenir Membre</a>
                </li>";
                }
                ?>

                <?php
                if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'admin')){
                    echo "<li>
                     <a href='admin'>Admin</a>
                </li>";
                }
                ?>

<!--                <li>-->
<!--                    <a href="#">Services</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">Contact</a>-->
<!--                </li>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
