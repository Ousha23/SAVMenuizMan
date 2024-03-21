<?php ob_start();  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://kit.fontawesome.com/24368e6b70.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../vues/css/savMenuizMan.css">
    <link rel="stylesheet" href="../vues/css/form.css">
    <link rel="stylesheet" href="../vues/css/listeTicket.css">

</head>
<body>
<header class="custom-header">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-between">
        <div class="col-md-6 col-6">
          <a href="#" class="text-decoration-none">
            <img src="../vues/images/MenuizMan.png" class="custom-logo" alt="Logo" height="120">
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
  <h2 class="text-center custom-title"><?= $pageTitle ?></h2>
   <?= @$contenu ?>
    
   <footer class="container-fluid custom-footer p-3 mt-auto">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <p class=""><i class="far fa-copyright "></i> By Bouchra, Leila et Thierry</p>
      </div>
    </div>
  </footer>
  

  <!-- Scripts jQuery et DataTables -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.11.5/i18n/French.json"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../vues/JS/listeTicket.js"></script>
</body>
</html>

<?php 
    $output = ob_get_clean(); 
    echo $output;       
?>