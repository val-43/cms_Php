<?php include "include/admin_header.php"?>

<div id="wrapper">

    <?php include "include/admin_navigation.php"?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Panneau d'administration
                        <small>des commentaires</small>
                    </h1>
                    <?php

                    $source = $_GET['source'] ?? '';

                    switch($source) {
                        case 'add_post';
                            include "include/add_comment.php";
                            break;
                        case 'edit_post';
                            include "include/edit_comment.php";
                            break;
                        default:
                            include "include/view_all_comments.php";
                    }


                    ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"?>
