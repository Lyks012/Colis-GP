<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarTogglerDemo01"
      aria-controls="navbarTogglerDemo01"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <img class="img-fluid logo-img" src="public/images/colisGPlogo.jpg"> Colis-GP
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if($_SESSION['type'] == 'transporteur'){
          ?>
          <li class="nav-item">
            <li class="nav-item"><a class="nav-link <?php if(!isset($_GET['action'])) echo "active"; ?>" aria-current="page" href="index.php?action=myAnnouncements">Consulter mes annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php  if(isset($_GET['action']) AND $_GET['action'] == 'newAnnouncement') echo "active"; ?>" href="index.php?action=newAnnouncement">Publier une annonce</a>
          </li>
          <li class="nav-item">
            <a href=""></a>
        <?php
        }
        if($_SESSION['type'] == 'client'){
          ?>
          <li class="nav-item">
            <li class="nav-item"><a class="nav-link <?php if(!isset($_GET['action'])) echo "active"; ?>" aria-current="page" href="index.php">Consulter les annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php  if(isset($_GET['action']) AND $_GET['action'] == 'myReservations') echo "active"; ?>" href="index.php?action=myReservations">Mes Reservations</a>
          </li>
          <?php
        }
        ?>
        
        <li class="nav-item">
          <a class="nav-link <?php if(isset($_GET['action']) AND $_GET['action'] == 'personalInfos') echo "active"; ?>" href="index.php?action=personalInfos" >Mon Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=disconnect">Se deconnecter</a>
        </li>
      </ul>
    </div>
  </div>
</nav>