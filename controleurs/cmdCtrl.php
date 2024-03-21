<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__ . '../../modele/CmdMgr.class.php';
    $msg ="";
    try {
        $tCommandes = CmdMgr::getDetailCmd($numCmdGet);
    } catch (Exception $e){
        $msg ="Une erreur est survenue : Merci de contacter un Administrateur.";
        error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
    }
    if(count($tCommandes) < 1){
        $msg = "Le N° de Commande ne figure pas dans la base de données";
    }
    $pageTitle = "Détail de la commande N° : ".$numCmdGet;
    require_once ("vues/view_consultCmd.php");


    