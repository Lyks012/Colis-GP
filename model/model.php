<?php
function dbConnect(){
    $db = new PDO('mysql:host=localhost;dbname=colis-gp;charset=utf8', 'root', '');
    return $db;
}

function getAnnouncementsInfos(){
    $db = dbConnect();

    $announcements = $db->query('SELECT
    id_annonce, pays_depart, pays_destination, date_depart, devise, nbr_kg_disponibles, prix_kg, moyen_transport, nom, prenom, civilite, path_to_picture
    FROM annonces NATURAL JOIN transporteurs');

    return $announcements;
}

function getAnnouncementWithCarrierDetails($annoucementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * from annonces NATURAL JOIN transporteurs WHERE id_annonce = :announcementId");
    $getRequest->execute(array(
        "announcementId" => $annoucementId
    ));

    return $getRequest;
}

function addClient($clientInfos, $password_hash){
    $db = dbConnect();

    extract($clientInfos);

    $addRequest = $db->prepare("INSERT INTO clients VALUES(null, :last_name, :first_name, :civilite, :phone_number, :email, :password, :path_to_picture)");
    $addRequest->execute(array(
        "last_name" => $last_name,
        "first_name" => $first_name,
        "civilite" => $civilite,
        "phone_number" => $phone_number,
        "email" => $email,
        "password" => $password_hash,
        "path_to_picture" => ""
    ));
    
}

function addCarrier($carrierInfos, $password_hash){
    $db = dbConnect();
    extract($carrierInfos);

    $addRequest = $db->prepare("INSERT INTO transporteurs(id_transporteur, nom, prenom, civilite, numero_telephone, addresse_mail, addresse_postale, mot_de_passe, path_to_picture, biographie) VALUES(null, :last_name, :first_name, :civilite, :phone_number, :email, :addresse_postale, :mot_de_passe, :path_to_picture, :biographie)");
    $addRequest->execute(array(
        "last_name" => $last_name,
        "first_name" => $first_name,
        "civilite" => $civilite,
        "phone_number" => $phone_number,
        "email" => $email,
        "mot_de_passe" => $password_hash,
        "addresse_postale" => "",
        "biographie" => "",
        "path_to_picture" => ""
    ));
}

function getCredentials($type, $email){
    $db = dbConnect(); 
    

    $check = $db->prepare("SELECT * FROM {$type} WHERE addresse_mail = :email");
    $check->execute(array(
        'email' => htmlspecialchars($email), 
    ));
    $result = $check->fetch();
    
    return $result;
}

function initializeSessionVariables($type, $correctCredentials){
    extract($correctCredentials);
    session_start();

    $_SESSION['connected'] = true;
    
    $_SESSION['fullName'] = $prenom." ".$nom;
    $_SESSION['genre'] = $civilite;
    $_SESSION['phone_number'] = $numero_telephone;
    $_SESSION['email'] = $addresse_email;

    if($type == "transporteurs"){
        $_SESSION['id_transporteur'] = $id_transporteur;
        $_SESSION['type'] = "transporteur";
    }
    else if($type == "clients"){
        $_SESSION['id_client'] = $id_client;
        $_SESSION['type'] = "client";
    }
}

function addAnnouncement($transportInfos, $devise_prixKg_kg_disponibles, $payment_method, $servicesInfosToString, $additionnalServices){
    $db = dbConnect();

    extract($transportInfos);
    
    $addRequest = $db->prepare("INSERT INTO annonces VALUES(
        null, :pays_depart, :pays_destination, :lieu_depart, :lieu_arrivee, :date_depart, :date_arrivee, 
        :date_cloture_reception_colis, :biens_acceptes, :nbr_kg_disponible, :prix_kg, 
        :devise, :moyen_transport, :paiements_acceptes, :services_additionnels ,:id_transporteur)"
    );

    $requestResult = $addRequest->execute(array(
        "pays_depart" => $departure_country,
        "pays_destination" => $destination_country,
        "lieu_depart" => $departure_place,
        "lieu_arrivee" => $arrival_place,
        "date_depart" => $departure_date,
        "date_arrivee" => $arrival_date,
        "date_cloture_reception_colis" => $package_reception_closing_date,
        "biens_acceptes" => $servicesInfosToString,
        "nbr_kg_disponible" => $devise_prixKg_kg_disponibles['kgDisponibles'],
        "prix_kg" => $devise_prixKg_kg_disponibles['prixKg'],
        "devise" => $devise_prixKg_kg_disponibles['devise'],
        "moyen_transport" => $conveyance,
        "paiements_acceptes" => $payment_method,
        "services_additionnels" => $additionnalServices,
        "id_transporteur" => $_SESSION["id_transporteur"]
    ));
}

function getCarrierInfos($carrierId){
    $db =dbConnect();

    $getRequest = $db->prepare("SELECT * FROM transporteurs WHERE id_transporteur = ?");
    $getRequest->execute(array($carrierId));

    return $getRequest;
}

function getClientInfos($clientId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * FROM clients WHERE id_client = ?");
    $getRequest->execute(array($clientId));

    return $getRequest;
}

function changeCarrierInfos($newinfos, $id, $password_hash){
    $db =dbConnect();
    extract($newinfos);

    $updateRequest = $db->prepare("UPDATE transporteurs SET nom = :nom, prenom = :prenom, numero_telephone = :phone_number, addresse_mail = :email, addresse_postale = :addresse, mot_de_passe = :hpassword, biographie = :biographie WHERE id_transporteur = :id_transporteur");
    $updateRequest->execute(array(
        "nom" => $last_name,
        "prenom" => $first_name,
        "phone_number" => $phone_number,
        "email" => $email,
        "addresse" => $addresse,
        "hpassword" => $password_hash,
        "biographie" => $biographie,
        "id_transporteur" => $id
    ));
}

function updateCarrierProfilePicture($path, $id){
    $db = dbConnect();

    $updateRequest = $db->prepare("UPDATE transporteurs SET path_to_picture = :pathToPicture WHERE id_transporteur = :id");
    $updateRequest->execute(array(
        "pathToPicture" => $path,
        "id" => $id
    ));
}

function updateClientProfilePicture($path, $id){
    $db = dbConnect();

    $updateRequest = $db->prepare("UPDATE clients SET path_to_picture = :pathToPicture WHERE id_client = :id");
    $updateRequest->execute(array(
        "pathToPicture" => $path,
        "id" => $id
    ));
}

function changeClientInfos($newInfos, $id, $password_hash){
    $db = dbConnect();
    extract($newInfos);

    $updateRequest = $db->prepare("UPDATE clients SET nom = :nom, prenom = :prenom, numero_telephone = :phone_number, addresse_mail = :email, mot_de_passe = :hpassword");
    ($newInfos);
    $updateRequest->execute(array(
        "nom" => $last_name,
        "prenom" => $first_name,
        "phone_number" => $phone_number,
        "email" => $email,
        "hpassword" => $password_hash,
    ));
}

function getCarrierAnnouncements($carrierId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT id_annonce, pays_depart, pays_destination, date_depart, devise, nbr_kg_disponibles, prix_kg, moyen_transport, nom, prenom, civilite, path_to_picture
    FROM annonces NATURAL JOIN transporteurs WHERE id_transporteur = ?");
    $getRequest->execute(array($carrierId));
    return $getRequest;
}

function addNewColis($paiementAndContent, $receiverInfos, $announcementId, $carrierId, $clientId, $receiverId){
    $db = dbConnect();

    extract($paiementAndContent);
    extract($receiverInfos);
    $addRequest = $db->prepare("INSERT INTO colis VALUES(
        null, :contenu, :nombre_kilo, :date_livraison_colis_au_transporteur, :lieu_livraison_colis_au_transporteur,
        :montant, :statut, :id_transporteur, :id_destinataire, :id_client, :id_annonce
        )
    ");

    $addRequest->execute(array(
        "contenu" => $contenu,
        "nombre_kilo" => $nbrKgs,
        "date_livraison_colis_au_transporteur" => $dateLivraisonAuTransporteur,
        "lieu_livraison_colis_au_transporteur" => $lieuLivraisonTransporteur,
        "montant" => $paiementAndContent['montant'],
        "statut" => "En attente",
        "id_transporteur" => $carrierId,
        "id_destinataire" => $receiverId,
        "id_client" => $clientId,
        "id_annonce" => $announcementId,
    ));

}

function reduceAnnouncementKgsAvailable($announcementId, $newKgsAvailable){
    $db = dbConnect();

    $updateRequest = $db->prepare("UPDATE annonces SET nbr_kg_disponibles = :newKgsAvailable WHERE id_annonce = :id_annonce");
    $updateRequest->execute(array(
        "newKgsAvailable" => $newKgsAvailable,
        "id_annonce" => $announcementId
    ));

}

function getAnnouncementKgsAvailable($announcementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT nbr_kg_disponibles FROM annonces WHERE id_annonce = ?");
    $getRequest->execute(array($announcementId));

    return $getRequest;
}

function getAnnouncementPaymentMethod($announcementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT paiements_acceptes FROM annonces WHERE id_annonce = ?");
    $getRequest->execute(array($announcementId));   
    return $getRequest;
}

function getAnnouncementCarrierId($announcementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT id_transporteur FROM annonces WHERE id_annonce = ?");

    $getRequest->execute(array($announcementId));

    return $getRequest;
}

function addReceiverAndReturnId($receiverInfos){
    $db = dbConnect();

    extract($receiverInfos);

    $addRequest = $db->prepare("INSERT INTO destinataires VALUES(null, :nom, :prenom, :numero_CIN, :tel, :addresse_mail, :addresse)");
    $addRequest->execute(array(
        "nom" => $nom_destinataire,
        "prenom" => $prenom_destinataire,
        "numero_CIN" => $CIN_destinataire,
        "tel" => $telephone_destinataire,
        "addresse_mail" => $addresse_mail_destinataire,
        "addresse" => $addresse_postale_destinataire,
    ));

    return $db->lastInsertId();
}

function getClosestReservationPackageDeliveryToCarrierDate($announcementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT date_livraison_colis_au_transporteur FROM colis WHERE id_annonce = ? ORDER BY date_livraison_colis_au_transporteur ASC LIMIT 0,1");
    $getRequest->execute(array($announcementId));

    return $getRequest;
}

function updateAnnouncement($id, $infos){
    $db = dbConnect();
    extract($infos);

    $updateRequest = $db->prepare("UPDATE annonces SET lieu_depart = :departure_place, lieu_arrivee = :arrival_place, date_cloture_reception_colis = :package_closing_reception_date, nbr_kg_disponibles = :kilosAvailable WHERE id_annonce = :id");
    $updateRequest->execute(array(
        "departure_place" => $departure_place,
        "arrival_place" => $arrival_place,
        "package_closing_reception_date" => $package_closing_reception_date,
        "kilosAvailabe" => $kilosAvailable,
        "id_annonce" => $id,
    ));
}

function checkReservationForAnnouncement($announcementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT id_annonce FROM colis WHERE id_annonce = ?");
    $getRequest->execute(array($announcementId));

    return $getRequest;
}

function getAnnouncementDetails($announcementId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * FROM annonces WHERE id_annonce = ?");
    $getRequest->execute(array($announcementId));

    return $getRequest;
}

function updateWholeAnnouncement($transportInfos, $devise_prixKg_kg_disponibles, $payment_method, $servicesInfosToString, $additionnalServices, $announcementId){
    $db = dbConnect();

    extract($transportInfos);
    
    $addRequest = $db->prepare("INSERT INTO annonces VALUES(
        :id_annonce, :pays_depart, :pays_destination, :lieu_depart, :lieu_arrivee, :date_depart, :date_arrivee, 
        :date_cloture_reception_colis, :biens_acceptes, :nbr_kg_disponible, :prix_kg, 
        :devise, :moyen_transport, :paiements_acceptes, :services_additionnels ,:id_transporteur)"
    );

    $requestResult = $addRequest->execute(array(
        "id_annonce" => $announcementId,
        "pays_depart" => $departure_country,
        "pays_destination" => $destination_country,
        "lieu_depart" => $departure_place,
        "lieu_arrivee" => $arrival_place,
        "date_depart" => $departure_date,
        "date_arrivee" => $arrival_date,
        "date_cloture_reception_colis" => $package_reception_closing_date,
        "biens_acceptes" => $servicesInfosToString,
        "nbr_kg_disponible" => $devise_prixKg_kg_disponibles['kgDisponibles'],
        "prix_kg" => $devise_prixKg_kg_disponibles['prixKg'],
        "devise" => $devise_prixKg_kg_disponibles['devise'],
        "moyen_transport" => $conveyance,
        "paiements_acceptes" => $payment_method,
        "services_additionnels" => $additionnalServices,
        "id_transporteur" => $_SESSION["id_transporteur"]
    ));
}

function deleteAnnouncement($announcementId){
    $db = dbConnect();

    $deleteRequest = $db->prepare("DELETE FROM annonces WHERE id_annonce = ?");
    $deleteRequest->execute(array($announcementId));
}

function getClientColisInformationsDescOrder($id_client){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * FROM colis WHERE id_client = ? ORDER BY id_colis DESC");
    $getRequest->execute(array($id_client));

    return $getRequest;
}

function getReceiverInformations($receiverId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * FROM destinataires WHERE id_destinataire = ?");
    $getRequest->execute(array($receiverId));

    return $getRequest;
}

function deleteReservation($reservationId){
    $db = dbConnect();

    $deleteRequest = $db->prepare("DELETE FROM colis WHERE id_colis = ?");
    $deleteRequest->execute(array($reservationId));
}

function getReceivedReservationsDescOrder($carrierId){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * FROM colis WHERE id_transporteur = ? ORDER BY id_colis DESC");
    $getRequest->execute(array($carrierId));

    return $getRequest;
}

function changeReservationStatus($id_colis, $updatedStatus){
    $db = dbConnect();
    $updateRequest = $db->prepare("UPDATE colis SET statut = :updatedStatus WHERE id_colis = :id_colis");
    $updateRequest->execute(array(
        "id_colis" => $id_colis,
        "updatedStatus" => $updatedStatus,
    ));
}

function getSpecificAnnouncements($departureCountry, $arrivalCountry, $dateDepartMin){
    $db = dbConnect();

    $getRequest = $db->prepare("SELECT * FROM annonces NATURAL JOIN transporteurs WHERE pays_depart = :departureCountry AND pays_destination = :arrivalCountry AND date_depart >= :dateDepartMin");
    $getRequest->execute(array(
        "departureCountry" => $departureCountry,
        "arrivalCountry" => $arrivalCountry,
        "dateDepartMin" => $dateDepartMin
    ));

    return $getRequest;
}

function changeAnnouncementReservationStatusOnDelete($announcementId){
    $db = dbConnect();

    $updateRequest = $db->prepare("UPDATE colis SET statut = ? WHERE id_annonce = ?");
    $updateRequest->execute(array(
        "Annonce supprimee par le transporteur",
        $announcementId
    ));
}