    <div class="row mt-3">
        <div class="col-6">
            <label for="lastName">Nom</label>
            <input type="text" class="form-control" id="lastName" name="last_name" value="<?= $nom ?>">
        </div>
        <div class="col-6">
            <label for="FirstName">Prenom</label>
            <input type="text" class="form-control" id="Firstname" name="first_name" value="<?= $prenom ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="email">Addresse Email</label>
            <input type="email" name="email" class="form-control" value="<?= $addresse_mail ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="phoneNumber">Numero Telephone</label>
            <input type="tel" class="form-control" name="phone_number" value="<?= $numero_telephone ?>" id="">
        </div>
        <div class="col-6">
            <label for="addresse">Addresse postale</label>
            <input type="tel" class="form-control" name="addresse" id="" value="<?= $addresse_postale ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <label for="biographie">Biographie</label>
            <textarea name="biographie" id="biographie" class="form-control" cols="30" rows="10"><?= $biographie ?></textarea>
    </div>
    <div class="row my-3">
        <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit">Enregistrer les modifications</button>
        </div>
    </div>
</div>