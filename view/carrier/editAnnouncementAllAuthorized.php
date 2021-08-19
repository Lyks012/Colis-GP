<?php
ob_start();
require_once("view/navbar.php");
($announcementInfos);
?>
<form action="EditAnnouncement" method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Modifier l'annonce</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                pays depart : <input type="text" name="" id="">
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
</form>
<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>
