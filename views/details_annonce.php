<?php

?>
<div class="container-fluid">
<h1 class="text-center text-info">Détails de l' annonces</h1>
    <div class="row">

        <div class="col-md-6 col-sm-12">
            <img width="10%" class="card-img-top img-fluid" src="<?= $details['photo_article'] ?>" alt="<?= $details['nom_article'] ?>" title="<?= $details['nom_article'] ?>">
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="">
                <h5 class="card-title"><?= $details['nom_article'] ?></h5>
                <p class="card-text"><b>Description :</b></p>
                <p><?= $details['description_article'] ?></p>
                <p><b>Prix : </b><?= $details['prix_article'] ?> €</p>
                <p><b>Catégorie : </b><?= $details['type_categorie'] ?></p>
                <p><b>Nom du vendeur : </b><?= $details['nom_utilisateur'] ?></p>

                <?php
                if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){
                    ?>
                    <a href="acheter&id=<?= $details['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                    <?php
                }else{
                    ?>
                    <a href="connexion_utilisateur&id=<?= $details['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                    <?php
                }
                ?>


                <a onclick="changeText()" id="<?= $details['utilisateur_id'] ?>" class="btn btn-success mt-3 num_vendeur">Voir me numéro du vendeur</a>
                <a href="messageVendeur&id=<?= $details['utilisateur_id'] ?>" class="btn btn-primary mt-3">Message</a>
                <a target="_blank" href="pdf&id=<?= $details['id_article'] ?>" class="btn btn-warning mt-3">Annonce en PDF</a>
            </div>
        </div>
    </div>
</div>

<script>
    function changeText(){
        $("#num_vendeur").text("06 36 25 41 45");
    }


</script>

