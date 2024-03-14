<?php ob_start();  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - <?php echo $siteTitle; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="custom-header">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-between">
        <div class="col-md-6 col-6">
          <a href="#" class="text-decoration-none">
            <img src="vues/images/Menuiz Man.png" class="custom-logo" alt="Logo" height="120">
          </a>
        </div>
        <div class="col-md-6 col-6 text-right custum-connexion">
          <a href="#" class="text-decoration-none text-dark">
            <i class="fas fa-user custom-icon"></i> <span style="color:#395395;">Connexion</span>
          </a>
        </div>
      </div>
    </div>
  </header>
   
   <?= @$contenu ?>
    
   <footer class="container-fluid custom-footer p-3 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <p ><i class="far fa-copyright"></i> By Bouchra, Leila et Thierry</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    $output = ob_get_clean(); 
    echo $output;       
?>