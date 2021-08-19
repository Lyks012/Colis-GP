<?php
ob_start();
require_once("view/shared/navbarConnected.php");
?>

<div class="jumbotron text-center bg-light bg-overlay worldwideDeliveryImage">
    <div class="container py-5">
        <h1 class="display-3">Colis GP</h1>
        <p class="lead">Les continents vous separent, Colis-GP vous rapproche</p></p>
    </div>
</div>

<div class="container text-center">
    <hr>
        <h2>Mes annonces</h2>
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