<?php 
    ob_start(); 
    session_start();
    $pageTitle = "Détailles du ticket";
    $siteTitle = "Détailles du ticket";
    $connexion = $_SESSION['nomUtilisateur'];
?>

<main class="justify-content-center">
    <div class="container-fluid">
        <?php if (isset($ticketDetails) && !empty($ticketDetails)): ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="divForm">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                                <select class="form-control custom-input" id="idEtatTicket" <?php if ($isTechSAV) echo 'disabled' ?>>
                                    <option value="<?= $ticketDetails['statutTicket'] ?? '' ?>" selected><?= $ticketDetails['statutTicket'] ?? '' ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idTypeTicket">Type du ticket</label>
                                <select class="form-control custom-input" id="idTypeTicket" readonly>
                                    <option value="<?= $ticketDetails['idDossier'] ?? '' ?>" selected><?= $ticketDetails['idDossier'] ?? '' ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idNumCmd">Numéro de la commande</label>
                                <input type="text" class="form-control custom-input" id="idNumCmd" value="<?= $ticketDetails['numCommande'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="idDescription">Description</label>
                                <textarea class="form-control custom-input" id="idDescription" rows="5" <?php if ($isTechSAV) echo 'readonly' ?>><?= $ticketDetails['description'] ?? '' ?></textarea>
                            </div>
                            <?php if ($isTechSAV): ?>
                                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h3 class="text-center">Aucun détail de ticket trouvé.</h3>
        <?php endif; ?>
    </div>

    <div class="text-center ">
        <a href="index.php?action=dashboard" class="btn btn-primary retour">Retour à la page d'accueil</a>
    </div>
</main>

<?php
    $contenu = ob_get_contents();
    ob_end_clean();
    require("gabarit.php");
?>
