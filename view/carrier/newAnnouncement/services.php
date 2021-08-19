<?php
    ob_start();
    require_once("view/shared/navbarConnected.php");
    if(isset($_SESSION['servicesInfos'])){
        $servicesAlreadyset = 1;
        extract($_SESSION['servicesInfos']);
    }
    else{
        $servicesAlreadyset = 0;
    }
?>
<div class="row">
    <div class="col-12">
        <h1>Informations de voyage</h1>
        <hr>
    </div>
</div>
<form action="index.php?action=addAnnouncement" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    <h2>Devise, prix et espace disponibles</h2>
                </div>
                <div class="col-6">
                    <label for="devise" class="form_label">Devise</label>
                    <select name="devise" id="devise" required class="form-control">
                        <option value="euros" <?php if($servicesAlreadyset && $devise == "euros") echo "selected"; ?>>Euros</option>
                        <option value="dollarsAmericain" <?php if($servicesAlreadyset && $devise == "dollarsAmericain") echo "selected"; ?>>Dollars american</option>
                        <option value="cfa" <?php if($servicesAlreadyset && $devise == "cfa") echo "selected"; ?>>Francs CFA</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="prixKg" class="form_label">Prix par Kilogrammes</label>
                    <input type="number" name="prixKg" id="prixKg" class="form-control" value="<?php if($servicesAlreadyset) echo $prixKg; ?>">
                </div>
                <div class="col-6">
                    <label for="kgDisponibles" class="form_label">Nombre de kilogrammes disponibles</label>
                    <input type="number" name="kgDisponibles" id="kgDisponibles" class="form-control" value="<?php if($servicesAlreadyset) echo $kgDisponibles; ?>">
                    <small class="form-text text-muted">
                        Ce chiffre sera automatiquement diminue si vous acceptez des reservations
                    </small>
                </div>
            </div>
            <div class="row">
                <label for="paymentMethod" class="form_label">Moyens de paiement</label>
                <div class="col">
                    <input type="checkbox" name="payment_method[]" value="Orange Money" class="form-check-input"> <label for="" class="form-check-label"></label> Orange Money
                </div>
                <div class="col">
                <input type="checkbox" name="payment_method[]" value="Free Money" class="form-check-input"> <label for="" class="form-check-label"></label> Free Money
                </div>
                <div class="col">
                <input type="checkbox" name="payment_method[]" value="En especes" class="form-check-input"> <label for="" class="form-check-label"></label> En especes

                </div>
                <div class="col">
                <input type="checkbox" name="payment_method[]" value="Wave" class="form-check-input"> <label for="" class="form-check-label"></label> Wave
                </div>
                <div class="col">
                <input type="checkbox" name="payment_method[]" value="Carte bancaire" class="form-check-input"> <label for="" class="form-check-label"></label> Carte bancaire
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h2>Types de biens acceptes</h2>
            <div class="row">
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixDocument').disabled = !this.checked;">
                    Documents
                    <input type="number" class="form-control" name="prixDocument" disabled id="prixDocument" value="<?php if($servicesAlreadyset) echo $prixDocuments; ?>">
                </div>
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixNourriture').disabled = !this.checked;">
                    Nourriture
                    <input type="number" class="form-control" name="prixNourriture" disabled id="prixNourriture" value="<?php if($servicesAlreadyset) echo $prixNourriture; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixHabillement').disabled = !this.checked;">

                    Vetements/chaussures
                    <input type="number" class="form-control" name="prixHabillement" disabled id="prixHabillement" value="<?php if($servicesAlreadyset) echo $prixHabillement; ?>">
                </div>
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixLiquide').disabled = !this.checked;">
                    Liquide
                    <input type="number" class="form-control" name="prixLiquide" disabled id="prixLiquide" value="<?php if($servicesAlreadyset) echo $prixLiquide; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixAccessoires').disabled = !this.checked;">

                    Accessoires/Bijoux
                    <input type="number" class="form-control" name="prixAccessoires" disabled id="prixAccessoires" value="<?php if($servicesAlreadyset) echo $prixAccessoires; ?>">
                </div>
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixElectronique').disabled = !this.checked;">
                    Appareils Electroniques
                    <input type="number" class="form-control" name="prixElectronique" disabled id="prixElectronique" value="<?php if($servicesAlreadyset) echo $prixElectronique; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixCosmetique').disabled = !this.checked;">

                    Produit Cosmetiques
                    <input type="number" class="form-control" name="prixCosmetique" disabled id="prixCosmetique" value="<?php if($servicesAlreadyset) echo $prixCosmetique; ?>">
                </div>
                <div class="col-6">
                    <input type="checkbox" class="form-check-input" onchange="document.getElementById('prixPharmaceutique').disabled = !this.checked;">

                    produit pharmaceutique
                    <input type="number" class="form-control" name="prixPharmaceutique" disabled id="prixPharmaceutique" value="<?php if($servicesAlreadyset) echo $prixPharmaceutique; ?>">
                </div>
            </div>
            <div class="row">
                <label for="additionalServices" class="form_label">Veuillez renseigner si vous Proposez des services additionnels</label>
                <input type="text" class="form-control" name="additionalServices" id="">
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit">Valider</button>
        </div>
    </div>
</form>

<?php
    require_once("view/footer.php");
    $content = ob_get_clean();

    require_once("view/template.php");
?>