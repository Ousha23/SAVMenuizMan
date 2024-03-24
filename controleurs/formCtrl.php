
<?php
//var_dump($_POST);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    require_once __DIR__ . '/../modele/CmdMgr.class.php';
    require_once __DIR__ . '/../modele/TicketMgr.class.php';
    //require_once __DIR__ . '/../modele/afficheTicketMgr.php';

    $idTicket = null;
    $idCommande = null;
    $nomClt = null;
    $statutTicket = null;
    $idFact = null;
    $dateTicket = null; 
    $idDossier = null;
    $isTechSAV = false; // Par défaut, l'utilisateur n'est pas un technicien SAV

    // Recup l'id User;
    if (isset($_SESSION['idPrifil'])) {
        $idUser = $_SESSION['idPrifil'];
    }

    $actionPost = "accueil";
    //$idUser = 2;
    

    /**
     * Verifie si le champs Txt n'est pas vide
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
     * @param [type] $msg
     * @param [type] $tdata
     * @return void
     */
    function retourForm($action,$msg,$tdata){

//var_dump($_POST["action"]);
        $actionPost = $action;
        $msgErreur = $msg;
        $tCommandes = $tdata;
        require_once __DIR__ . "/../vues/view_formRecherche.php";
        
    }

    /**
     * Execute la requete et retourne true si tout s'est bien passé ou false s'il une erreur est survenue
     *
     * @param [type] $dTicket
     * @param [type] $typeDossier
     * @param [type] $idCmd
     * @param [type] $idUser
     * @param [type] $nomClient
     * @param [type] $numFact
     * @param [type] $codeArticle
     * @return boolean
     */
    function ajouterTicket($dTicket,$typeDossier,$idCmd,$idUser,$nomClient, $numFact = null, $codeArticle = null):bool {    
        try {
            $nvTicket = TicketMgr::addTicket($dTicket, $typeDossier, $idCmd, $idUser, $codeArticle);
            $msg = "Ajout effectué avec succès. Numéro du Ticket : " . $nvTicket;
            $actionPost = "accueil";
            retourForm($actionPost, $msg,"");
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
            require_once("vues/view_formAddTicket.php");
            return false;
        }
    }

    if ($action == "dashboard") {
        if(isset($_GET['idTicket'])) {
            $idTicketSav = $_GET['idTicket']; 
            $idProfil = $_SESSION['idPrifil'];
            $ticketDetails = TicketMgr::getTicketDetails($idTicketSav);
            require_once __DIR__ . "/../vues/view_afficher_ticket.php";
        } else if(isset($_GET['numCommande']) && $_GET['numCommande'] !== "") { 
            $numCmdGet = $_GET['numCommande'];
            $idProfil = $_SESSION['idPrifil'];
            require_once ("controleurs/cmdCtrl.php");
        } else if(isset($_GET['nomClient']) || isset($_GET['idFact'])){
            require_once ("vues/view_enConstr.php");
        } else if(isset($_POST['action'])){
        $actionPost = $_POST['action'];
//var_dump($actionPost);
//var_dump($_POST['numTicket']);
//die(); 
        switch($actionPost){
            case 'accueil':
                retourForm($actionPost,"","");
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
                } 
                if(estTxtRenseigne('typeDossier')){
                    $idDossier = $_POST['typeDossier'];
                } 
                if(estNbrRenseigne('numFact')){
                    $idFact = (int)$_POST['numFact'];
                    $pageTitle = "Liste des tickets de la Facture N° : $idFact";
                } 
                if(estNbrRenseigne('numCmd')){
                    $idCommande = (int)$_POST['numCmd'];
                    $pageTitle = "Liste des tickets de la commande N° : $idCommande";
                } 
                if(estTxtRenseigne('nomClt')){
                    $nomClt = $_POST['nomClt'];
                    $pageTitle = "Liste des tickets des clients dont le nom contient : \"$nomClt\"";
                }
                try{
                $tTickets = TicketMgr::searchTicket($idTicket,$idCommande,$nomClt,$statutTicket,$idFact,$dateTicket,$idDossier);
//var_dump($tTickets);
//var_dump($idTicket);
                } catch (Exception $e){
                    $msgErreur ="Erreur : Merci de contacter un Administrateur.";
                    error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
                    retourForm($actionPost, $msgErreur,"");
                }
                
                require_once __DIR__ . "/../vues/view_listTicket.php";
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
                    require_once("vues/view_formAddTicket.php");
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
                    require_once("vues/view_formAddTicket.php");
                    break;
                } else {
                    $msg = "";
                    $actionPost = "accueil";
                    retourForm($actionPost,$msg,"");
                    break;
                }

            case "ajouterTicketMAJ" :    
                if (estTxtRenseigne('descTicket') && estTxtRenseigne('typeDossier')) {
                    $typeTicket = $_POST['typeDossier'];
                    $descTicket = $_POST['descTicket'];
                    if(estNbrRenseigne('numCmd') && estNbrRenseigne('codeArticle')){
//var_dump($_POST);
                        $idCmd = $_POST['numCmd'];
                        $codeArticle = $_POST['codeArticle'];
                        $tArticleCmd = CmdMgr::getArticleCmd($idCmd,$codeArticle);  
// var_dump($codeArticle);
// var_dump($tArticleCmd[0]['codeArticle']); 
// var_dump(count($tArticleCmd));              
                        if (count($tArticleCmd) == 1 && ((int)$codeArticle === $tArticleCmd[0]['codeArticle'])){

                            if (ajouterTicket($descTicket,$typeTicket,$idCmd,$idUser,$_POST['nomClt'],$_POST['numFact'], $codeArticle) == false) break;
                        } else {
                            $msg = "L'article ne correspond pas à l'article selectionner";
                            $actionPost = "ajouterTicket";
                            require_once("vues/view_formAddTicket.php");
                            break;
                        }
                    } else if(estNbrRenseigne('numCmd')) {
                        $idCmd = $_POST['numCmd'];
                        if (ajouterTicket($descTicket,$typeTicket,$idCmd,$idUser,$_POST['nomClt'],$_POST['numFact'])== false) break;
                    }
//var_dump($idCmd);
//die();
                } else {   
                    if(estTxtRenseigne('typeDossier')) $typeTicket = $_POST['typeDossier'];
                    if (estTxtRenseigne('descTicket')) $descTicket = $_POST['descTicket'];
                    if (isset($_POST['numCmd']) && isset($_POST['codeArticle'])){
//var_dump($_POST);
                        $tCommandes[0]['numCommande'] = $_POST['numCmd'];
                        $tCommandes[0]['codeArticle'] = $_POST['codeArticle'];
                        $tCommandes[0]['libArticle'] = $_POST['libArticle'];
                        $tCommandes[0]['numFact']= $_POST['numFact'];
                        $tCommandes[0]['nomClient'] = $_POST['nomClt'];
                    } else {
//var_dump($_POST);
                        $tCommandes[0]['numCommande'] = $_POST['numCmd'];
                        $tCommandes[0]['nomClient'] = $_POST['nomClt'];
                        $tCommandes[0]['numFact']= $_POST['numFact'];
                        
                    }
//var_dump($tCommandes);
                    $msg = "Merci de renseigner tous les champs (description et/ou type de ticket).";
                    $actionPost = "ajouterTicket";
                    require_once("vues/view_formAddTicket.php");
                    break;
                }
                break;
            case "modifierTicket":
                $ticketTraite = false;
                $msgErreur ="";
                $idTicketSav = $_POST['idTicketSAV']; 
                $ticketDetails = TicketMgr::getTicketDetails($idTicketSav);
//var_dump($ticketDetails['statutTicket']);
                if ($ticketDetails['statutTicket'] == "Traité"){
                    $ticketTraite = true;
                    $msgErreur ="Le Ticket ".$idTicketSav." est déjà traité, vous ne pouvez plus le modifier.";
                    require_once __DIR__ . "/../vues/view_modifier_ticket.php";
                    break;
                }
//var_dump($ticketDetails);
                require_once __DIR__ . "/../vues/view_modifier_ticket.php";
                break;
            case "modifierTicketMAJ":
                $diagnostic = null;
                if(estNbrRenseigne('idTicketSAV')) $idTicketSAV = $_POST['idTicketSAV'];
                if(estTxtRenseigne('etatTicket')) $etatTicket = $_POST['etatTicket'];
//die();        
                if (estTxtRenseigne('description')) $descrptTicket = $_POST['description'];
                if (estNbrRenseigne('codeArticle')) $codeArticle = $_POST['codeArticle'];
                if (estTxtRenseigne('diagnostic')) $diagnostic = $_POST['diagnostic'];
                if (estNbrRenseigne('numCommande')) $numCommande = $_POST['numCommande'];
                if (estTxtRenseigne('actionArticle')) {
                 $actionArticle = $_POST['actionArticle'];
                 $qtRebus = null;
                 $qtReexped = null;
                    switch ($actionArticle){
                        case 'miseSAVStock':
                            $qtStockSAV = 1;
                            try{
                                TicketMgr::updateTicketStock($idTicketSAV, $codeArticle, $etatTicket, $descrptTicket, $qtStockSAV, $qtRebus, $qtReexped, $numCommande, $diagnostic);
                            } catch (Exception $e) {
                                $msgErreur ="La modification n'a pas pu être effectuée. Merci de contacter un Administrateur.";
                                error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                                $ticketDetails = TicketMgr::getTicketDetails($idTicketSAV);
                                require_once __DIR__ . "/../vues/view_modifier_ticket.php";
                                break;
                            }
                            $msg = "Modification effectuée avec succès. MAJ Stock SAV effectuée.";
                            $actionPost = "accueil";
                            retourForm($actionPost,$msg,"");
                            break;
                        case 'miseEnRebus':
                            $qtStockSAV = 0;
                            $qtRebus = 1;
                            try{
                                TicketMgr::updateTicketStock($idTicketSAV, $codeArticle, $etatTicket, $descrptTicket, $qtStockSAV, $qtRebus, $qtReexped, $numCommande, $diagnostic);
                            } catch (Exception $e) {
                                $msgErreur ="La modification n'a pas pu être effectuée. Merci de contacter un Administrateur.";
                                error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                                $ticketDetails = TicketMgr::getTicketDetails($idTicketSAV);
                                require_once __DIR__ . "/../vues/view_modifier_ticket.php";
                                break;
                            }
                            $msg = "Modification effectuée avec succès. MAJ Rebus et Stock SAV effectuée.";
                            $actionPost = "accueil";
                            retourForm($actionPost,$msg,"");
                            break;
                        case 'reexpedition':
                            $qtStockSAV = 0;
                            $qtReexped = 1;
                            try{
                                TicketMgr::updateTicketStock($idTicketSAV, $codeArticle, $etatTicket, $descrptTicket, $qtStockSAV, $qtRebus, $qtReexped, $numCommande, $diagnostic);
                            } catch (Exception $e) {
                                $msgErreur ="La modification n'a pas pu être effectuée. Merci de contacter un Administrateur.";
                                error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                                $ticketDetails = TicketMgr::getTicketDetails($idTicketSAV);
                                require_once __DIR__ . "/../vues/view_modifier_ticket.php";
                                break;
                            }
                            $msg = "Modification effectuée avec succès. MAJ Expédition et Stock SAV effectuée.";
                            $actionPost = "accueil";
                            retourForm($actionPost,$msg,"");
                            break;
                    }
                break;
                }
                try { 
//var_dump($_POST);
                    TicketMgr::updateTicket($idTicketSAV, $etatTicket,$descrptTicket);
                    $msg = "Modification effectuée avec succès.";
                    $actionPost = "accueil";
                    retourForm($actionPost,$msg,"");
                } catch (Exception $e) {
                    $msgErreur ="La modification n'a pas pu être effectuée. Merci de contacter un Administrateur.";
                    error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                    $ticketDetails = TicketMgr::getTicketDetails($idTicketSAV);
                    require_once __DIR__ . "/../vues/view_modifier_ticket.php";
                    break;
                }
                break;
            case "listTicketsCmd":
                $numCmd = $_POST['numCommande'];
                try {
                    $tTicketsByCmd = TicketMgr::getTicketsByCmd($numCmd);
                } catch (Exception $e){
                    $msg ="Une erreur est survenue : Merci de contacter un Administrateur.";
                    error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                    break;
                }
//var_dump($tTicketsByCmd);
                $msg = "";
                $tCommandes = CmdMgr::getDetailCmd($numCmd);
                require_once ("vues/view_consultCmd.php");
            break;
        }                
    } else {
            retourForm($actionPost,"","");
    }
}