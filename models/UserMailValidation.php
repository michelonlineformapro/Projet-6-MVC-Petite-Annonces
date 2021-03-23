<?php

//Import de la classe php mailer intalée depuis composer  = composer require phpmailer/phpmailer
//Le tous est dans le dossier vendor
//Appel des namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//On utilise autoload si un classe n'est pas trouvée
require "../vendor/autoload.php";

class UserMailValidation
{
    private $id_utilisateur;
    private $nom;
    private $destinataire;
    private $password;

    public function validerInscriptionMail(){
        //Insatnce de la classe phpmailer
        $mail = new PHPMailer();
        try {
            //Config pour mailtrap
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Autorise le debug
            $mail->isSMTP(); //Utilisation du service mail transfer protocole
            $mail->Host = 'smtp.mailtrap.io'; //Appel du host mailtrap
            $mail->SMTPAuth = true; //Autorise et impose un user name + password
            $mail->Username = '1e9a0eeda636b9'; //Generer lors de la création du compte mailTrap = dans l'espace mailtrap roue crantée + smtp setting -> zendFramework https://mailtrap.io/inboxes/1163067/messages
            $mail->Password = '64faa6d7e0bd01'; // Idem pour le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
            $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS` et gmail
            $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');
            $mail->CharSet = 'UTF-8';

            //Envoyeur et destinataire
            $mail->setFrom('annonce@gmail.com', 'Annonces Administration');
            $mail->addAddress('annonce@gmail.com', 'Administrateur Annonces.com');
            $mail->addReplyTo('annonce@gmail.com', 'Annonces Administration');
            //Connexion et requete PDO get by ID
            $user = "root";
            $pass = "";
            $db = new PDO("mysql:host=localhost;dbname=annonces;charset=utf8;", $user, $pass);
            $query = "SELECT * FROM utilisateurs";
            $req = $db->query($query);


            //Contenu du mail
            $mail->isHTML(true);
            $this->destinataire = $_POST['email_utilisateur'];
            $this->nom = $_POST['nom_utilisateur'];
            $this->password = $_POST['password_utilisateur'];
            $mail->Subject = "Validation de votre inscription sur le site annonces.com";

            $query = "INSERT INTO `utilisateurs`(`nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES (?,?,?)";

            $insertUser = $db->prepare($query);
            $insertUser->bindParam(1, $this->nom);
            $insertUser->bindParam(2, $this->destinataire);
            $insertUser->bindParam(3, $this->password);

            $insertUser->execute(array($this->nom, $this->destinataire, $this->password));
            //Boucle de lecture pour retrouver le token ID

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $this->id_utilisateur = $datas['id_utilisateur'];
                //Url du liens de validation
                $url = "http://localhost/bon_coin_mic/confirme_inscription&id=".$this->id_utilisateur += 1;
                //Contenus du mail
                $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>Votre inscription sur Annonce.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="color: #43617f; font-size: 22px;">
    <div style="padding: 20px;">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6fV5-gvJoErCmW1i-kzcc5C0slzboniFycw&usqp=CAU" width="75px" height="75px">
    </div>
    <div style="padding: 20px;">
        <h1>Annonce.com</h1>
        <h2>Bonjour : '.$this->destinataire.'</h2>
        <p>Vous êtes desormais inscrit sur le site Annonce.com merci de valider votre inscription avec le liens suivant</p><br />
        <p>Recapitulatif de vos information de connexion</p>
        <p>Nom :<b style="color: #8b0000">'.$this->nom.'</b></p>
        <p>Email :<b style="color: #8b0000"> '.$this->destinataire.'</b></p>
        <p>Mot de passe :<b style="color: #8b0000;">'.$this->password.'</p>
        <br /><br />
        <a href="' . $url . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer votre inscription sur notre site</a><br />
        <br /><br />
        <p style="color: #43617f;">Merci d\'utiliser notre site web</p>
        <p style="color: #43617f;">Cordialement : Annonces.com: Michael MICHEL : Administrateur</p>    
    </div>
    </body>
    </html>
    ';
                $mail->body = "MIME-Version: 1.0" . "\r\n";
                $mail->body .= "Content-type:text/html;charset=utf8" . "\r\n";
            }

            $mail->send();
        }catch (Exception $e){
            echo "<p class='alert-danger p-3'>Erreur lors de la tentative d'envoi de l'email {$mail->ErrorInfo}</p>";
        }

    }
}