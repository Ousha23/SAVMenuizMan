
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

    $actionGet = "accueil";

    /**
     * return 
     *
     * @param [type] $champs
     * @return void
     */
    function estRenseigne($champs):bool{
        return isset($_POST[$champs]) && !empty($_POST[$champs]);
    }

    if(isset($_GET['action']) && isset($_POST['action'])){
        $actionPost = $_POST['action'];
var_dump($_GET['action']);
var_dump($actionPost);
var_dump($actionGet);
//die();   
        try {
            switch($actionPost){
                case 'Rechercher':
                    
                    if(estRenseigne('numTicket')){
                        $idTicket = $_POST['numTicket'];
                    }
                    if(estRenseigne('dateTicket')){
                        $dateTicket = $_POST['dateTicket'];
//var_dump($dateTicket);
                    }
                    if(isset($_POST['etatTicket'])){
                        $statutTicket = $_POST['etatTicket'];
                    }
                    if(isset($_POST['typeDossier'])){
                        $idDossier = $_POST['typeDossier'];
                    }
                    if(estRenseigne('numFact')){
                        $idFact = $_POST['numFact'];
                    }
                    if(estRenseigne('numCmd')){
                        $idCommande = $_POST['numCmd'];
                        $titreListe = "Liste des commandes";
                    }
                    if(estRenseigne('nomClt')){
                        $nomClt = $_POST['nomClt'];
                    }
                    $tTickets = TicketMgr::searchTicket($idTicket,$idCommande,$nomClt,$statutTicket,$idFact,$dateTicket,$idDossier);
//var_dump($tTickets);
                    $titreListe = "Liste des tickets";
                    require_once "../vues/view_listTicket.php";
                    break;

                case "ouvrirTicket" :
                    $titreForme = "Ouvrir un Ticket";
                    require_once "../vues/view_form.php";
                    break;
            }   
        } catch (PDOException $e){
            $msgErreur = $e->getMessage();
echo $msgErreur;
        }
    } else {
        $titreForme = "Bienvenue";
        require_once "../vues/view_form.php";
    }
    