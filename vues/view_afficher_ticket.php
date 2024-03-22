<?php 
    ob_start(); 
    $pageTitle = "Détails du ticket";
    $siteTitle = "Détails du ticket";
    $connexion = $_SESSION['nomUtilisateur'];
?>

<main class="justify-content-center">
    <div class="container-fluid">
        <?php if (isset($ticketDetails) && !empty($ticketDetails)): ?>
                <div class="divForm">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="idNumTicket">Numéro de ticket</label>
                                <input type="text" class="form-control custom-input" id="idNumTicket" value="<?= $ticketDetails['idTicketSAV'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="idDate">Date du ticket</label>
                                <input type="date" class="form-control custom-input" id="idDate" value="<?= $ticketDetails['dateTicket'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="idEtatTicket">Etat du ticket</label>
                                
                                <select class="form-control custom-input" name="etatTicket" id="idEtatTicket">
                                            <option disabled selected>Choisissez une option</option>
                                            <option value="attente">En attente</option>
                                            <option value="cours">En cours</option>
                                            <option value="traite">Traité</option>
                                        </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="idTypeTicket">Type du ticket</label>
                                <select class="form-control custom-input" id="idTypeTicket" readonly>
                                    <option value="<?= $ticketDetails['idDossier'] ?? '' ?>" selected><?= $ticketDetails['idDossier'] ?? '' ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">  
                            <div class="form-group">
                                <label for="idNumCmd">Numéro de la commande</label>
                                <input type="text" class="form-control custom-input" id="idNumCmd" value="<?= $ticketDetails['numCommande'] ?? '' ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nomClient">Nom du client</label>
                                <input type="text" class="form-control custom-input" id="nomClient" value="<?= $ticketDetails['nomClient'] ?? '' ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="codeArticle">Code de l'Article</label>
                                <input type="text" class="form-control custom-input" id="codeArticle" value="<?= $ticketDetails['codeArticle'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="libArticle">Article concerné</label>
                                <input type="text" class="form-control custom-input" id="libArticle" value="<?= $ticketDetails['libArticle'] ?? '' ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idDescription">Description</label>
                                <textarea class="form-control custom-input" id="idDescription" rows="5" ><?= $ticketDetails['description'] ?? '' ?></textarea>
                            </div>
                        </div>
                            
                    </div>
                    </form>
            </div>
        <?php else: ?>
            <h3 class="text-center">Aucun détail de ticket trouvé.</h3>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center">
    <div class="col-md-6 text-right">
                <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn">Retour à la page d'accueil</a>
            </div>

    <?php
        if ($idProfil === 2) {
            echo '
            <form class="col-md-6" action="index.php?action=dashboard" method="POST">
                <input type="hidden" name="action" value="modifierTicket">
                <input type="hidden" name ="idTicketSAV" value = "'.$ticketDetails['idTicketSAV'].'" >
                <input type="submit" class="btn btn-primary custom-submit-btn" value="Modifier le ticket">
            </form>';
        }
    ?>
    </div>
    
</main>

<?php
    $contenu = ob_get_contents();
    ob_end_clean();
    require("gabarit.php");
?>
