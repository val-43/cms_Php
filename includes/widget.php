<div class="well">

    <?php if(isset($_SESSION['username'])){
        echo <<< DELIMITER
                <div class="text-center">
                        <h4  class="username-display" style="color: darkgreen;" > {$_SESSION['username']} est connecté</h4>
                        <a href="includes/logout.php"><h4  class="username-display" style="color: red;" >Se déconnecter</h4></a>
                </div>
DELIMITER;
    } ?>
    <br>
    <br>
    <h4>Penser à mettre un widget cool ici <br> une carte pour rechercher les photos/articles en fonction de l'endroit ou elles ont été prises !</h4>
    <p>La carte sera ici</p><br>
    <p>Peut être relier les réseaux sociaux</p><br>
    <p>Un forum ?</p><br>
    <p>Un annuaire des adresses utiles ?</p><br>

</div>
