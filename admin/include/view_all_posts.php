<?php

if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxPostId){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'publié':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxPostId ";
                $update_to_published_status = mysqli_query($connection,$query);
                confirmQuery($update_to_published_status);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxPostId ";
                $update_to_draft_status = mysqli_query($connection,$query);
                confirmQuery($update_to_draft_status);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $checkBoxPostId ";
                $delete_bulk_query = mysqli_query($connection,$query);
                confirmQuery($delete_bulk_query);
                break;
            case 'reset_all':
                $query = "UPDATE posts SET post_views_count = 0 ";
                $reset_bulk_query = mysqli_query($connection,$query);
                confirmQuery($reset_bulk_query);
                break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = $checkBoxPostId ";
                $select_bulk_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($select_bulk_query)){
                    $post_title = mysqli_real_escape_string($connection,$row['post_title']);
                    $post_category_id = $row['post_category_id'];
                    $post_title = mysqli_real_escape_string($connection, $row['post_title']);
                    $post_date = $row['post_date'];
                    $post_user = mysqli_real_escape_string($connection, $row['post_user']);
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = mysqli_real_escape_string($connection,$row['post_tags']);
                    $post_content = mysqli_real_escape_string($connection, $row['post_content']);
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_status, post_tags, post_content, post_image) ";
                $query .= "VALUES('$post_category_id', '$post_title', '$post_user', now(), '$post_status', '$post_tags', '$post_content', '$post_image') ";
                $copy_query = mysqli_query($connection, $query);

                if(!$copy_query){
                    die("ERREUR REQUETE" . mysqli_error($connection));
                }

                break;

            default:
                echo 'Action impossible';
                break;
        }
    }
}

?>


<form action="" method="post">

<table class="table table-bordered table-hover">
    <div class="col-xs-4" id="bulkOptionsContainer">
        <select name="bulk_options" class="form-control" id="">
            <option value="">Actions de groupe</option>
            <option value="clone">Dupliquer</option>
            <option value="publié">Publier</option>
            <option value="draft">Retirer</option>
            <option value="delete">Effacer</option>
            <option value="reset_all">Remettre à zero les vues</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Appliquer">
        <a class="btn btn-primary" href="posts.php?source=add_post">Créer</a>
    </div>
<thead>

    <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>ID</th>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Catégorie</th>
        <th>Statut</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Commentaires</th>
        <th>Date</th>
        <th>Vues</th>
        <th colspan="3" class="text-center">Actions</th>

    </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * FROM posts ORDER BY post_id DESC";
$select_posts = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];

    echo "<tr>";
    ?>
    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?= $post_id ?>'></td>
    <?php

    echo "<td>$post_id</td>";

   if(!empty($post_author)){

        echo "<td>$post_author</td>";
    } elseif(!empty($post_user)){
        echo "<td>$post_user</td>";
   }


    echo "<td>$post_title</td>";

    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                $edit_categories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($edit_categories)) {
                    $cat_title = $row['cat_title'];
                }

    echo "<td>$cat_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img width='100' src='images/$post_image' alt='image'></td>";
    echo "<td>$post_tags</td>";

    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
    $send_comment_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($send_comment_query);
    $comment_id = isset($row['comment_id']);
    $count_comments = mysqli_num_rows($send_comment_query);

    echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";

    echo "<td>$post_date</td>";
    echo "<td>$post_views_count<br><a href='posts.php?reset=$post_id'>Reset vues</a></td>";
    echo "<td><a href='../post.php?p_id=$post_id'>Voir</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Modifier</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Etes vous certain de la suppression ? '); \" href='posts.php?delete=$post_id'>Supprimer</a></td>";
    echo "</tr>";
}
?>
    </tbody>
    </table>
</form>

<?php

if(isset($_GET['delete'])){

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {

        $image = "";
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id =  $the_post_id ";
        $delete_query = mysqli_query($connection, $query);
        unlink('images/$post_image');
        header("Location: posts.php");
    }
}

if(isset($_GET['reset'])){

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {

        $the_post_id = $_GET['reset'];
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
}

?>