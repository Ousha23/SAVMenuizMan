

<?php ob_start(); ?>

<?php $pageTitle ="hello Tecnicien-Sav" ; ?>
  <?php $siteTitle ="Tecnicien-Sav"; ?>

  <?php
$connexion = $_SESSION['nomUtilisateur'] ;
?>
<main>
  
    
      <h1>Bienvenu <?php echo $_SESSION['nomUtilisateur']; ?></h1>
    
    
    <!-- Contenu spécifique à l'administrateur -->
    <p>Vous pouvez consulter et gérer les demandes de service après-vente.</p>

</main>
<?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>