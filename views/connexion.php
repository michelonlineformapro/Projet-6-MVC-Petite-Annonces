<?php

//Instance dela classe Admin
$admin = new Administration();

if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
    header("Location:http://localhost/bon_coin_mic/index.php?url=administration");
}
?>

    <div id="login-form-admin" class="main-content mt-2">

    <h1 class="text-center text-warning">CONNEXION A VOTRE ESPACE ADMINISTRATION</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email_admin" class="form-control form-search-item" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password_admin" class="form-control form-search-item" id="exampleInputPassword1" placeholder="Mot de passe">
        </div>

        <input name="btn_valid_admin" type="submit" class="btn btn-primary" />

    </form>
    </div>

<?php
if(isset($_POST['btn_valid_admin'])){
    $admin->adminLogin();
}
