<!-- <pre> -->
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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

        public static function addTicket(string $descTicket, string $typeTicket, int $idCommande, int $idUser, int $codeArticle = null):int {
            $bdd = BDDMgr::getBDD();
            try {
                $bdd->beginTransaction();
                $sql = "INSERT INTO `Ticket`(`statutTicket`, `description`, `dateTicket`, `idUtilisateur`, `numCommande`, `idDossier`) VALUES (?,?,CURRENT_DATE,?,?,?)";
                $resultat = $bdd->prepare($sql);
                $resultat->execute(array('En attente',$descTicket,$idUser,$idCommande,$typeTicket));
                $lastId = $bdd->lastInsertId();
                if($codeArticle !== null) {
                    $sql = "INSERT INTO `Retourner`(`idTicketSAV`, `codeArticle`) VALUES (?,?)";
                    $resultat = $bdd->prepare($sql);
                    $resultat->execute(array($lastId,$codeArticle));
                }
                $bdd->commit();
                return $lastId; 
            } catch (PDOException $e){
                $bdd->rollBack();
                throw $e;
            }  
        }

        // /**
        //  * Récupère le num de commande en utilisant le numero de facture
        //  *
        //  * @param integer $idFact
        //  * @return array
        //  */
        // public static function getNumCmdByFact(int $idFact) : array {
        //     $bdd = BDDMgr::getBDD();
        //     $sql = "SELECT `numCommande` FROM `Facture` WHERE numFact = ?;";
        //     $resultat = $bdd->prepare($sql);
        //     $resultat->execute(array($idFact));
        //     $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
        //     return $tResultat;
        // }

        // /**
        //  * Recherche le num Commande renseigné au niveau de la BDD
        //  *
        //  * @param integer $idCmd
        //  * @return array
        //  */
        // public static function getCmd(int $idCmd):array{
        //     $bdd = BDDMgr::getBDD();
        //     $sql = "SELECT `numCommande` FROM `Commande` WHERE `numCommande` = ?";
        //     $resultat = $bdd->prepare($sql);
        //     $resultat->execute(array($idCmd));
        //     $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
        //     return $tResultat;
        // }

        // public static function getNomCltByFact(int $idFact) : array {
        //     $bdd = BDDMgr::getBDD();
        //     try {
        //         $sql = "SELECT `nomClient` FROM `Commande` cmd 
        //         JOIN Client C on C.idClient = cmd.idClient
        //         JOIN `Facture` F on F.numCommande = cmd.numCommande
        //         WHERE numFact = ?;";
        //         $resultat = $bdd->prepare($sql);
        //         $resultat->execute(array($idFact));
        //         $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
        //         return $tResultat;
        //     } catch (PDOException $e){
        //         error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
        //         return array();
        //     }
        // }

        // public static function getNomCltByCmd(int $idCmd) : array {
        //     $bdd = BDDMgr::getBDD();
        //     try {
        //         $sql = "SELECT `nomClient` FROM Commande Cmd 
        //             JOIN Client C on C.idClient = Cmd.idClient
        //             WHERE numCommande = ?";
        //         $resultat = $bdd->prepare($sql);
        //         $resultat->execute(array($idCmd));
        //         $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
        //         return $tResultat;
        //     } catch (PDOException $e){
        //         error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
        //         return array();
        //     }
        // }
}

    
//$test = searchTicket(null,null,null,null,null,"13/03/2024", null);
//$test = TicketMgr::addTicket("test d'ajout d'un ticket","EP",6,3);
//$test = TicketMgr::getNumCmd('1');
//$test = TicketMgr::getNomCltByCmd(1);
// $test = TicketMgr::getNomCltByFact(1);
//var_dump($test);
    
