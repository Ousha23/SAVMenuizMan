
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
                <!-- <th>Modifier</th> -->
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
                <!-- <form action="" method="get">
                    <td><input type="submit" value="Détails" name="update"></td>
                </form> -->
                
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</main>
<?php
    $pageTitle = "Liste des utilisateurs";
    $contenu = ob_get_contents(); 
    ob_end_clean();
    require_once "../vues/gabarit.php";
?>