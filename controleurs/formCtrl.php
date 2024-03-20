
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("../modele/TicketMgr.class.php");
    require_once("../modele/CmdMgr.class.php");

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
    function retourForm($action,$titrePage,$msg,$tdata){

//var_dump($_POST["action"]);
        $actionPost = $action;
        $pageTitle = $titrePage;
        $msgErreur = $msg;
        $tCommandes = $tdata;
        require_once "../vues/view_form.php";
    }

    function ajouterTicket($dTicket,$typeDossier,$idCmd,$idUser,$nomClient, $numFact = null, $codeArticle = null):bool {
        $pageTitle = "Bienvenue dans l'espace de recherche";
        
        try {
            $nvTicket = TicketMgr::addTicket($dTicket, $typeDossier, (int)$idCmd, (int)$idUser, (int)$codeArticle);
            $msg = "Ajout effectué avec succès. Numéro du Ticket : " . $nvTicket;
            $actionPost = "accueil";
            retourForm($actionPost, $pageTitle, $msg,"");
            return true;
        } catch (Exception $e) {
            $msg = "Une erreur est survenue lors de l'ouverture du ticket: Merci de contacter un Administrateur.";
            error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
            $actionPost = "ajouterTicket";
            $typeTicket = $typeDossier;
            $descTicket = $dTicket;
            $tCommandes[0]['numCommande'] = $idCmd;
            $tCommandes[0]['codeArticle'] = $codeArticle;
            $tCommandes[0]['nomClient'] = $nomClient;
            $tCommandes[0]['numFact']= $numFact;
            require_once("../vues/view_formAddTicket.php");
            return false;
        }
    }


    if(isset($_GET['action'])){
        $actionGet = $_GET['action'];
        switch ($actionGet){
            case "detailsCmd":
                if(isset($_GET['numCmd'])){
                    $numCmdGet = $_GET['numCmd'];
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
                    retourForm($actionPost,$pageTitle,"","");
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
                        retourForm($actionPost,$pageTitle, $msgErreur,"");
                    }
                    require_once "../vues/view_listTicket.php";
                    break;

                case "ajouterTicket" :
                    if (isset($_POST['numCommande']) && isset($_POST['codeArticle'])){
                        $numCmd = $_POST['numCommande'];
                        $codeArticle = $_POST['codeArticle'];
                        $msg = "";
                        try {
                            $tCommandes = CmdMgr::getArticleCmd($numCmd,$codeArticle);
                        } catch (Exception $e){
                            $msg ="Une erreur est survenue : Merci de contacter un Administrateur.";
                            error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                            break;
                        }
                        $pageTitle = "Création d'un nouveau Ticket";
                        require_once("../vues/view_formAddTicket.php");
                        break;
                    } else if(isset($_POST['numCommande'])){
                        $numCmd = $_POST['numCommande'];
                        $msg = "";
                        try {
                            $tCommandes = CmdMgr::getCmd($numCmd);
                        } catch (Exception $e){
                            $msg ="Une erreur est survenue : Merci de contacter un Administrateur.";
                            error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                            break;
                        }
                        $pageTitle = "Création d'un nouveau Ticket";
                        require_once("../vues/view_formAddTicket.php");
                        break;
                    } else {
                        $msg = "";
                        $actionPost = "accueil";
                        $pageTitle = "Bienvenue dans l'espace de recherche";
                        retourForm($actionPost,$pageTitle,$msg,"");
                        break;
                    }

                case "ajouterTicketMAJ" :
                    
                    if (estTxtRenseigne('descTicket') && estTxtRenseigne('typeDossier')) {
//echo "niveau 1";
                        $typeTicket = $_POST['typeDossier'];
                        $descTicket = $_POST['descTicket'];

                        if(estNbrRenseigne('numCmd') && estNbrRenseigne('codeArticle')){
var_dump($_POST);
echo "niveau 2";
                            $idCmd = $_POST['numCmd'];
                            $codeArticle = $_POST['$codeArticle'];
                            
//TODO partie ticket Article
                            if (ajouterTicket($descTicket,$typeTicket,$idCmd,$idUser,$_POST['nomClt'],$_POST['numFact'], $codeArticle) == false) break;
                        } else if(estNbrRenseigne('numCmd')) {

                            $idCmd = $_POST['numCmd'];
                            if (ajouterTicket($descTicket,$typeTicket,$idCmd,$idUser,$_POST['nomClt'],$_POST['numFact'])== false) break;
                        }
//var_dump($idCmd);
//die();
                    } else {
//var_dump($_POST);
                            $typeTicket = $_POST['typeDossier'];
                            $descTicket = $_POST['descTicket'];
                        if (isset($_POST['numCmd']) && isset($_POST['codeArticle'])){
//var_dump($_POST);
                            $tCommandes[0]['numCommande'] = $_POST['numCmd'];
                            $tCommandes[0]['codeArticle'] = $_POST['codeArticle'];
// TODO ajouter libArticle
                        } else {
//var_dump($_POST);
                            $tCommandes[0]['numCommande'] = $_POST['numCmd'];
                            $tCommandes[0]['nomClient'] = $_POST['nomClt'];
                            $tCommandes[0]['numFact']= $_POST['numFact'];
                        }
//var_dump($tCommandes);
                        $msg = "Merci de renseigner tous les champs (description et type de ticket).";
                        $pageTitle = "Création d'un nouveau Ticket";
                        $actionPost = "ajouterTicket";
                        require_once("../vues/view_formAddTicket.php");
                        break;
                    }
                }                
    } else {
        $msg = "";
        $pageTitle = "Bienvenue dans l'espace de recherche";
        retourForm($actionPost,$pageTitle,$msg,"");
    }
    
    }