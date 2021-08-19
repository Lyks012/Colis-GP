<?php
ob_start();
require_once("view/shared/navbarConnected.php");
extract($announcementDetails[0]);

$actionButtonToDisplay = array(
    '
    <div class="col-12 mt-3">
        <a href="index.php?action=editAnnouncement&announcementId='.$_GET['announcementId'].'" type="button" class="btn btn-warning">
            Modifier
        </a>
    </div>'
    ,
    '
    <div class="col-12 mt-3">
        <a href="index.php?action=deleteAnnouncement&announcementId='.$_GET['announcementId'].'" type="button" class="btn btn-danger">
            Supprimer
        </a>
    </div>
    '
)
?>
<?php
require_once("view/carrier/listAnnouncementDetails.php");
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>