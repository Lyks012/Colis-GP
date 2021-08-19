<?php
    ob_start();
    require_once("view/shared/navbarConnected.php");
?>

<?php
    require_once("view/shared/reservationDetails.php");
    require_once("view/footer.php");
    $content = ob_get_clean();
    require_once("view/template.php");
?>