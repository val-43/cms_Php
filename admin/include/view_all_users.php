<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Pseudo</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th colspan="4" class="text-center">Actions</th>
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

        echo "<td class='text-center'><a href='users.php?source=edit_user&edit_user=$user_id'>Modifier</a></td>";
        echo "<td class='text-center'><a onClick=\"javascript: return confirm('Etes vous certain de la suppression ? '); \" href='users.php?delete=$user_id'>Effacer</a></td>";
        echo "<td class='text-center'><a href='users.php?change_to_admin=$user_id'>Pass Admin</a></td>";
        echo "<td class='text-center'><a href='users.php?change_to_suscriber=$user_id'>Pass Utilisateur</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php

if(isset($_GET['edit_user'])){

    header("Location: users.php");

}


if(isset($_GET['change_to_admin'])){

    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");

}

if(isset($_GET['change_to_suscriber'])){

    $the_user_id = $_GET['change_to_suscriber'];

    $query = "UPDATE users SET user_role = 'utilisateur' WHERE user_id = $the_user_id ";
    $change_to_suscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");

}

if(isset($_GET['delete'])){

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){

        $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

        $query = "DELETE FROM users WHERE user_id = $the_user_id ";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

?>
