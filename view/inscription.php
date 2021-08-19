<?php ob_start() ?>
<?php require_once('view/navbar.php'); ?>
<div class="container mx-auto" style="max-width: 500px">
  <ul class="nav nav-tabs d-flex justify-content-center mt-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button
        class="nav-link active"
        id="home-tab"
        data-bs-toggle="tab"
        data-bs-target="#registerClient"
        type="button"
        role="tab"
        aria-controls="registerClient"
        aria-selected="true"
      >
        Client
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button
        class="nav-link"
        id="profile-tab"
        data-bs-toggle="tab"
        data-bs-target="#registerCarrier"
        type="button"
        role="tab"
        aria-controls="registerCarrier"
        aria-selected="false"
      >
        Transporteur
      </button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div
      class="tab-pane fade show active"
      id="registerClient"
      role="tabpanel"
      aria-labelledby="registerClient-tab"
    >
      <form action="index.php?action=addClient" class="bg-light my-2" method="post">
        <div class="row">
          <div class="col-12">
            <label for="last_name" class="form_label">Nom</label>
            <input
              type="text"
              class="form-control"
              name="last_name"
              id="last_name"
              required
            />
          </div>
        </div>
        <div class="row">
        <div class="col-12">
            <label for="first_name" class="form-label">Prenom</label>
            <input
              type="text"
              class="form-control"
              name="first_name"
              id="first_name"
              required
            />
          </div>
          
        </div>
        <div class="row">
          <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              required
            />
          </div>
        </div>
        <div class="row">
        <div class="col-12">
            <label for="phone_number" class="form-label"
              >Numero de telephone</label
            >
            <input
              type="tel"
              class="form-control"
              name="phone_number"
              id="phone_number"
              required
            />
        </div>
        </div>
        <div class="row">
          <div class="col-12">
              <label for="civilite" class="form-label">Civilite</label>
              <select class="form-control" name="civilite" id="civilite">
                    <option>Choisir...</option>
                    <option value="male">Homme</option>
                    <option value="female"> Femme</option>
                </select>
            </div>
          </div>
        <div class="row">
          <div class="col-12">
            <label for="password" class="form-label"
              >Password</label
            >
            <input
              type="password"
              class="form-control"
              name="password"
              id="password"
              required
            />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col text-center">
            <button class="btn btn-primary" type="submit"">S'inscrire</button>
          </div>
        </div>
      </form>
    </div>
    <div
      class="tab-pane fade"
      id="registerCarrier"
      role="tabpanel"
      aria-labelledby="registerCarrier-tab"
    >
      <form action="index.php?action=addCarrier" method="post" class="bg-light my-2">
      <div class="row">
          <div class="col-12">
            <label for="last_name" class="form_label">Nom</label>
            <input
              type="text"
              class="form-control"
              name="last_name"
              id="last_name"
              required
            />
          </div>
        </div>
        <div class="row">
        <div class="col-12">
            <label for="first_name" class="form-label">Prenom</label>
            <input
              type="text"
              class="form-control"
              name="first_name"
              id="first_name"
              required
            />
          </div>
          
        </div>
        <div class="row">
          <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              required
            />
          </div>
        </div>
        <div class="row">
        <div class="col-12">
            <label for="phone_number" class="form-label"
              >Numero de telephone</label
            >
            <input
              type="tel"
              class="form-control"
              name="phone_number"
              id="phone_number"
              required
            />
        </div>
        </div>
        <div class="row">
          <div class="col-12">
              <label for="civilite" class="form-label">Civilite</label>
              <select class="form-control" name="civilite" id="civilite">
                    <option>Choisir...</option>
                    <option value="male">Homme</option>
                    <option value="female"> Femme</option>
                </select>
            </div>
          </div>
        <div class="row">
          <div class="col-12">
            <label for="password" class="form-label"
              >Password</label
            >
            <input
              type="password"
              class="form-control"
              name="password"
              id="password"
              required
            />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col text-center">
            <button class="btn btn-primary" type="submit"">S'inscrire</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
require_once("view/footer.php");
$content = ob_get_clean();
?>
<?php require_once('view/template.php') ?>
