<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("../modele/CmdMgr.class.php");

    $tCommandes = CmdMgr::detailCmd($numCmd);
    $pageTitle = "Détail de la commande N° : ".$numCmd;
    require_once ("../vues/view_consultCmd.php");


    