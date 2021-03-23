<?php
require "../models/Articles.php";


    //Afficher tous les articles pour un visiteur
    function displayAllArticle(){
        //Instance du model
        $articles = new Articles();
        //Appel de la methode concernée depuis le model
        $allArticle = $articles->getAllArticle();
        require "../views/accueil.php";
    }

    //Afficher un article par id
    function displayArticleById(){
        //Instance du model
        $article = new Articles();
        //Appel de la methode concernée
        $details = $article->getArticleById($_GET['id']);
        require "../views/details_annonce.php";
    }

    //Afficher les article par utilisateur
    function articleByUser(){
        //Insatnce du model article
        $article = new Articles();
        //stock et appel de la methode du model
        $showArticleByUser = $article->getArticleByUser();
        //Appel de la vue concerné
        //La methode du controller est appelée depuis le router
        require "../views/gestion_annonces.php";
    }

    //Inserer un article pour user on passe les parramètre a vérifié dans le router
    function addArticleUser($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id, $region_id){
        //Instance du model
        $article = new Articles();
        //Appel de la methode du model
        $ajouterArtcileUser = $article->createUserArticle($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id, $region_id);
        //Cette methode controller est appelée dans le router
    }

    //Liste toutes les catégorie = cette methode est appelée dans les formulaire insert et update
    function displayAllCategories(){
        $article = new Articles();
        $categorie_id = $article->getAllCategories();

                    ?>
        <option value="">Choix de la catégorie</option>
                    <?php
                    foreach ($categorie_id as $item) {
                        ?>

                        <option value="<?= $item['id_categorie'] ?>"><?= $item['type_categorie'] ?></option>
                    <?php
                    }

        //var_dump($_POST['categorie_id']);
        return $categorie_id;
    }

//Supprimer un article
    function removeUserArticle(){
        //Instance du model
        $article = new Articles();
        //Appel de la methode concernée
        $delete = $article->deleteUserAticle();
        if($delete){
            header("Location:http://localhost/bon_coin_mic/index.php?url=gestion_annonces");
        }else{
            echo "Erreur lors de la supression de l'article";
        }
    }

    //Mettre a jour un article pour user on passe les parramètre a vérifié dans le router
    function updateArticleUser($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id,$region_id, $id){
        //Instance du model
        $article = new Articles();
        $_GET['id'] = $id;
        //Appel de la methode du model
        $majArticleUser = $article->majUserArticle($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id,$region_id, $_GET['id']);
        //Cette methode controller est appelée dans le router
        if($majArticleUser){
            header("Location:http://localhost/bon_coin_mic/index.php?url=gestion_annonces");
        }else{
            echo "Auncun id trouvé pour cette annonce";
        }
    }


    //Articles par regions
    function afficherProduitParRegion($id){
        $region = new Articles();
        $getRegion = $region->getArticleByRegion($_GET['id']);
        if($getRegion){
            require "../views/region.php";
        }else{
            echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region</b></p>";
        }
    }

    function getArticleByCategorieAndRegion($region, $categorie){
        $article = new Articles();
        $resultsCR = $article->getArticleByRegionAndCategorie($region, $categorie);
        if($resultsCR){
            require "../views/regionCR.php";
        }else{
            echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region et cette catégorie</b></p>";
        }
    }


//Export d'une annonces en PDF
    function pdfExport($id){
        $article = new Articles();
        $id = $_GET['id'];
        $getPdf = $article->generatePDF($id);
        return $getPdf;

    }

    function rechercheGlobaleMotCle($recherche){
        $article = new Articles();
        $results = $article->searchProductGlobal($_POST['recherche']);
        if($results){
            require "../views/resultat_recherche_globale.php";
        }else{
            echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region et cette catégorie</b></p>";
        }

    }
    //Recherche global dans la barre de recherche de la navbar




