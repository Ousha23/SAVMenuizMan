<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "BDDMgr.class.php";
    
        function searchTicket(?int $idTicket, ?int $idCommande, ?string $nomClt, ?string $statutTicket, ?int $idFact, ?string $dateTicket, ?string $idDossier) {
            $queryParams = [];
            $bdd = BDDMgr::getBDD();

            $sql = "SELECT T.idTicketSAV, C.numCommande, nomClient, statutTicket, numFact, dateTicket, idDossier, nomUtilisateur FROM `Commande` C
            INNER JOIN Client Clt ON Clt.idClient = C.idClient
            LEFT JOIN Facture F ON F.numCommande = C.numCommande
            LEFT JOIN Ticket T ON C.numCommande = T.numCommande
            LEFT JOIN Utilisateur U ON U.idUtilisateur = T.idUtilisateur
            WHERE 1=1 ";
            if ($idTicket != null){
                $sql .= "AND T.idTicketSAV LIKE ? ";
                $queryParams[]='%'.$idTicket.'%';
            }
            if ($idCommande != null){
                $sql .= "AND C.numCommande LIKE ? ";
                $queryParams[]='%'.$idCommande.'%';
            } 
            if ($nomClt != null) {
                $sql .= "AND nomClient LIKE ? ";
                $queryParams[]='%'.$nomClt.'%';
            }
            if ($statutTicket != null){
                $sql .= "AND statutTicket LIKE ? ";
                $queryParams[]='%'.$statutTicket.'%';
            }
            if ($idFact != null){
                $sql .= "AND numFact LIKE ? ";
                $queryParams[]='%'.$idFact.'%';
            }
            if ($dateTicket != null){
                //TODO à revoir 
                $sql .= "AND dateTicket = STR_TO_DATE('".$dateTicket."', '%d/%m/%Y')";
                //$queryParams[]= "STR_TO_DATE('".$dateTicket."', '%d/%m/%Y')";
            }
            if ($idDossier != null){
                $sql .= "AND idDossier LIKE ?";
                $queryParams[]='%'.$idDossier.'%';
            }

            $resultat = $bdd->prepare($sql);

            $resultat->execute($queryParams);

            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            echo $sql;
            return $tResultat;
    }
    
    $test = searchTicket(null,null,null,null,null,"13/03/2024", null);?>
    <pre><?=var_dump($test)?></pre>
    
