<?php
    ob_start();
    require_once("view/shared/navbarConnected.php");
    extract($announcementInfos->fetch());
?>
<div class="row">
    <div class="col-12">
        <h1>Modifier l'annonce</h1>
        <p>
            Pour le confort de nos clients ayant deja reserves, vous ne pouvez pas modifier la date de depart,
            la date d'arrivee, les services additionnels ainsi que les prix.
            La date de reception de colis ne peut etre reculee au dela d'une date choisie par un client qui a deja reserve.
        </p>
    </div>
    <form action="updateAnnouncement" method="POST">
        <div class="row">
            <div class="col-6">
                lieu_depart: <input type="tel" name="departure_place" value=<?= $lieu_depart ?> id="">
            </div>
            <div class="col-6">
                lieu_arrivee: <input type="text" name="arrival_place" value=<?= $lieu_arrivee?> id="">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Date reception Colis : <input type="date" name="package_closing_reception_date" value=<?= $date_cloture_reception_colis ?> min="<?= $dateLimitToModify ?>" id="">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                nombre kgs disponibles
                <input type="number" name="kilosAvailable"value=<?= $nbr_kg_disponibles ?> id="">
            </div>
            <div class="col-6"></div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <button type="submit">Modifier</button>
            </div>
        </div>
    </form>
</div>
<?php
    require_once("view/footer.php");
    $content = ob_get_clean();
    require_once("view/template.php");

?>