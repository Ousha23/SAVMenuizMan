<?php ob_start(); ?>
<main>
    <div class="row justify-content-center divForm">
        <div class="col-md-5">
            <span class="font-weight-bold">Num Commande : </span><span><?=$tCommandes[0]['numCommande']?></span><br>
            <span class="font-weight-bold">Statut Commande : </span><span><?=$tCommandes[0]['statutCommande']?></span><br>
            <span class="font-weight-bold">Date Commande : </span><span><?=$tCommandes[0]['dateCommande']?></span>
        </div>
        <div class="col-md-5">
            <span class="font-weight-bold">Nom Client : </span><span><?=$tCommandes[0]['nomClient']?></span><br>
            <span class="font-weight-bold">Num Facture : </span><span><?=$tCommandes[0]['numFact']?></span><br>
            <span class="font-weight-bold">Date Facture : </span><span><?=$tCommandes[0]['dateFact']?></span>
        </div>
        <form class="col-md-2" method="post" action="../controleurs/formCtrl.php">
                <input type="hidden" name="numCommande" value="<?=$tCommandes[0]['numCommande']?>">
                <input type="hidden" name="action" value="ajouterTicket">
                <input type="submit" class="btn btn-primary custom-submit-btn" value="Ouvrir un ticket">
        </form>
    </div>
    <h3 class="titreDetail text-center my-5">Détail de la commande</h3>
    <table id ="detailsCmd" class="table table-striped table-bordered dataTable tableListeTicket mt-5" style="width:100%">
        <thead>
            <tr>
                <th>Code Article</th>
                <th>Libellé article</th>
                <th>Quantité Commandée</th>
                <th>Garantie</th>
                <th>Num Expédition</th>
                <th>Date Expédition</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>  
        <?php foreach ($tCommandes as $dataCommande):?>
            <tr>
                <td><?=$dataCommande['codeArticle']?></td>
                <td><?=$dataCommande['libArticle']?></td>
                <td><?=$dataCommande['qteArticle']?></td>
                <td><?=$dataCommande['garantie_Article']?></td>
                <td><?=$dataCommande['idExpedition']?></td>
                <td><?=$dataCommande['dateExp']?></td>
                <td><form class="row justify-content-center" method="post" action="../controleurs/formCtrl.php">
                        <input type="hidden" name="codeArticle" value="<?=$dataCommande['codeArticle']?>">
                        <input type="hidden" name="numCommande" value="<?=$tCommandes[0]['numCommande']?>">
                        <input type="hidden" name="action" value="ajouterTicket">
                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Ouvrir Ticket">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <form class="row justify-content-center" action="../controleurs/formCtrl.php">
            <input type="submit" class="btn btn-primary custom-submit-btn" value="Retour au formulaire de recherche">
    </form>
</main>
<?php
    $siteTitle = "Détails Commande";
    $contenu = ob_get_contents(); 
    ob_end_clean();              
    require_once "../vues/gabarit.php";
