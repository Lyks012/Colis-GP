<?php
ob_start();
require_once("view/shared/navbarConnected.php");
extract($carrierInfos);
if(!$path_to_picture){
    if($civilite == "male") $imgSrc = "public/images/maleIcon.png";
    else $imgSrc = "public/images/annonces/femaleIcon.png";
}
?>
<div class="row">
    <div class="col-12 text-center">
        <img src="<?= $imgSrc ?>" class="medium-image" alt="">
    </div>
    <div class="row mt-3">
        <div class="col-6"><?= $nom ?></div>
        <div class="col-6"><?= $prenom ?></div>
    </div>
    <div class="row">
        <div class="col-12">
            Adresse email
            <?= $addresse_mail ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">Numero telephone<?= $numero_telephone ?></div>
        <div class="col-6">addresse postale <?= $addresse_postale ?></div>
    </div>
    
    <div class="row">
        <div class="col-12 text-center">
            biographie
            <?= $biographie ?>
        </div>
    </div>
</div>
<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>