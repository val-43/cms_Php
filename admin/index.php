<?php include 'include/admin_header.php'?>

<div id="wrapper">

<?php include_once 'include/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Panneau d'administration
                        </h1>
<!--                        <ol class="breadcrumb">-->
<!--                            <li>-->
<!--                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>-->
<!--                            </li>-->
<!--                            <li class="active">-->
<!--                                <i class="fa fa-file"></i> Blank Page-->
<!--                            </li>-->
<!--                        </ol>-->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $select_all_posts = mysqli_query($connection, $query);
                                            $post_count = mysqli_num_rows($select_all_posts);
                                            echo "<div class='huge'>$post_count</div>";
                                        ?>

                                        <div>Articles</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir d??tails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connection, $query);
                                        $comments_count = mysqli_num_rows($select_all_comments);
                                        echo "<div class='huge'>$comments_count</div>";
                                        ?>

                                        <div>Commentaires</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir d??tails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        $query = "SELECT * FROM users";
                                        $select_all_users = mysqli_query($connection, $query);
                                        $users_count = mysqli_num_rows($select_all_users);
                                        echo "<div class='huge'>$users_count</div>";
                                        ?>

                                        <div> Membres</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir d??tails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($connection, $query);
                                        $categories_count = mysqli_num_rows($select_all_categories);
                                        echo "<div class='huge'>$categories_count</div>";
                                        ?>

                                        <div>Cat??gories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir d??tails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php

                    $result = mysqli_query($connection, 'SELECT SUM(post_views_count) AS views_sum FROM posts');
                    $row = mysqli_fetch_assoc($result);
                    $sum = $row['views_sum'];

                    $query = "SELECT * FROM posts WHERE post_status = 'publi??' ";
                    $select_draft_posts_query = mysqli_query($connection, $query);
                    $draft_post_count = mysqli_num_rows($select_draft_posts_query);
                    //echo "<div class='huge'>$draft_post_count</div>";

                    $query = "SELECT * FROM posts WHERE post_status = 'non-publi??' ";
                    $select_undrafted_posts_query = mysqli_query($connection, $query);
                    $undrafted_post_count = mysqli_num_rows($select_undrafted_posts_query);
                    //echo "<div class='huge'>$undrafted_post_count</div>";

                    $query = "SELECT * FROM comments WHERE comment_status = 'Accept??' ";
                    $select_all_approved_comments = mysqli_query($connection, $query);
                    $approved_comments_count = mysqli_num_rows($select_all_approved_comments);

                    $query = "SELECT * FROM comments WHERE comment_status = 'Non accept??' ";
                    $select_all_unapproved_comments = mysqli_query($connection, $query);
                    $unapproved_comments_count = mysqli_num_rows($select_all_unapproved_comments);


                    $query = "SELECT * FROM users WHERE user_role = 'admin' ";
                    $select_admin_user_query = mysqli_query($connection, $query);
                    $admin_user_count = mysqli_num_rows($select_admin_user_query);
                    //echo "<div class='huge'>$admin_user_count</div>";

                    $query = "SELECT * FROM users WHERE user_role = 'utilisateur' ";
                    $select_suscriber_user_query = mysqli_query($connection, $query);
                    $suscriber_user_count = mysqli_num_rows($select_suscriber_user_query);
                    //echo "<div class='huge'>$suscriber_user_count</div>";


                ?>

                <div class="row">
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart(){
                            var data = google.visualization.arrayToDataTable([

                                ['Donn??es', 'Nombre'],

                                <?php

                                    $elements_text = ['Articles post??s','Articles publi??s' , 'Articles non publi??s' ,'Commentaires' ,'Commentaires publi??s','Commentaires non publi??s', 'Membres','Membres admin' ,'Membres utilisateurs' , 'Cat??gories', 'Vues totales'];
                                    $elements_count = [$post_count,$draft_post_count, $undrafted_post_count, $comments_count, $approved_comments_count,$unapproved_comments_count, $users_count,$admin_user_count,$suscriber_user_count, $categories_count, $sum];

                                    for($i = 0;$i < 11; $i++){
                                       echo "['$elements_text[$i]'" . "," . "$elements_count[$i]], ";
                                    }
                                ?>

                                //['Articles', 1000],
                            ]);

                            var options = {
                                chart: {
                                    title: 'Gathou\'s incredible life-blog',
                                    subtitle: 'Statistiques g??n??rales : ',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "include/admin_footer.php"?>