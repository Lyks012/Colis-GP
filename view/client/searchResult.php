<?php
    ob_start();
    if(isset($_SESSION['connected'])) require_once("view/shared/navbarConnected.php");
    else require_once("view/navbar.php");
    
?>
<div class="container-fluid">
    <h1>Resultats</h1>
</div>

<?php
    require_once("view/annoncesList.php");
    require_once('view/footer.php');
    $content = ob_get_clean();
    require_once("view/template.php");
?>