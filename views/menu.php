
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="accueil">
        <img id="logo-annonce" src="assets/img/logo-mini.png" alt="Annonces.com" title="Annonces.com">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php
            //POUR LES UTILISATEUR
            if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                ?>
                <a href="deconnexion" class="btn btn-danger my-2 my-sm-0 ml-2" type="submit">DECONNEXION</a>
                <a href="gestion_annonces" class="text-warning ml-2 mt-2">Bonjour : <?= $_SESSION['email_utilisateur'] ?></a>
                <?php
            }else{
                ?>
                <a href="connexion_utilisateur" class="btn btn-danger my-2 my-sm-0 ml-2" type="submit">CONNEXION</a>
                <?php
            }

            ?>

            <a href="inscription" class="btn btn-warning my-2 my-sm-0 ml-2" type="submit">INSCRIPTION</a>
        </ul>
        <!--FOMULAIRE DE RECHERCHE GLOBALE PAR MOT CLE-->
            <form class="form-inline my-2 my-lg-0" method="post">
                <a href="resultat_recherche" name="btn-search-name" class="btn btn-info my-2 my-sm-0 mr-2" type="submit">Rechercher</a>
            </form>
            <?php
            if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
                ?>
                <a href="deconnexion" class="btn btn-success my-2 my-sm-0" type="submit">DECONNEXION ADMINISTRATEUR</a>
                <?php
            }else{
                ?>
                <a href="connexion" class="btn btn-success my-2 my-sm-0" type="submit">ADMINISTRATION</a>
                <?php
            }
            ?>

        </form>
    </div>
</nav>