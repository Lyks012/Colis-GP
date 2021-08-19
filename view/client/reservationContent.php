<?php
ob_start();
require_once("view/shared/navbarConnected.php");
?>
<form action="index.php?action=newReservation" method="post">
    <div class="row">
        
        <div class="col-lg-3">
            <div class="col-12"><a href="index.php?action=receiverPage">Contacts du destinataire</a></div>
            <div class="col-12"><a href="index.php?action=reservationDetails">Details de reservation</a></div>
            </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-12">
                    <label for="payment_method_chosen" class="form_label">Moyen de paiement :</label>    
                    <?php
                        for($i = 0; $i < sizeof($payment_method_accepted); $i++){
                            ?>
                            <input type="radio" name="payment_method_chosen" class="form-check-input" value="<?= $payment_method_accepted[$i] ?>"> <?= $payment_method_accepted[$i] ?>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <label for="contenu" class="form_label">Contenu</label>
                    <textarea class="form-control" name="contenu"></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <label for="" class="form_label">Date livraison colis au transporteur</label>
                    <input type="date" name="dateLivraisonAuTransporteur" class="form-control" id="">
                </div>
                <div class="col-6">
                    <label for="" class="form_label">Lieu livraison colis au transporteur</label>
                    <input type="text" name="lieuLivraisonTransporteur" class="form-control" id="">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="" class="form_label">Montant Convenu avec le vendeur</label>
                    <input type="number" name="montant" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="" class="form_label">Nombre de kilos du colis</label>
                    <input type="number" name="nbrKgs" id="" class="form-control">
                </div>
            </div>
            <div class="row my-3 text-center">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Reserver</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>