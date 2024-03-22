<?php
    include_once('../modele/UserMgr.class.php');

    //----------------afficher liste utilisateur-----
    if(isset($_POST['listeUsers']))
        {
        try{
            $tUsers = UserMgr::getListUsers(); 
// var_dump($tUsers); 
            require_once('../vues/view-table.php');    
        }catch(PDOException $e){
            die("<h1>Erreur de connexion :</h1>".$e ->getMessage());
        }        
        }
    
    //-------Ajouter utilisateur---------------------

     if(isset($_POST['ajoutUser'])){
//var_dump($_POST);
        $msgEmail='';
        include_once('../vues/view_form_user.php');}
     
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
           
        echo  '<script language="Javascript">
          alert ("Cette adresse email existe déjà, veuillez réessayer" )
          </script>';
        require_once('../vues/view_form_user.php');     
        die();
        }  else{
         UserMgr::addUser($nomUtilisateur, $prenomUtilisateur, $emailUtilisateur, $mdpUtilisateur, $idProfil);
        
          $msgUser = '<p>Ajout réussi</p>';
        
          require_once('../vues/view_msg_User.php'); 
                           
          $msgEmail='';
          $nomUtilisateur = '';    
          $prenomUtilisateur = '';   
          $emailUtilisateur = '';
          $idProfil = '';
          $mdpUtilisateur = ''; 
          die();                
        }
    }
 
?>

  