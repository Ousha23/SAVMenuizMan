
<?php ob_start(); ?>
    <main class=justify-content-center>
        <?=$msgUser?>
        <div class="container-fluid">
               <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <form class="row justify-content-center" action="index.php?action=dashboard" method="post">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idnom">Nom</label>
                                    <input type="text" class="form-control custom-input" name="nomUtilisateur" id="idnom" required value="<?php echo isset($nomUtilisateur) ? $nomUtilisateur : '' ; ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="idprenom">Prénom</label>
                                    <input type="text" class="form-control custom-input" name="prenomUtilisateur" id="idprenom"  required value="<?php echo isset($prenomUtilisateur) ? $prenomUtilisateur : '' ; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="idmail">Email</label>
                                    <input type="email" class="form-control custom-input" name="mailUtilisateur" id="idmail"  required>
                                </div>
                                <div class="form-group">
                                    <label for="IdProfil">Profil</label>
                                    <select class="form-control custom-input" name="idProfil" id="idProfil"  required>
                                        <option value="<?php echo isset($idProfil) ? $idProfil : '' ; ?>" selected disabled hidden>Admin, SAV ou Hotline ?</option>
                                        <option value="1">Administrateur</option>
                                        <option value="2">Technicien SAV</option>
                                        <option value="3">Technicien Hotline</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idpwd">Mot de passe</label>
                                    <input type="password" class="form-control custom-input" name="mdpUtilisateur" id="idpwd" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" 
                                      title="Au moins 1 majuscusle, au moins 1 minuscule, au moins un chiffre, 8 caractères minimum " required>
                                </div>                              
                            </div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 d-flex justify-content-md-between">
                                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Ajouter" name="ajoutUserForm"> 
                                         <input type="reset" class="btn btn-primary custom-submit-btn" value="Réinitialiser" name="reset">
                                    </div>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn">Retour à la page d'accueil</a>
        </div>
    </main>

<?php
$connexion = $_SESSION['nomUtilisateur'];
$siteTitle = "Liste des utilisateurs";
$pageTitle = "Ajout d'un utilisateur";
$contenu = ob_get_contents(); 
ob_end_clean();
require_once "vues/gabarit.php";
?>
