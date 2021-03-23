<?php
require "../models/UserMailValidation.php";
//Instance de la classe gites
$email = new UserMailValidation();

if(isset($_POST['validRegister'])){
    $email->validerInscriptionMail();
    echo "<p class='alert-success mt-2 p-3'>Un email pour valider votre inscription vous à été envoyer !</p>";
}else{
    echo "<p class='alert-warning mt-2 p-3'>Inscription</p>";
}
?>



<form method="post">

    <div class="form-group">
        <label for="nom_utilisateur">Merci d'entrer votre nom</label>
        <input type="text" class="form-control" name="nom_utilisateur" id="nom_utilisateur" placeholder="Pseudo">
    </div>

    <div class="form-group">
        <label for="email_utilisateur">Merci d'entrer votre email</label>
        <input type="email" class="form-control" name="email_utilisateur" id="email_utilisateur" placeholder="email@email.com">
    </div>

    <div class="form-group">
        <label for="password_utilisateur">Merci d'entrer votre mot de passe</label>
        <input type="password" class="form-control" name="password_utilisateur" id="password_utilisateur" placeholder="Mot2P@sseSolide">
    </div>
    <input type="submit" value="S'inscrire" name="validRegister" class="btn btn-outline-info"/>
</form>


<?php
/*
var_dump($_POST['nom_utilisateur']);
var_dump($_POST['email_utilisateur']);
var_dump($_POST['password_utilisateur']);
*/
