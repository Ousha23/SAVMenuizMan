<?php ob_start(); ?>

<?php $pageTitle ="Votre profil" ; ?>
  <?php $siteTitle ="profil"; ?>

  <?php
$connexion = $_SESSION['nomUtilisateur'] ;
?>


    <h1>Profil de <?= $_SESSION['nomUtilisateur'] ?></h1><br>
    <form action="update-profile.php" method="POST">
        <!-- Afficher les informations de l'utilisateur dans des champs de formulaire -->
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?= $_SESSION['nomUtilisateur'] ?>" disabled>
        <br>
        <label for="nom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?= $_SESSION['prenomUtilisateur'] ?>" disabled>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['emailUtilisateur'] ?>" disabled>
        <br>
        <label for="nom">Profil:</label>
        <input type="text" id="profil" name="profil" value="<?= $_SESSION['libProfil'] ?>" disabled>
        <br>
       
    </form>

    <a href="index.php?action=dashboard" class="retour" href="#">Retour à la page d'acceuil</a>


<?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>
