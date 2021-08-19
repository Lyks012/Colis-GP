<?php
ob_start();
if(isset($_SESSION['connected'])){
    require_once("view/shared/navbarConnected.php");
}
else require_once("view/navbar.php");
?>
<p>Erreur : <?= $errorMsg ?></p>
<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>