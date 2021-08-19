<?php
ob_start();
($_SESSION);
require_once("view/shared/navbarConnected.php");
if(isset($_SESSION['transportInfos'])){
    $transportAlreadyset = 1;
    extract($_SESSION['transportInfos']);
}
else{
    $transportAlreadyset = 0;
}
?>
<div class="container mx-auto" style="max-width: 600px">
    <h1>Informations de voyage</h1>
    <p>Soyez le plus clair et concis pour faciliter la tache aux clients</p>

    <form action="index.php?action=servicesPage" method="post" class="bg-light my-2">
        <div class="row">
            <div class="col-md-6">
                <label for="departure_country" class="form_label">Pays de depart</label>
                <select name="departure_country" id="departure_country" class="form-select" required>
                    <option value="<?= $departure_country || "" ?>"><?php if($transportAlreadyset) echo $departure_country ?></option>
                    <?php require("view/shared/countriesListOption.php") ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="destination_country" class="form_label">Pays d'arrivee</label>
                <select name="destination_country" required class="form-select" id="destination_country">
                    <option value="<?= $destination_country || "" ?>"><?php if($transportAlreadyset) echo $destination_country ?></option>
                    <?php require("view/shared/countriesListOption.php") ?>
                </select>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <label for="departure_place" class="form_label">Lieu de depart</label>
                <input type="text" name="departure_place" required id="departure_place" class="form-control" value="<?php if($transportAlreadyset) echo $departure_place; ?>">
            </div>
            <div class="col-md-6">
                <label for="arrival_place" class="form_label">Lieu d'arrivee</label>
                <input type="text" name="arrival_place" required id="arrival_place" class="form-control" value="<?php if($transportAlreadyset) echo $arrival_place; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="departure_date" class="form_label">Date de depart</label>
                <input type="date" name="departure_date" required id="departure_date" class="form-control" value="<?php if($transportAlreadyset) echo $departure_date; ?>">
            </div>
            <div class="col-md-6">
                <label for="arrival_date" class="form_label">Date d'arrivee</label>  
                <input type="date" name="arrival_date" required id="arrival_date" class="form-control" value="<?php if($transportAlreadyset) echo $arrival_date; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="package_reception_closing_date" class="form_label">Date de cloture reception des colis</label>
                <input type="date" name="package_reception_closing_date" id="package_reception_closing_date" class="form-control" value="<?php if($transportAlreadyset) echo $package_reception_closing_date; ?>">
            </div>
            <div class="col-md-6">
                <label for="conveyance" class="form_label">Moyen de transport</label>
                <select name="conveyance"class="form-select" id="conveyancee">
                    <option value="Avion">Avion</option>
                </select>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col text-center">
                <button class="btn btn-primary" type="submit"">Suivant</button>
            </div>
        </div>
    </form>
</div>
<?php
require("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>