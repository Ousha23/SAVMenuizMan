
<?php ob_start(); ?>
<main>
    <table id ="listeTickets" class="table table-striped table-bordered dataTable tableListeTicket" style="width:100%">
        <thead>
            <tr>
                <th>N° Utilisateur</th>
                <th>Nom </th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Profil</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($tUsers as $user):?>
            <tr>
                <td><?=$user['idUtilisateur']?></td>
                <td><?=$user['nomUtilisateur']?></td>
                <td><?=$user['prenomUtilisateur']?></td>
                <td><?=$user['emailUtilisateur']?></td>
                <td><?=$user['libProfil']?></td>
                <td class="text-center"><a href="index.php?action=dashboard&idUser=<?=$user['idUtilisateur']?>" class="btn btn-primary custom-submit-btn">Modifier</a></td>
                
                
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="text-center">
        <a href="index.php?action=dashboard" class="btn btn-primary custom-submit-btn ">Retour à la page d'accueil</a>
    </div>
</main>
<?php
    $siteTitle="Liste Utilisateurs";
    $connexion = $_SESSION['nomUtilisateur'];
    $pageTitle = "Liste des utilisateurs";
    $contenu = ob_get_contents(); 
    ob_end_clean();
    require_once "vues/gabarit.php";
?>