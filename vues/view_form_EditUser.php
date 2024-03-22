<?php ob_start(); ?>
    <main class=justify-content-center>
        <div class="container-fluid">
               <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <form class="row justify-content-center" action="index.php?action=dashboard" method="post">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="idUser">Identifiant</label>
                                    <input type="number" class="form-control custom-input" name="idUser" id="idUser"  required>
                                </div>
                                <div class="form-group">
                                    <label for="idnom">Nom</label>
                                    <input type="text" class="form-control custom-input" name="nomUtilisateur" id="idnom" required value="<?php echo $nomUtilisateur ; ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="idprenom">Prénom</label>
                                    <input type="text" class="form-control custom-input" name="prenomUtilisateur" id="idprenom"  required value="<?php echo  $prenomUtilisateur ?>">
                                </div>
                                <div class="form-group">
                                    <label for="IdProfil">Profil</label>
                                    <select class="form-control custom-input" name="idProfil" id="idProfil"  required>
                                        <option value="" selected disabled hidden>Admin, SAV ou Hotline ?</option>
                                        <option value="1">Administrateur</option>
                                        <option value="2">Technicien SAV</option>
                                        <option value="3">Technicien Hotline</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 d-flex justify-content-md-between">
                                        <!-- <form action="/controleurs/UserCtrl.php" method="post"></form> -->
                                         <input type="submit" class="btn btn-primary custom-submit-btn" value="Rechercher" name="EditUser"> 
                                         <input type="reset" class="btn btn-primary custom-submit-btn" value="Réinitialiser" name="reset"> 
                                    </div>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-left">
                            <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn ">Retour à la page d'accueil</a>
                        </div>
    </main>
<?php
$siteTitle = "Modifier un Utilisateur";
$connexion = $_SESSION['nomUtilisateur'];
$pageTitle = "Modifier un Utilisateur";
$contenu = ob_get_contents(); 
ob_end_clean();
require_once "vues/gabarit.php";
?>