<?php
//var_dump($_POST['action']); 
ob_start(); ?>
    <main class=justify-content-center>
        <div class="container-fluid">
            <h3 class="text-center"><?=$msgErreur?></h3>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <form  action="../controleurs/formCtrl.php" method="POST">
                            <?php if ($actionPost == "accueil") {?>
                            <div class="row  ">
                                <div class="form-group col-md-6">
                                    <label for="idNumTicket">Numéro de ticket</label>
                                    <input type="text" class="form-control custom-input" name="numTicket" id="idNumTicket" pattern="[0-9]*"  title="Ce champs doit contenir uniquement des nombres">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idDate">Date du ticket</label>
                                        <input type="date" class="form-control custom-input" name="dateTicket" id="idDate">
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
                            <?php } ?>
                                    <div class="form-group">
                                        <label for="idTypeTicket">Type du ticket</label>
                                        <select class="form-control custom-input" name="typeDossier" id="idTypeTicket" required>
                                            <option disabled selected>Choisissez une option</option>
                                            <option value="EC">Erreur client lors de la commande</option>
                                            <option value="EP">Erreur de préparation</option>
                                            <option value="NP">Non présent lors de la livraison</option>
                                            <option value="NPAI">N'habite pas à l'adresse indiquée</option>
                                            <option value="SAV">Services SAV</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idNumFact">Numéro de la facture</label>
                                        <input type="text" class="form-control custom-input" name="numFact" id="idNumFact" pattern="[0-9]*" title="Ce champs doit contenir uniquement des nombres">
                                    </div>
                                    <div class="form-group">
                                        <label for="idNumCmd">Numéro de la commande</label>
                                        <input type="text" class="form-control custom-input" name="numCmd" id="idNumCmd" pattern="[0-9]*"  title="Ce champs doit contenir uniquement des nombres">
                                    </div>
                                    <div class="form-group">
                                        <label for="idNomClt">Nom client</label>
                                        <input type="text" class="form-control custom-input" name="nomClt" id="idNomClt" >
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center text-center">
                                <div class="form-group col-md-6">
                                    <?php if($actionPost == "accueil") { ?> 
                                    <input type="submit" id ="idBtnRechercher" class="btn btn-primary custom-submit-btn btnRechercher" name="action" value="Rechercher">
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form class="row justify-content-center" action="../controleurs/formCtrl.php" method="POST">
                        <?php if($actionPost !== "accueil") { ?>
                        <input type="hidden" name="action" value="accueil">
                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Retour à la page de recherche">
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php
    $siteTitle = "Interface de recherche";
    $contenu = ob_get_contents(); 
    ob_end_clean();              
    require("gabarit.php");
?>