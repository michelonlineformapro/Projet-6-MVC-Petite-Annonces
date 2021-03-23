<?php
require "../models/Panier.php";

$article = new  Articles();
$panier = new Panier();
$id = $_GET['id'];
if(isset($_GET['id'])){
    $article->getArticleById($id);
    $addProduct = $panier->ajouterArticlePanier($id);
}

//https://grafikart.fr/tutoriels/panier-php-session-309
var_dump($article);
?>



<h1 class="text-center text-info">Votre panier</h1>

