
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Rechercher un article</h4>
        <form action="./search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
<?php if(!isset($_SESSION['username']) && isset($_SESSION['username']) !== null){
    echo <<< DELIMITER
     <div class="well">
        <h4>Se connecter</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Nom d'utilisateur">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Mot de passe">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Se connecter</button>
                </span>
            </div>
        </form>
    </div>
DELIMITER;
} ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Sujets</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php

                    $query= "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                    }
                    ?>
                </ul>
            </div>



            <!-- /.col-lg-6 -->
<!--            <div class="col-lg-6">-->
<!--                <ul class="list-unstyled">-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
            <!-- /.col-lg-6 -->



        </div>
        <!-- /.row -->
    </div>


    <!-- Side Widget Well -->
    <?php include "widget.php";?>
</div>