<?php
session_start();
//Router de base
require "../controllers/ArticlesController.php";
require "../controllers/UtilisateursController.php";
require "../controllers/AdminController.php";

ob_start();



if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}
if($url === ""){
    header("Location: http://localhost/bon_coin_mic/accueil");
}

//LES ROUTES

    //Page accueil

if($url == "accueil"){
    $title = "Annonces.com - Accueil -";
    displayAllArticle();
    if(isset($_POST['search_valid'])){
        $cat = $_POST['categorie_id'];
        $reg = $_POST['region_id'];
        getArticleByCategorieAndRegion($reg, $cat);
        var_dump($_POST['categorie_id']);
        var_dump($_POST['region_id']);
    }

    if(isset($_POST['btn-search-name'])){
        $recherche = $_POST['recherche'];
        rechercheGlobaleMotCle($recherche);
    }

    //Detail des annonces

}elseif ($url === "details_annonce" && isset($_GET['id']) && $_GET['id'] > 0){
    $title = "Annonces.com - DÉTAILS ANNONCES -";
    displayArticleById();

    //Connexion

}elseif ($url === "connexion"){
    //Connexion admin
    require "connexion.php";
    $title = "Mon Gite.com - CONNEXION ADMINISTRATEUR -";

    //Connexion utilisateur

}elseif ($url == "connexion_utilisateur"){
    require "connexion_user.php";
    $title = "Annonces.com - CONNEXION UTILISATEUR -";

    //Si connecter va à la page admin


}elseif (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true && $url === "administration"){

    $title = "Annonces.com - ADMINISTRATION -";
    //Lister tous les admin
    afficherTableAdmin();
    //Deconnexion pour utilisateur et admin

}elseif (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true && $url === "ajouter_admin"){
    require "administration/ajouter_admin.php";

    $title = "Annonces.com - Ajouter Admin -";
    if(!empty($_POST['email_admin']) && !empty($_POST['password_admin'])){
        if(isset($_POST['email_admin']) && isset($_POST['password_admin'])){
            ajouterAdministrateur($_POST['email_admin'],$_POST['password_admin']);
            header("Location: http://localhost/bon_coin_mic/administration");
        }

    }else{
        echo "<p class='alert-warning p-2'>Merci de ne donner les droit d'administration qu'aux personnes de confiance !</p>";
    }


} elseif (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true && $url === "supprimer_admin"){
    $title = "Annonce.com -Supprimer Admin-";
    supprimerUnAdmin();

}elseif (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true && $url === "supprimer_user"){
    $title = "Annonce.com -Supprimer Utilisateur-";
    supprimerUnUser();
}elseif (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true && $url === "supprimer_annonce"){
    $title = "Annonce.com -Supprimer Annonce-";
    supprimerUneAnnonce();
}


elseif ($url === "deconnexion"){
    require "deconnexion.php";

    //Sin connexter dashboard utilisateur

}elseif (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true && $url === "gestion_annonces"){
    $title = "Annonce.com - GESTION ANNONCES -";
    articleByUser();
    //Inscription utilisateur

}elseif ($url === "inscription"){
    $title = "Annonces.com - INSCRIPTION -";
    require "../views/inscription.php";

    //Confirmer inscription

}elseif ($url === "confirme_inscription"){
    $title = "Annonce.com - CONFIRMER INSCRIPTION -";
    displayUserById();
}

elseif (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true && $url === "ajouter_annonce"){

    //Ajout annonce utilisateur

    require "ajouter_annonce.php";
    $_POST['utilisateur_id'] = $_SESSION['id_utilisateur'];
    $title = "Annonces.com -AJOUTER ANNONCE - ";
    if(isset($_POST['nom_article']) && isset($_POST['description_article']) && isset($_POST['prix_article']) && isset($_POST['photo_article']) && isset($_POST['categorie_id']) && isset($_SESSION['id_utilisateur']) && isset($_POST['region_id'])){
        //ICI AJOUTER !empty
        addArticleUser($_POST['nom_article'], $_POST['description_article'], $_POST['prix_article'], $_POST['photo_article'], $_POST['categorie_id'],$_SESSION['id_utilisateur'], $_POST['region_id']);
        header("Location: http://localhost/bon_coin_mic/gestion_annonces");
    }

    //Suprimer une annonce utilisateur

}elseif (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true && $url === "supprimer_annonces" && isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
        removeUserArticle();

        //Editer annonce utilisateur

}elseif (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true && $url === "editer_annonce_user" && isset($_GET['id']) && $_GET['id'] > 0){
    require "maj_annonce.php";
    $title = "Annonces.com - METTRE A JOUR ANNONCE - ";
    if(isset($_POST['nom_article']) && isset($_POST['description_article']) && isset($_POST['prix_article']) && isset($_POST['photo_article']) && isset($_POST['categorie_id'])&& isset($_SESSION['id_utilisateur']) && isset($_POST['region_id'])){
        //ICI AJOUTER !empty
        updateArticleUser($_POST['nom_article'], $_POST['description_article'], $_POST['prix_article'], $_POST['photo_article'], $_POST['categorie_id'],  $_SESSION['id_utilisateur'],$_POST['region_id'], $_GET['id']);
        //header("Location: http://localhost/bon_coin_mic/gestion_annonces");
    }


}elseif ($url === "panier"){
    $title = "Annonce.com - Panier - ";
    require "panier.php";
}elseif ($url === "region"){
    $title = "Annonce.com - Produits par région - ";
    $id = $_GET['id'];
    afficherProduitParRegion($id);

}elseif ($url === "pdf" && isset($_GET['id']) && $_GET['id'] > 0){
    $id = $_GET['id'];
    pdfExport($id);
}elseif ($url === "resultat_recherche"){
    require "../views/resultat_recherche_globale.php";
}elseif ($url === "messageVendeur"){
    require "../views/messageVendeur.php";
}

/*
else{
    require "404.php";
}
*/

$content = ob_get_clean();
require "template.php";