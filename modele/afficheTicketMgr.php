<?php

require_once __DIR__ . '/../modele/BDDMgr.class.php';

function getTicketDetails($idTicketSav) {
    // Connexion à la base de données (à adapter selon votre configuration)
    $pdo = BDDMgr::getBDD();

    // Préparez la requête SQL
    $stmt = $pdo->prepare("SELECT * FROM Ticket WHERE idTicketSAV = :idTicketSav");

    // Liez le paramètre :idTicketSav
    $stmt->bindParam(':idTicketSav', $idTicketSav, PDO::PARAM_INT);

    // Exécutez la requête
    $stmt->execute();

    // Récupérez les résultats
    $ticketDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    require_once __DIR__ . "/../vues/view_afficher_ticket.php";

    // Retournez les détails du ticket
    return $ticketDetails;
}
