<?php ob_start(); ?>

<?php $pageTitle ="hello admin" ; ?>
  <?php $siteTitle ="admin"; ?>

  <?php
$connexion = $_SESSION['nomUtilisateur'] ;
?>
<main class="d-flex align-items-center">
    <div style="width: 100%;">
        <h2 class="word-wrap: break-word;">Bienvenue <?php echo $_SESSION['nomUtilisateur']; ?></h2>
        <p>Vous avez accès à toutes les fonctionnalités d'administration.</p>
        <a href="vues/view_from.php">continuez vers votre application</a>
    </div>
</main>
<?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>