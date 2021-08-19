
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Annonce Concerne</th>
      <th>Informations destinataire</th>
      <th scope="col">Contenu</th>
      <th scope="col">Nombre de Kilos</th>
      <th scope="col">Date livraison au transporteur</th>
      <th scope="col">Lieu livraison au transporteur</th>
      <th scope="col">Montant</th>
      <th scope="col">Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        while($colis = $reservationInfos->fetch()){
            extract($colis);

            if($statut == "En attente")$color = "table-warning";
            else if($statut == "Confirmee") $color = "table-success";
            else if($statut == "Annonce supprimee par le transporteur") $color = "table-danger";

        ?>
        <tr class="<?= $color ?>">
            <td><a href="index.php?action=announcementDetails&announcementId=<?= $id_annonce ?>" type="button" class="btn btn-primary">Annonce</a></td>
            <td><a href="index.php?action=receiverDetails&receiverId=<?= $id_destinataire ?>" type="button" class="btn btn-primary">Destinataire</a></td>
            <td><?= $contenu ?></td>
            <td><?= $nombre_kilo ?></td>
            <td><?= $date_livraison_colis_au_transporteur ?></td>
            <td><?= $lieu_livraison_colis_au_transporteur ?></td>
            <td><?= $montant ?></td>
            <td><?= $statut ?></td>
            <?php
            if($_SESSION['type'] == "client"){
            ?>
                <td>
                    <a type="button" href="index.php?action=deleteMyReservation&reservationId=<?= $id_colis ?>" class="btn btn-danger" onclick="return(confirm("Etes-vous sûr de vouloir supprimer cette reservation ?"));">Supprimer</a>
                </td>
            <?php
            }
            else if($_SESSION['type'] == "transporteur"){
                ?>
                <td>
                <?php
                if($statut == "En attente"){
                    ?>
                    <a type="button"  href="index.php?action=ConfirmClientyReservation&reservationId=<?= $id_colis ?>" class="btn btn-warning mb-2">Confirmer</a>
                    <?php
                }
                else{
                    ?>
                    <a type="button" href="index.php?action=putClientyReservationOnHold&reservationId=<?= $id_colis ?>" class="btn btn-danger">Mettre en attente</a>
                    <?php
                }
                ?>
                </td>
                <?php
            }
            ?>  
            </tr>
        <?php
        }
    ?>
  </tbody>
</table>