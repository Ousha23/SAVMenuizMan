<?php ob_start(); ?>
<main>
    
</main>
<?php
$connexion = $_SESSION['nomUtilisateur'];
$siteTitle = "En Construction";
$pageTitle = "Page en cours de construction";
$contenu = ob_get_contents();
ob_end_clean();
require("gabarit.php");
?>