document.addEventListener("DOMContentLoaded", function() {
    var tTickets = document.getElementById('listeTickets');
    var tDetailsCmd = document.getElementById('detailsCmd');
    if (!$.fn.DataTable.isDataTable('#listeTickets')) {
        var dataTable = new DataTable(tTickets, {
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucun ticket trouvé.",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
        });
    }   
    if (!$.fn.DataTable.isDataTable('#detailsCmd')) {
        var dataTableDetCmd = new DataTable(tDetailsCmd, {
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ articles",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'article 0 &agrave; 0 sur 0 articles",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucun article trouvé.",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
        });
    }
});

// var btnRechercher = document.getElementById("idBtnRechercher");

// // Vérifie si le bouton de recherche est correctement récupéré
// console.log(btnRechercher);

// btnRechercher.addEventListener("click", function() {
//     // Appelle la fonction verifValues
//     console.log("Clic sur le bouton de recherche");
//     verifValues();
// });

// function verifValues() {
//     alert("ça fonctionne");
//     return false;
// }
