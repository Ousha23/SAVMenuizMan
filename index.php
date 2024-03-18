<?php
// index.php (Contrôleur)

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirigez l'utilisateur vers le tableau de bord
    header('location: index.php?action=dashboard');
    exit;
}

// Inclure le modèle
require_once 'modele/LoginMerg.class.php';
require_once 'modele/BDDMgr.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$email_err = $password_err = '';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['emailUtilisateur']) ? $_POST['emailUtilisateur'] : '';
            $password =isset($_POST['mdpUtilisateur']) ? $_POST['mdpUtilisateur'] : '';

            // Valider la connexion
            $user = login($email, $password);

            if ($user) {
                $_SESSION['emailUtilisateur'] = $email;
                $_SESSION['nomUtilisateur'] = $user['nomUtilisateur'];
                $_SESSION['idPrifil'] = $user['idProfil'];
                $_SESSION['prenomUtilisateur'] = $user['prenomUtilisateur'];
                $_SESSION['libProfil'] = $user['libProfil'];
                header('location: index.php?action=dashboard');
                exit;
            } else {
                $email_err = empty($email) ? 'Please enter email' : '';
                $password_err = empty($password) ? 'Please enter password' : 'Invalid email or password';
                include 'vues/view-login.php';
                exit;
            }
        } else {
            // Afficher le formulaire de connexion
            include 'vues/view-login.php';
        }
        break;
    
    case 'dashboard':
        if (!isset($_SESSION['emailUtilisateur']) || empty($_SESSION['emailUtilisateur'])) {
            header('location: index.php?action=login');
            exit;
        } 

        $idProfil = $_SESSION['idPrifil'];
        switch ($idProfil) {
            case 1:
                include 'vues/view-admin.php';
                break;
            case 2:
                include 'vues/view-sav.php';
                break;
            case 3:
                include 'vues/view-hotline.php';
                break;
            default:
                header('location: index.php?action=login');
                exit;
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
        break;
        
    default:
        header('location: index.php?action=login');
        exit;
}
?>
