<?php include "../admin/include/db.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_username = '$username' ";
    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query){

        die("ECHEC REQUETE". mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)){

        $db_user_id = $row['user_id'];
        $db_user_username = $row['user_username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_password = $row['user_password'];
    }

    if($username !== $db_user_username && $password !== $db_user_password){
        header("Location: ../index.php");
    }else if($username === $db_user_username && $password === $db_user_password){
        header("Location: ../admin/index.php");
    }else{
        header("Location: ../index.php");
    }

}