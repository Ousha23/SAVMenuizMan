<!-- <pre> -->
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "BDDMgr.class.php";

    class CmdMgr {
        public static function getDetailCmd(int $idCmd):array {
            $bdd = BDDMgr::getBDD();
            $sql = "SELECT cmd.numCommande,cmd.dateCommande, cmd.statutCommande, C.codeArticle, A.libArticle, C.qteArticle, A.garantie_Article,F.numFact, F.dateFact, Clt.nomClient, E.idExpedition,E.dateExp, Kit.libKitArticle  FROM `Commande` cmd
            LEFT JOIN `Contenir` C ON C.numCommande = cmd.numCommande
            LEFT JOIN `Article` A ON C.codeArticle = A.codeArticle
            LEFT JOIN Client Clt ON Clt.idClient = cmd.idClient
            LEFT JOIN Expedition E ON E.numCommande = cmd.numCommande 
            LEFT JOIN Inclure I ON I.codeArticle = A.codeArticle
            LEFT JOIN KitLotArticles Kit ON Kit.idKitArticle = I.idKitArticle
            LEFT JOIN Facture F ON F.numCommande = cmd.numCommande
            LEFT JOIN Concerner Con ON Con.codeArticle = C.codeArticle
            WHERE cmd.numCommande = ?;";

            $resultat = $bdd->prepare($sql);
            $resultat->execute(array($idCmd));
            $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $tResultat;
        }

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

        public static function getArticleCmd(int $idCmd, int $codeArticle){
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