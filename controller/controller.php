<?php

require_once("model/model.php");

function displayHomePage(){
    session_start();
    $announcements = getAnnouncementsInfos()->fetchAll();
    require_once("view/home.php");
}

function registerClient($clientInfos){
    $password_hash = password_hash($clientInfos["password"], PASSWORD_DEFAULT);

    addClient($clientInfos, $password_hash);

    header("location:index.php?action=connexion");

}

function registerCarrier($carrierInfos){
    $password_hash = password_hash($carrierInfos["password"], PASSWORD_DEFAULT);

    addCarrier($carrierInfos, $password_hash);

    header("location:index.php?action=connexion");
}

function initializeConnexionAndRedirect($type, $email, $password){
    $credentials = getCredentials($type, $email);

    $isPasswordCorrect = password_verify($password, $credentials['mot_de_passe']);

    if(!$isPasswordCorrect){
        throw new Exception("Identifiants de connexion errones");
    }
    
    initializeSessionVariables($type, $credentials);

    if($type == "clients") header("Location:index.php");
    else if($type == "transporteurs") header("Location:index.php?action=myAnnouncements");
}

function checkConnection(){
    session_start();
    if(!isset($_SESSION['connected'])){
        throw new Exception("Veuillez vous connecter pour acceder a cette page");
    }
}

function disconnectAndDirectToHome(){
    session_start();
    session_destroy();
    header('Location:index.php');
}
function displayNewAnnouncementPage(){
    checkConnection();

    if($_SESSION['type'] != "transporteur"){
        throw new Exception("Veuillez vous connecter en tant que transporteur pour publier une annonce");
    }

    require_once("view/carrier/newAnnouncement/travelInfos.php");
}

function displayAnnoucementDetails($announcementId){
    checkConnection();
    $announcementDetails = getAnnouncementWithCarrierDetails($announcementId)->fetchAll();

    require_once("view/shared/annonceDetail.php");
}

function displayProfilePage(){
    checkConnection();

    if($_SESSION['type'] == 'transporteur'){
        $personalInfos = getCarrierInfos($_SESSION["id_transporteur"])->fetch();
        $action = "updateCarrierInfos";
    }

    else if($_SESSION['type'] == "client"){
        $personalInfos = getClientInfos($_SESSION['id_client'])->fetch();
        $action = "updateClientInfos";
    }

    require_once("view/shared/personalInfos.php");
}

function updateCarrierInfos($newInfos){
    checkConnection();

    $password_hash = password_hash($newInfos["password"], PASSWORD_DEFAULT);
    changeCarrierInfos($newInfos, $_SESSION['id_transporteur'], $password_hash);
    header("Location:index.php?action=personalInfos");
}

function changeProfilePicture(){
    checkConnection();

    if(is_uploaded_file($_FILES['profilePicture']['tmp_name'])){
        $pathProfilePicture = saveProfilePicture();
        if($_SESSION['type'] == 'client'){
            updateClientProfilePicture($pathProfilePicture, $_SESSION['id_client']);
        }
        else{
            updateCarrierProfilePicture($pathProfilePicture, $_SESSION['id_transporteur']);
        }
    }

    header("Location:index.php?action=personalInfos");
    
}

function displayTransportInfos(){
    checkConnection();
    require_once("view/carrier/transportInfos.php");
}

//connection checked and session started in appendServicesInfosToTransportInfos function
function displayConfirmationPage($announcementInfos){
    require_once("view/carrier/newAnnouncement/confirmation.php");
}


function saveInfosInSession($sessionVariableName, $infos){
    $_SESSION[$sessionVariableName] = $infos;
}

function mergeServicesInfosToTransportInfos($transportInfos, $servicesInfos){
    checkConnection();
 
    return array_merge($transportInfos, $servicesInfos);
}
function associativeArrayToString($array){
    $list = Array();

    foreach($array as $key => $value){
        $list[] = "$key : $value";
    }
    return implode(",", $list);
}

//this function use the transportInfos in the session variable and services infos from post
//this function is used to add a new announcement or modify an announcement
function newAnnouncement($servicesInfos){
    checkConnection();

    //put services Infos in separate variables to transform the arrays into strings
    $devise_prixKg_kg_disponibles = array_splice($servicesInfos, 0, 3);

    
    $payment_method = array_splice($servicesInfos, 0, 1)['payment_method'];

    
    $additionnalServices = array_splice($servicesInfos, sizeof($servicesInfos) - 1, 1)['additionalServices'];
    

    if(isset($servicesInfos)) $servicesInfosToString = associativeArrayToString($servicesInfos);
    if(isset($servicesInfos)) $payment_methodToString = implode(", ", $payment_method);
    
    if($_SESSION['updatingAnnouncement']){
        //delete outdated annoncement so the updated will have the same id as before
        deleteAnnouncement($_SESSION['announcementId']);
        updateWholeAnnouncement($_SESSION['transportInfos'], $devise_prixKg_kg_disponibles, $payment_methodToString, $servicesInfosToString, $additionnalServices, $_SESSION['announcementId']);
        $_SESSION['updatingAnnouncement'] = false;
    }
    else{
        addAnnouncement($_SESSION['transportInfos'], $devise_prixKg_kg_disponibles, $payment_methodToString, $servicesInfosToString, $additionnalServices);
    }

    deleteSessionTransportInfos();
    
    header("Location:index.php?action=myAnnouncements");
}

function deleteSessionTransportInfos(){
    unset($_SESSION['transportInfos']);
}

function displayCarrierAnnouncements(){
    checkConnection();
    $announcements = getCarrierAnnouncements($_SESSION['id_transporteur'])->fetchAll();
    require_once("view/carrier/myAnnouncements.php");
}

function displayMyAnnouncementDetails($idAnnonce){
    checkConnection();
    $announcementDetails = getAnnouncementWithCarrierDetails($idAnnonce)->fetchAll();
    require_once("view/carrier/myAnnouncementDetails.php");
}

function reservationPage($announcementId){
    checkConnection();

    saveInfosInSession("announcementId", $announcementId);

    require_once("view/client/reservation.php");
}

function saveReceiverInfosAndGoToReservationContentPage($receiverInfos){
    checkConnection();
    if(isset($_POST)) saveInfosInSession("receiverInfos", $receiverInfos);
    $payment_method_accepted = explode(", ", getAnnouncementPaymentMethod($_SESSION['announcementId'])->fetchAll()[0]["paiements_acceptes"]);
    require_once("view/client/reservationContent.php");
}

function newReservation($paiementAndContent){
    checkConnection();

    $receiverInfos = $_SESSION['receiverInfos'];
    $announcementId = $_SESSION['announcementId'];
    $carrierId = getAnnouncementCarrierId($announcementId)->fetchAll()[0][0];
    
    $receiverId = addReceiverAndReturnId($receiverInfos);

    $previousKgsAvailable = getAnnouncementKgsAvailable($announcementId)->fetch()[0];
    $newKgsAvailable = intval($previousKgsAvailable) - intval($paiementAndContent['nbrKgs']);

    if($newKgsAvailable < 0){
        throw new Exception("Le poids de votre colis est superieur au poids disponible");
    }
    

    reduceAnnouncementKgsAvailable($announcementId, $newKgsAvailable);
    
    
    addNewColis($paiementAndContent, $receiverInfos, $announcementId, $carrierId, $_SESSION['id_client'], $receiverId);
    header("Location:index.php");
}

function updateClientInfos($newInfos){
    checkConnection();
    $password_hash = password_hash($newInfos["password"], PASSWORD_DEFAULT);
    changeClientInfos($newInfos, $_SESSION['id_client'], $password_hash,);
}

function displayCarrierProfile($id){
    checkConnection();
    $carrierInfos = getCarrierInfos($id)->fetch();

    require_once("view/client/seeCarrierProfile.php");
}

function storeAnnouncementIdInSessionAndRedirectToModifyPage($announcementId){
    checkConnection();

    $_SESSION['idAnnouncementToModify'] = $announcementId;
    $clientAlreadyReserved = checkReservationForAnnouncement($announcementId)->fetch();

    $announcementInfos = getAnnouncementDetails($announcementId)->fetch();

    if($clientAlreadyReserved){
        $dateLimitToModify = getClosestReservationPackageDeliveryToCarrierDate($announcementId)->fetch()[0];
        require_once("view/carrier/editAnnouncementRestricted.php");
    }

    else{
        extract($announcementInfos);
        // do as if we were adding a new announcement with informations saved from database in the session variables
        // then insert the modified info in the annonce table with the same id as before
        $_SESSION['transportInfos'] = array(
            "departure_country" => $pays_depart,
            "destination_country" => $pays_destination,
            "departure_place" => $lieu_depart,
            "arrival_place" => $lieu_arrivee,
            "departure_date" => $date_depart,
            "arrival_date" => $date_arrivee,
            "package_reception_closing_date" => $date_cloture_reception_colis,
            "conveyance" => $moyen_transport
        );

        $_SESSION['servicesInfos'] = array(
            "devise" => $devise,
            "prixKg" => $prix_kg,
            "kgDisponibles" => $nbr_kg_disponibles,
            "prixDocument" => $prixDocument,
            "prixNourriture" => $prixNourriture,
            "prixhabillement" => $prixhabillement,
            "prixAccessoires" => $prixAccessoires,
            "prixElectronique" => $prixElectronique,
            "prixCosmetique" => $prixCosmetique,
            "prixPharmaceutique" => $prixPharmaceutique,
            "prixLiquide" => $prixLiquide,
        );

        //use this session variable to know wether we are updating or adding a new announcement
        $_SESSION['updatingAnnouncement'] = true;
        $_SESSION['announcementId'] = $announcementId;

        header("Location:index.php?action=newAnnouncement");
    }
}

function updateAnnouncementAndRedirect($infos){
    checkConnection();
    $announcementId = $_SESSION['idAnnouncementToModify'];
    updateAnnouncement($announcementId, $infos);
    
    header("Location:index.php?action=myAnnouncementDetails&announcementId=".$announcementId);
    
}

function displayReceivedReservations(){
    checkConnection();

    $reservationInfos = getReceivedReservationsDescOrder($_SESSION['id_transporteur']);
    require_once("view/carrier/receivedReservations.php");
}

function displayMyReservations(){
    checkConnection();
    
    $reservationInfos = getClientColisInformationsDescOrder($_SESSION['id_client']);
    require_once("view/client/myReservations.php");
}

function displayReceiverDetails($receiverId){
    session_start();

    $receiverInfos = getReceiverInformations($receiverId)->fetch();

    require_once("view/shared/receiverInfos.php");
}

function removeReservation($reservationId){
    checkConnection();

    deleteReservation($reservationId);
    
    header("Location:index.php?action=myReservations");
}

function confirmClientReservation($id_colis){
    checkConnection();

    changeReservationStatus($id_colis, "Confirmee");

    header("Location:index.php?action=receivedReservations");
}

function putClientReservationOnHold($id_colis){
    checkConnection();

    changeReservationStatus($id_colis, "En attente");

    header("Location:index.php?action=receivedReservations");
}

function saveProfilePicture(){
    $uploadDir = 'subscriberProfilePictures/';
    $uploadFile = $uploadDir.basename($_FILES['profilePicture']['name']);

    if(move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)){
        return $uploadFile;
    }
    throw new Exception("Le fichier n'a pu etre uploade");
}

function showSearchResults($searchInfos){
    extract($searchInfos);
    $announcements = getSpecificAnnouncements($departureCountry, $arrivalCountry, $dateDepart)->fetchAll();

    require_once("view/client/searchResult.php");
}

function removeAnnouncementAndChangeReservationStatus($announcementId){
    checkConnection();
    changeAnnouncementReservationStatusOnDelete($announcementId);

    deleteAnnouncement($announcementId);
    header("Location:index.php?action=myAnnouncements");

}