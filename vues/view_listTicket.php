<?php ob_start(); ?>
<main>
    <h2><?=$titreListe?></h2>
    <table id ="listeTickets" class="table table-striped table-bordered dataTable tableListeTicket" style="width:100%">
        <thead>
            <tr>
                <th>N° Commande</th>
                <th>Nom Client</th>
                <th>N° Ticket</th>
                <th>Statut Ticket</th>
                <th>Type Ticket</th>
                <th>Date Ticket</th>
                <th>N° Facture</th>
                <th>Créateur Ticket</th>
            </tr>
        </thead>
        <tbody>  
        <?php foreach ($tTickets as $dataTicket):?>
            <tr>
                <td><a href=""><?=$dataTicket['numCommande']?></a></td>
                <td><a href=""><?=$dataTicket['nomClient']?></a></td>
                <td><a href=""><?=$dataTicket['idTicketSAV']?></a></td>
                <td><?=$dataTicket['statutTicket']?></td>
                <td><?=$dataTicket['idDossier']?></td>
                <td><?=$dataTicket['dateTicket']?></td>
                <td><a href=""><?=$dataTicket['numFact']?></a></td>
                <td><?=$dataTicket['nomUtilisateur']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <form class="row justify-content-center" action="../controleurs/formCtrl.php">
            <input type="submit" class="btn btn-primary custom-submit-btn" value="Retour au formulaire de recherche">
    </form>
</main>
<?php
    $pageTitle = "Liste de commandes et tickets";
    $contenu = ob_get_contents(); 
    ob_end_clean();              
    require_once "../vues/gabarit.php";
?>