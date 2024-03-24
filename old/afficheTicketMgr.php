<?php

require_once __DIR__ . '/../modele/BDDMgr.class.php';
/**
 * Fonction pour récupérer le ticket et ses information
 *
 * @param [type] $idTicketSav
 * @return void
 */
// function getTicketDetails($idTicketSav) {
//     // Connexion à la base de données (à adapter selon votre configuration)
//     $pdo = BDDMgr::getBDD();

//     // Préparez la requête SQL
//     $stmt = $pdo->prepare("SELECT statutDiagnostic, qteStockSAV, idMiseEnRebus, T.idTicketSAV, T.description, T.statutTicket, T.dateTicket, T.idDossier, C.numCommande, Clt.nomClient, F.numFact, R.codeArticle, A.libArticle 
//     FROM `Ticket` T 
//     LEFT JOIN Retourner R ON R.idTicketSAV = T.idTicketSAV
//     LEFT JOIN Article A ON A.codeArticle = R.codeArticle
//     INNER JOIN Commande C ON C.numCommande = T.numCommande
//     LEFT JOIN Client Clt ON Clt.idClient = C.idClient
//     LEFT JOIN Facture F ON F.numCommande = C.numCommande
//     WHERE T.idTicketSAV = :idTicketSav");

//     // Liez le paramètre :idTicketSav
//     $stmt->bindParam(':idTicketSav', $idTicketSav, PDO::PARAM_INT);

//     // Exécutez la requête
//     $stmt->execute();

//     // Récupérez les résultats
//     $ticketDetails = $stmt->fetch(PDO::FETCH_ASSOC);

//     // Retournez les détails du ticket
    // return $ticketDetails;
// }
