
<?php ob_start(); ?>

<main class="d-flex align-items-center justify-content-center">
  <div class="container-fluid mt-5">
  <?php $pageTitle ="Merci de vous connecter"; ?>
  <?php $siteTitle ="Login"; ?>
  <?php $connexion="connexion";?>
    
    <div class="row justify-content-center">
      <div class="col-md-3 col-8">
        <div class="custom-container">
          <form action="index.php?action=login" method="POST" >
            <div class="form-group">
              <label for="username">Nom d'utilisateur:</label>
              <input type="email" name="emailUtilisateur" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="Entrez votre email" value="<?php echo isset($emailUtilisateur) ? $emailUtilisateur : '' ; ?>" >
              <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
              <label for="password">Mot de passe:</label>
              <input type="password" name="mdpUtilisateur" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Entrez votre mot de passe" value="<?php echo isset($mdpUtilisateur) ? $mdpUtilisateur : '';?>">
              <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group ">
              <a href="#" class="text-dark">Mot de passe oublié?</a>
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary custom-submit-btn">Connexion</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>


<?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>
