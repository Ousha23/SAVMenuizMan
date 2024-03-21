<?php ob_start(); ?>

<?php $connexion = $_SESSION['nomUtilisateur']; ?>
<main>
    <table id="listeTickets" class="table table-striped table-bordered dataTable tableListeTicket" style="width:100%">
        <thead>
            <tr>
                <th><i class="fa-solid fa-sort"></i>  N° Commande </th>
                <th><i class="fa-solid fa-sort"></i>  Nom Client</th>
                <th><i class="fa-solid fa-sort"></i>  N° Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Statut Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Type Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  Date Ticket</th>
                <th><i class="fa-solid fa-sort"></i>  N° Facture</th>
                <th><i class="fa-solid fa-sort"></i>  Créateur Ticket</th>
            </tr>
        </thead>
        <tbody>  
        <?php foreach ($tTickets as $dataTicket):
        
            ?>
            <tr>
                <td><a href="index.php?action=dashboard&numCommande=<?= $dataTicket['numCommande']?>"><?=$dataTicket['numCommande']?></a></td>
                <td><a href="../controleurs/formCtrl.php?action=detailsClient&nomClient=<?=$dataTicket['nomClient']?>"><?=$dataTicket['nomClient']?></a></td>
                <td><a href="index.php?action=dashboard&idTicket=<?= $dataTicket['idTicketSAV']?>"><?=$dataTicket['idTicketSAV']?></a></td>
                <td><?=$dataTicket['statutTicket']?></td>
                <td><?=$dataTicket['idDossier']?></td>
                <td><?=$dataTicket['dateTicket']?></td>
                <td><a href="../controleurs/formCtrl.php?action=detailsFact&idFact=<?=$dataTicket['numFact']?>"><?=$dataTicket['numFact']?></a></td>
                <td><?=$dataTicket['nomUtilisateur']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="row justify-content-center">
        <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn ">Retour à la page d'accueil</a>
    </div>
</main>
<?php
$siteTitle = "Liste de commandes et tickets";
$contenu = ob_get_contents();
ob_end_clean();
require("gabarit.php");
?>
