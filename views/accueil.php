<div class="text-center mt-2 main-content">
    <img width="25%" src="assets/img/logo.png" alt="Annonces.com" title="Annonce.com">
    <div>
        <h1 class="text-info">Rechercher une annonce</h1>

        <div id="search-form">
            <form class="form-inline text-center mt-2" method="post">
                <div class="form-group mb-2">
                    <select name="categorie_id" class="form-control form-search-item">
                        <option value="1">Multimédias</option>
                        <option value="2">Electro-menager</option>
                        <option value="3">Meubles</option>
                        <option value="4">Véhicules</option>
                        <option value="5">Modes</option>
                        <option value="6">Divers</option>
                    </select>
                </div>

                <div class="form-group mb-2 ml-2">
                    <select class="form-control" id="stock" name="region_id">
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
                <div class="form-group mb-2 ml-2">
                    <button type="submit" name="search_valid" class="btn btn-outline-warning">Rechercher</button>
                </div>
            </form>
        </div>

        <!--RECHERCHE PAR MOT CLE-->
        <div class="jumbotron">
            <div class="text-center">

        <h1 class="text-center text-primary">Résultat de votre recherche</h1>
        <!--FOMULAIRE DE RECHERCHE GLOBALE PAR MOT CLE-->
            <form method="post">
                <input class="form-control mr-sm-2" type="search" name="recherche"  placeholder="Rechercher" aria-label="Rechercher">
                <button name="btn-search-name" class="btn btn-info mt-3" type="submit">Rechercher</button>
            </form>
        </div>
        </div>

    </div>
</div>

<div class="container-fluid text-center mt-3">
    <h2 class="text-center text-danger">Votre région :</h2>
    <link rel="stylesheet" href="assets/carte/cmap/style.css">
    <script src="assets/carte/cmap/jquery-1.11.1.min.js"></script>
    <script src="assets/carte/cmap/France-map.js"></script>
    <script>
        francefree();
    </script>
</div>
<?php
/*
var_dump($_POST['categorie_id']);
var_dump($_POST['region_id']);
*/


