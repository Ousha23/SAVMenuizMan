<?php ob_start(); ?>
    <main class=justify-content-center>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <form class="row justify-content-center" action="/controleurs/UserCtrl.php" method="post">
                            <div class="container">
                                <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary custom-submit-btn" value="Liste des utilisateurs" name="listeUsers">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Créer un utilisateur" name="ajoutUser">
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row justify-content-center">                                    
                            </div>
                            </div>    
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
$contenu = ob_get_contents(); 
$pageTitle="Gestion d'utilisateurs";
ob_end_clean();              
require("gabarit.php");
?>

