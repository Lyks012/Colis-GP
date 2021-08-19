<?php
require_once("controller/controller.php");

try{
    if(isset($_GET['action'])){
        $action = $_GET['action'];

        if($action == "inscription"){
            require_once("view/inscription.php");
        }
        
        else if($action == "connexion"){
            require_once("view/connexion.php");
        }

        else if($action == "addClient"){
            $clientInfos = $_POST;
            registerClient($clientInfos);
        }

        else if($action == "notConnected"){
            throw new Exception ("Vous devez etre connecte pour acceder a cette page");
        }
        
        else if ($action == "addCarrier"){
            $carrierInfos = $_POST;
            registerCarrier($carrierInfos);
        }

        else if($action == "connexionAttempt"){
            extract($_POST);
            initializeConnexionAndRedirect($userType, $email, $password);
        }
        
        else if($action == "disconnect"){
            disconnectAndDirectToHome();
        }

        else if($action == "newAnnouncement"){
            displayNewAnnouncementPage();
        }

        else if($action == "personalInfos"){
            displayProfilePage();
        }

        else if($action == "announcementDetails"){
            if(isset($_GET['announcementId'])){
                displayAnnoucementDetails($_GET['announcementId']);
            }
            else throw new Exception("Veuillez choisir une annonce");
        }

        else if($action == "updateCarrierInfos"){
            $newInfos = $_POST;
            updateCarrierInfos($newInfos);
        }

        else if($action == "changeProfilePicture"){
            changeProfilePicture();
        }

        else if($action == "transportInfos"){
            displayTransportInfos();
        }

        else if($action == "servicesPage"){
            
            checkConnection();
            if(isset($_POST) AND !empty($_POST)) saveInfosInSession("transportInfos", $_POST);
            require_once("view/carrier/newAnnouncement/services.php");
        }

        else if($action == "addAnnouncement"){
            // we can either be updating an announcement so we need to save it with the same id as before
            // or be adding a new announcement
            //PS : look storeAnnouncementIdInSessionAndRedirectToModifyPage function in controller
            newAnnouncement($_POST);
        }

        else if($action == "myAnnouncements"){
            displayCarrierAnnouncements();
        }

        else if($action == "myAnnouncementDetails"){
            if(isset($_GET['announcementId'])){
                displayMyAnnouncementDetails($_GET['announcementId']);
            }
            else throw new Exception("Veuillez choisir une annonce");

        }
        
        else if($action == "makeReservation"){
            reservationPage($_GET['id_annonce']);
        }

        else if($action == "reservationDetails"){
            $receiverInfos = $_POST;
            saveReceiverInfosAndGoToReservationContentPage($receiverInfos,);
        }

        else if($action == "receiverPage"){
            checkConnection();
            require_once("view/client/reservation.php");
        }
        else if($action == "newReservation"){
            newReservation($_POST);
        }

        else if($action == "updateClientInfos"){
            $newInfos = $_POST;
            updateClientInfos($newInfos);
        }
        else if($action == "transporteurProfile"){
            if(isset($_GET['transporteurId']))
                displayCarrierProfile($_GET['transporteurId']);

            else throw new Exception("Veuillez choisir un transporteur");
        }

        else if($action == "editAnnouncement"){
            if(isset($_GET['announcementId'])){
                storeAnnouncementIdInSessionAndRedirectToModifyPage($_GET['announcementId']);
            }
            else throw new Exception("Veuillez choisir une annonce a modifier");
        }

        else if($action == "updateAnnouncement"){
            updateAnnouncementAndRedirect($_POST);
        }

        else if($action == "receivedReservations"){
            displayReceivedReservations();
        }
        else if($action == "myReservations"){
            displayMyReservations();
        }

        else if($action == "receiverDetails"){
            if(isset($_GET['receiverId'])){
                displayReceiverDetails($_GET['receiverId']);
            }
            else throw new Exception("Veuillez choisir un destinataire");
        }

        else if($action == "deleteMyReservation"){
            if(isset($_GET['reservationId'])) removeReservation($_GET['reservationId']);
            else throw new Exception("Veuillez choisir une annonce a supprimer");
        }

        else if($action == "receivedReservations"){
            displayReceivedReservations();
        }

        else if($action == "ConfirmClientyReservation"){
            if(isset($_GET['reservationId'])){
                confirmClientReservation($_GET['reservationId']);
            }
            else throw new Exception("Veuillez choisir une annonce a modifier");
        }

        else if($action == "putClientyReservationOnHold"){
            if(isset($_GET['reservationId'])){
                putClientReservationOnHold($_GET['reservationId']);
            }
            else throw new Exception("Veuillez choisir une annonce a modifier");
        }

        else if($action == "deleteAnnouncement"){
            if(isset($_GET['announcementId'])){
                removeAnnouncementAndChangeReservationStatus($_GET['announcementId']);
            }
            else throw new Exception("Veuillez choisir une annonce a supprimer");
        }

        else if($action == "search"){
            showSearchResults($_POST);
        }
        else{
            throw new Exception("Cette page n'existe pas");
        }
    }

    else{
        displayHomePage();
    }
}

catch(Exception $e){
    $errorMsg = $e->getMessage();
    require_once("view/404.php");
}