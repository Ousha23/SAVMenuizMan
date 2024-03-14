<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function searchTicket(?int $idTicket, ?int $idCommande, ?int $codeClt, ?string $nomClt, ?string $statutTicket, ?int $idFact, ?DateTime $dateTicket) {
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT C.numCommande, numFact, nomClient, T.idTicketSAV, statutTicket, dateTicket, idDossier, nomUtilisateur FROM `Commande` C
            INNER JOIN Client Clt ON Clt.idClient = C.idClient
            LEFT JOIN Facture F ON F.numCommande = C.numCommande
            LEFT JOIN Ticket T ON C.numCommande = T.numCommande
            LEFT JOIN Utilisateur U ON U.idUtilisateur = T.idUtilisateur
            WHERE T.idTicketSAV LIKE ? AND C.numCommande LIKE ? AND C.idClient LIKE ? AND nomClient LIKE ? AND statutTicket LIKE ? AND numFact LIKE ? AND dateTicket LIKE ?";
            $resultat = $bdd->prepare($sql);
            $resultat->execute(array('%'.$idTicket.'%','%'.$idCommande.'%','%'.$codeClt.'%','%'.$nomClt.'%', '%'.$statutTicket.'%','%'.$idFact.'%', '%'.$dateTicket.'%'  ));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
    }

    $result = searchTicket(1,null,null,null,null,null,null);
    var_dump($result);
