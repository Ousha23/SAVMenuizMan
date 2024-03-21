
<?php


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__ . '/../modele/TicketMgr.class.php';
    require_once __DIR__ . '/../modele/afficheTicketMgr.php';

    $idTicket = null;
    $idCommande = null;
    $nomClt = null;
    $statutTicket = null;
    $idFact = null;
    $dateTicket = null; 
    $idDossier = null;
    $isTechSAV = false; // Par défaut, l'utilisateur n'est pas un technicien SAV

// Verifiez si l'utilisateur est un technicien SAV
if (isset($_SESSION['idPrifil']) && $_SESSION['idPrifil'] === '2') {
    $isTechSAV = true;
}

    $actionPost = "accueil";
    

    if (!isset($_SESSION['emailUtilisateur'])) {
        // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
        header('Location: login.php');
        exit; // Assurez-vous de quitter le script après la redirection
    }

    /**
     * return 
     *
     * @param [type] $champs
     * @return void
     */
    function estTxtRenseigne($champs): bool {
        return isset($_POST[$champs]) && !empty($_POST[$champs]); 
    }
    function estNbrRenseigne($champs): bool {
        return isset($_POST[$champs]) && ($_POST[$champs] !== '');
    }

    function retourForm($action,$msg){
        $pageTitle = "Bienvenue dans l'espace de recherche";
        $msgErreur = $msg;
        require_once __DIR__ . "/../vues/view_form.php";
        
    }

    if(isset($_POST['action'])){
        $actionPost = $_POST['action'];
//var_dump($actionPost);
//var_dump($_POST['numTicket']);
//die(); 
            switch($actionPost){
                case 'acceuil':
                case 'Rechercher':
                    $pageTitle = "Liste des commandes";
                    if(estNbrRenseigne('numTicket')){
                        $idTicket = (int)$_POST['numTicket'];    
var_dump($idTicket);
                    } 
                    if(estTxtRenseigne('dateTicket')){
                        $dateTicket = $_POST['dateTicket'];
//var_dump($dateTicket);
                        $pageTitle = "Liste des Tickets";
                    } 
                    if(estTxtRenseigne('etatTicket')){
                        $statutTicket = $_POST['etatTicket'];
//var_dump($statutTicket);
                        $pageTitle = "Liste des Tickets";
                    } 
                    if(estTxtRenseigne('typeDossier')){
                        $idDossier = $_POST['typeDossier'];
                        $pageTitle = "Liste des Tickets";
                    } 
                    if(estNbrRenseigne('numFact')){
                        $idFact = (int)$_POST['numFact'];
                        $pageTitle = "Liste des Factures";
                    } 
                    if(estNbrRenseigne('numCmd')){
                        $idCommande = (int)$_POST['numCmd'];
                    } 
                    if(estTxtRenseigne('nomClt')){
                        $nomClt = $_POST['nomClt'];
                    }
                    try{
                    $tTickets = TicketMgr::searchTicket($idTicket,$idCommande,$nomClt,$statutTicket,$idFact,$dateTicket,$idDossier);
//var_dump($tTickets);
//var_dump($idTicket);
                    } catch (PDOException $e){
                        $msgErreur ="Erreur : ".$e->getMessage();
                        retourForm($actionPost, $msgErreur);
                    }
                   
                    require_once __DIR__ . "/../vues/view_listTicket.php";
                    break;

                case "ajouterTicket" :
                    $pageTitle = "Création d'un nouveau Ticket";
                    retourForm($actionPost,"");
                    break;
                
                    // case "afficherTicket" :
                    //     $idTicketSav = $_GET['id']; 
                    //     $ticketDetails = getTicketDetails($idTicketSav);
                   
                    // break;
                    
                    
                }   
    } else if ($action == "dashboard") {
        if(isset($_GET['idTicket'])) {
            $idTicketSav = $_GET['idTicket']; 
            $ticketDetails = getTicketDetails($idTicketSav);
        } else {
            retourForm($actionPost,"");
        }
    } else {
        retourForm($actionPost,"");
    }
    