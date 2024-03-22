<?php
      
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once('BDDMgr.class.php');


    class UserMgr{
        //afficher liste utilisateurs-------------------------------------------------------------------------
       public static function  getListUsers() {
          $bdd = BDDMgr::getBDD();
          $sql = "SELECT * FROM utilisateur 
          INNER JOIN profil on utilisateur.idProfil = profil.idProfil";
          $resultat = $bdd->prepare($sql);
          $resultat->execute();
          $tResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
          return $tResultat;
      }
        // ajouter utilisateur---------------------------------------------------------------------------------
      /**
       * Undocumented function
       *
       * @param string $nomUtilisateur
       * @param string $prenomUtilisateur
       * @param string $emailUtilisateur
       * @param string $mdpUtilisateur
       * @param string $idProfil
       * @return void
       */
        public static function  addUser(string $nomUtilisateur, string $prenomUtilisateur, string $emailUtilisateur, string $mdpUtilisateur, string $idProfil) {
          $bdd = BDDMgr::getBDD();
          $sql= "INSERT INTO `utilisateur` (nomUtilisateur, prenomUtilisateur, emailUtilisateur, mdpUtilisateur, idProfil)
          VALUES (:nomUtilisateur, :prenomUtilisateur, :mailUtilisateur, :mdpUtilisateur, :idProfil)";        
        $query = $bdd->prepare($sql);
        $res = $query->execute(array(':nomUtilisateur' => $nomUtilisateur,
         ':prenomUtilisateur'=> $prenomUtilisateur,
         ':mailUtilisateur'=> $emailUtilisateur,
         ':idProfil'=> $idProfil,
         ':mdpUtilisateur'=> $mdpUtilisateur,
          
        ));
      
      return $res;  ;
      //echo "res: " .$res;
        }

        // Vérifier si adresse email existe déjà--------------------------------------------------------------- 
        /**
         * Undocumented function
         *
         * @param string $emailUtilisateur
         * @return void
         */
        public static function  checkEmail(string $emailUtilisateur){
          $bdd = BDDMgr::getBDD();
          $stmt = $bdd->prepare("SELECT emailUtilisateur FROM utilisateur WHERE emailUtilisateur = :emailUtilisateur");
          $stmt->execute([
              ':emailUtilisateur' => $emailUtilisateur
          ]);
          $resEmail = $stmt->fetch(PDO::FETCH_ASSOC);
          return $resEmail;
        }

        //Charger ligne à modifier

        public static function  modifForm(int $idUtilisateur){
          $bdd = BDDMgr::getBDD();
          $stmt = $bdd->prepare("SELECT *FROM utilisateur WHERE idUtilisateur = : idUtilisateur");
          $stmt->execute([
              ':idUtilisateur' => $idUtilisateur
          ]);
          $res = $stmt->fetch(PDO::FETCH_ASSOC);
          return $res;
        }
             
        

      }    


        
        
    
           
             

   
 

   