<h1 class="alert-primary mt-3 p-3 text-center text-info">Annonces de la region :</h1>
    <div class="row">

        <?php
        foreach ($getRegion as $row){
        ?>
        <div class="col-md-4 col-sm-12 mt-3">
            <div class="card"">
            <img width="10%" class="card-img-top img-fluid" src="~/<?= $row['photo_article'] ?>" alt="<?= $row['nom_article'] ?>" title="<?= $row['nom_article'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><b>Produits : </b><br /><?= $row['nom_article'] ?></h5>
                    <p class="card-text"><?= $row['description_article'] ?></p>
                    <p><b>Prix : </b><?= $row['prix_article'] ?> €</p>
                    <p><b>Catégorie : </b><?= $row['type_categorie'] ?></p>
                    <p><b>Nom du vendeur : </b><?= $row['nom_utilisateur'] ?></p>
                    <p><b>Région du vendeur : </b><?= $row['nom_region'] ?></p>

                    <?php
                    if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){
                        ?>
                        <a href="acheter&id=<?= $row['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                        <?php
                    }else{
                        ?>
                        <a href="connexion_utilisateur&id=<?= $row['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                        <?php
                    }
                    ?>


                    <a onclick="changeText()" class="btn btn-success mt-3 num_vendeur">Voir me numéro du vendeur</a>

                    <a href="messageVendeur&id=<?= $row['utilisateur_id'] ?>" class="btn btn-primary mt-3">Message</a>

                    <a target="_blank" href="pdf&id=<?= $row['id_article'] ?>" class="btn btn-warning mt-3">Annonce en PDF</a>
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

