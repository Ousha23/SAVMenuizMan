
<pre>
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

    function estRenseigne($champs){
        return isset($_POST[$champs]) && !empty($_POST[$champs]);
    }

    if(isset($_GET['action']) && isset($_POST['action'])){
        $actionPost = $_POST['action'];
var_dump($actionPost);
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
                    }
                    if(estRenseigne('numClt')){
                        $nomClt = $_POST['nomClt'];
                    }
                    $tTickets = TicketMgr::searchTicket($idTicket,$idCommande,$nomClt,$statutTicket,$idFact,$dateTicket,$idDossier);
var_dump($tTickets);
                    break;
            }
        } catch (PDOException $e){
            $msgErreur = $e->getMessage();
echo $msgErreur;
        }
            
    }