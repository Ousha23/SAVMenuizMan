<?php
    require_once __DIR__ . '/../modele/UserMgr.class.php';
    //----------------afficher liste utilisateur-----

echo "je suis là";
    if($action == "dashboard"){

        if(isset($_GET['idUser'])){
            require_once "vues/view_enConstr.php";
            die();
        }
        if(isset($_POST['listeUsers']))
        {
        try{
            $tUsers = UserMgr::getListUsers(); 
// var_dump($tUsers); 
            require_once "vues/view-table.php";    
        }catch(PDOException $e){
            die("<h1>Erreur de connexion :</h1>".$e ->getMessage());
        }        
        } else if(isset($_POST['ajoutUser'])){
//var_dump($_POST);
        $msgEmail='';
        $msgUser="";
        require_once "vues/view_form_user.php";}
     
        if(isset($_POST['ajoutUserForm'])){

         $nomUtilisateur = $_POST['nomUtilisateur'];    
         $prenomUtilisateur = $_POST['prenomUtilisateur'];   
         $emailUtilisateur = $_POST['mailUtilisateur'];
         $idProfil = $_POST['idProfil'];
         $mdpUtilisateur = $_POST['mdpUtilisateur'];
        
         // vérifier si email existe déja   
        
         UserMgr::checkEmail($emailUtilisateur); 
         $affiche = UserMgr::checkEmail($emailUtilisateur);
         if( $affiche){
           
        $msgUser = '<h3 class="text-center">Le mail existe déjà. Veuillez réessayer!</h3>';
          require_once "vues/view_form_user.php";     
        die();
        }  else{
            try{
                UserMgr::addUser($nomUtilisateur, $prenomUtilisateur, $emailUtilisateur, $mdpUtilisateur, $idProfil);
            } catch (PDOException $e){
                $msg = "Une erreur est survenue lors de l'ajout à la BDD";
            }
          $msgUser = '<h3 class="text-center">Ajout effectué avec succès</h3>';
          require_once  "vues/view-menuAdmin.php"; 
                           
          $msgEmail='';
          $nomUtilisateur = '';    
          $prenomUtilisateur = '';   
          $emailUtilisateur = '';
          $idProfil = '';
          $mdpUtilisateur = ''; 
          die();                
        }
    } else {
        $msgUser = "";
        require_once  "vues/view-menuAdmin.php";
    }
}

    
 
?>

  