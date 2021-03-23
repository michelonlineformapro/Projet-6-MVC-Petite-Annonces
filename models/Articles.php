<?php

require "Database.php";
class Articles extends Database
{
    private $id_article;
    private $nom_article;
    private $description_article;
    private $prix_article;
    private $photo_article;
    private $categorie_id;
    private $utilisateur_id;
    private $region_id;

    //Afficher tous les articles pour un visiteur
    public function getAllArticle(){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions";
        $stmt = $db->query($sql);
        return $stmt;
    }

    //Afficher les détails de l'annonce pour les visiteurs
    public function getArticleById($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE id_article = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $details = $stmt->fetch();
        return $details;
    }

    //Afficher les articles en fonction de l'utilisateur
    public function getArticleByUser(){
        //Connexion a la classe mere Database PDO
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE utilisateur_id = ?";
        //Requète préparée
        $req= $db->prepare($sql);
        $this->id_article = $_SESSION['id_utilisateur'];
        $req->bindParam(1, $this->id_article);
        $req->execute(array($this->id_article));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    //Ajouter un article pour un utilisateur
    public function createUserArticle($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id, $region_id){
        $db = $this->getPDO();

        $this->nom_article = $nom_article;
        $this->description_article = $description_article;
        $this->prix_article = $prix_article;
        $this->photo_article = $photo_article;
        $this->categorie_id = $categorie_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->region_id = $region_id;

        $sql = "INSERT INTO articles (nom_article, description_article, prix_article, photo_article, categorie_id, utilisateur_id, region_id) VALUES (?,?,?,?,?,?,?)";
        $insert = $db->prepare($sql);
        $insert->bindParam(1, $nom_article);
        $insert->bindParam(2, $description_article);
        $insert->bindParam(3, $prix_article);
        $insert->bindParam(4, $photo_article);
        $insert->bindParam(5, $categorie_id);
        $insert->bindParam(6, $utilisateur_id);
        $insert->bindParam(7, $region_id);

        $insert->execute(array($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id, $region_id));
        return $insert;

    }

    //Ajouter un article pour un utilisateur
    public function majUserArticle($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id, $region_id, $id){
        $db = $this->getPDO();
        $query = "UPDATE `articles` SET `nom_article`= ?,`description_article`= ?,`prix_article`= ?,`photo_article`= ?,`categorie_id`= ?,`utilisateur_id`= ?, region_id = ? WHERE id_article = ?";
        $req = $db->prepare($query);
        $req->execute(array($nom_article, $description_article, $prix_article, $photo_article, $categorie_id, $utilisateur_id, $region_id, $id));
        //$id = $req->fetch(PDO::FETCH_ASSOC);
        return $req;
    }

    //Supprimer un article pour un utilisateur
    public function deleteUserAticle(){
        $db = $this->getPDO();
        $sql = "DELETE FROM articles WHERE id_article = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $_GET['id']);
        $delete = $stmt->execute();
        return $delete;
    }

    ///////////////////////////////////////////////////CATEGORIES//////////////////////////
    public function getAllCategories(){
        $db = $this->getPDO();
        $sql =  "SELECT * FROM `categories`";
        $categories = $db->query($sql);

        return $categories;
    }

    /////////////////////////////////////////////UTILISATEUR//////////
    ///

    //////////////////REGIONS/////
    //Afficher les détails de l'annonce par regions
    public function getArticleByRegion($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles  INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE region_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $getRegion = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $getRegion;
    }

    //Afficher les détails de l'annonce par categories
    public function getArticleByCategories($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE categorie_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $details = $stmt->fetch();
        return $details;
    }

    //Afficher les détails de l'annonce par regions et categories
    public function getArticleByRegionAndCategorie($id_region, $id_categorie){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE region_id = ? AND categorie_id = ?";
        $stmt = $db->prepare($sql);
        $this->region_id = $id_region;
        $this->categorie_id = $id_categorie;
        $stmt->bindParam(1, $id_region);
        $stmt->bindParam(2, $id_categorie);
        $stmt->execute(array($id_region, $id_categorie));
        $resultsCR = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultsCR;
    }
    function generatePDF($annonceID){
        ob_get_clean();
        //Instance de la classe
        require "../assets/FPDF/fpdf.php";
        $db = $this->getPDO();
        $query = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE id_article = ?";
        $req = $db->prepare($query);
        $req->execute(array($annonceID));
        $details_annonces = $req->fetch();

        $this->nom_article = $details_annonces['nom_article'];
        $this->description_article = $details_annonces['description_article'];
        $this->prix_article = $details_annonces['prix_article'];
        $this->photo_article = $details_annonces['photo_article'];
        $this->categorie_id = $details_annonces['type_categorie'];
        $this->utilisateur_id = $details_annonces['nom_utilisateur'];
        $this->region_id = $details_annonces['nom_region'];

        ?>
        <!DOCTYPE>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        </html>

        <?php
        ob_get_clean();
        $pdf = new FPDF();
        //Sortie
        $pdf->AddPage();
        //Header
        $pdf->Image('../models/logo-mini.png');

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Votre annonces : ');
        $pdf->Ln(10);
        $pdf->Cell(190,10, iconv('UTF-8', 'ISO-8859-2', 'Nom du jeux : '.$this->nom_article));

        $pdf->Ln(10);
        $pdf->Image(''.$details_annonces['photo_article'], 100, 120, 100,100);

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell(190,10,'Description du jeux : '.utf8_decode($this->description_article), 1, 'J');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Prix du produit : '.$this->prix_article. ' EUROS');
        $pdf->Ln(10);
        $pdf->Cell(190,10,iconv('UTF-8', 'ISO-8859-2', 'Catégorie : '.$this->categorie_id));
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Nom du vendeur : '.$this->utilisateur_id);
        $pdf->Ln(10);
        $pdf->Cell(190,10,iconv('UTF-8', 'ISO-8859-2', 'Région : '.$this->region_id));
        $pdf->Ln(10);
        $pdf->AddLink("http://localhost/bon_coin_mic/region&id=3");


        $pdf->Output('','annonces.pdf',true);
    }

    /*************************RECHERCHE********************************/
    //Recherche de gite par mot clé dans nom_gite + description_gite + prix + category_gite
    public function  searchProductGlobal($recherche){
        //Connexion à PDO
        $db = $this->getPDO();
        //Recup de input recherche
        if(isset($_POST['recherche'])){
            $recherche = $_POST['recherche'];
        }else{
            $recherche = "";
            if(empty($recherche)){
                echo "<p class='alert-danger mt-2 p-2'>Merci d'enter un champ dans le barre de recherche</p>";
            }
        }
        var_dump($recherche);

        //$sql = "SELECT * FROM articles  WHERE nom_article = '%$recherche%' ";
        $sql = "SELECT * FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie INNER JOIN regions ON articles.region_id = regions.id_regions WHERE nom_article LIKE '%$recherche%' OR description_article LIKE '%$recherche%' OR prix_article LIKE '%$recherche%' OR type_categorie LIKE '%$recherche%' OR nom_region LIKE '%$recherche%'";
        //Parcours des résultats
        $results = $db->query($sql);
        //Boucle de lecture
        return $results;
    }
}