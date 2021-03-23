<?php
require "../models/Utilisateurs.php";



/*
function validRegisterUsers($nom_utilisateur, $email_utilisateur, $password_utilisateur){
    //Instance de la classe utilisateur
    $user = new Utilisateurs();
    //Appel de la methode du model
    $addUser = $user->userRegister($nom_utilisateur, $email_utilisateur, $password_utilisateur);
    if($addUser){
        header("Location: http://localhost/bon_coin_mic/confirme_inscription");
    }
}
*/

function displayUserById(){
    $utilisateur = new Utilisateurs();
    $getUserById = $utilisateur->getUserById($_GET['id']);
    require "../views/confirme_inscription.php";
}