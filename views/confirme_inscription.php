<h1 class="text-center text-success">Confirmation d'inscription au site Annonces.com</h1>
<h2 class="text-warning">Reprise de vos informations :</h2>
<ul class="list-group">
    <li class="list-group-item">Nom : <?= $getUserById['nom_utilisateur']  ?></li>
    <li class="list-group-item">Email : <?= $getUserById['email_utilisateur']  ?></li>
    <li class="list-group-item">Mot de passe : <?= $getUserById['password_utilisateur']  ?></li>
    <li class="list-group-item"><a class="btn btn-outline-primary" href="connexion_utilisateur">Connexion</a></li>
</ul>