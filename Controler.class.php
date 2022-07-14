<?php
include('./controller/Connexion.php');
include('./controller/Enregistrement.php');
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler
{
    /**
     * Traite la requête
     * @return void
     */
    public function gerer()
    {
        switch ($_GET['requete']) {
            case 'mesCelliers': //gm
                $this->listeCelliers();
                break;
            case 'celliers'://gm
                $this->listerCelliers();
                break;
            case 'ajouterNouveauCellier': //gm
                $this->ajouterNouveauCellier();
                break;
            case 'modifierCellier': //gm
                $this->modifierCellier();
                break;
            case 'supprimerCellier': //gm
                $this->supprimerCellier();
                break;
            case 'deplacerSupprimer': //gm
                $this->deplacerSupprimer();
                break;
            case 'listeBouteilleCellier':
                $this->listerBouteilleCellier();
                break;
            case 'ajouterQteBouteille': //gm
                $this->ajouterQteBouteille();
                break;
            case 'reduireQteBouteille': //gm
                $this->reduireQteBouteille();
                break;
            case 'listes': //gm
                $this->listes();
                break;
            case 'bouteille': //fr
                $this->ficheBouteille();
                break;
            case 'noteBouteille': //fr
                $this->noteBouteille();
                break;
            case 'modifierAAcheter': //fr
                $this->modifierAAcheter();
                break;
            case 'modifierAEssayer': //fr
                $this->modifierAEssayer();
                break;
            case 'modifierFavoris': //fr
                $this->modifierFavoris();
                break;
            case 'detruireBouteille': //detruire une bouteille from cellier
                return $this->detruireBouteille();
                break;
            case 'getBouteille': //fr
                $this->getBouteille();
                break;
            case 'enregistrer':
                $this->enregistrerUtilisateur();
                break;
            case 'connecter':
                $this->connecterUtilisateur();
                break;
            case 'deconnecter':
                $this->deconnecterUtilisateur();
                break;
            case 'rechercher':
                $this->rechercher();
                break;
            case 'rechercherBouteilles':
                $this->rechercherBouteilles();
                break;
            case 'rechercherBouteillesCellier':
                $this->rechercherBouteillesCellier();
                break;
            case 'profil':
                $this->profilUtilisateur();
                break;
            case 'statistiques':
                $this->statistiquesUtilisateur();
                break;
            case 'scan':
                $this->scan();
            case 'admin':
                $this->afficherPageAdmin();
                break;
            case 'lireAdminBouteilles':
                $this->lireAdminBouteilles();
                break;
            case 'lireAdminCelliers':
                $this->lireAdminCelliers();
                break;
            case 'lireAdminUnCellier':
                $this->lireAdminUnCellier();
                break;
            case 'lireAdminUneBouteille':
                $this->lireAdminUneBouteille();
                break;
            case 'lireAdminUnUsager':
                $this->lireAdminUnUsager();
                break;
            case 'lireAdminUsagers':
                $this->lireAdminUsagers();
                break;
            case 'lireDetailBouteille':
                $this->lireDetailBouteille();
                break;
            case 'lireDetailCellier':
                $this->lireDetailCellier();
                break;
            case 'lireDetailUsager':
                $this->lireDetailUsager();
                break;
            case 'lireDetailVino':
                $this->lireDetailVino();
                break;
            case 'lireFormulaireBouteille':
                $this->lireFormulaireBouteille();
                break;
            case 'lireFormulaireCellier':
                $this->lireFormulaireCellier();
                break;
            case 'lireFormulaireUsager':
                $this->lireFormulaireUsager();
                break;
            case 'lireFormulaireVino':
                $this->lireFormulaireVino();
                break;
            case 'lireTableSelection':
                $this->lireTableSelection();
                break;
            case 'lireTableVino':
                $this->lireTableVino();
                break;
            case 'modifierAdminBouteille':
                $this->modifierAdminBouteille();
                break;
            case 'obtenirTablesNbEnrg':
                $this->obtenirTablesNbEnrg();
                break;
            case 'obtenirVinoTablesNbEnrg':
                $this->obtenirVinoTablesNbEnrg();
                break;
            case 'sauvegarderAdminDonnees':
                $this->sauvegarderAdminDonnees();
                break;
            case 'profilUsager':
                $this->voirProfilUsager();
                break;
            case 'accueil':
                $this->accueil();
                break;
            case '':
                $this->accueil();
                break;
            default:
                $this->erreurhttp();
                break;
        }
    }


    /**
     * Cette méthode affiche la page principale de l'administrateur
     *  
     */
    private function afficherPageAdmin()
    {
        include("vues/entete.php");
        include("vues/Admin/admin.php");
        include("vues/pied.php");
    }


    private function lireAdminBouteilles()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $bte = new Bouteille();
            $listeBouteilles = $bte->getAdminBouteilles();
            echo json_encode($listeBouteilles);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireAdminCelliers()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $celliers = new Cellier();
            $listeCelliers = $celliers->getAdminCelliers();
            echo json_encode($listeCelliers);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireAdminUnCellier()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'), true);

            $celliers = new Cellier();
            $listeCelliers = $celliers->getAdminUnCellier($body["id_cellier"]);
            echo json_encode($listeCelliers);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireAdminUneBouteille()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'), true);

            $bte = new Bouteille();
            $listeBouteilles = $bte->getAdminUneBouteille($body["id_bouteille"]);
            echo json_encode($listeBouteilles);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireAdminUnUsager()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'), true);

            $usagers = new Usager();
            $listeUsagers = $usagers->getAdminUnUsager($body["id_usager"]);
            echo json_encode($listeUsagers);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireAdminUsagers()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $usagers = new Usager();
            $listeUsagers = $usagers->getAdminUsagers();
            echo json_encode($listeUsagers);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireDetailBouteille()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));

            $mode = isset($body->mode) ? $body->mode : "lire";
            $id = isset($body->id) ? $body->id : null;
            $url = isset($body->url) ? $body->url : null;

            if ($url) {
                $saq = new SAQ();
                $usagerBouteille = $saq->recupereInfo($url);
            }

            include("vues/Admin/detailBouteille.php");
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireDetailCellier()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));
            $mode = isset($body->mode) ? $body->mode : "lire";
            $id = isset($body->id) ? $body->id : null;

            include("vues/Admin/detailCellier.php");
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireDetailUsager()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));
            $mode = isset($body->mode) ? $body->mode : "lire";
            $id = isset($body->id) ? $body->id : null;

            include("vues/Admin/detailUsager.php");
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireDetailVino()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));
            $mode = isset($body->mode) ? $body->mode : "lire";
            $id = isset($body->id) ? $body->id : null;
            $nomTable = isset($body->nomTable) ? $body->nomTable : null;

            switch ($nomTable) {
                case 'vino__bouteille':
                    include("vues/Admin/vinoBouteille.php");
                    break;

                case 'vino__degre_alcool':
                    include("vues/Admin/vinoDegreAlcool.php");
                    break;

                case 'vino__format':
                    include("vues/Admin/vinoFormat.php");
                    break;

                case 'generique__pays':
                    include("vues/Admin/vinoPays.php");
                    break;

                case 'vino__taux_de_sucre':
                    include("vues/Admin/vinoTauxSucre.php");
                    break;

                case 'vino__type_cellier':
                    include("vues/Admin/vinoTypeCellier.php");
                    break;

                default:
                    include("vues/Admin/detailVino.php");
                    break;
            }
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireFormulaireBouteille()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            include('vues/Admin/formulaireBouteille.php');
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireFormulaireCellier()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            include('vues/Admin/formulaireCellier.php');
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireFormulaireUsager()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            include('vues/Admin/formulaireUsager.php');
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireFormulaireVino()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));
            $nomTable = $body->nomTable;

            include('vues/Admin/formulaireVino.php');
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireTableSelection()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            include("vues/Admin/tableSelection.php");
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function lireTableVino()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));
            $vino = new Vino();

            $nomTable = $body->nomTable;
            $id = isset($body->id) ? $body->id : null;

            $liste = $vino->lireTable($nomTable, $id);
            echo json_encode($liste);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function modifierAdminBouteille()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $donnees = json_decode(file_get_contents('php://input'));

            $bte = new Bouteille();
            $res = $bte->modifierAdminBouteille($donnees);
            echo json_encode($res);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function obtenirTablesNbEnrg()
    {
        $oUsager = new Usager();
        $nbUsagers = $oUsager->getAdminNbUsagers();

        $oCellier = new Cellier();
        $nbCelliers = $oCellier->getAdminNbCelliers();

        $oBouteille = new Bouteille();
        $nbBouteilles = $oBouteille->getAdminNbBouteilles();

        $res = array(
            "nbBouteilles" => $nbBouteilles,
            "nbCelliers" => $nbCelliers,
            "nbUsagers" => $nbUsagers
        );

        echo json_encode($res);
    }


    private function obtenirVinoTablesNbEnrg()
    {
        $oVino = new Vino();

        $aAppellations = $oVino->lireAppellations();
        $aBouteilles = $oVino->lireBouteilles();
        $aCepages = $oVino->lireCepages();
        $aClassifications = $oVino->lireClassifications();
        $aDegresAlcool = $oVino->lireDegresAlcool();
        $aDesignations = $oVino->lireDesignations();
        $aFormats = $oVino->lireFormats();
        $aPays = $oVino->lirePays();
        $aProduitsQc = $oVino->lireProduitsQc();
        $aRegions = $oVino->lireRegions();
        $aTauxDeSucre = $oVino->lireTauxDeSucre();
        $aTypesCellier = $oVino->lireTypesCellier();
        $aTypesVin = $oVino->lireTypesVin();

        $res = array(
            "vino__appellation" => count($aAppellations),
            "vino__bouteille" => count($aBouteilles),
            "vino__cepage" => count($aCepages),
            "vino__classification" => count($aClassifications),
            "vino__degre_alcool" => count($aDegresAlcool),
            "vino__designation" => count($aDesignations),
            "vino__format" => count($aFormats),
            "generique__pays" => count($aPays),
            "vino__produit_du_quebec" => count($aProduitsQc),
            "vino__region" => count($aRegions),
            "vino__taux_de_sucre" => count($aTauxDeSucre),
            "vino__type_cellier" => count($aTypesCellier),
            "vino__type" => count($aTypesVin)
        );

        echo json_encode($res);
    }


    private function sauvegarderAdminDonnees()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $body = json_decode(file_get_contents('php://input'));

            $nomTable = $body->nomTable;
            $action = $body->action;
            $donnees = $body->donnees;

            switch ($nomTable) {
                case "bouteille":
                    $bte = new Bouteille();

                    if ($action == "ajouter") {
                        $res = $bte->ajouterAdminBouteille($donnees);
                    } else if ($action == "modifier") {
                        $res = $bte->modifierAdminBouteille($donnees);
                    }

                    break;

                case "cellier":
                    $cellier = new Cellier();

                    if ($action == "ajouter") {
                        $res = $cellier->ajouterAdminCellier($donnees);
                    } else if ($action == "modifier") {
                        $res = $cellier->modifierAdminCellier($donnees);
                    }

                    break;

                case "usager":
                    $usager = new Usager();

                    if ($action == "ajouter") {
                        $res = $usager->ajouterAdminUsager($donnees);
                    } else if ($action == "modifier") {
                        $res = $usager->modifierAdminUsager($donnees);
                    }

                    break;

                case "vino__appellation":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterAppellation($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierAppellation($donnees);
                    }

                    break;

                case "vino__bouteille":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterBouteille($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierBouteille($donnees);
                    }

                    break;

                case "vino__cepage":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterCepage($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierCepage($donnees);
                    }

                    break;

                case "vino__classification":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterClassification($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierClassification($donnees);
                    }

                    break;

                case "vino__degre_alcool":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterDegreAlcool($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierDegreAlcool($donnees);
                    }

                    break;

                case "vino__designation":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterDesignation($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierDesignation($donnees);
                    }

                    break;

                case "vino__format":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterFormat($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierFormat($donnees);
                    }

                    break;

                case "generique__pays":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterPays($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierPays($donnees);
                    }

                    break;

                case "vino__produit_du_quebec":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterProduitQc($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierProduitQc($donnees);
                    }

                    break;

                case "vino__region":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterRegion($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierRegion($donnees);
                    }

                    break;

                case "vino__taux_de_sucre":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterTauxSucre($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierTauxSucre($donnees);
                    }

                    break;

                case "vino__type_cellier":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterTypeCellier($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierTypeCellier($donnees);
                    }

                    break;

                case "vino__type":
                    $vino = new Vino();

                    if ($action == "ajouter") {
                        $res = $vino->ajouterTypeVin($donnees);
                    } else if ($action == "modifier") {
                        $res = $vino->modifierTypeVin($donnees);
                    }

                    break;

                default:
                    break;
            }

            echo json_encode($res);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    /**
     * Cette méthode renvoi selon si l'utilisateur est connecté ou non
     * la bonne page d'accueil
     *  
     */
    private function accueil()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $id = $_SESSION['utilisateur']['id'];
            $type = $_SESSION['utilisateur']['type'];

            if ($type == 2) {
                include("vues/Admin/admin.php");
            } else {
                $celliers = new Cellier();

                $data = $celliers->getListeCellier($id);
                $nombre_cellier = $celliers->nombreCellierUsager($id);
                $bouteille_total = 0;
                $prix_total = 0;
                foreach ($data as $cellier) {

                    $bouteille_total += $cellier['bouteille_total'];
                    $prix_total += $cellier['prix_total'];
                }
                $total = $prix_total * $bouteille_total;


                $stats = new Statistique();
                $bouteillesBues = 0;
                $actionsBues = $stats->getBouteilleBues($id);

                foreach ($actionsBues as $bues) {
                    $bouteillesBues += $bues['quantite_bouteille'];
                }
                $bouteillesAchetees = 0;
                $actionsAjouts = $stats->getBouteilleAjouts($id);
                foreach ($actionsAjouts as $achetees) {
                    $bouteillesAchetees += $achetees['quantite_bouteille'];
                }

                include("vues/entete.php");
                include("vues/index.php");
                include("vues/pied.php");
            }
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }



    /**
     * Cette méthode appelle la fonction pour ajouter un nouveau cellier 
     * selon les information rentrée par l'usagé ($body).
     *  
     */
    private function ajouterNouveauCellier()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $cellier = new Cellier();
            $resultat = $cellier->ajouterNouveauCellier($body);
        } else {
            include("vues/entete.php");
            include("vues/Celliers/celliers.php");
            include("vues/pied.php");
        }
    }



    /**
     * Cette méthode appelle la fonction pour récupérer la liste des bouteilles dans un cellier
     *  selon l'id_cellier envoyé dans l'url 
     *  
     */
    private function ajouterQteBouteille()
    {
        $id_usager = $_SESSION['utilisateur']['id'];
        $body = json_decode(file_get_contents('php://input'));

        $bte = new Bouteille();
        $resultat = $bte->modifierQuantiteBouteilleCellier($id_usager, $body->id, 1, "a");
    }



    private function connecterUtilisateur()
    {
        include("vues/entete.php");

        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            include("vues/index.php");
        } else {
            include("vues/connexion.php");
        }

        include("vues/pied.php");
    }


    private function deconnecterUtilisateur()
    {
        unset($_SESSION['utilisateur']);
        include("vues/entete.php");
        include("vues/connexion.php");
        include("vues/pied.php");
    }

    
    /**
     * Cette méthode déplace toutes les bouteilles d'un cellier à l'autre selon l'id_cellier choisi
     * et supprime le cellier selon l'id_cellier envoyé dans l'url 
     *  
     */
    private function deplacerSupprimer()
    {

        $body = json_decode(file_get_contents('php://input'));
        $id = $body->id_cellierSupprime;

        if (!empty($body)) {

            $bte = new Bouteille();
            $bouteilles = $bte->getListeBouteilleCellier($body->id_cellierSupprime);
            if ($bouteilles) {

                $cellier = new Cellier();
                $resultat = $cellier->deplacerBouteillesCellier($body->id_cellierChoisi, $bouteilles);

                if ($resultat) {
                    $resultat = $cellier->supprimerCellier($id);
                }
            }
        }
    }


    private function detruireBouteille()
    {
        $body = json_decode(file_get_contents('php://input'));

        $bte = new Bouteille();
        $resultat = $bte->deleteUsageBouteille($body->id_bouteille, $body->id_cellier);

        if ($resultat) {
            return $this->returnJsonHttpResponse(true, ['id_bouteille' => $body->id_bouteille, 'id_cellier' => $body->id_cellier, 'resultat' => $resultat]);
        }
        return $this->returnJsonHttpResponse(false, []);
        // echo json_encode($resultat);
    }


    private function enregistrerUtilisateur()
    {
        include("vues/entete.php");

        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            include("vues/index.php");
        } else {
            include("vues/enregistrement.php");
        }

        include("vues/pied.php");
    }

    /**
     * Cette méthode affiche une page d'erreur lorsque l'url est erronnée
     *   
     */
    private function erreurhttp()
    {
        include("vues/entete.php");
        include("vues/erreur.php");
        include("vues/pied.php");
    }

    // Ajouter la note à une bouteille
    private function noteBouteille()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $bouteille = new Bouteille();

            $resultat = $bouteille->noteBouteille($body->note, $body->id_bouteille);

            if ($resultat) {
                return $this->returnJsonHttpResponse(true, true);
            }
        }

        return $this->returnJsonHttpResponse(false, null);
    }

    // Bouteille à acheter (rendre oui ou non)
    private function modifierAAcheter()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $bouteille = new Bouteille();

            if (isset($body->vino_id) && $body->vino_id) {
                $usager_bouteille  = $bouteille->copierVinoDansUsagerBouteillle($body->vino_id);
                if ($usager_bouteille) {
                    $resultat = $bouteille->modifierAAcheter($body->valeur, $usager_bouteille['id_bouteille'], null);
                    if ($resultat) {
                        return $this->returnJsonHttpResponse(true, ['id_bouteille' => $usager_bouteille['id_bouteille']]);
                    }
                }
            } else {
                $resultat = $bouteille->modifierAAcheter($body->valeur, $body->id_bouteille, $body->id_cellier);
                if ($resultat) {
                    return $this->returnJsonHttpResponse(true, ['id_bouteille' => $body->id_bouteille]);
                }
            }
        }

        return $this->returnJsonHttpResponse(false, null);
    }

    // Bouteille à essayer (rendre oui ou non)
    private function modifierAEssayer()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $bouteille = new Bouteille();

            if (isset($body->vino_id) && $body->vino_id) {
                $usager_bouteille  = $bouteille->copierVinoDansUsagerBouteillle($body->vino_id);
                if ($usager_bouteille) {
                    $resultat = $bouteille->modifierAEssayer($body->valeur, $usager_bouteille['id_bouteille'], null);
                    if ($resultat) {
                        return $this->returnJsonHttpResponse(true, ['id_bouteille' => $usager_bouteille['id_bouteille']]);
                    }
                }
            } else {
                $resultat = $bouteille->modifierAEssayer($body->valeur, $body->id_bouteille, $body->id_cellier);
                if ($resultat) {
                    return $this->returnJsonHttpResponse(true, ['id_bouteille' => $body->id_bouteille]);
                }
            }

            if ($resultat) {
                return $this->returnJsonHttpResponse(true, true);
            }
        }

        return $this->returnJsonHttpResponse(false, null);
    }

    // Bouteille favoris (rendre oui ou non)
    private function modifierFavoris()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $bouteille = new Bouteille();
            // récupérer bouteille depuis vinno__bouteille et insérer dans usager__bouteille
            if (isset($body->vino_id) && $body->vino_id) {
                $usager_bouteille  = $bouteille->copierVinoDansUsagerBouteillle($body->vino_id);
                if ($usager_bouteille) {
                    $resultat = $bouteille->modifierFavoris($body->valeur, $usager_bouteille['id_bouteille'], null);
                    if ($resultat) {
                        return $this->returnJsonHttpResponse(true, ['id_bouteille' => $usager_bouteille['id_bouteille']]);
                    }
                }
            } else {
                $resultat = $bouteille->modifierFavoris($body->valeur, $body->id_bouteille, $body->id_cellier);
                if ($resultat) {
                    return $this->returnJsonHttpResponse(true, ['id_bouteille' => $body->id_bouteille]);
                }
            }

            if ($resultat) {
                return $this->returnJsonHttpResponse(true, true);
            }
        }

        return $this->returnJsonHttpResponse(false, null);
    }

    private function ficheBouteille()
    {
        if (!$_SESSION['utilisateur']['id']) {
            $this->deconnecterUtilisateur();
            return;
        }

        $id_usager = $_SESSION['utilisateur']['id'];
        $id_cellier = isset($_GET['id_cellier']) ? $_GET['id_cellier'] : null;
        $id_bouteille = isset($_GET['id_bouteille']) ? $_GET['id_bouteille'] : null;
        $vino_id = isset($_GET['vino_id']) ? $_GET['vino_id'] : null;
        $message = isset($_GET['message']) ? $_GET['message'] : null;

        if ($id_bouteille) {

            $bouteille = new Bouteille();

            $bouteille = $bouteille->getOneBouteille($id_bouteille, $id_cellier);
            if (is_array($bouteille) && count($bouteille) > 0) {
                $bouteille = $bouteille[0];
            }
        } else {
            if (isset($vino_id) && $vino_id != null) {
                $idB = new Cellier;
                $id_bouteille = $idB->getBouteilleCUP($vino_id);

                $bouteille = new Bouteille();

                $bouteille = $bouteille->getOneBouteilleFromVino($id_bouteille);
                if (is_array($bouteille) && count($bouteille) > 0) {
                    $bouteille = $bouteille[0];
                    $id_bouteille = $bouteille['id_bouteille'];
                    $vino_id = $bouteille['id_bouteille'];
                }
            }
        }

        //            print_r($bouteille); die();

        $body = json_decode(file_get_contents('php://input'));

        $list = new Lists();
        $bouteilles = $list->getList('bouteille');
        $usager_celliers = $list->getList('usager_cellier');
        $usager_bouteille = $list->getList('usager_bouteille');
        //var_dump($usager_bouteille);exit;
        $pays = $list->getList('pays');
        $regions = $list->getList('region');
        $types = $list->getList('type');
        $formats = $list->getList('format');
        $appellations = $list->getList('appellation');
        $designations = $list->getList('designation');
        $cepages = $list->getList('cepages');
        $taux_de_sucres = $list->getList('taux_de_sucre');
        $degre_alcools = $list->getList('degre_alcool');
        $produit_du_quebecs = $list->getList('produit_du_quebec');
        $classifications = $list->getList('classifications');


        $celliers = $usager_celliers;
        if (!is_array($celliers) || !(count($celliers) > 0)) {
            $bouteille['celliers'] = [
                'id_cellier' => null,
                'nom_cellier' => '',
                'quantite' => 0
            ];
        } else {
            $bouteille['celliers'] = $celliers;
        }


        $bouteille['id_cellier'] = $id_cellier;

        include("vues/entete.php");
        include("vues/details.php");
        include("vues/pied.php");
    }


    public function getBouteille()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $bouteille = new Bouteille();

            $resultat = $bouteille->getOneBouteilleByName($body->nom);


            if (count($resultat) > 0) {
                return $this->returnJsonHttpResponse(true, $resultat[0]);
            }
        }

        return $this->returnJsonHttpResponse(false, null);
    }


    /**
     * Cette méthode appelle la fonction pour récupérer la liste des bouteilles dans un cellier
     *  selon l'id_cellier envoyé dans l'url, ou la quantité_bouteille est plus grande que 0, trié DESC selon l'id_bouteille 
     *  
     */
    private function listerBouteilleCellier()
    {
        $id_usager = $_SESSION['utilisateur']['id'];
        if (filter_has_var(INPUT_GET, 'id_cellier')) {

            $id_cellier = filter_var($_GET['id_cellier'], FILTER_SANITIZE_NUMBER_INT);
        }

        $nom_cellier = htmlspecialchars($_GET['nom_cellier']);
        $bte = new Bouteille();
        $data = $bte->getListeBouteilleCellier($id_cellier);

        include("vues/entete.php");
        include("vues/Celliers/bouteilles.php");
        include("vues/pied.php");
    }

    /**
     * Cette méthode affiche les listes
     * 
     */
    private function listes()
    {
        include("vues/entete.php");
        include("vues/listes.php");
        include("vues/pied.php");
    }


    /**
     * Cette méthode récupère la liste des celliers d'un usager ainsi que le nombre de cellier par usager
     * avec l'id session de l'usager
     */
    private function listeCelliers()
    {
        include("vues/entete.php");

        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $id = $_SESSION['utilisateur']['id'];
            $celliers = new Cellier();

            $data = $celliers->getListeCellier($id);
            $nombre_cellier = $celliers->nombreCellierUsager($id);

            // Si le nombre de cellier est égal à 10
            if ($nombre_cellier == '10') {

                $erreur = "Vous avez atteint le maximum de celliers disponibles (10).";
            } else {
                $erreur = "";
            }
            include("vues/Celliers/celliers.php");
        } else {
            include("vues/connecter.php");
        }

        include("vues/pied.php");
    }

    /**
     * Cette méthode récupère la liste des celliers selon l'id de l'utilisateur
     *  
     */
    private function listerCelliers()
    {
        $id = $_SESSION['utilisateur']['id'];

        $celliers = new Cellier();

        $data = $celliers->getListeCellier($id);

        echo json_encode($data, \JSON_UNESCAPED_UNICODE);
    }


    /**
     * Cette méthode appelle la fonction pour récupérer les informations d'un cellier
     *  selon l'id_cellier envoyé dans l'url
     *  
     */
    private function modifierCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        if (!empty($body)) {
            $cellier = new Cellier();
            $resultat = $cellier->modifierCellier($body);
        } else {
            include("vues/entete.php");
            include("vues/Cellliers/celliers.php");
            include("vues/pied.php");
        }
    }

    /**
     * Cette méthode affiche la page du profil de l'utilisateur
     *  
     */
    private function profilUtilisateur()
    {

        include("vues/entete.php");
        include("vues/profil.php");
        include("vues/pied.php");
    }


    private function rechercher()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $id_usager = $_SESSION['utilisateur']['id'];

            include("vues/entete.php");
            include("vues/recherche.php");
            include("vues/pied.php");
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function rechercherBouteilles()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $aDonnees = json_decode(file_get_contents('php://input'), true);

            $tri = $aDonnees['tri'];
            $filtres = $aDonnees['filtres'];

            $recherche = new Recherche();
            $listeBouteille = $recherche->rechercherBouteilles($tri, $filtres);

            $resultats = array("liste" => $listeBouteille);
            echo json_encode($resultats);
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }


    private function rechercherBouteillesCellier()
    {
        $aDonnees = json_decode(file_get_contents('php://input'), true);
        $id_cellier = $aDonnees['id_cellier'];
        $filtres = $aDonnees['filtres'];

        $bte = new Bouteille();
        $listeBouteille = $bte->rechercherBouteillesCellier($id_cellier, $filtres);

        $resultats = array("liste" => $listeBouteille);
        echo json_encode($resultats);
    }

    /**
     * Cette méthode réduit la quantité d'une bouteille (-1) dans un cellier
     * 
     *  
     */
    private function reduireQteBouteille()
    {
        $id_usager = $_SESSION['utilisateur']['id'];
        $body = json_decode(file_get_contents('php://input'));
        $bte = new Bouteille();
        $resultat = $bte->modifierQuantiteBouteilleCellier($id_usager, $body->id, 1, "d");
    }


    function returnJsonHttpResponse($success, $data)
    {
        // remove any string that could create an invalid JSON
        // such as PHP Notice, Warning, logs...
        ob_clean();

        // this will clean up any previously added headers, to start clean
        header_remove();

        // Set the content type to JSON and charset
        // (charset can be set to something else)
        header("Content-type: application/json; charset=utf-8");

        // Set your HTTP response code, 2xx = SUCCESS,
        // anything else will be error, refer to HTTP documentation
        if ($success) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }

        // encode your PHP Object or Array into a JSON string.
        // stdClass or array
        echo json_encode($data);

        // making sure nothing is added
        exit();
    }


    /**
     * Cette méthode récupère l'id d'une bouteille lors du scan du code barre
     * 
     *  
     */
    private function scan()
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'));

        $id_bouteille = new Cellier;
        $id = $id_bouteille->getBouteilleCUP($body->scan_resultat);

        echo json_encode($id);
    }

    /**
     * Cette méthode affiche les statistiques d'un usager
     *  
     */
    private function statistiquesUtilisateur()
    {

        $jan = $fev = $mar = $avr = $mai = $jun = $jui = $aout = $sept = $oct = $nov = $dec = 0;
        $mois = [
            '01' => ['Jan' => $jan],
            '02' => ['Fev' => $fev],
            '03' => ['Mar' => $mar],
            '04' => ['Avr' => $avr],
            '05' => ['Mai' => $mai],
            '06' => ['Juin' => $jun],
            '07' => ['Juill' => $jui],
            '08' => ['Août' => $aout],
            '09' => ['Sept' => $sept],
            '10' => ['Oct' => $oct],
            '11' => ['Nov' => $nov],
            '12' => ['Dec' => $dec],

        ];

        $id_cellier = 0;

        $id_usager = $_SESSION['utilisateur']['id'];
        $bouteilles_bues = 0;
        $bouteilles_achat = 0;

        $celliers = new Cellier();
        $data = $celliers->getListeCellier($id_usager);

        // Valeur de tous les celliers
        $bouteille_total = 0;
        $prix_total = 0;
        foreach ($data as $cellier) {
            $bouteille_total += $cellier['bouteille_total'];
            $prix_total += $cellier['prix_total'];
        }
        $total = $prix_total * $bouteille_total;



        $stats = new Statistique();

        //TYPE DE VIN
        $types = $stats->getTypeVinCellier($id_usager, $id_cellier);

        // BOUTEILLES BUES
        $actionsBues = $stats->getBouteilleBues($id_usager);

        $moisBue = $mois;
        foreach ($actionsBues as $actionBue) {
            $bouteilles_bues += $actionBue['quantite_bouteille'];
            foreach ($moisBue as $cle => $valeur) {

                if ($actionBue['date_creation'][1] === $cle) {
                    foreach ($valeur as $val => $nbre) {

                        $nbre += $actionBue['quantite_bouteille'];
                        $moisBue[$cle][$val] = $nbre;
                    }
                }
            }
        }

        // BOUTEILLES AJOUTÉES
        $actionsAjouts = $stats->getBouteilleAjouts($id_usager);
        foreach ($actionsAjouts as $actionAjout) {
            $bouteilles_achat += $actionAjout['quantite_bouteille'];
            foreach ($mois as $cle => $valeur) {

                if ($actionAjout['date_creation'][1] === $cle) {
                    foreach ($valeur as $val => $nbre) {

                        $nbre += $actionAjout['quantite_bouteille'];
                        $mois[$cle][$val] = $nbre;
                    }
                }
            }
        }
        //INFO BOUTEILLES
        $bouteilles = $stats->getInfosBouteilleUsager($id_usager, $id_cellier);
        include("vues/entete.php");
        include("vues/statistiques.php");
        include("vues/pied.php");
    }

    
    /**
     * Cette méthode supprime un cellier selon l'id envoyé dans l'url
     *  
     */
    private function supprimerCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        $id = $body->id_cellierSupprime;
        $bte = new Bouteille();
        $bouteilles = $bte->getListeBouteilleCellier($body->id_cellierSupprime);
        if (count($bouteilles) > 0) {
            $cellier = new Cellier();
            $resultat = $cellier->deplacerBouteillesCellier($body->id_cellierChoisi, $bouteilles);

            $cellier->supprimerCellier($id);
        } else {
            $cellier = new Cellier();
            $cellier->supprimerCellier($id);
        }
    }

    private function voirProfilUsager()
    {
        if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
            $id_usager = $_SESSION['utilisateur']['id'];

            $usagers = new Usager();
            $unUsager = $usagers->lireUsager($id_usager)[0];

            include("vues/entete.php");
            include("vues/profilUsager.php");
            include("vues/pied.php");
        } else {
            include("vues/entete.php");
            include("vues/connexion.php");
            include("vues/pied.php");
        }
    }
}