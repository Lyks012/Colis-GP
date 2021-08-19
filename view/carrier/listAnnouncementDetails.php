<?php
    $biensAccepteArray = explode(",", $biens_acceptes);
    $paiementsAcceptesArray = explode(", ", $paiements_acceptes);

    if(!$path_to_picture){
        if($civilite == "male") $imgSrc = "public/images/maleIcon.png";
        else $imgSrc = "public/images/annonces/femaleIcon.png";
    }
    else $imgSrc = $path_to_picture;

?>
<div class="container">
    <h1><?= $pays_depart.", ".$lieu_depart." ---> ".$pays_destination.", ".$lieu_arrivee ?></h1>
    <hr>
    <div class="row">
        <div class="col-lg-4">
            <div class="row container-fluid">
                <div class="col-12">
                    <h6>Publie par</h6>
                </div>
                <div class="col-12">
                    <img src="<?= $imgSrc ?>" class="medium-image" alt="image"><br>
                    <?= $prenom." ".$nom ?>
                </div>
                <?php
                    for($i = 0; $i < sizeof($actionButtonToDisplay); $i++){
                        echo $actionButtonToDisplay[$i];
                    }
                ?>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>Informations de voyage</h2>
                        <hr>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <h6>Date depart</h6>
                        <img class="small-image" src="public/images/annonces/calendar.png" alt="">
                        <?= $date_depart ?>
                    </div>
                    <div class="col-6">
                        <h6>Date arrivee</h6>
                        <img class="small-image" src="public/images/annonces/calendar.png" alt="">
                        <?= $date_arrivee ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <h6>Lieu depart</h6>
                        <img class="small-image" src="public/images/annonces/plane/planeTakeoff1.png" alt="">
                        <?= $pays_depart.", ".$lieu_depart ?>
                    </div>
                    <div class="col-6">
                        <h6>Lieu depart</h6>
                        <img class="small-image" src="public/images/annonces/plane/planeTakeoff1.png" alt="">
                        <?= $pays_destination.", ".$lieu_arrivee ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <h6>Date Cloture reception colis</h6>
                        image
                        <?= $date_cloture_reception_colis ?>
                    </div>
                    <div class="col-6">
                        <h6>moyen transport</h6>
                        <img class="small-image" src="public/images/annonces/plane/plane1.png" alt="">
                        <?= $moyen_transport ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12"><h1>Informations de transport</h1></div>
                </div>
                <div class="row">
                    <div class="col-12"><h2>Biens acceptes</h2></div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <h6>Nombre de kgs disponibles</h6>
                        <img class="small-image" src="public/images/annonces/luggages.png" alt="">
                        <?= $nbr_kg_disponibles ?> kgs/disponibles
                    </div>
                    <div class="col-6">
                        <h6>Prix/Kg</h6>
                        <img class="small-image" src="public/images/annonces/money.png" alt="">
                        <?= $prix_kg ?> Franc/kgs
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Biens Acceptes:
                        </div>
                        <div class="col-6">Moyens de paiement</div>
                        <div class="row">
                            <div class="col-6">

                                <?php
                                    for($i = 0; $i < sizeof($biensAccepteArray); $i++){
                                        echo $biensAccepteArray[$i]." ".$devise."<br>";
                                    }
                                ?>
                            </div>
                            <div class="col-6">
                                <?php
                                    for($i = 0; $i < sizeof($paiementsAcceptesArray); $i++){
                                        echo $paiementsAcceptesArray[$i]."<br>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>