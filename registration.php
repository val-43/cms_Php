<?php  include "admin/include/db.php"; ?>
<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
<?php

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])){

        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );

//        $query = "SELECT user_randSalt FROM users";
//        $select_randSalt_query = mysqli_query($connection, $query);
//
//        if(!$select_randSalt_query){
//            die("Erreur Requete" . mysqli_error($connection));
//        }
//
//        $row = mysqli_fetch_array($select_randSalt_query);
//
//        $salt = $row['user_randSalt'];
//        $password = crypt($password, $salt);

        $query = "INSERT INTO users (user_username, user_firstname, user_lastname, user_password, user_email, user_role) ";
        $query .= "VALUES('$username', '$firstname', '$lastname', '$password', '$email' , 'utilisateur' )";
        $register_user_query = mysqli_query($connection, $query);
        echo "<div class='alert alert-success' style='text-align: center;'><h3>Demande envoyée</h3><br><p>Vous pouvez dès à présent vous identifier</p>
            <button class='btn btn-primary'><a href='index.php' style='color:white;'>Retour à l'accueil</a></button></div>";

        //header('Location: index.php');

        if(!$register_user_query){
            die("ERREUR REQUETE" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }

    }else{
        $message = '<h3 class="text-center" style="color:red;">Veuillez remplir tous les champs</h3>';
    }
}
?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>S'enregistrer</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo isset($message) ? $message : ''; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">Pseudo</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Entrez votre pseudo">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">Prénom</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Entrez votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Nom</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Entrez votre nom">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="S'enregistrer">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
        <hr>
<?php include "includes/footer.php";?>
