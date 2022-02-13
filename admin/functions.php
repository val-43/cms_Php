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

function confirmQuery($result){

    global $connection;
    if(!$result){
        die("ERREUR REQUETE : " . mysqli_error($connection));
    }
}

function escape($string): string
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}