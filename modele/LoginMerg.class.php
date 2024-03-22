<?php
require_once __DIR__ . '/../modele/BDDMgr.class.php';
/**
 * fonction pour la connexion
 *
 * @param [type] $email
 * @param [type] $password
 * @return void
 */
function login($email, $password) {
    $pdo = BDDMgr::getBDD();
    
    // Préparez la requête
    $sql = 'SELECT U.nomUtilisateur, U.prenomUtilisateur, U.emailUtilisateur, U.mdpUtilisateur, U.idProfil, P.libProfil
            FROM Utilisateur U
            INNER JOIN Profil P ON U.idProfil = P.idProfil
            WHERE U.emailUtilisateur = :emailUtilisateur';

    // Préparez l'instruction
    $stmt = $pdo->prepare($sql);
    if ($stmt) {
        // Liez les paramètres
        $stmt->bindParam(':emailUtilisateur', $email, PDO::PARAM_STR);
        
        // Tentez d'exécuter la requête
        if ($stmt->execute()) {
            // Vérifiez si l'email existe
            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch();
                $stored_password = $row['mdpUtilisateur'];
                // Comparez les mots de passe
                if ($password === $stored_password) {
                    // Connexion réussie, retourne les données de l'utilisateur
                    return $row;
                } else {
                    // Mot de passe incorrect
                    return false;
                }
            } else {
                // Email non trouvé
                return false;
            }
        } else {
            // Erreur lors de l'exécution de la requête
            die('Erreur lors de l\'exécution de la requête.');
        }
    } else {
        // Erreur lors de la préparation de la requête
        die('Erreur lors de la préparation de la requête.');
    }
}
/**
 * fonction pour logout
 *
 * @return void
 */
function logout() {
    // Détruit toutes les valeurs de session
    $_SESSION = array();

    // Détruit la session
    session_destroy();

    // Redirige vers la page de connexion
    header('location: index.php?action=login');
    exit;
}
?>
