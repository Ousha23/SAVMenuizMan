<!-- <pre> -->
<?php
    
    require_once "BDDMgr.class.php";
    class TicketMgr {
        /**
         * Rercherche au niveau de la BD en prenant uun ou plusieurs param en compte
         *
         * @param integer|null $idTicket
         * @param integer|null $idCommande
         * @param string|null $nomClt
         * @param string|null $statutTicket
         * @param integer|null $idFact
         * @param string|null $dateTicket
         * @param string|null $idDossier
         * @return array
         */
        public static function searchTicket(?int $idTicket, ?int $idCommande, ?string $nomClt, ?string $statutTicket, ?int $idFact, ?string $dateTicket, ?string $idDossier):array {
            $queryParams = [];
            $bdd = BDDMgr::getBDD();
                $sql = "SELECT T.idTicketSAV, C.numCommande, nomClient, statutTicket, numFact, dateTicket, idDossier, nomUtilisateur FROM `Commande` C
                INNER JOIN Client Clt ON Clt.idClient = C.idClient
                LEFT JOIN Facture F ON F.numCommande = C.numCommande
                LEFT JOIN Ticket T ON C.numCommande = T.numCommande
                LEFT JOIN Utilisateur U ON U.idUtilisateur = T.idUtilisateur
                WHERE 1=1 ";
                if ($idTicket !== null){
                    $sql .= "AND T.idTicketSAV = ? ";
                    $queryParams[]=$idTicket;
                }
                if ($idCommande !== null){
                    $sql .= "AND C.numCommande = ? ";
                    $queryParams[]=$idCommande;
                } 
                if ($nomClt !== null) {
                    $sql .= "AND nomClient LIKE ? ";
                    $queryParams[]='%'.$nomClt.'%';
                }
                if ($statutTicket !== null){
                    $sql .= "AND statutTicket LIKE ? ";
                    $queryParams[]='%'.$statutTicket.'%';
                }
                if ($idFact !== null){
                    $sql .= "AND numFact = ? ";
                    $queryParams[]=$idFact;
                }
                if ($dateTicket !== null){
                    //TODO à revoir 
                    //$sql .= "AND dateTicket = STR_TO_DATE('".$dateTicket."', '%d/%m/%Y')";
                    //$queryParams[]= "STR_TO_DATE('".$dateTicket."', '%d/%m/%Y')";
                    $sql .= "AND dateTicket LIKE ? ";
                    $queryParams[]='%'.$dateTicket.'%';
    
                }
                if ($idDossier !== null){
                    $sql .= "AND idDossier = ?";
                    $queryParams[]=$idDossier;
                }
    
                $resultat = $bdd->prepare($sql);
    
                $resultat->execute($queryParams);
    
                $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
// echo $sql;
// var_dump($queryParams);
                return $tResultat;
    }


    //affichage du ticket SAV





}

    
//$test = searchTicket(null,null,null,null,null,"13/03/2024", null);
//var_dump($test);
    
