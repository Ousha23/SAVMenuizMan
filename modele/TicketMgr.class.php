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

        /**
         * Crée un ticket dans la BDD en prenant en compte le cas ticket lié à un article lié à une commande ou à uune cmd
         *
         * @param string $descTicket
         * @param string $typeTicket
         * @param integer $idCommande
         * @param integer $idUser
         * @param integer|null $codeArticle
         * @return integer
         */
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

        /**
         * Affiche la liste des Tickets d'une commande donnée
         *
         * @param integer $idCmd
         * @return array
         */
        public static function getTicketsByCmd(int $idCmd):array{
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT * FROM `Ticket` T
            INNER JOIN `Utilisateur` U on T.idUtilisateur = U.idUtilisateur
            WHERE numCommande = ?;";
            $resultat = $bdd->prepare($sql);
            $resultat->execute(array($idCmd));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
        }

        /**
         * MAJ Ticket sans articles
         *
         * @param integer $idTicket
         * @param string $etatTicket
         * @param string $description
         * @return void
         */
        public static function updateTicket(int $idTicket,string $etatTicket,string $description){
            $bdd = BDDMgr::getBDD();
            $sql = "UPDATE Ticket SET statutTicket = :etatTicket, description = :description WHERE idTicketSAV = :idTicket";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':etatTicket', $etatTicket);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':idTicket', $idTicket);
            
            $resultat = $stmt->execute();
        }

        /**
         * Recupère ma table Ticket
         *
         * @param integer $idTicket
         * @return array
         */
        public static function getTicket (int $idTicket):array{
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT * FROM Ticket WHERE ?";
            $resultat = $bdd->prepare($sql);
            $resultat->execute(array($idTicket));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
        }

        /**
         * Fonction pour récupérer le ticket et ses information
         *
         * @param [type] $idTicketSav
         * @return void
         */
        public static function getTicketDetails($idTicketSav) {
            // Connexion à la base de données (à adapter selon votre configuration)
            $pdo = BDDMgr::getBDD();

            // Préparez la requête SQL
            $stmt = $pdo->prepare("SELECT statutDiagnostic, qteStockSAV, idMiseEnRebus, T.idTicketSAV, T.description, T.statutTicket, T.dateTicket, T.idDossier, C.numCommande, Clt.nomClient, F.numFact, R.codeArticle, A.libArticle 
            FROM `Ticket` T 
            LEFT JOIN Retourner R ON R.idTicketSAV = T.idTicketSAV
            LEFT JOIN Article A ON A.codeArticle = R.codeArticle
            INNER JOIN Commande C ON C.numCommande = T.numCommande
            LEFT JOIN Client Clt ON Clt.idClient = C.idClient
            LEFT JOIN Facture F ON F.numCommande = C.numCommande
            WHERE T.idTicketSAV = :idTicketSav");

            // Liez le paramètre :idTicketSav
            $stmt->bindParam(':idTicketSav', $idTicketSav, PDO::PARAM_INT);

            // Exécutez la requête
            $stmt->execute();

            // Récupérez les résultats
            $ticketDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retournez les détails du ticket
            return $ticketDetails;
        }

        /**
         * MAJ Ticket avec des articles et MAJ des stocks correspondants
         *
         * @param integer $idTicket
         * @param integer $codeArticle
         * @param string $etatTicket
         * @param string $description
         * @param integer $qteSAV
         * @param integer|null $qteRebus
         * @param integer|null $qteExpedier
         * @param integer|null $numCommande
         * @param string|null $diagnostic
         * @return void
         */
        public static function updateTicketStock(int $idTicket, int $codeArticle,string $etatTicket, string $description, int $qteSAV, ?int $qteRebus, ?int $qteExpedier, ?int $numCommande, ?string $diagnostic) {
            $bdd = BDDMgr::getBDD();
            try {
                $bdd->beginTransaction();
                $lastIdRebus = null;
                $lastIdExped = null;
                $statutExped = "Traitée";
                if ($qteRebus == 1){
                    $sql = "INSERT INTO `Rebus`(`QteRebus`, `dateMiseRebu`) VALUES (?,CURRENT_DATE)";
                    $resultat = $bdd->prepare($sql);
                    $resultat->execute(array($qteRebus));
                    $lastIdRebus = $bdd->lastInsertId();
                }
                if ($qteExpedier == 1){
                    $sql = "INSERT INTO `Expedition`(`statutExp`, `dateExp`, `numCommande`) VALUES (?,CURRENT_DATE,?)";
                    $resultat = $bdd->prepare($sql);
                    $resultat->execute(array($statutExped,$numCommande));
                    $lastIdExped = $bdd->lastInsertId();
                }
                if ($lastIdExped != null){
                    $sql = "INSERT INTO `Concerner`(`idExpedition`, `codeArticle`, `qteExpArticle`) VALUES (?,?,?)";
                    $resultat = $bdd->prepare($sql);
                    $resultat->execute(array($lastIdExped,$codeArticle,$qteExpedier));
                }
                TicketMgr::updateTicket($idTicket,$etatTicket,$description);
                $sql = "UPDATE `Retourner` SET `qteStockSAV`=?,`statutDiagnostic`=?, `IdMiseEnRebus`=? WHERE `idTicketSAV`=? and `codeArticle`=?";
                $resultat = $bdd->prepare($sql);
                $resultat->execute(array($qteSAV,$diagnostic,$lastIdRebus,$idTicket,$codeArticle));
                $bdd->commit();
            } catch (PDOException $e){
                $bdd->rollBack();
                throw $e;
            } 
        }
//Fonctions utilisées précédemment dans le formulaire de création ticket avec saisi de données(cmd, fact ..) par l'agent
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
        // public static function updateTicketRetourner(int $idTicket, int $codeArticle,string $etatTicket, string $description, int $qteSAV, ?int $idMisEnRebus, ?string $diagnostic){
        //     $bdd = BDDMgr::getBDD();
        //     try {
        //         $bdd->beginTransaction();
        //         TicketMgr::updateTicket($idTicket,$etatTicket,$description);
        //         $sql = "UPDATE `Retourner` SET `qteStockSAV`=?,`statutDiagnostic`=?, `IdMiseEnRebus`=? WHERE `idTicketSAV`=? and `codeArticle`=?";
        //         $resultat = $bdd->prepare($sql);
        //         $resultat->execute(array($qteSAV,$diagnostic,$idMisEnRebus,$idTicket,$codeArticle));
        //         $bdd->commit();
        //     } catch (PDOException $e){
        //         $bdd->rollBack();
        //         throw $e;
        //     } 
        // }
}

    
//$test = searchTicket(null,null,null,null,null,"13/03/2024", null);
//$test = TicketMgr::addTicket("test d'ajout d'un ticket","EP",6,3);
//$test = TicketMgr::getNumCmd('1');
//$test = TicketMgr::getNomCltByCmd(1);
// $test = TicketMgr::getNomCltByFact(1);
// $test = TicketMgr::getTicketsByCmd(1);
//$test = TicketMgr::updateTicketRetourner(50,1,"En cours","test update ticket avc retour",1,"en cours",null);
//$test = TicketMgr::updateTicketStock(51,1,"En cours","test misEnRebus",0,1,0,6,"test rebus");
// $test = TicketMgr::updateTicketStock(52,1,"En cours","test expedition",0,0,1,6,"test reexpedition");
// var_dump($test);
    
