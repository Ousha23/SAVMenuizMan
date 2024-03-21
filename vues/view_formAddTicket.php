<?php
//var_dump($_POST['action']); 
ob_start(); ?>
    <main class=justify-content-center>
        <div class="container-fluid">
            <h3 class="text-center"><?=$msg?></h3>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="divForm">
                        <?php if (($actionPost == "ajouterTicket") || ($actionPost == "ajouterTicketMAJ")) {?>
                        <form  action="../controleurs/formCtrl.php" method="POST">
                            <div class="row justify-content-center">
                                <fieldset class="form-group col-md-6">
                                    <label class="col-md-12" for="idDescription">Description</label><br>
                                    <textarea class="col-md-10" id="idDescription" name="descTicket" required rows="4"><?php if(isset($descTicket)) echo $descTicket ;?></textarea>
                                </fieldset>
                            </div>
                             <div class="row justify-content-center">
                                <div class="col-md-6">
                                <?php if(isset($tCommandes[0]['codeArticle']) && !empty($tCommandes[0]['codeArticle'])) { ?>
                                    <div class="form-group">
                                        <label for="idCodeArticle">Code article</label>
                                        <input type="text" class="form-control custom-input" name="codeArticle" id="idCodeArticle" pattern="[0-9]*" value="<?php if(isset($tCommandes[0]['codeArticle'])) echo $tCommandes[0]['codeArticle']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="idLibArticle">Libellé Article</label>
                                        <input type="text" class="form-control custom-input" name="libArticle" id="idLibArticle" pattern="[0-9]*" value="<?= isset($tCommandes[0]['libArticle']) ? $tCommandes[0]['libArticle'] : ''; ?>"  readonly>
                                    </div>
                                <?php } ?>
                                    <div class="form-group">
                                        <label for="idTypeTicket">Type du ticket</label>
                                        <select class="form-control custom-input" name="typeDossier" id="idTypeTicket" required>
                                            <option disabled <?php if(!isset($typeTicket)) echo "selected"?>>Choisissez une option</option>
                                            <option <?php if(isset($typeTicket) && ($typeTicket== "EC")) echo "selected";?> value="EC">Erreur client lors de la commande (EC)</option>
                                            <option <?php if(isset($typeTicket) && ($typeTicket== "EP")) echo "selected";?> value="EP">Erreur de préparation (EP)</option>
                                            <option <?php if(isset($typeTicket) && ($typeTicket== "NP")) echo "selected";?> value="NP">Non présent lors de la livraison (NP)</option>
                                            <option <?php if(isset($typeTicket) && ($typeTicket== "NPAI")) echo "selected";?> value="NPAI">N'habite pas à l'adresse indiquée (NPAI)</option>
                                            <option <?php if(isset($typeTicket) && ($typeTicket== "SAV")) echo "selected";?> value="SAV">Services SAV (SAV)</option>
                                        </select>
                                    </div>
                                    <?php if(!isset($tCommandes[0]['codeArticle']) || empty($tCommandes[0]['codeArticle'])) { ?>
                                    <div class="form-group">
                                        <label for="idNomClt">Nom client</label>
                                        <input type="text" class="form-control custom-input" name="nomClt" id="idNomClt" value="<?php if(isset($tCommandes[0]['nomClient'])) echo $tCommandes[0]['nomClient']; ?>" readonly>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idNumFact">Numéro de la facture</label>
                                        <input type="text" class="form-control custom-input" name="numFact" id="idNumFact" pattern="[0-9]*" title="Ce champs doit contenir uniquement des nombres" value="<?php if(isset($tCommandes[0]['numFact'])) echo $tCommandes[0]['numFact']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="idNumCmd">Numéro de la commande</label>
                                        <input type="text" class="form-control custom-input" name="numCmd" id="idNumCmd" pattern="[0-9]*"  title="Ce champs doit contenir uniquement des nombres" value="<?php if(isset($tCommandes[0]['numCommande'])) echo $tCommandes[0]['numCommande']; ?>" readonly>
                                    </div>
                                    <?php if(isset($tCommandes[0]['codeArticle']) && !empty($tCommandes[0]['codeArticle'])) { ?>
                                    <div class="form-group">
                                        <label for="idNomClt">Nom client</label>
                                        <input type="text" class="form-control custom-input" name="nomClt" id="idNomClt" value="<?php if(isset($tCommandes[0]['nomClient'])) echo $tCommandes[0]['nomClient']; ?>" readonly>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row justify-content-center text-center">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="action" value="ajouterTicketMAJ">   
                                    <input type="submit" id ="idBtnRechercher" class="btn btn-primary custom-submit-btn btnRechercher" value="Valider">
                                    
                                </div>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 text-right ">
                        <button  id="idBtnAnnuler" class="btn btn-primary custom-submit-btn" ><a href="../controleurs/formCtrl.php?action=detailsCmd&numCmd=<?=$tCommandes[0]['numCommande']?>"></a>Retour à la page précédente</button>
                        </div>
                        <form class="col-md-6 text-left" action="../controleurs/formCtrl.php" method="POST">
                            <input type="hidden" name="action" value="accueil">
                            <input type="submit" class="btn btn-primary custom-submit-btn" value="Retour à la page de recherche">
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
<?php
    $siteTitle = "Interface de recherche";
    $pageTitle = "Création d'un nouveau Ticket";
    $contenu = ob_get_contents(); 
    ob_end_clean();              
    require("gabarit.php");
?>