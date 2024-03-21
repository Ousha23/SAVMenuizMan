
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
    function retourForm($action,$msg,$tdata){

//var_dump($_POST["action"]);
        $actionPost = $action;
        $msgErreur = $msg;
        $tCommandes = $tdata;
        require_once "../vues/view_form.php";
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
            require_once("../vues/view_formAddTicket.php");
            return false;
        }
    }


    if(isset($_GET['action'])){
        $actionGet = $_GET['action'];
        switch ($actionGet){
            case "detailsCmd":
                if(estNbrRenseigne('numCmd')){
                    $numCmdGet = $_GET['numCmd'];
                    require_once ("cmdCtrl.php");
                    break;
                }
//______________________A revoir après regroupement du code
            case "detailsTicket":
                if(estNbrRenseigne('idTicketSAV')){
                    $idTicket = $_GET['idTicketSAV'];
                    require_once ("../vues/view_enConstr.php");
                    break;
                }
//_______________________
            case "detailsClient":
                if(isset($_GET['nomClient'])){
                    $idTicket = $_GET['nomClient'];
                    require_once ("../vues/view_enConstr.php");
                    break;
                }
            case "detailsFact":
                if(estNbrRenseigne('numFact')){
                    $idTicket = $_GET['numFact'];
                    require_once ("../vues/view_enConstr.php");
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
                        require_once("../vues/view_formAddTicket.php");
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
// var_dump($_POST);
                            $idCmd = $_POST['numCmd'];
                            $codeArticle = $_POST['codeArticle'];
                            $tArticleCmd = CmdMgr::getArticleCmd($idCmd,$codeArticle);                 
                            if (count($tArticleCmd) == 1 && ($codeArticle === $tArticleCmd[0]['codeArticle'])){
//var_dump($tArticleCmd[0]['codeArticle']);
                                if (ajouterTicket($descTicket,$typeTicket,$idCmd,$idUser,$_POST['nomClt'],$_POST['numFact'], $codeArticle) == false) break;
                            } else {
                                $msg = "L'article ne correspond pas à l'article selectionner";
                                $actionPost = "ajouterTicket";
                                require_once("../vues/view_formAddTicket.php");
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
                        require_once("../vues/view_formAddTicket.php");
                        break;
                    }
                }                
        } else {
            $msg = "";
            retourForm($actionPost,$msg,"");
        }
    
    }