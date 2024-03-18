<?php ob_start();?>

<?php $pageTitle ="Rechercher un ticket" ; ?>
  <?php $siteTitle ="admin"; ?>

  <?php
$connexion = "admin" ;
?>


    <main class=justify-content-center>
        <div class="container-fluid">
       
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
    <?php
$contenu = ob_get_contents(); 
ob_end_clean();              
require("gabarit.php");
?>