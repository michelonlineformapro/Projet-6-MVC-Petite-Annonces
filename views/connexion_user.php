<?php


//Instance dela classe Admin
$user= new Utilisateurs();

if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
    header("Location:http://localhost/bon_coin_mic/index.php?url=gestion_annonces");
}
?>

    <div class="main-content mt-2">


        <h1 class="text-center text-warning">CONNEXION A VOTRE ESPACE DE GESTION DE VOS ANNONCES</h1>

        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email_utilisateur" class="form-control form-search-item" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password_utilisateur" class="form-control form-search-item" id="exampleInputPassword1" placeholder="Mot de passe">
            </div>

            <input name="btn_valid_admin" type="submit" class="btn btn-primary" />

        </form>
    </div>

<?php
if(isset($_POST['btn_valid_admin'])){
    $user->userLogin();
}

