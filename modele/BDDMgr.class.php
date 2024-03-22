<?php

    require_once('ModelException.php');

    class BDDMgr {
        private static $bdd;
    
        public static function getBDD() {
            if (self::$bdd !== null) {
                return self::$bdd;
            }
    
            if (file_exists("param.ini")) {
                $cheminFichier = "param.ini";
            } else {
                // Si le fichier n'existe pas dans le répertoire actuel, utilisez un chemin relatif
                $cheminFichier = "../param.ini";
            }
            
            if (!file_exists($cheminFichier)) {
                throw new ModeleException("Aucun fichier de configuration trouvé");
            } else { 
    
            $tParametres = parse_ini_file($cheminFichier, true);
    
            extract($tParametres['BDD']);
            $dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset=utf8';
            self::$bdd = new PDO($dsn, $login, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return self::$bdd;
            
            }
        }
    }
    
