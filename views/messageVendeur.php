
<?php

require  "../models/EmailVisiteur.php";
$emailVisiteur = new EmailVisiteur();
?>

<h1 class="text-center text-secondary">Votre email au vendeur</h1>
<form method="post">
    <div class="form-group">
        <label>Votre email : </label>
        <input type="email" name="email_visteur" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Votre message : </label>
        <textarea type="text" rows="5" name="message_visiteur" class="form-control" required></textarea>
    </div>

    <div class="form-group">

        <button type="submit" name="send_mail_to_seller" class="btn btn-warning">Envoyer</button>
        <a href="accueil" class="btn btn-primary">Retour</a>
    </div>
</form>

<?php
    if(isset($_POST['send_mail_to_seller'])){
        $emailVisiteur->validerEmailVisiteur();
    }
?>

