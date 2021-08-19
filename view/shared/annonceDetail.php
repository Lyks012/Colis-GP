<?php
    ob_start();
    require_once("view/shared/navbarConnected.php");
    extract($announcementDetails[0]);
?>
<?php 
$actionButtonToDisplay = array(
    '
    <div class="col-12 mt-3">
        <a href="index.php?action=transporteurProfile&transporteurId='.$id_transporteur.'" type="button" class="btn btn-primary">
            Voir le Profil
        </a>
    </div>
    ',
    '
    <div class="col-12 mt-3">
        <a href="index.php?action=makeReservation&id_annonce='.$id_annonce.'" type="button" class="btn btn-primary">
            Reserver
        </a>
    </div>
    '

);
require_once("view/carrier/listAnnouncementDetails.php");

?>

<?php
require_once("view/footer.php");
    $content = ob_get_clean();
    require_once("view/template.php");
?>