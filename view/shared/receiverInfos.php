<?php
ob_start();
require_once("view/shared/navbarConnected.php");
extract($receiverInfos);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12"><h1>Informations destinataire</h1></div>
    </div>
    <div class="row">
        <div class="col-6"><h2>Nom : </h2></div>
        <div class="col-6"><h2>Prenom</h2></div>
    </div>
    <div class="row">
        <div class="col-6"><p><?= $nom ?></p></div>
        <div class="col-6"> <p><?= $prenom ?></p></div>
    </div>
    <div class="row">
        <div class="col-6"><h2>Addresse</h2></div>
        <div class="col-6"><h2>Email</h2></div>
    </div>
    <div class="row">
        <div class="col-6"><p><?= $addresse ?></p></div>
        <div class="col-6"><p><?= $addresse_mail ?></p></div>
    </div>
    <div class="row">
        <div class="col-6"><h2>Numero Telephone</h2></div>
        <div class="col-6"><h2>Numero care d'identite nationale</h2></div>
    </div>
    <div class="row">
        <div class="col-6"><p><?= $tel ?></p></div>
        <div class="col-6"><p><?= $numero_CIN ?></p></div>
    </div>
</div>
<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>