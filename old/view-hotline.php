

<?php ob_start(); ?>

<?php $pageTitle ="hello tech Hotline" ; ?>
  <?php $siteTitle ="tech Hotline"; ?>

  <?php
$connexion = $_SESSION['nomUtilisateur'] ;
?>
<main>
  
    
      <h1>Bienvenu <?php echo $_SESSION['nomUtilisateur']; ?></h1>
    
    
    <!-- Contenu spécifique au tech Hotline -->
    <p>Vous pouvez répondre aux appels et aider les clients avec leurs problèmes techniques.</p>

</main>
<?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>