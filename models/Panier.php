<?php


class Panier
{

    //Constructeur pour verifier que session existe
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
    }


    public function ajouterArticlePanier($produit_id){
        $_SESSION['panier'][$produit_id] = 1;
    }
}