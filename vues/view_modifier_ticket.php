<?php 
    ob_start(); 
    $pageTitle = "Modifier le ticket";
    $siteTitle = "Modifier du ticket";
    $connexion = $_SESSION['nomUtilisateur'];
//var_dump($ticketDetails['statutTicket']);
?>

<main class="justify-content-center">
<h3 class="text-center"><?=$msgErreur?></h3>
    <div class="container-fluid">
        <?php if (isset($ticketDetails) && !empty($ticketDetails)): ?>
                <div class="divForm">
                    <form action="index.php?action=dashboard" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="idNumTicket">Numéro de ticket</label>
                                <input type="text" class="form-control custom-input" name="idTicketSAV" id="idNumTicket" value="<?= $ticketDetails['idTicketSAV'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="idDate">Date du ticket</label>
                                <input type="date" class="form-control custom-input" id="idDate" value="<?= $ticketDetails['dateTicket'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="idEtatTicket">Etat du ticket</label>
                                <select class="form-control custom-input" <?php if($ticketTraite) echo "readonly"?> name="etatTicket"  id="idEtatTicket">
                                <?php if(!$ticketTraite) {?>
                                    <option disabled selected>Choisissez une option</option>
                                    <option <?php if(isset($ticketDetails['statutTicket']) && ($ticketDetails['statutTicket']== "En attente")) echo "selected";?>  value="En attente">En attente</option>
                                    <option <?php if(isset($ticketDetails['statutTicket']) && ($ticketDetails['statutTicket']== "En cours")) echo "selected";?> value="En cours">En cours</option>
                                    <option <?php if(isset($ticketDetails['statutTicket']) && ($ticketDetails['statutTicket']== "Traité")) echo "selected" ;?> value="traite">Traité</option>
                                    <?php } else {?>
                                        <option <?php if(isset($ticketDetails['statutTicket']) && ($ticketDetails['statutTicket']== "Traité")) echo "selected" ;?> value="traite">Traité</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idTypeTicket">Type du ticket</label>
                                <input class="form-control custom-input" id="idTypeTicket" readonly value="<?= $ticketDetails['idDossier'] ?? '' ?>" selected>
                            </div>
                        <?php if(isset($ticketDetails['codeArticle'])) { ?>
                            <div class="form-group">
                                <label for="idDiagnostic">Diagnostic de l'équipe SAV</label>
                                <textarea class="form-control custom-input" name="diagnostic" id="idDiagnostic" rows="5" ><?= $ticketDetails['diagnostic'] ?? '' ?></textarea>
                            </div>
                        <?php } ?>
                        </div>
                        <div class="col-md-6">  
                            <div class="form-group">
                                <label for="idNumCmd">Numéro de la commande</label>
                                <input type="text" class="form-control custom-input" name="numCommande" id="idNumCmd" value="<?= $ticketDetails['numCommande'] ?? '' ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nomClient">Nom du client</label>
                                <input type="text" class="form-control custom-input" id="nomClient" value="<?= $ticketDetails['nomClient'] ?? '' ?>" readonly>
                            </div>
                    <?php if(isset($ticketDetails['codeArticle'])) { ?>
                            <div class="form-group">
                                <label for="codeArticle">Code de l'Article</label>
                                <input type="text" class="form-control custom-input" name="codeArticle" id="codeArticle" value="<?= $ticketDetails['codeArticle'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="libArticle">Article concerné</label>
                                <input type="text" class="form-control custom-input" id="libArticle" value="<?= $ticketDetails['libArticle'] ?? '' ?>" readonly>
                            </div>
                    <?php } ?>
                            <div class="form-group">
                                <label for="idDescription">Description de la réclamation</label>
                                <textarea <?php if($ticketTraite) echo "readonly"?> class="form-control custom-input" name="description" id="idDescription" rows="5"<?php if(isset($ticketDetails['codeArticle'])) echo "readonly"?>><?= $ticketDetails['description'] ?? '' ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php if(isset($ticketDetails['codeArticle'])) { ?>
                <div class="row justify-content-center">
                        <div class="form-group">
                                <label for="idStockSAV">
                                    <input type="radio" id="idStockSAV" name="actionArticle" value="miseSAVStock">
                                    Article Retourné au SAV
                                </label>
                                <label for="idMiseEnRebus">
                                    <input type="radio" id="idMiseEnRebus" name="actionArticle" value="miseEnRebus">
                                    Article mis en rebus
                                </label>
                                <label for="idReexpidie">
                                    <input type="radio" id="idReexpidie" name="actionArticle" value="reexpedition">
                                    Article réexpidié au client
                                </label>
                        </div>
                </div>
                <?php } ?>
                <?php if(!$ticketTraite){?>    
                    <div class="form-group text-center">
                        <input type="hidden" name="action" value="modifierTicketMAJ">
                        <input type="submit" value ="Enregister la modification" class="btn btn-primary custom-submit-btn">
                    </div>
                <?php }?>
                </form>
            </div>

    </div>
    <?php endif; ?>
    <div class="row justify-content-center ">
                <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn">Retour à la page d'accueil</a>
            </div>
</main>

<?php
    $contenu = ob_get_contents();
    ob_end_clean();
    require("gabarit.php");
?>

