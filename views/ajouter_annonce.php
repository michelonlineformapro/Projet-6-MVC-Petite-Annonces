
<?php

if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){

?>
        <h1 class="text-primary text-center">Ajouter un produit</h1>

        <form  method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Nom du produit</label>
                <input class="form-control" type="text" name="nom_article" id="title" placeholder="Nom du produit" required/>
            </div>

            <div class="form-group">
                <label for="description">Description du produits</label>
                <textarea rows="4" class="form-control" type="text" name="description_article" id="description" placeholder="Description du produit" required></textarea>
            </div>

            <div class="form-group">
                <label for="title">Prix du produit</label>
                <input class="form-control" type="number" step="any" name="prix_article" id="title" placeholder="Prix du produit" required/>
            </div>


            <div class="form-group">
                <label for="stock">Catégories : </label>
                <select class="form-control" id="stock" name="categorie_id" required>
                    <?php
                    displayAllCategories();
                    //$categories = $_POST['categorie_id'];
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Région : </label>
                <select class="form-control" id="stock" name="region_id" required>
                    <option value="1">Grand-Est</option>
                    <option value="2">Aquitaine</option>
                    <option value="3">Rhône-Alpes-Auvergne</option>
                    <option value="4">Normandie</option>
                    <option value="5">Bourgogne-Franche-Compté</option>
                    <option value="6">Bretagne</option>
                    <option value="7">Centre</option>
                    <option value="8">Corse</option>
                    <option value="9">Ile de France</option>
                    <option value="10">Occitanie</option>
                    <option value="11">Haut de France</option>
                    <option value="12">Pays de Loire</option>
                    <option value="13">Provence Alpes Cote D'Azur</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image jeux</label>
                <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                <!--<input type="hidden" name="MAX_FILE_SIZE" value="30000" />-->
                <input type="file" id="image" name="photo_article" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="hidden" id="image" name="id_utilisateur" class="form-control">
            </div>


            <button type="submit" class="btn btn-outline-success">Ajouter le jeux</button>
        </form>

<?php
    $_POST['id_utilisateur'] = $_SESSION['id_utilisateur'];

    if(isset($_FILES['photo_article'])) {
        //Gestion upload image
        $uploaddir = '../assets/img/';
        $photo_article = $uploaddir . basename($_FILES['photo_article']['name']);
        $_POST['photo_article'] = $photo_article;
        if (move_uploaded_file($_FILES['photo_article']['tmp_name'], $photo_article)) {
            echo '<p class="alert-success">Le fichier est valide et à été téléchargé avec succès !</p>';
        } else {
            echo '<p class="alert-danger">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
        }
    }else{
        echo "<p class='alert-warning mt-5 p-5'>Seul les format d'image png, jpg, webp, svg et gif sont accepté !</p>";
    }
    /*
    var_dump($_POST['nom_article']);
    var_dump($_POST['description_article']);
    var_dump($_POST['prix_article']);
    var_dump($_POST['photo_article']);

    var_dump( $_SESSION['id_utilisateur']);
    */
}else{
    echo "merci de vous connecter pour ajouter un produit";
}
