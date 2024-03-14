<?php
    class BDDMgr {
        public static function getBDD() {
            $cheminFichier = "../param.ini";
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else {
                $tParametres = parse_ini_file($cheminFichier, true);
                //extract($tParametres['BDD']);
                //extract($tParametres['BD']);
                $dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset=utf8';
                try {
                    $bdd =new PDO($dsn, $login, $mdp , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    return $bdd;
                } catch (PDOException $e){
                    return $e->getMessage();
                }  
            }
        }
    }
