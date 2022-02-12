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
                        <small>des articles</small>
                    </h1>

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Auteur</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Commentaires</th>
                            <th>Date</th>
                            <th colspan="2" class="text-center">Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $query = "SELECT * FROM posts";
                        $select_posts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_posts)){
                            $post_id = $row['post_id'];
                            $post_author = $row['post_author'];
                            $post_title = $row['post_title'];
                            $post_category = $row['post_category_id'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_comments = $row['post_comment_count'];
                            $post_date = $row['post_date'];

                            echo "<tr>";
                            echo "<td>$post_id</td>";
                            echo "<td>$post_author</td>";
                            echo "<td>$post_title</td>";
                            echo "<td>$post_category</td>";
                            echo "<td>$post_status</td>";
                            echo "<td>$post_image</td>";
                            echo "<td>$post_tags</td>";
                            echo "<td>$post_comments</td>";
                            echo "<td>$post_date</td>";
                            echo "<td><a href='categories.php?edit=$post_id'>Modifier</a></td>";
                            echo "<td><a href='categories.php?delete=$post_id'>Supprimer</a></td>";
                            echo "</tr>";
                        }

                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"?>
