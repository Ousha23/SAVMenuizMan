
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("../modele/TicketMgr.class.php");
    $idTicket = null;
    $idCommande = null;
    $nomClt = null;
    $statutTicket = null;
    $idFact = null;
    $dateTicket = null; 
    $idDossier = null;

    $actionPost = "accueil";

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

    function retourForm($action){
            if ($action == "accueil") $pageTitle = "Bienvenue dans l'espace de recherche";
        require_once "../vues/view_form.php";
    }

    if(isset($_POST['action'])){
        $actionPost = $_POST['action'];
//var_dump($actionPost);
var_dump($_POST['numTicket']);
//die(); 
        try {
            switch($actionPost){
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
                    $tTickets = TicketMgr::searchTicket($idTicket,$idCommande,$nomClt,$statutTicket,$idFact,$dateTicket,$idDossier);
//var_dump($tTickets);
//var_dump($idTicket);
                    require_once "../vues/view_listTicket.php";
                    break;

                case "ajouterTicket" :
                    $pageTitle = "Création d'un nouveau Ticket";
                    require_once "../vues/view_form.php";
                    break;
            }   
        } catch (PDOException $e){
            $msgErreur = $e->getMessage();
echo $msgErreur;
        }
    } else {
        retourForm($actionPost);
    }
    