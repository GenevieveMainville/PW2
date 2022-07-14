<?php
$oRecherche = new Recherche();
$listeBouteille = [];
$erreur = "";
$aTri = array('champ' => 'nom_bouteille', 'ordre' => 'asc');
$aDonnees = [];
$id_appellant = -1;
$achat = false;
$favori = false;
$essayer = false;

$les_listes = "";

if (isset($_GET['id_cellier'])) {
    $id_appellant = $_GET['id_cellier'];
    $aDonnees['id_cellier'] = $id_appellant;
}

if (isset($_GET['favori']) && $_GET['favori'] == 1) {
    $favori = true;
    $les_listes .= "favori,";
}

if (isset($_GET['essayer']) && $_GET['essayer'] == 1) {
    $essayer = true;
    $les_listes .= "essayer,";
}

if (isset($_GET['achat']) && $_GET['achat'] == 1) {
    $achat = true;
    $les_listes .= "achat,";
}

if ($les_listes) {
    $aDonnees["les_listes"] = substr($les_listes, 0, strlen($les_listes) - 1);
}

if (isset($_SESSION) && isset($_SESSION['utilisateur'])) {
    $listeBouteille = $oRecherche->rechercherBouteilles($aTri, $aDonnees);

    $nbBouteilles = count($listeBouteille);
    $qteDeb = "1";
    $qteFin = $nbBouteilles;
    $qteMax = $nbBouteilles;
} else {
    $erreur = "Impossible de continuer. L'utilisateur n'est pas défini!";
}

$aAppellations = $oRecherche->lireAppellations();
$aBouteilles = $oRecherche->lireBouteilles();
$aCelliers = $oRecherche->lireCelliers();
$aCepages = $oRecherche->lireCepages();
$aClassifications = $oRecherche->lireClassifications();
$aDegresAlcool = $oRecherche->lireDegreAlcool();
$aDesignations = $oRecherche->lireDesignations();
$aFormats = $oRecherche->lireFormats();
$aGardeJusqua = $oRecherche->lireGardeJusqua();
$aMillesimes = $oRecherche->lireMillesimes();
$aNotes = $oRecherche->lireNotes();
$aOrdresTri = $oRecherche->lireOrdresTri();
$aPays = $oRecherche->lirePays();
$aPrix = $oRecherche->lirePrix();
$aProduitsQc = $oRecherche->lireProduitsQc();
$aRegions = $oRecherche->lireRegions();
$aTauxDeSucre = $oRecherche->lireTauxDeSucre();
$aTypesCellier = $oRecherche->lireTypesCellier();
$aTypesVin = $oRecherche->lireTypesVin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recherche de bouteilles</title>

    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/styles.css" type="text/css" media="screen">

    <base href="<?= BASEURL; ?>">

    <script src="./js/recherche.js" defer></script>
</head>

<body>
    <div class="page-precedente-container ferme">
        <button class="bouton bouton-secondaire page-precedente" data-js-page-precedente>
            <i class="fa fa-chevron-left fleche-page-precedente" aria-hidden="true"></i>
            Retour à la page précédente
        </button>
    </div>

    <section class="section-wrapper carte carte--bg-couleur " data-js-usager="<?= $id_usager ?>">
        <div class="detail">
            <div class="barre-tri" data-js-barre-tri>
                <div class="ouvrir-fermer">
                    <div class="ouvrir-recherche" title="Ouvrir la barre de filtres">
                        <button class="ouvrir-filtres" data-js-ouvrir-filtres>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />
                            </svg>
                        </button>
                    </div>
                    <div class="fermer-recherche" title="Fermer la barre de filtres">
                        <button class="fermer-filtres ferme" data-js-fermer-filtres>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="top-nav">
                    <div class="top-nav-ligne-1">
                        <span class="page-titre">Mes bouteilles</span>
                    </div>
                    <div class="top-nav-ligne-2">
                        <div class="qte-wrapper" data-js-qte-wrapper>
                            <span>Résultat: </span>
                            <?php if (count($listeBouteille)) { ?>
                                <span data-js-qte-deb><?= $qteDeb ?></span>
                                <span>-</span>
                                <span data-js-qte-fin><?= $qteFin ?></span>
                                <span>sur</span>
                                <span data-js-qte-max><?= $qteMax ?></span>
                            <?php } else { ?>
                                <span>Aucune bouteille trouvée</span>
                            <?php } ?>
                        </div>
                        <div class="tri-select-wrapper">
                            <div class="tri-container select-container">
                                <select id="tri-select" class="tri-select-options">
                                    <?php for ($i = 0, $l = count($aOrdresTri); $i < $l; $i++) {
                                        $id = $aOrdresTri[$i]['id'];
                                        $nom = $aOrdresTri[$i]['nom'];
                                        $champ = $aOrdresTri[$i]['champ'];
                                        $ordre = $aOrdresTri[$i]['ordre'];

                                        echo '
                                <option value="' . $id . '" data-js-champ="' . $champ . '" data-js-ordre="' . $ordre . '">' . $nom . '</option>
                            ';
                                    } ?>
                                </select>
                            </div>
                            <button class="bouton bouton-secondaire" data-js-trier title="Lancer le tri">Trier</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main" id="main" data-js-main>
                <div class="menuRecherche" data-js-menu-recherche>
                    <div class="recherche-container">
                        <div class="recherche-top-nav">
                            <div class="recherche-action">
                                <button class="bouton bouton-primaire" data-js-rechercher title="Lancer la recherche">Rechercher</button>
                                <button class="bouton bouton-secondaire" data-js-reinit title="Vider tous les champs">Réinitialiser</button>
                            </div>
                        </div>

                        <div class="recherche-groupe">
                            <!-- Les listes -->
                            <div class="recherche-item">
                                <button class="accordeon accordeon-flex" data-js-accordeon-listes>
                                    <div class="nb-listes nb-selectionnes"><span class="nb-selections hide"></span></div>
                                    <div>Mes listes</div>
                                </button>

                                <div class="acc-container">
                                    <div class="filtre-listbox">
                                        <div class="filtre-entete">
                                            <div class="filtre-entete-checkbox">
                                                <input type="checkbox" id="listes-toutes" data-js-listes-toutes data-js-type-tous />
                                                <label class="libelle-tous" for="listes-toutes">Toutes</label>
                                            </div>
                                        </div>

                                        <fieldset>
                                            <div class="liste-choix">
                                                <div class="choix-item">
                                                    <input name="favori_bouteille" type="checkbox" id="favori_bouteille" title="Afficher mes bouteilles favorites" data-js-liste="favori" />

                                                    <div class="choix-nom">
                                                        <label for="favori_bouteille" title="Afficher mes bouteilles favorites">mes bouteilles favorites</label>
                                                    </div>
                                                </div>
                                                <div class="choix-item">
                                                    <input name="essayer_bouteille" type="checkbox" id="essayer_bouteille" title="Afficher mes bouteilles à essayer" data-js-liste="essayer" />

                                                    <div class=" choix-nom">
                                                        <label for="essayer_bouteille" title="Afficher mes bouteilles à essayer">mes bouteilles à essayer</label>
                                                    </div>
                                                </div>
                                                <div class="choix-item">
                                                    <input name="achat_bouteille" type="checkbox" id="achat_bouteille" title="Afficher mes bouteilles à acheter" data-js-liste="achat" />

                                                    <div class=" choix-nom">
                                                        <label for="achat_bouteille" title="Afficher mes bouteilles à acheter">mes bouteilles à acheter</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <!-- Cellier -->
                            <div class="recherche-item">
                                <?php if (!$aCelliers) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun cellier trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex" data-js-accordeon-cellier>
                                        <div class="nb-cellier nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Cellier</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="cellier-tous" data-js-cellier-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="cellier-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php
                                                    for ($i = 0, $l = count($aCelliers); $i < $l; $i++) {
                                                        $id = $aCelliers[$i]['id'];
                                                        $nom = $aCelliers[$i]['nom'] . " - " . ucfirst($aCelliers[$i]['description']);
                                                        $infoBulle = $aCelliers[$i]['nom'];
                                                        $nomChamp = "cellier-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-cellier="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Type de cellier -->
                            <div class="recherche-item">
                                <?php if (!$aTypesCellier) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun type de cellier trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-type-cellier nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Type de cellier</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="type-cellier-tous" data-js-type-cellier-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="type-cellier-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aTypesCellier); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aTypesCellier[$i]['nom'];
                                                        $nbTrouve = $aTypesCellier[$i]['nbTrouve'];
                                                        $nomChamp = "type-cellier-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-type-cellier="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Bouteille -->
                            <div class="recherche-item">
                                <?php if (!$aBouteilles) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune bouteille trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-bouteille nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Bouteille</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="bouteille-tous" data-js-bouteille-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="bouteille-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aBouteilles); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aBouteilles[$i]['nom'];
                                                        $nbTrouve = $aBouteilles[$i]['nbTrouve'];
                                                        $nomChamp = 'bouteille-' . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-bouteille="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Type de vin -->
                            <div class="recherche-item">
                                <?php if (!$aTypesVin) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun type de vin trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-type-de-vin nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Type de vin</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="type-de-vin-tous" data-js-type-de-vin-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="type-de-vin-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aTypesVin); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aTypesVin[$i]['nom'];
                                                        $nbTrouve = $aTypesVin[$i]['nbTrouve'];
                                                        $nomChamp = "type-de-vin-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-type-de-vin="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Pays -->
                            <div class="recherche-item">
                                <?php if (!$aPays) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun pays trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-pays nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Pays</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="pays-tous" data-js-pays-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="pays-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aPays); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aPays[$i]['nom'];
                                                        $nbTrouve = $aPays[$i]['nbTrouve'];
                                                        $nomChamp = "pays-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-pays="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Région -->
                            <div class="recherche-item">
                                <?php if (!$aRegions) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune région trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-region nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Région</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="region-tous" data-js-region-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="region-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aRegions); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aRegions[$i]['nom'];
                                                        $nbTrouve = $aRegions[$i]['nbTrouve'];
                                                        $nomChamp = "region-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-region="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Prix -->
                            <div class="recherche-item">
                                <?php if (!$aPrix) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun prix trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-prix nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Prix</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="prix-tous" data-js-prix-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="prix-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aPrix); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aPrix[$i]['nom'];
                                                        $nbTrouve = $aPrix[$i]['nbTrouve'];
                                                        $nomChamp = "prix-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-prix="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Format de la bouteille -->
                            <div class="recherche-item">
                                <?php if (!$aFormats) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun format de bouteille trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-format nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Format</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="format-tous" data-js-format-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="format-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aFormats); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aFormats[$i]['nom'];
                                                        $nbTrouve = $aFormats[$i]['nbTrouve'];
                                                        $nomChamp = "format-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-format="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Quantité -->
                            <div class="recherche-item">
                                <button class="accordeon accordeon-flex">
                                    <div class="accordeon-icon hide" data-js-quantite-icone>
                                    </div>
                                    <div>Quantité</div>
                                </button>

                                <div class="acc-container">
                                    <div class="filtre-slider">
                                        <div class="slider-container">
                                            <div class="slider-groupe">
                                                <div class="slider-input-container">
                                                    <label for="qte_val_min">Min: </label>
                                                    <input class="slider-input" name="qte_val_min" id="qte_val_min" data-js-slider-input="entier" data-js-qte-val-min>
                                                </div>
                                                <div class="slider-item">
                                                    <input type="radio" name="qte_min" id="qte_min_1" value="" required>
                                                    <label for="qte_min_1" data-slider-value="aucun"></label>
                                                    <input type="radio" name="qte_min" id="qte_min_2" value="5" required>
                                                    <label for="qte_min_2" data-slider-value="5"></label>
                                                    <input type="radio" name="qte_min" id="qte_min_3" value="10" required>
                                                    <label for="qte_min_3" data-slider-value="10"></label>
                                                    <input type="radio" name="qte_min" id="qte_min_4" value="20" required>
                                                    <label for="qte_min_4" data-slider-value="20"></label>
                                                    <input type="radio" name="qte_min" id="qte_min_5" value="50" required>
                                                    <label for="qte_min_5" data-slider-value="50"></label>
                                                    <div class="slider-pos"></div>
                                                </div>
                                            </div>

                                            <div class="slider-groupe">
                                                <div class="slider-input-container">
                                                    <label for="qte_val_max">Max: </label>
                                                    <input class="slider-input" name="qte_val_max" id="qte_val_max" data-js-slider-input="entier" data-js-qte-val-max>
                                                </div>
                                                <div class="slider-item">
                                                    <input type="radio" name="qte_max" id="qte_max_1" value="" required>
                                                    <label for="qte_max_1" data-slider-value="aucun"></label>
                                                    <input type="radio" name="qte_max" id="qte_max_2" value="5" required>
                                                    <label for="qte_max_2" data-slider-value="5"></label>
                                                    <input type="radio" name="qte_max" id="qte_max_3" value="10" required>
                                                    <label for="qte_max_3" data-slider-value="10"></label>
                                                    <input type="radio" name="qte_max" id="qte_max_4" value="20" required>
                                                    <label for="qte_max_4" data-slider-value="20"></label>
                                                    <input type="radio" name="qte_max" id="qte_max_5" value="50" required>
                                                    <label for="qte_max_5" data-slider-value="50"></label>
                                                    <div class="slider-pos"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Millésime -->
                            <div class="recherche-item">
                                <?php if (!$aMillesimes) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun millésime trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-millesime nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Millésime</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="millesime-tous" data-js-millesime-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="millesime-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aMillesimes); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aMillesimes[$i]['nom'];
                                                        $nbTrouve = $aMillesimes[$i]['nbTrouve'];
                                                        $nomChamp = "millesime-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-millesime="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Note -->
                            <div class="recherche-item">
                                <?php if (!$aNotes) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune note trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-note nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Note</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="note-tous" data-js-note-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="note-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aNotes); $i < $l; $i++) {
                                                        $id = $aNotes[$i]['nom'];
                                                        $nom = $infoBulle = $aNotes[$i]['nom'] . " étoiles";
                                                        $nbTrouve = $aNotes[$i]['nbTrouve'];
                                                        $nomChamp = "note-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-note="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Garder jusqu'à -->
                            <div class="recherche-item">
                                <?php if (!$aGardeJusqua) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune date de garde trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-garde-jusqua nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Garder jusqu'à</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="garde-jusqua-tous" data-js-garde-jusqua-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="garde-jusqua-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aGardeJusqua); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aGardeJusqua[$i]['nom'];
                                                        $nbTrouve = $aGardeJusqua[$i]['nbTrouve'];
                                                        $nomChamp = "garde-jusqua-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-garde-jusqua="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Produit du Québec -->
                            <div class="recherche-item">
                                <?php if (!$aProduitsQc) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun produit du Québec trouvé</p>
                                    </div>

                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-produit-qc nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Produit du Québec</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="produit-qc-tous" data-js-produit-qc-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="produit-qc-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aProduitsQc); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aProduitsQc[$i]['nom'];
                                                        $nbTrouve = $aProduitsQc[$i]['nbTrouve'];
                                                        $nomChamp = "produit-qc-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-produit-qc="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Appellation -->
                            <div class="recherche-item">
                                <?php if (!$aAppellations) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune appellation trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-appellation nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Appellation</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="appellation-tous" data-js-appellation-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="appellation-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aAppellations); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aAppellations[$i]['nom'];
                                                        $nbTrouve = $aAppellations[$i]['nbTrouve'];
                                                        $nomChamp = "appellation-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-appellation="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Cépage -->
                            <div class="recherche-item">
                                <?php if (!$aCepages) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun cépage trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-cepage nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Cépage</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="cepage-tous" data-js-cepage-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="cepage-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aCepages); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aCepages[$i]['nom'];
                                                        $nbTrouve = $aCepages[$i]['nbTrouve'];
                                                        $nomChamp = "cepage-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-cepage="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Classification -->
                            <div class="recherche-item">
                                <?php if (!$aClassifications) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune classification trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-classification nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Classification</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="classification-tous" data-js-classification-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="classification-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aClassifications); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aClassifications[$i]['nom'];
                                                        $nbTrouve = $aClassifications[$i]['nbTrouve'];
                                                        $nomChamp = "classification-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-classification="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Désignation -->
                            <div class="recherche-item">
                                <?php if (!$aDesignations) { ?>
                                    <div class="non-trouve">
                                        <p>Aucune désignation trouvée</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-designation nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Designation</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="designation-tous" data-js-designation-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="designation-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aDesignations); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aDesignations[$i]['nom'];
                                                        $nbTrouve = $aDesignations[$i]['nbTrouve'];
                                                        $nomChamp = "designation-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-designation="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Taux de sucre -->
                            <div class="recherche-item">
                                <?php if (!$aTauxDeSucre) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun taux de sucre trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-taux-de-sucre nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Taux de sucre</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="taux-de-sucre-tous" data-js-taux-de-sucre-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="taux-de-sucre-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aTauxDeSucre); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aTauxDeSucre[$i]['nom'];
                                                        $nbTrouve = $aTauxDeSucre[$i]['nbTrouve'];
                                                        $nomChamp = "taux-de-sucre-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-taux-de-sucre="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Degré d'alcool -->
                            <div class="recherche-item">
                                <?php if (!$aDegresAlcool) { ?>
                                    <div class="non-trouve">
                                        <p>Aucun degré d'alcool trouvé</p>
                                    </div>
                                <?php } else { ?>
                                    <button class="accordeon accordeon-flex">
                                        <div class="nb-degre-alcool nb-selectionnes"><span class="nb-selections hide"></span></div>
                                        <div>Degré d'alcool</div>
                                    </button>

                                    <div class="acc-container">
                                        <div class="filtre-listbox">
                                            <div class="filtre-entete">
                                                <div class="filtre-entete-checkbox">
                                                    <input type="checkbox" id="degre-alcool-tous" data-js-degre-alcool-tous data-js-type-tous />
                                                    <label class="libelle-tous" for="degre-alcool-tous">Tous</label>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div class="liste-choix">
                                                    <?php for ($i = 0, $l = count($aDegresAlcool); $i < $l; $i++) {
                                                        $id = $nom = $infoBulle = $aDegresAlcool[$i]['nom'];
                                                        $nbTrouve = $aDegresAlcool[$i]['nbTrouve'];
                                                        $nomChamp = "degre-alcool-" . ($i + 1);

                                                        echo '
                                                        <div class="choix-item">
                                                            <input name="' . $nomChamp . '" type="checkbox" id="' . $nomChamp . '" title="' . $infoBulle . '" data-js-degre-alcool="' . $id . '" />

                                                            <div class="choix-nom">
                                                                <label for="' . $nomChamp . '" title="' . $infoBulle . '">' .  $nom . '</label>
                                                                <div class="choix-nb-trouve">
                                                                    (' . $nbTrouve . ')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" data-js-id-appellant="<?= $id_appellant ?>" />
                <input type="hidden" data-js-achat="<?= $achat ?>" />
                <input type="hidden" data-js-favori="<?= $favori ?>" />
                <input type="hidden" data-js-essayer="<?= $essayer ?>" />

                <div class="carte__contenant" data-js-carte-contenant>
                    <?php
                    if (count($listeBouteille)) {
                        for ($i = 0, $l = count($listeBouteille); $i < $l; $i++) {
                            $id_cellier = $listeBouteille[$i]["id_cellier"];
                            $id_bouteille = $listeBouteille[$i]["id_bouteille"];
                            $image_bouteille = $listeBouteille[$i]["image_bouteille"];
                            $nom_bouteille = $listeBouteille[$i]["nom_bouteille"];
                            $description_bouteille = $listeBouteille[$i]["description_bouteille"];
                            $millesime_bouteille = $listeBouteille[$i]["millesime"];
                            $quantite_bouteille = $listeBouteille[$i]["quantite_bouteille"];
                            $date_achat = $listeBouteille[$i]["date_achat"];
                            $prix_bouteille = $listeBouteille[$i]["prix_bouteille"];
                            $note = $listeBouteille[$i]["note"];

                            if ($note) {
                                $note = "Ma note est de " . $note . "/5";
                            } else {
                                $note = "Aucune note encore attribuée";
                            }
                    ?>

                            <a class="carte__lien" href="?requete=bouteille&id_bouteille=<?= $id_bouteille ?>&id_cellier=<?= $id_cellier ?>">
                                <div class="carte__contenu" data-js-bouteille="<?= $id_bouteille ?>">
                                    <div class="carte__lien carte--flex">
                                        <div class="carte__img">
                                            <img src="<?= $image_bouteille ?>" alt="bouteille">
                                        </div>


                                        <div class="carte__description">
                                            <div>
                                                <div class="carte--flex carte__titre">
                                                    <h4 class=""><?= $nom_bouteille ?> - <?= $millesime_bouteille ?></h4>
                                                </div>

                                                <div>
                                                    <div class="carte__texte">
                                                        <?= $description_bouteille ?>
                                                    </div>
                                                    <div class="carte__texte">
                                                        Acheté le <?= $date_achat ?>
                                                    </div>
                                                    <div class="carte__texte">
                                                        Au prix de <?= $prix_bouteille ?>
                                                    </div>
                                                    <div class="carte__texte">
                                                        <?= $note ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <ul class="carte--haut">
                                                <li class="carte--aligne-droite">
                                                    <form data-js-id="<?= $id_bouteille ?>">
                                                        <i><svg class="carte__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                <path d="M507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.25 6.254-6.251 16.38-.0006 22.63l-76.63 76.63c-46.63-19.75-102.4-10.75-140.4 27.25l-158.4 158.4c-25 25-25 65.51 0 90.51l90.51 90.52c25 25 65.51 25 90.51 0l158.4-158.4c38-38 47-93.76 27.25-140.4l76.63-76.63c6.25 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57zM179.3 423.2l-90.51-90.51l122-122l90.51 90.52L179.3 423.2z"></path>
                                                            </svg></i>

                                                        <button class="bouton btnAjouter">
                                                            <i class="carte__icone-petit--espace"><svg class="carte__icone-petit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"></path>
                                                                </svg></i>
                                                        </button>

                                                        <span data-js-quantite=""><?= $quantite_bouteille ?></span>

                                                        <button class="bouton btnBoire">
                                                            <i class="carte__icone-petit--espace"><svg class="carte__icone-petit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM168 232C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H168z"></path>
                                                                </svg></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        <?php
                        }
                    } else { ?>
                        <div class="aucune-bouteille-wrapper">
                            <p class="aucune-bouteille">Aucune bouteille trouvée</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>