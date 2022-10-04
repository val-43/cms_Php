<?php

function insert_categories(){

    global $connection;

    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];

        if (empty($cat_title)) {

            echo "<h2 style='color: #ac2925'>Merci de saisir un titre</h2>";

        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('$cat_title') ";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die('ERREUR REQUETE ' . mysqli_error($connection));
            }
        }

    }

}

function findAllCategories(){

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?edit=$cat_id'>Modifier</a></td>";
        echo "<td><a href='categories.php?delete=$cat_id'>Supprimer</a></td>";
        echo "</tr>";
    }

}

function deleteCategories(){

    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $the_cat_id ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function confirmQuery($result){

    global $connection;
    if(!$result){
        die("ERREUR REQUETE : " . mysqli_error($connection));
    }
}

function fetchRecords($result){
    return mysqli_fetch_array($result);
}

function escape($string): string
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function stmtConnection(){
    global $connection;
    return mysqli_stmt_init($connection);
}

function redirect($location){
    return header("Location:" . $location);
}

function debug($value){
    echo '<pre>';
    print_r( $value );
    echo '</pre>';
}

function users_online(){

    if(isset($_GET['onlineusers'])){

        global $connection;
        if(!$connection){
            session_start();
            include("./include/db.php") ;
        }
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 5;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection,$query);
        $count = mysqli_num_rows($send_query);

        if($count === NULL || $count === 0){

            mysqli_query($connection, "INSERT INTO users_online (session,time) VALUES ('$session','$time' ) ");
            mysqli_query($connection, "INSERT INTO users_online (session,time) VALUES ('$session','$time' ) ");

        } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
        echo $count_user = mysqli_num_rows($users_online_query);

    }

}

function recordCount($table){

    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_posts);
    if(!$result === 0){
        confirmQuery($result);
    }
    return $result;
}

function sumViews($table){
    global $connection;
    $query = "SELECT SUM(post_views_count) AS views_sum FROM " . $table;
    $post_views_count = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($post_views_count);
    if(!$result === 0){
        $result = $result['views_sum'];
    }
    return $result['views_sum'];
}

function checkStatus($table,$column,$status){
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);
}



