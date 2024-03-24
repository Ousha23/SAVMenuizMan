<?php ob_start(); 
?>
<main>
    <h3 class="text-center"><?php if($msg) echo $msg ?></h3>
    <div class="row justify-content-center divForm">
        <div class="col-md-5">
            <span class="font-weight-bold">Num Commande : </span><span><?php if(isset($tCommandes[0]['numCommande'])) echo $tCommandes[0]['numCommande']?></span><br>
            <span class="font-weight-bold">Statut Commande : </span><span><?php if (isset($tCommandes[0]['statutCommande'])) echo $tCommandes[0]['statutCommande']?></span><br>
            <span class="font-weight-bold">Date Commande : </span><span><?php if (isset($tCommandes[0]['dateCommande'])) echo $tCommandes[0]['dateCommande']?></span>
        </div>
        <div class="col-md-5">
            <span class="font-weight-bold">Nom Client : </span><span><?php if (isset($tCommandes[0]['nomClient'])) echo $tCommandes[0]['nomClient']?></span><br>
            <span class="font-weight-bold">Num Facture : </span><span><?php if (isset($tCommandes[0]['numFact'])) echo $tCommandes[0]['numFact']?></span><br>
            <span class="font-weight-bold">Date Facture : </span><span><?php if (isset($tCommandes[0]['dateFact'])) echo $tCommandes[0]['dateFact']?></span>
        </div>
        <div class="col-md-2">
            <div clas="row justify-content-center">
            <div class="d-flex flex-column align-items-center">
            <?php if(isset($tCommandes[0]['numCommande'])) { ?>
                <form class="col-md-4" method="post" action="index.php?action=dashboard">
                    <input type="hidden" name="numCommande" value="<?=$tCommandes[0]['numCommande']?>">
                    <input type="hidden" name="action" value="ajouterTicket">
                    <input type="submit" class="btn btn-primary custom-submit-btn px-3" value="Ouvrir un ticket">
                </form>
            <?php } ?>
            <?php if($actionPost == "listTicketsCmd") { ?>
                </div>
                </div>
                
            </div>
        </div>
        <h3 class="titreDetail text-center my-5">Liste des Ticket de la commande</h3>
    <table id ="detailsCmd" class="table table-striped table-bordered dataTable tableListeTicket mt-5" style="width:100%">
        <thead>
            <tr>
                <th><i class="fa-solid fa-sort"></i>  N° Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Statut Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Type Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Date Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Créateur Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Description</th>
            </tr>
        </thead>
        <tbody>  
        <?php foreach ($tTicketsByCmd as $dataTicket):?>
            <tr>
                <td><?=$dataTicket['idTicketSAV']?></td>
                <td><?=$dataTicket['statutTicket']?></td>
                <td><?=$dataTicket['idDossier']?></td>
                <td><?=$dataTicket['dateTicket']?></td>
                <td><?=$dataTicket['nomUtilisateur']?></td>
                <td><?=$dataTicket['description']?></td>

            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
            <?php } else {?>
                <?php if(isset($tCommandes[0]['numCommande'])) {?>
                <form class="col-md-4" method="post" action="index.php?action=dashboard">
                    <input type="hidden" name="numCommande" value="<?=$tCommandes[0]['numCommande']?>">
                    <input type="hidden" name="action" value="listTicketsCmd">
                    <input type="submit" class="btn btn-primary custom-submit-btn" value="Liste des Tickets">
                </form>
                <?php } ?>
            </div>
            </div>
            
        </div>
    </div>
    <h3 class="titreDetail text-center my-5">Liste des articles</h3>
    <table id ="detailsCmd" class="table table-striped table-bordered dataTable tableListeTicket mt-5" style="width:100%">
        <thead>
            <tr>
                <th><i class="fa-solid fa-sort"></i>  Code Article</th>
                <th><i class="fa-solid fa-sort"></i>  Libellé article</th>
                <th><i class="fa-solid fa-sort"></i>  Quantité Commandée</th>
                <th><i class="fa-solid fa-sort"></i>  Garantie</th>
                <th><i class="fa-solid fa-sort"></i>  Num Expédition</th>
                <th><i class="fa-solid fa-sort"></i>  Date Expédition</th>
                <th><i class="fa-solid fa-sort"></i>  Action</th>
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
                <td><form class="row justify-content-center" method="post" action="index.php?action=dashboard">
                        <input type="hidden" name="codeArticle" value="<?=$dataCommande['codeArticle']?>">
                        <input type="hidden" name="numCommande" value="<?=$dataCommande['numCommande']?>">
                        <input type="hidden" name="action" value="ajouterTicket">
                        <input type="submit" class="btn btn-primary custom-submit-btn" value="Ouvrir Ticket">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php }?>
    <div class="row justify-content-center">
    <?php if($actionPost == "listTicketsCmd") { ?>
        <div class="col-md-6 text-right ">
            <a href="index.php?action=dashboard&numCommande=<?=$tCommandes[0]['numCommande']?>" class="btn btn-primary custom-submit-btn ">Retour à la page précédente</a>
        </div>
        <div class="col-md-6 text-left ">
    <?php } ?>
            <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn ">Retour à la page d'accueil</a>
    
        </div>
    </div>
</main>
<?php
    $connexion = $_SESSION['nomUtilisateur'];
    if(isset($tCommandes[0]['numCommande'])){
        $pageTitle = "Détail de la commande N° : ".$tCommandes[0]['numCommande'];
    } else $pageTitle = "Commande inexistante";
    $siteTitle = "Détails Commande";
    $contenu = ob_get_contents(); 
    ob_end_clean();              
    require_once "vues/gabarit.php";
