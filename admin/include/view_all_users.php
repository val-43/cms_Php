<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Pseudo</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th colspan="3" class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    if(!$select_users){
        die('ERREUR REQUETE'. mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";

//        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
//        $select_post_id_query = mysqli_query($connection, $query);
//        while ($row = mysqli_fetch_assoc($select_post_id_query)){
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//        }

        echo "<td class='text-center'><a href='users.php?edit='>Modifier</a></td>";
        echo "<td class='text-center'><a href='users.php?delete='>Effacer</a></td>";
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
