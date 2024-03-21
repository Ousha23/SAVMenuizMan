<?php ob_start(); ?>

<?php $pageTitle ="Votre profil" ; ?>
  <?php $siteTitle ="profil"; ?>

  <?php
$connexion = $_SESSION['nomUtilisateur'] ;
?>

<<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="#" method="POST">
                <!-- Afficher les informations de l'utilisateur dans des champs de formulaire -->
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?= $_SESSION['nomUtilisateur'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?= $_SESSION['prenomUtilisateur'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= $_SESSION['emailUtilisateur'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="profil">Profil:</label>
                    <input type="text" id="profil" name="profil" class="form-control" value="<?= $_SESSION['libProfil'] ?>" disabled>
                </div>
            </form>
            
            <!-- Bouton de retour -->
            <div class="row justify-content-center">
                <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn ">Retour à la page d'accueil</a>
            </div>
        </div>
    </div>
</div>


<?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>
