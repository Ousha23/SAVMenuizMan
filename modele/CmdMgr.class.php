<!-- <pre> -->
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "BDDMgr.class.php";

    class CmdMgr {
        /**
         * Recupère tous les détails liées à un commande depuis la BDD et retourne un tableau utilisé dans la vue_consultCmd
         *
         * @param integer $idCmd
         * @return array
         */
        public static function getDetailCmd(int $idCmd):array {
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT DISTINCT cmd.numCommande,cmd.dateCommande, cmd.statutCommande, C.codeArticle, A.libArticle, C.qteArticle, A.garantie_Article,F.numFact, F.dateFact, Clt.nomClient, Con.idExpedition, E.dateExp, Kit.libKitArticle  FROM `Commande` cmd
            LEFT JOIN `Contenir` C ON C.numCommande = cmd.numCommande
            LEFT JOIN `Article` A ON C.codeArticle = A.codeArticle
            LEFT JOIN Client Clt ON Clt.idClient = cmd.idClient
            LEFT JOIN Expedition E ON E.numCommande = cmd.numCommande 
            LEFT JOIN Inclure I ON I.codeArticle = A.codeArticle
            LEFT JOIN KitLotArticles Kit ON Kit.idKitArticle = I.idKitArticle
            LEFT JOIN Facture F ON F.numCommande = cmd.numCommande
            LEFT JOIN Concerner Con ON Con.idExpedition = E.idExpedition AND Con.codeArticle = A.codeArticle
            WHERE cmd.numCommande = ?;";

            $resultat = $bdd->prepare($sql);
            $resultat->execute(array($idCmd));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
        }
        /**
         * Recupere le détail d'une commande afin de remplir le form (view_formAddTicket) pour le cas d'une ouverture de ticket pour commande
         *
         * @param integer $idCmd
         * @return array
         */
        public static function getCmd(int $idCmd):array {
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT cmd.numCommande, F.numFact, Clt.nomClient FROM `Commande` cmd
            LEFT JOIN Client Clt ON Clt.idClient = cmd.idClient
            LEFT JOIN Facture F ON F.numCommande = cmd.numCommande
            WHERE cmd.numCommande = ?;";

            $resultat = $bdd->prepare($sql);
            $resultat->execute(array($idCmd));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
        }

        /**
         * recupere le detail d'un article donné lié à une commande donnée afin de remplir le form (view_formAddTicket) pour le cas d'une ouverture de ticket pour un article spécifique dans la commande
         *
         * @param integer $idCmd
         * @param integer $codeArticle
         * @return void
         */
        public static function getArticleCmd(int $idCmd, int $codeArticle):array{
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT cmd.numCommande, F.numFact, C.codeArticle, A.libArticle, Clt.nomClient  FROM `Commande` cmd
            LEFT JOIN `Contenir` C ON C.numCommande = cmd.numCommande
            LEFT JOIN `Article` A ON C.codeArticle = A.codeArticle
            LEFT JOIN Client Clt ON Clt.idClient = cmd.idClient 
            LEFT JOIN Facture F ON F.numCommande = cmd.numCommande
            WHERE cmd.numCommande = ? AND C.codeArticle = ?;";

            $resultat = $bdd->prepare($sql);
            $resultat->execute(array($idCmd,$codeArticle));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
        }
    }
//$test = CmdMgr::getCmd(1);
//var_dump($test);