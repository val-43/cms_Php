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
    echo "<td><img width='100' src='images/$post_image' alt='image'></td>";
    echo "<td>$post_tags</td>";
    echo "<td>$post_comments</td>";
    echo "<td>$post_date</td>";
    echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Modifier</a></td>";
    echo "<td><a href='posts.php?delete=$post_id'>Supprimer</a></td>";
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