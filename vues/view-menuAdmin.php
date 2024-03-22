<?php ob_start(); ?>
    <main class=justify-content-center>
    <?php echo $msgUser;?>
        <div class="container-fluid mt-4">
                <div class="divForm">
                        <form class="row justify-content-center" action="index.php?action=dashboard" method="post">
                            <div class="col-md-6 text-right">
                                <input type="submit" class="btn btn-primary custom-submit-btn" value="Liste des utilisateurs" name="listeUsers">
                            </div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary custom-submit-btn" value="Créer un utilisateur" name="ajoutUser">
                            </div>
                        </form> 

            </div>
        </div>
    </main>
<?php
$siteTitle="Menu Admin";
$connexion = $_SESSION['nomUtilisateur'];
$contenu = ob_get_contents(); 
$pageTitle="Gestion d'utilisateurs";
ob_end_clean();              
require_once ("vues/gabarit.php");
?>

