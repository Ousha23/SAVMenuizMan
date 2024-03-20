case "ajouterTicketMAJ" :
                    $pageTitle = "Bienvenue dans l'espace de recherche";
                    if (estTxtRenseigne('descTicket') && estTxtRenseigne('typeDossier')) {
echo "niveau 1";
                        $typeTicket = $_POST['typeDossier'];
                        $descTicket = $_POST['descTicket'];
                        if ((estNbrRenseigne('numFact') && !empty($_POST['numFact'])) || ((estNbrRenseigne('numCmd') && !empty($_POST['numCmd'])))) {
echo "niveau 2";
                            if (estNbrRenseigne('numFact') && estNbrRenseigne('numCmd')){
                                $idFact = $_POST['numFact'];
                                $idCmd = $_POST['numCmd'];
                                // $idCmdByFact = [];
                                try {
                                    $idCmdByFact = TicketMgr::getNumCmdByFact($idFact);
                                } catch (Exception $e){
                                    $msgErreur ="Une erreur est survenue : Merci de contacter un Administrateur.";
                                    error_log('Erreur de récupération numCommande by numFact : ' . $e->getMessage());
                                    break;
                                }
var_dump($idCmdByFact);
var_dump($idCmd);
                                if (!empty($idCmdByFact)) {

                                    if ((int)$idCmd === $idCmdByFact[0]["numCommande"]) $idCmd = $idCmdByFact[0]["numCommande"];
                                    else {
                                        $msg = "Le numéro de Commande renseigné ne correspond à aucune Facture. Merci de vérifier.";
                                        $pageTitle = "Création d'un nouveau Ticket";
                                        $actionPost = "ajouterTicket";
                                        retourForm($actionPost, $pageTitle, $msg,"");
                                        break;
                                    }
                                } else {
                                    $msg = "Le numéro de facture renseigné ne correspond à aucune commande. Merci de vérifier.";
                                    $pageTitle = "Création d'un nouveau Ticket";
                                    $actionPost = "ajouterTicket";
                                    retourForm($actionPost, $pageTitle, $msg,"");
                                    break;
                                }
                            } else if (estNbrRenseigne('numFact')) {
echo "niveau 3";
                                $idFact = $_POST['numFact'];
                                try {
                                    $idCmdByFact = TicketMgr::getNumCmdByFact($idFact);
                                } catch (PDOException $e){
                                    $msgErreur ="Erreur : Merci de contacter un Administrateur.";
                                    error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
                                    break;
                                }
                                if (!empty($idCmdByFact)) {
                                    $idCmd = $idCmdByFact[0]["numCommande"];
                                } else {
                                    $msg = "Le numéro de facture renseigné ne correspond à aucune commande. Merci de vérifier.";
                                    $pageTitle = "Création d'un nouveau Ticket";
                                    $actionPost = "ajouterTicket";
                                    retourForm($actionPost, $pageTitle, $msg,"");
                                    break;
                                }
//var_dump($idCmdByFact);
                            } else {
                                $idCmd = $_POST['numCmd'];
                                try {
                                    $tCmd = TicketMgr::getCmd($idCmd);
                                } catch (Exception $e){
                                    $msgErreur = "Une Erreur est survenue: Merci de contacter un Administrateur.";
                                    error_log("Erreur récupérration ID Commande".$e->getMessage());
                                    retourForm($actionPost, $pageTitle, $msgErreur,"");
                                    break;
                                }
                                
                                if (count($tCmd) !== 1) {
                                    $msg = "Le numéro de Commande renseigné ne correspond à aucune commande. Merci de vérifier.";
                                    $pageTitle = "Création d'un nouveau Ticket";
                                    $actionPost = "ajouterTicket";
                                    retourForm($actionPost, $pageTitle, $msg,"");
                                    break;
                                }
                            }
//var_dump($idCmd);
                        } else {
                            $msg = "Vous devez renseigner un numéro de facture ou un numéro de commande valide pour créer le ticket.";
                            $pageTitle = "Création d'un nouveau Ticket";
                            $actionPost = "ajouterTicket";
                            retourForm($actionPost, $pageTitle, $msg,"");
                            break;
                        }
                        try {
                            $nvTicket = TicketMgr::addTicket($descTicket, $typeTicket, $idCmd, $idUser);
                            $msg = "Ajout effectué avec succès. Numéro du Ticket : " . $nvTicket;
                            $actionPost = "accueil";
                            retourForm($actionPost, $pageTitle, $msg,"");
                        } catch (Exception $e) {
                            $msgErreur = "Une erreur est survenue lors de l'ouverture du ticket: Merci de contacter un Administrateur.";
                            error_log('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
                            retourForm($actionPost, $pageTitle, $msgErreur,"");
                            break;
                        }

                    } else {
                        $msg = "Merci de renseigner tous les champs et un numéro de commande ou de facture valide pour pouvoir créer le ticket.";
                        $pageTitle = "Création d'un nouveau Ticket";
                        $actionPost = "ajouterTicket";
                        retourForm($actionPost, $pageTitle, $msg,"");
                        break;
                    }