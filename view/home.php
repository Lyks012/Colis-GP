<?php ob_start();
if(isset($_SESSION['connected'])) require_once('view/shared/navbarConnected.php');
else require_once('view/navbar.php');
?>
<div class="jumbotron text-center bg-light bg-overlay worldwideDeliveryImage">
    <div class="container py-5">
        <h1 class="display-3">Colis GP</h1>
        <p class="lead">Les continents vous séparent, Colis GP vous rapproche.</p>
    </div>
</div>
<hr>

<div class="jumbotron text-center bg-light bg-overlay searchImage">
    <div class="container py-5">
        <h1 class="display-3">Rechercher un colis</h1>
        <form action="index.php?action=search" method="post">
            <p>Je veux envoyer un colis de
                <select name="departureCountry" class="searchInput" id="" required>
                <option value="">Choisir un pays de depart</option>
                <?php require("view/shared/countriesListOption.php") ?>
            </select>
            a
            <select name="arrivalCountry" class="searchInput" required id="">
                <option value="">Choisir un pays de destination</option>
                <?php require("view/shared/countriesListOption.php") ?>
            </select>
             a partir du<input type="date" required name="dateDepart" class="searchInput"></p>
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </form>
    </div>
</div>


<div class="container text-center">
    <hr>
        <h2>Dernieres annonces</h2>
    <hr>
</div>

<?php
    require_once("view/annoncesList.php");
?>

<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>