<?php

if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
?>

<h1 class="text-center text-info">Gestion de vos annonces</h1>
<a href="ajouter_annonce" class="btn btn-success">Ajouter une annonce</a>
    <div class="row mt-3">
<?php

foreach ($showArticleByUser as $data){
    ?>

        <div class="col-sm-12 col-lg-4 mt-2">
            <div id="annonce-card" class="card">
                <img class="card-img-top img-fluid" src="~/<?= $data['photo_article'] ?>" alt="<?= $data['nom_article'] ?>" title="<?= $data['nom_article'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['nom_article'] ?></h5>
                    <p class="card-text"><b>Description :</b></p>
                    <p><?= $data['description_article'] ?></p>
                    <p><b>Prix : </b><?= $data['prix_article'] ?> €</p>
                    <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                    <p><b>Nom du vendeur : </b><?= $data['nom_utilisateur'] ?></p>
                    <p><b>Région : </b><?= $data['nom_region'] ?></p>
                    <a href="editer_annonce_user&id=<?= $data['id_article'] ?>" class="btn btn-info">Editer</a>
                    <!--MODAL SUPPRIMER-->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supprimer_annonce_user&id=<?= $data['id_article'] ?>">
                        Supprimer cette annonce
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="supprimer_annonce_user&id=<?= $data['id_article'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="text-center text-danger">ATTENTION</h1>
                                    <h2 class="text-warning text-center">Vous allez supprimer ce produit !</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <li>
                                            <h3 class="modal-title text-info text-center" id="exampleModalLabel"><?= $data['nom_article'] ?></h3>
                                        </li>
                                        <li class="list-group-item text-center">
                                            <img src="<?= $data['photo_article'] ?>" alt="<?= $data['nom_article'] ?>" title="<?= $data['nom_article'] ?>" width="50%" class="img-fluid">
                                        </li>
                                        <li>
                                            <p><b>Description : </b></p>
                                            <p><?= $data['description_article'] ?></p>
                                        </li>
                                        <li>
                                            <p><b>Prix : <?= $data['prix_article'] ?> €</b></p>
                                        </li>
                                        <li>
                                            <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                                        </li>
                                        <li>
                                            <p><b>Région : </b><?= $data['nom_region'] ?></p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="index.php?url=supprimer_annonces&id=<?= $data['id_article'] ?>"  type="button" class="btn btn-primary">Confirmer la suppression</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
}
?>
  </div>
<?php
}else{
    echo "merci de vous connecteer";
}