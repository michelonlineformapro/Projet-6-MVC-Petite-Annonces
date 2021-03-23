<?php



class Utilisateurs extends Database
{
    private $id_utilisateur;
    private $nom_utilisateur;
    private $email_utilisateur;
    private $password_utilisateur;

    public function userLogin()
    {

        //Connexion a la base de données a l'aide de l'instance de la classe mere (database)
        //Et appel de sa methode puyblic getPDO()

        $db = $this->getPDO();

        //Verifie si admin est deja connexté

        if (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true) {
            header('Location: http://localhost/bon_coin_mic/gestion_annonces');
        }

        //Verification des champ du formulaire

        if (isset($_POST['email_utilisateur']) && !empty($_POST['email_utilisateur'])) {
            $this->email_utilisateur = htmlspecialchars(strip_tags($_POST['email_utilisateur']));
        } else {
            echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        }

        if (isset($_POST['password_utilisateur']) && !empty($_POST['password_utilisateur'])) {
            $this->password_utilisateur = htmlspecialchars(strip_tags($_POST['password_utilisateur']));
        } else {
            echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        }

        if (!empty($_POST['email_utilisateur']) && !empty($_POST['password_utilisateur'])) {
            //Requète de connexion
            $sql = "SELECT * FROM utilisateurs WHERE email_utilisateur = ? AND password_utilisateur = ?";

            //Requète préparée
            $stmt = $db->prepare($sql);

            //Bind des paramètre

            $stmt->bindParam(1, $_POST['email_utilisateur']);
            $stmt->bindParam(2, $_POST['password_utilisateur']);
            //Attention ici 2 paramètres a liés
            $stmt->execute();

            if ($stmt->rowCount() >= 1) {
                //CReer une variavle qui liste (recherche) tous les element
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_utilisateur = $row['id_utilisateur'];
                //Recup de email
                $this->email_utilisateur = $row['email_utilisateur'];
                $hashed_password = $row['password_utilisateur'];

                //Verif que le mot passe encrypté match
                if (password_verify($_POST['password_utilisateur'], $hashed_password)) {
                    echo "Le mot passe est bon";
                } else {
                    echo "erreru le mot passe ne match pas";
                }

                if ($_POST['email_utilisateur'] == $row['email_utilisateur'] && $_POST['password_utilisateur'] == $row['password_utilisateur']) {
                    //Demarre la seesion
                    session_start();
                    //Booléen pour verifié si on est connecté
                    $_SESSION['connecter_user'] = true;
                    $_SESSION['id_utilisateur'] = $id_utilisateur;
                    $_SESSION['email_utilisateur'] = $this->email_utilisateur;
                    //La redirection
                    header('Location: http://localhost/bon_coin_mic/gestion_annonces');
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

    public function userRegister($nom_utilisateur, $email_utilisateur, $password_utilisateur){
        $db = $this->getPDO();
        $sql = "INSERT INTO `utilisateurs`(`nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES (?,?,?)";

        $this->nom_utilisateur = $nom_utilisateur;
        $this->email_utilisateur = $email_utilisateur;
        $this->password_utilisateur = $password_utilisateur;

        $insertUser = $db->prepare($sql);
        $insertUser->bindParam(1, $nom_utilisateur);
        $insertUser->bindParam(2, $email_utilisateur);
        $insertUser->bindParam(3, $password_utilisateur);

        $insertUser->execute(array($nom_utilisateur, $email_utilisateur, $password_utilisateur));
        return $insertUser;
    }


    //Afficher les détails de l'annonce pour les visiteurs
    public function getUserById($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $user_id = $stmt->fetch();
        return $user_id;
    }
}