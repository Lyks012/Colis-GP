<div class="container mt-3">
    <div class="row">
        <?php
        if(isset($_SESSION['type'])){
            if($_SESSION['type'] == "transporteur") $action = "myAnnouncementDetails";
            else if($_SESSION['type'] == "client") $action = "announcementDetails";
        }
        //visitor
        else $action ="notConnected";
            for($i = 0; $i < sizeof($announcements); $i++){
                extract($announcements[$i]);
                if(!$path_to_picture){
                    if($civilite == "male") $imgSrc = "public/images/maleIcon.png";
                    else $imgSrc = "public/images/annonces/femaleIcon.png";
                }
                else $imgSrc = $path_to_picture;
                
                ?>
                <div class="col-lg-6 border-bottom border-end my-2 text-center">
                    <a href="index.php?action=<?= $action ?>&announcementId=<?= $id_annonce ?>">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 col-lg-3 col-xl-2">
                                    <img class="medium-image" src="<?= $imgSrc ?>" alt="">
                                </div>
                                <div class="col-md-2 col-lg-3 col-xl-2">
                                    <p><?= $prenom." ".$nom ?></p>
                                </div>
                                <div class="col-md-8 col-lg-7 col-xl-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <img class="small-image" src="public/images/annonces/calendar.png" alt="">
                                                    <p><?= $date_depart ?></p>
                                                </div>
                                                <div class="col-6">
                                                    <img class="small-image" src="public/images/annonces/plane/plane1.png" alt="">
                                                    <?= $moyen_transport ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <div class="row my-4">
                                                <div class="col-6">
                                                    <img class="small-image" src="public/images/annonces/plane/planeTakeoff1.png" alt="">
                                                    <?= $pays_depart ?>
                                                </div>
                                                <div class="col-6">
                                                    <img class="small-image" src="public/images/annonces/money.png" alt="">
                                                    <br><?= $prix_kg." ".$devise?>/Kg
                                                </div>
                                            </div>
                                            <div class="row my-4">
                                                <div class="col-6">
                                                    <img class="small-image" src="public/images/annonces/plane/planeLanding.png" alt="">
                                                    <?= $pays_destination ?> 
                                                </div>
                                                <div class="col-6">
                                                <img class="small-image" src="public/images/annonces/luggages.png" alt="">
                                                <br> <?= $nbr_kg_disponibles ?>kgs disponibles
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </a>
                </div>
                <?php
            }
        ?>
    </div>
</div>