<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAVMenuizMan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
  <link rel="stylesheet" href="css/savMenuizMan.css">
  <link rel="stylesheet" href="css/form.css">
</head>
<body>
  <!-- Header -->
  <header class="container-fluid custom-header p-3">
    <div class="row align-items-center">
      <div class="col-md-6">
        <a href="#" class="text-decoration-none text-dark">
          <img src="path/to/logo.png" alt="Logo" height="30">
        </a>
      </div>
      <div class="col-md-6 text-right">
        <a href="#" class="text-decoration-none text-dark">
          <i class="fas fa-user custom-icon"></i> Connexion
        </a>
      </div>
    </div>
  </header>
    <main class=justify-content-center>
        <div class="container-fluid">
        <h2 class="text-center">Rechercher un ticket</h2>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <form class="row justify-content-center" action="" method="">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idNumTicket">Numéro de ticket</label>
                                    <input type="text" class="form-control custom-input" name="numTicket" id="idNumTicket">
                                </div>
                                <div class="form-group">
                                    <label for="idDate">Date du ticket</label>
                                    <input type="date" class="form-control custom-input" name="dateTicket" id="idDate">
                                </div>
                                <div class="form-group">
                                    <label for="idEtatTicket">Etat du ticket</label>
                                    <select class="form-control custom-input" name="etatTicket" id="idEtatTicket">
                                        <option value="attente">En attente</option>
                                        <option value="enCours">En cours</option>
                                        <option value="traite">Traité</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idNumFact">Numéro de la facture</label>
                                    <input type="text" class="form-control custom-input" name="numFact" id="idNumFact">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idNumCmd">Numéro de la commande</label>
                                    <input type="text" class="form-control custom-input" name="numCmd" id="idNumCmd">
                                </div>
                                <div class="form-group">
                                    <label for="idCodeClt">Code client</label>
                                    <input type="text" class="form-control custom-input" name="codeClt" id="idCodeClt">
                                </div>
                                <div class="form-group">
                                    <label for="idNomClt">Nom client</label>
                                    <input type="text" class="form-control custom-input" name="nomClt" id="idNomClt">
                                </div>
                                <div class="form-group">
                                    <label for="idVille">Ville</label>
                                    <input type="text" class="form-control custom-input" name="nomVille" id="idVille">
                                </div>
                            </div> 
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary custom-submit-btn" name="action" value="Rechercher">
                            </div>
                        </form>
                    </div>
                    <form class="row justify-content-center" action="">
                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Ouvrir un nouveau ticket">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
  <footer class="container-fluid custom-footer p-3 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <p>Phrase simple dans le footer</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>