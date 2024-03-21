<?php

// index.php (Contrôleur principal)



session_start();

// Vérifie si l'utilisateur est connecté et le rediriger vers la page d'acceuil
/*if (isset($_SESSION['emailUtilisateur']) && ($_GET['action'] !== 'login' && $_GET['action'] !== 'dashboard')) {
 
    require_once('location: index.php?action=dashboard');
    exit;
}*/

// Inclure le modèle

require_once 'modele/LoginMerg.class.php';
require_once 'modele/BDDMgr.class.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';
$actionPost = isset($_POST['action']) ? $_POST['action'] : '';

$email_err = $password_err = '';

switch ($action) {
    case 'login':
echo

        require 'controleurs/loginCtrl.php'; 
        break;
    
    case 'dashboard':
echo "jesuilà";
        if (!isset($_SESSION['emailUtilisateur']) || empty($_SESSION['emailUtilisateur'])) {
            header('location: index.php?action=login');
            exit;
        } 
        $mailProfil = $_SESSION['emailUtilisateur'];
        $idProfil = $_SESSION['idPrifil'];
        switch ($idProfil) {
            case 1:
                include 'vues/view-admin.php';
                break;
            case 2:
                if(isset($_GET['idTicket']) || (isset($_GET['numCommande']))){
                    require 'controleurs/formCtrl.php';
                    break;
                } else {
                    $actionPost = "accueil";
                    require 'controleurs/formCtrl.php';
                    break;
                }
            case 3:
                if(isset($_GET['idTicket']) || (isset($_GET['numCommande']))){
                    require 'controleurs/formCtrl.php';
                    break;
                } else {
                    $actionPost = "accueil";
                    require 'controleurs/formCtrl.php';
                    break;
                }

            // default:
            //     header('location: index.php?action=login');
            //     exit;
        }
        break;
 
    
    case 'profile':
        if (!isset($_SESSION['emailUtilisateur']) || empty($_SESSION['emailUtilisateur'])) {
            header('location: index.php?action=login');
            exit;
        }
        include 'vues/view-profile.php';
        break;
        
    case 'logout':
        logout();
        header('location: index.php?action=login');
        exit;
      
        
    default:
        header('location: index.php?action=login');
        exit;
}

?>
