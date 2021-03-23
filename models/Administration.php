<?php


//Appel du fichier de la classe de connexion


class Administration extends Database
{
    //Admin
    private $email_admin;
    private $password_admin;

    //Utilisateurs


    //Articles

    //Categories

    public function adminLogin()
    {

        //Connexion a la base de données a l'aide de l'instance de la classe mere (database)
        //Et appel de sa methode puyblic getPDO()

        $db = $this->getPDO();

        //Verifie si admin est deja connexté

        if (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true) {
            header('Location: http://localhost/bon_coin_mic');
        }

        //Verification des champ du formulaire

        if (isset($_POST['email_admin']) && !empty($_POST['email_admin'])) {
            $this->email_admin = htmlspecialchars(strip_tags($_POST['email_admin']));
        } else {
            echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        }

        if (isset($_POST['password_admin']) && !empty($_POST['password_admin'])) {
            $this->password_admin = htmlspecialchars(strip_tags($_POST['password_admin']));
        } else {
            echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        }

        if (!empty($_POST['email_admin']) && !empty($_POST['password_admin'])) {
            //Requète de connexion
            $sql = "SELECT * FROM administration WHERE email_admin = ? AND password_admin = ?";

            //Requète préparée
            $stmt = $db->prepare($sql);

            //Bind des paramètre

            $stmt->bindParam(1, $_POST['email_admin']);
            $stmt->bindParam(2, $_POST['password_admin']);
            //Attention ici 2 paramètres a liés
            $stmt->execute();

            if ($stmt->rowCount() >= 1) {
                //CReer une variavle qui liste (recherche) tous les element
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_admin = $row['id_admin'];
                //Recup de email
                $this->email_admin = $row['email_admin'];
                $hashed_password = $row['password_admin'];

                //Verif que le mot passe encrypté match
                if (password_verify($_POST['password_admin'], $hashed_password)) {
                    echo "Le mot passe est bon";
                } else {
                    echo "erreru le mot passe ne match pas";
                }

                if ($_POST['email_admin'] == $row['email_admin'] && $_POST['password_admin'] == $row['password_admin']) {
                    //Demarre la seesion
                    session_start();
                    //Booléen pour verifié si on est connecté
                    $_SESSION['connecter'] = true;
                    $_SESSION['id_admin'] = $id_admin;
                    $_SESSION['email_admin'] = $this->email_admin;
                    //La redirection
                    header('Location: http://localhost/bon_coin_mic/administration');
                } else {
                    echo "erreur email et mot passe pas bon";
                }
            } else {
                echo "<p class='alert-danger mt-3 p-2'>Erreur de connexion, merci de verifié votre email et mote de passe</p>";
            }
        } else {
            echo "Merci de remplir tous les champs";
        }

    }

    public function getTableAdmin(){
        $db = $this->getPDO();
        $sql= "SELECT * FROM administration";
        $req = $db->query($sql);
        ?>
            <h1 class="text-center text-success">ADMINISTRATION</h1>
            <h2 class="alert-warning p-3 text-danger">Table administrateur</h2>
            <a href="ajouter_admin" class="btn btn-outline-primary">Ajouter</a>
            <table class="table table-striped mt-2">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($req as $row) {
                ?>
                <tr>
                    <td><?= $row['email_admin'] ?></td>
                    <td><?= $row['password_admin'] ?></td>
                    <td><a href="supprimer_admin&id=<?= $row['id_admin'] ?>" class="btn btn-outline-primary">Supprimer</a></td>
                </tr>
                       <?php

                }
                ?>
                </tbody>
            </table>
         <?php
    }

    /////////////////AJOUTER ADMIN///////////////

    public function addAdmin($email_admin, $password_admin){
        $db = $this->getPDO();
        $this->email_admin = $email_admin;
        $this->password_admin = $password_admin;
        $sql = "INSERT INTO administration (email_admin, password_admin) VALUES (?,?)";
        $insert = $db->prepare($sql);
        $insert->bindParam(1, $email_admin);
        $insert->bindParam(2, $password_admin);
        $insert->execute(array($email_admin, $password_admin));
        return $insert;
    }

    //SUPPRIMER UN ADMIN/////

    public function deleteAdmin(){
        $db = $this->getPDO();
        $sql = "DELETE FROM administration WHERE id_admin = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $_GET['id']);
        $delete = $stmt->execute();
        return $delete;
    }




    /*************************************UTILISATEURS****************************************/


    public function getTableUsers(){
        $db = $this->getPDO();
        $sql= "SELECT * FROM utilisateurs";
        $req = $db->query($sql);
        ?>
            <h2 class="alert-success p-3 text-info mt-2">Table utilisateurs</h2>

            <table class="table table-striped mt-2">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Supprimer</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($req as $row) {
                ?>
                <tr>
                    <td><?= $row['nom_utilisateur'] ?></td>
                    <td><?= $row['email_utilisateur'] ?></td>
                    <td><?= $row['password_utilisateur'] ?></td>
                    <td><a href="supprimer_user&id=<?= $row['id_utilisateur'] ?>" class="btn btn-outline-warning">Supprimer</a></td>
                </tr>
                     <?php

                    }
                ?>
                </tbody>
            </table>
           <?php
        return $req;
    }
    //SUPPRIMER UN UTILISATEUR QU'ON EST AIME PAS////

    function deleteUserFromAdmin(){
        $db = $this->getPDO();
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $_GET['id']);
        $delete = $stmt->execute();
        return $delete;
    }



    /*****************************************TABLE ARTICLES***********************/
    public function getTableArticles(){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM articles INNER JOIN utilisateurs ON articles.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON articles.categorie_id = categories.id_categorie";
        $req = $db->query($sql);
        ?>
        <h2 class="alert-danger p-3 text-warning mt-2">Table articles</h2>

        <table class="table table-striped mt-2">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Photo</th>
                <th>Categorie</th>
                <th>Vendeur</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($req as $row) {
                ?>
                <tr>
                    <td><?= $row['nom_article'] ?></td>
                    <td><?= $row['description_article'] ?></td>
                    <td><?= $row['prix_article'] ?></td>
                    <td><img width="100%" src="<?= $row['photo_article'] ?>" alt="<?= $row['nom_article'] ?>" title="<?= $row['nom_article'] ?>"></td>
                    <td><?= $row['type_categorie'] ?></td>
                    <td><?= $row['nom_utilisateur'] ?></td>
                    <td><a href="supprimer_annonce&id=<?= $row['id_article'] ?>" class="btn btn-outline-warning">Supprimer</a></td>
                </tr>
                <?php

            }
            ?>
            </tbody>
        </table>
        <?php
        return $req;
    }
    //SUPRIMER UN ARTICLE QUAND ON EST ADMIN/////

    function deleteArticleFromAdmin(){
        $db = $this->getPDO();
        $sql = "DELETE FROM articles WHERE id_article = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $_GET['id']);
        $delete = $stmt->execute();
        return $delete;
    }

    /*********************************************TABLE CATEGORIES*************************/
    public function getTableCategories(){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM categories";
        $req = $db->query($sql);
        ?>
        <h2 class="alert-secondary p-3 text-dark mt-2">Table catégories</h2>

        <table class="table table-striped mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type de catégorie</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($req as $row) {
                ?>
                <tr>
                    <td><?= $row['id_categorie'] ?></td>
                    <td><?= $row['type_categorie'] ?></td>
                    <td><a href="supprimer_admin&id=<?= $row['id_categorie'] ?>" class="btn btn-outline-warning">Supprimer</a></td>
                </tr>
                <?php

            }
            ?>
            </tbody>
        </table>
        <?php
        return $req;
    }
    /*********************************************TABLE REGIONS *************************/


}