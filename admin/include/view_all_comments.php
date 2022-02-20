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
        <th colspan="3" class="text-center">Actions</th>
        <td class="text-center"><button class="btn btn-success"><a href='comments.php?approveAll=$comment_id' style="color: white">Tout accepter</a></button></td>
        <td class="text-center"><button class="btn btn-danger"><a href='comments.php?unapproveAll=$comment_id' style="color: white">Tout refuser</a></button></td>

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
        echo "<td>$comment_status</td>";

        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        $select_post_id_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
        }

        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        echo "<td>$comment_date</td>";

        echo "<td><a href='comments.php?approve=$comment_id'>Accepter</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Refuser</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Effacer</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php

if(isset($_GET['approveAll'])){

    $the_comment_id = $_GET['approveAll'];

    $query = "UPDATE comments SET comment_status = 'Accepté' ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}

if(isset($_GET['approve'])){

    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'Accepté' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}

if(isset($_GET['unapproveAll'])){

    $the_comment_id = $_GET['unapproveAll'];

    $query = "UPDATE comments SET comment_status = 'Non accepté' ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}

if(isset($_GET['unapprove'])){

    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'Non accepté' WHERE comment_id = $the_comment_id";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}

if(isset($_GET['delete'])){

    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}

?>