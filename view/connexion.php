<?php
ob_start();
require_once("view/navbar.php");
?>
<div class="container" style="max-width: 600px">
<form action="index.php?action=connexionAttempt" method="post" class="bg-light my-2">
    <div class="row">
        <div class="col">
            <p class="d-inline-block">Vous etes : </p>
            <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="userType"
                  id="clients"
                  value="clients"
                />
                <label class="form-check-label" for="clients">Client</label>
                </div>
                <div class="form-check form-check-inline ml-2">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="userType"
                    id="transporteurs"
                    value="transporteurs"
                  />
                  <label class="form-check-label" for="transporteurs">Transporteur</label>
                </div>
              </div>

            
    </div>
    <div class="form-floating">
        <input type="email" class="form-control" name="email" id="emailn" placeholder="name@example.com">
        <label for="emailn">Adresse email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
    <div class="row mt-3">
          <div class="col text-center">
            <button class="btn btn-primary" type="submit"">Se connecter</button>
          </div>
</div>
</form>
</div>

<?php
require_once("view/footer.php");
$content = ob_get_clean();
require_once("view/template.php");
?>