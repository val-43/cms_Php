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
                $select_all_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='#'>$cat_title</a></li>";
                }
                ?>
                <?php if(!isset($_SESSION['username'])){

                echo "<li>
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

                <?php if(isset($_SESSION['username'])){
                    echo <<< DELIMITER
                <div style="float: right">
                    <li>
                        <a href="#" class="username-display" style="color: darkgreen;" > {$_SESSION['username']} Est connecté</a>
                    </li>
                    <li>
                        <a href="includes/logout.php" class="username-display" style="color: red;" >Se déconnecter</a>
                    </li>
                </div>
DELIMITER;
                } ?>

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
