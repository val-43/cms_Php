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
                        <small>Sujets</small>
                    </h1>
                    <div class="col-xs-6">

<?php // create
insert_categories(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Nouvelle catégorie</label>
                                    <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Créer une catégorie">
                            </div>
                        </form>

<?php // update and include

if(isset($_GET['edit'])){
    $cat_id = $_GET['edit'];
    include 'include/update_categories.php';
}
?>
                    </div>

                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom de la catégorie</th>
                                </tr>
                            </thead>
                            <tbody>

<?php // select all
findAllCategories(); ?>


<?php //delete
deleteCategories(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"?>
