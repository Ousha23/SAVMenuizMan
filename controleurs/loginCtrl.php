<?php

//controleurs/loginCtrl.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['emailUtilisateur']) ? $_POST['emailUtilisateur'] : '';
    $password =isset($_POST['mdpUtilisateur']) ? $_POST['mdpUtilisateur'] : '';

    // Valider la connexion
    $user = login($email, $password);

    if ($user) {
        $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
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
    include __DIR__ . '/../vues/view-login.php';

}




?>
