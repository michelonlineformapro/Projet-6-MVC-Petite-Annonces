<?php

require "../models/Administration.php";

    function afficherTableAdmin(){
        $tableAdmin = new Administration();
        $resTableAdmin = $tableAdmin->getTableAdmin();
        $resTableUsers = $tableAdmin->getTableUsers();
        $resTableArticle = $tableAdmin->getTableArticles();
        $resTableCategories = $tableAdmin->getTableCategories();
        require "../views/administration.php";

    }

    function ajouterAdministrateur($email_admin, $password_admin){
        $admin = new Administration();
        $ajouterUnAdmin = $admin->addAdmin($email_admin, $password_admin);

    }

    function supprimerUnAdmin(){
        $admin = new Administration();
        $confirmerSuprAdmin = $admin->deleteAdmin();
        require "../views/administration/supprimer_admin.php";
    }

    ////////////////////////////////USERS////////////////
    function supprimerUnUser(){
        $admin = new Administration();
        $confirmerSuprUser = $admin->deleteUserFromAdmin();
        require "../views/administration/supprimer_user.php";
    }

    //////////////////////ANNONCES//////////////////
    function supprimerUneAnnonce(){
        $admin = new Administration();
        $confirmerSuprProduit = $admin->deleteArticleFromAdmin();
        require "../views/administration/supprimer_article.php";
    }