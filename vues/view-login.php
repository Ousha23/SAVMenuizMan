<?php ob_start(); ?>

<main class="d-flex align-items-center justify-content-center">
  <div class="container-fluid mt-5">
    <h2 class="text-center">Merci de vous connecter</h2>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="custom-container">
          <form>
            <div class="form-group">
              <label for="username">Nom d'utilisateur:</label>
              <input type="text" class="form-control custom-input" id="username" required>
            </div>
            <div class="form-group">
              <label for="password">Mot de passe:</label>
              <input type="password" class="form-control custom-input" id="password" required>
            </div>

            <div class="form-group ">
              <a href="#" class="text-dark">Nom d'utilisateur ou mot de passe oublié?</a>
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
