<?php ob_start(); ?>
    <main class=justify-content-center>
        <div class="container-fluid">
            <h2 class="text-center"><?=$titreForme?></h2>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <form  action="../controleurs/formCtrl.php?action=searchTicket" method="POST">
                            <div class="row  ">
                                <div class="form-group col-md-6">
                                    <label for="idNumTicket">Numéro de ticket</label>
                                    <input type="text" class="form-control custom-input" name="numTicket" id="idNumTicket">
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
                                            <option value="enCours">En cours</option>
                                            <option value="traite">Traité</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="typeDossier">Type du ticket</label>
                                        <select class="form-control custom-input" name="typeDossier" id="idTypeTicket">
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
                                        <input type="text" class="form-control custom-input" name="numFact" id="idNumFact">
                                    </div>
                                    <div class="form-group">
                                        <label for="idNumCmd">Numéro de la commande</label>
                                        <input type="text" class="form-control custom-input" name="numCmd" id="idNumCmd">
                                    </div>
                                    <div class="form-group">
                                        <label for="idNomClt">Nom client</label>
                                        <input type="text" class="form-control custom-input" name="nomClt" id="idNomClt">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center text-center">
                                <div class="form-group col-md-6">
                                    <input type="submit" class="btn btn-primary custom-submit-btn btnRechercher" name="action" value="Rechercher">
                                </div>
                            </div>
                        </form>
                    </div>
                    <form class="row justify-content-center" action="../controleurs/formCtrl.php?action=addTicket" method="POST">
                        <input type="hidden" name="action" value="ouvrirTicket">
                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Ouvrir un nouveau ticket">
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php
    $pageTitle = "Interface de recherche";
    $contenu = ob_get_contents(); 
    ob_end_clean();              
    require("gabarit.php");
?>