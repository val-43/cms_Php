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
                                        <div class='huge'> <?php echo $post_count = recordCount('posts'); ?></div>
                                        <div>Articles</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir détails</span>
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
                                        <div class='huge'> <?php echo $comments_count = recordCount('comments');  ?></div>
                                        <div>Commentaires</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir détails</span>
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
                                        <div class='huge'><?php echo $users_count = recordCount('users'); ?></div>
                                        <div> Membres</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir détails</span>
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
                                        <div class='huge'><?php echo $categories_count = recordCount('categories'); ?></div>
                                        <div>Catégories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir détails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                    $sum_posts = sumViews('posts');
                    $posts_publie = checkStatus('posts', 'post_status', 'publié');
                    $posts_non_publie = checkStatus('posts', 'post_status', 'draft');
                    $comments_approved = checkStatus('comments', 'comment_status', 'accepté');
                    $comments_unapproved = checkStatus('comments', 'comment_status', 'Non accepté');
                    $admin_count = checkStatus('users', 'user_role', 'admin');
                    $suscriber_count = checkStatus('users', 'user_role', 'utilisateur');
                ?>
                <div class="row">
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart(){
                            var data = google.visualization.arrayToDataTable([
                                ['Données', 'Nombre'],
                                <?php
                                 $elements_text = ['Articles postés','Articles publiés' , 'Articles non publiés' ,'Commentaires' ,'Commentaires publiés','Commentaires non publiés', 'Membres','Membres admin' ,'Membres utilisateurs' , 'Catégories', 'Vues totales'];
                                    $elements_count = [$post_count,$posts_publie, $posts_non_publie, $comments_count, $comments_approved,$comments_unapproved, $users_count,$admin_user_count,$suscriber_count, $categories_count, $sum_posts];
                                    for($i = 0;$i < 11; $i++){
                                       echo "['$elements_text[$i]'" . "," . "$elements_count[$i]], ";
                                    }
                                ?>
                                //['Articles', 1000],
                            ]);
                            var options = {
                                chart: {
                                    title: 'Gathou\'s incredible life-blog',
                                    subtitle: 'Statistiques générales : ',
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