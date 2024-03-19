
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
    $idUser = 2;

    /**
     * Verifie si le champs nbr n'est pas vide
     *
     * @param [type] $champs
     * @return void
     */
    function estTxtRenseigne($champs): bool {
        return isset($_POST[$champs]) && !empty($_POST[$champs]); 
    }
    /**
     * Verifie si le champs nbr n'est vide
     *
     * @param [type] $champs
     * @return boolean
     */
    function estNbrRenseigne($champs): bool {
        return isset($_POST[$champs]) && ($_POST[$champs] !== '');
    }

    /**
     * Rederige vers le ctrleur avec les variables dont il a besoin
     *
     * @param [type] $action
     * @param [type] $titrePage
     * @param [type] $msg
     * @return void
     */
    function retourForm($action,$titrePage,$msg){

//var_dump($_POST["action"]);
        $actionPost = $action;
        $pageTitle = $titrePage;
        $msgErreur = $msg;
        require_once "../vues/view_form.php";
    }

    if(isset($_GET['action'])){
        $actionGet = $_GET['action'];
        switch ($actionGet){
            case "detailsCmd":
                if(isset($_GET['numCmd'])){
                    $numCmd = $_GET['numCmd'];
                    require_once ("cmdCtrl.php");
                    break;
                }
            case "detailsTicket":
                if(isset($_GET['idTicketSAV'])){
                    $idTicket = $_GET['idTicketSAV'];
                    require_once ("");
                    break;
                }
        }
    } else {
    if(isset($_POST['action'])){
        $actionPost = $_POST['action'];
//var_dump($actionPost);
//var_dump($_POST['numTicket']);
//die(); 
            switch($actionPost){
                case 'accueil':
                    $pageTitle = "Bienvenue dans l'espace de recherche";
                    retourForm($actionPost,$pageTitle,"");
                case 'Rechercher':
                    $pageTitle = "Liste des Tickets";
                    if(estNbrRenseigne('numTicket')){
                        $idTicket = (int)$_POST['numTicket'];    
//var_dump($idTicket);
                    } 
                    if(estTxtRenseigne('dateTicket')){
                        $dateTicket = $_POST['dateTicket'];
//var_dump($dateTicket);
                    } 
                    if(estTxtRenseigne('etatTicket')){
                        $statutTicket = $_POST['etatTicket'];
//var_dump($statutTicket);
                    } 
                    if(estTxtRenseigne('typeDossier')){
                        $idDossier = $_POST['typeDossier'];
                    } 
                    if(estNbrRenseigne('numFact')){
                        $idFact = (int)$_POST['numFact'];
                        $pageTitle = "Liste des Factures";
                    } 
                    if(estNbrRenseigne('numCmd')){
                        $idCommande = (int)$_POST['numCmd'];
                        $pageTitle = "Liste des commandes";
                    } 
                    if(estTxtRenseigne('nomClt')){
                        $nomClt = $_POST['nomClt'];
                    }
                    try{
                    $tTickets = TicketMgr::searchTicket($idTicket,$idCommande,$nomClt,$statutTicket,$idFact,$dateTicket,$idDossier);
//var_dump($tTickets);
//var_dump($idTicket);
                    } catch (Exception $e){
                        $msgErreur ="Erreur : Merci de contacter un Administrateur.";
                        error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
                        retourForm($actionPost,$pageTitle, $msgErreur);
                    }
                    require_once "../vues/view_listTicket.php";
                    break;

                case "ajouterTicket" :
                    
                    $msg = "";
                    $pageTitle = "Création d'un nouveau Ticket";
                    retourForm($actionPost,$pageTitle,$msg);
                    break;
                
                case "ajouterTicketMAJ" :
                    $pageTitle = "Bienvenue dans l'espace de recherche";
                    if (estTxtRenseigne('descTicket') && estTxtRenseigne('typeDossier')) {
echo "niveau 1";
                        $typeTicket = $_POST['typeDossier'];
                        $descTicket = $_POST['descTicket'];
                        if ((estNbrRenseigne('numFact') && !empty($_POST['numFact'])) || ((estNbrRenseigne('numCmd') && !empty($_POST['numCmd'])))) {
echo "niveau 2";
                            if (estNbrRenseigne('numFact') && estNbrRenseigne('numCmd')){
                                $idFact = $_POST['numFact'];
                                $idCmd = $_POST['numCmd'];
                                // $idCmdByFact = [];
                                try {
                                    $idCmdByFact = TicketMgr::getNumCmdByFact($idFact);
                                } catch (Exception $e){
                                    $msgErreur ="Une erreur est survenue : Merci de contacter un Administrateur.";
                                    error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                                    break;
                                }
var_dump($idCmdByFact);
var_dump($idCmd);
                                if (!empty($idCmdByFact)) {

                                    if ((int)$idCmd === $idCmdByFact[0]["numCommande"]) $idCmd = $idCmdByFact[0]["numCommande"];
                                    else {
                                        $msg = "Le numéro de Commande renseigné ne correspond à aucune Facture. Merci de vérifier.";
                                        $pageTitle = "Création d'un nouveau Ticket";
                                        $actionPost = "ajouterTicket";
                                        retourForm($actionPost, $pageTitle, $msg);
                                        break;
                                    }
                                } else {
                                    $msg = "Le numéro de facture renseigné ne correspond à aucune commande. Merci de vérifier.";
                                    $pageTitle = "Création d'un nouveau Ticket";
                                    $actionPost = "ajouterTicket";
                                    retourForm($actionPost, $pageTitle, $msg);
                                    break;
                                }
                            } else if (estNbrRenseigne('numFact')) {
echo "niveau 3";
                                $idFact = $_POST['numFact'];
                                try {
                                    $idCmdByFact = TicketMgr::getNumCmdByFact($idFact);
                                } catch (PDOException $e){
                                    $msgErreur ="Erreur : Merci de contacter un Administrateur.";
                                    error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
                                    break;
                                }
                                if (!empty($idCmdByFact)) {
                                    $idCmd = $idCmdByFact[0]["numCommande"];
                                } else {
                                    $msg = "Le numéro de facture renseigné ne correspond à aucune commande. Merci de vérifier.";
                                    $pageTitle = "Création d'un nouveau Ticket";
                                    $actionPost = "ajouterTicket";
                                    retourForm($actionPost, $pageTitle, $msg);
                                    break;
                                }
//var_dump($idCmdByFact);
                            } else {
                                $idCmd = $_POST['numCmd'];
                                try {
                                    $tCmd = TicketMgr::getCmd($idCmd);
                                } catch (Exception $e){
                                    $msgErreur = "Une Erreur est survenue: Merci de contacter un Administrateur.";
                                    error_log("Erreur récupérration ID Commande".$e->getMessage());
                                    retourForm($actionPost, $pageTitle, $msgErreur);
                                    break;
                                }
                                
                                if (count($tCmd) !== 1) {
                                    $msg = "Le numéro de Commande renseigné ne correspond à aucune commande. Merci de vérifier.";
                                    $pageTitle = "Création d'un nouveau Ticket";
                                    $actionPost = "ajouterTicket";
                                    retourForm($actionPost, $pageTitle, $msg);
                                    break;
                                }
                            }
//var_dump($idCmd);
                        } else {
                            $msg = "Vous devez renseigner un numéro de facture ou un numéro de commande valide pour créer le ticket.";
                            $pageTitle = "Création d'un nouveau Ticket";
                            $actionPost = "ajouterTicket";
                            retourForm($actionPost, $pageTitle, $msg);
                            break;
                        }
                        try {
                            $nvTicket = TicketMgr::addTicket($descTicket, $typeTicket, $idCmd, $idUser);
                            $msg = "Ajout effectué avec succès. Numéro du Ticket : " . $nvTicket;
                            $actionPost = "accueil";
                            retourForm($actionPost, $pageTitle, $msg);
                        } catch (Exception $e) {
                            $msgErreur = "Une erreur est survenue lors de l'ouverture du ticket: Merci de contacter un Administrateur.";
                            error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
                            retourForm($actionPost, $pageTitle, $msgErreur);
                            break;
                        }

                    } else {
                        $msg = "Merci de renseigner tous les champs et un numéro de commande ou de facture valide pour pouvoir créer le ticket.";
                        $pageTitle = "Création d'un nouveau Ticket";
                        $actionPost = "ajouterTicket";
                        retourForm($actionPost, $pageTitle, $msg);
                        break;
                    }
                }                
    } else {
        $msg = "";
        $pageTitle = "Bienvenue dans l'espace de recherche";
        retourForm($actionPost,$pageTitle,$msg);
    }
    
    }