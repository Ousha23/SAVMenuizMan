<?php ob_start(); ?>
<main>
<div class="col-md-6">
    <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn ">Retour à la page d'accueil</a>
</div>
</main>
<?php
$connexion = $_SESSION['nomUtilisateur'];
$siteTitle = "En Construction";
$pageTitle = "Page en cours de construction";
$contenu = ob_get_contents();
ob_end_clean();
require("gabarit.php");
?>