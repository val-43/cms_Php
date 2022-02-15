<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Auteur</th>
        <th>Commentaire</th>
        <th>Email</th>
        <th>Statut</th>
        <th>En réponse de</th>
        <th>Date</th>
        <th>Approuver</th>
        <th>Refuser</th>
        <th>Effacer</th>
        <th colspan="2" class="text-center">Actions</th>

    </tr>
    </thead>
    <tbody>

    <?php

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";


//        $query = "SELECT * FROM comments WHERE cat_id = $post_category_id ";
//        $edit_categories = mysqli_query($connection, $query);
//
//        while($row = mysqli_fetch_assoc($edit_categories)) {
//            $cat_title = $row['cat_title'];
//        }


        echo "<td>$comment_status</td>";
        echo "<td>$comment_date</td>";
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?source=edit_comment&p_id=$comment_id'>Approuver</a></td>";
        echo "<td><a href='comments.php?source=edit_comment&p_id=$comment_id'>Refuser</a></td>";
        echo "<td><a href='comments.php?source=edit_comment&p_id=$comment_id'>Effacer</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Supprimer</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


<?php

if(isset($_GET['delete'])){
    $image = "";
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id =  $the_post_id ";
    $delete_query = mysqli_query($connection, $query);
    unlink('images/$post_image');
    header("Location: posts.php");
}

?>