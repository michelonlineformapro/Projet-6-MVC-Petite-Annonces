
<h1 class="text-center text-primary">Résultat de votre recherche</h1>
<div class="row">
<?php

            foreach ($results as $data){
                ?>
                <div class="col-sm-12 col-lg-4 mt-2">
                    <div id="annonce-card" class="card">
                        <img class="card-img-top img-fluid" src="~/<?= $data['photo_article'] ?>" alt="<?= $data['nom_article'] ?>" title="<?= $data['nom_article'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['nom_article'] ?></h5>
                            <p class="card-text"><b>Description :</b></p>
                            <p><?= $data['description_article'] ?></p>
                            <p><b>Prix : </b><?= $data['prix_article'] ?> €</p>
                            <?php
                            if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){
                                ?>
                                <a href="acheter&id=<?= $data['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                                <?php
                            }else{
                                ?>
                                <a href="connexion_utilisateur&id=<?= $data['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                                <?php
                            }
                            ?>


                            <a onclick="changeText()"  class="btn btn-success mt-3 num_vendeur">Voir me numéro du vendeur</a>

                            <a href="messageVendeur&id=<?= $data['utilisateur_id'] ?>" class="btn btn-primary mt-3">Message</a>

                            <a target="_blank" href="pdf&id=<?= $data['id_article'] ?>" class="btn btn-warning mt-3">Annonce en PDF</a>
                        </div>
                    </div>
                </div>
                <?php
            }
?>
</div>
<script>
    function changeText(){
        $(".num_vendeur").text("06 36 25 41 45");
    }


</script>



