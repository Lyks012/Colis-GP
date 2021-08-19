<?php
    ob_start();
    require_once("view/shared/navbarConnected.php");
    if(isset($_SESSION['receiverInfos']))
        extract($_SESSION['receiverInfos']);
?>

<div class="row">
    <div class="col-lg-3">
        <div class="row">
            <div class="col-12"><a href="index.php?action=receiverPage">Contacts du destinataire</a></div>
            <div class="col-12"><a href="index.php?action=reservationDetails">Details de reservation</a></div>
        </div>
    </div>
    <div class="col-lg-9">
        <form action="index.php?action=reservationDetails" method="post">
            <div class="row">
                <div class="col-12">
                    <h1>Contact du destinataire</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="nom_destinataire">Nom</label>
                    <input type="text" value="<?php if(isset($_SESSION['receiverInfos'])) echo $nom_destinataire ?>" class="form-control" name="nom_destinataire" id="">
                </div>
                <div class="col-6">
                    <label for="pre_destinataire">Prenom</label>
                    <input type="text" name="prenom_destinataire" class="form-control" value="<?php if(isset($_SESSION['receiverInfos'])) echo $prenom_destinataire ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                <label for="telephone_destinataire">Telephone</label>
                <input type="tel" name="telephone_destinataire" id="" class="form-control" value="<?php if(isset($_SESSION['receiverInfos'])) echo $telephone_destinataire ?>">
                </div>
                <div class="col-6">
                    <label for="addresse_mail_destinataire">Addresse Mail destinataire</label>
                    <input type="mail" name="addresse_mail_destinataire" id="" class="form-control" value="<?php if(isset($_SESSION['receiverInfos'])) echo $addresse_mail_destinataire ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="addresse_postale_destinataire">Addresse Postale destinataire</label>
                    <input type="text" name="addresse_postale_destinataire" id="" class="form-control" value="<?php if(isset($_SESSION['receiverInfos'])) echo $addresse_postale_destinataire ?>">
                </div>
                <div class="col-6">
                    <label for="CIN_destinataire">Numero carte identite destinataire</label>
                    <input type="number" name="CIN_destinataire" id="" class="form-control" value="<?php if(isset($_SESSION['receiverInfos'])) echo $CIN_destinataire ?>">
                </div>
            </div>
            <div class="row my-3 text-center">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enregistrer & etape suivante</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>