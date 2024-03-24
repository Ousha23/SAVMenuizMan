<?php

// index.php (Contrôleur principal)

session_start();

require_once 'modele/LoginMerg.class.php';
require_once 'modele/BDDMgr.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Instancier le contrôleur approprié en fonction de l'action
switch ($action) {
    case 'login':
        $controller = new LoginController();
        break;
    case 'dashboard':
        $controller = new DashboardController();
        break;
    
    default:
        // Rediriger vers la page de connexion 
        $controller = new LoginController();
        break;
}

// Exécuter l'action appropriée
$controller->handleAction($action);

// Classe LoginController
class LoginController {
    public function handleAction($action) {
        switch ($action) {
            case 'login':
                
                require 'controleurs/loginCtrl.php'; 
            break;

            default:
            header('location: index.php?action=login');
           
                break;
        }
    }
}

// Classe DashboardController
class DashboardController {
    public function handleAction($action) {
        switch ($action) {
            case 'dashboard':
                
                if (!isset($_SESSION['emailUtilisateur']) || empty($_SESSION['emailUtilisateur'])) {
                    header('location: index.php?action=login');
                    exit;
                } 
                
                $idProfil = $_SESSION['idPrifil'];
                switch ($idProfil) {
                    case 1:
                        include 'vues/view-menuAdmin.php';
                        break;
                    case 2:
                        if(isset($_GET['idTicket'])){
                            require 'controleurs/formCtrl.php';
                            break;
                        } else {
                            $actionPost = "accueil";
                            require 'controleurs/formCtrl.php';
                            break;
                        }
                            
        
                    case 3:
                        if(isset($_GET['idTicket'])){
                            require 'controleurs/formCtrl.php';
                            break;
                        } else {
                            $actionPost = "accueil";
                            require 'controleurs/formCtrl.php';
                            break;
                        }
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
            require 'controleurs/formCtrl.php';
                break;
        }
    }
}


?>