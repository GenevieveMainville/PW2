<?php
if ($listeBouteille) {
    $nbBouteilles = count($listeBouteille);
}

$oRecherche = new Recherche();

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
    <link rel="stylesheet" href="./css/styles.css" type="text/css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="./js/recherche.js" defer></script>
</head>

<body>
    <section class="section-wrapper">
        <div class="barre-tri">
            <div class="burger-rechercher">
                <input type="checkbox" class="burgerMenuRecherche" id="burgerMenuRecherche">
                <label for="burgerMenuRecherche" class="sidebarIconToggle" title="ouvrir/fermer le menu de recherche">
                    <div class="spinner diagonal part-1"></div>
                    <div class="spinner horizontal"></div>
                    <div class="spinner diagonal part-2"></div>
                </label>
            </div>
            <div class="resultats">
                <div class="resultat-total">Résultats 1-12 sur 3790</div>
                <div class="qte-affichage-wrapper">
                    <label class="qte-affichage-label" for="qte-affichage-options">
                        <span>Afficher</span>
                    </label>
                    <div class="qte-affichage-container select-container">
                        <select id="qte-affichage-options" class="qte-affichage-options">
                            <option value="12"> 12 </option>
                            <option value="12"> 12 </option>
                            <option value="24"> 24 </option>
                            <option value="48"> 48 </option>
                        </select>
                    </div>
                    <div class="qte-affichage-text">
                        <span class="qte-affichage-text">par page</span>
                    </div>
                </div>
            </div>
            <div class="tri-select-wrapper">
                <div>Triée par:</div>
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
                <button class="bouton bouton-primaire" title="Lancer le tri">Trier</button>
            </div>
        </div>
        <div class="main">
            <div class="menuRecherche">
                <div class="recherche-wrapper">
                    <div class="rechercher-action">
                        <button class="bouton bouton-primaire" data-js-rechercher title="Lancer la recherche">Rechercher</button>
                        <button class="bouton bouton-secondaire" data-js-reinit title="Vider tous les champs">Réinitialiser</button>
                    </div>

                    <div class="rechercher-groupe">
                        <!-- Cellier -->
                        <div class="rechercher-item">
                            <?php if (!$aCelliers) { ?>
                                <div class="non-trouve">
                                    <p>Aucun cellier trouvé</p>
                                </div>
                            <?php } else { ?>
                                <button class="accordeon accordeon-flex">
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
                                                <?php for ($i = 0, $l = count($aCelliers); $i < $l; $i++) {
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
                            <button class="accordeon accordeon-flex">
                                <div class="accordeon-icon hide">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
                                    </svg>
                                </div>
                                <div>Quantité</div>
                            </button>

                            <div class="acc-container">
                                <div class="filtre-slider">
                                    <div class="slider-container">
                                        <div class="slider-groupe">
                                            <div class="slider-input-container">
                                                <label for="qte_val_min">Min: </label>
                                                <input class="slider-input" type="number" min="0" name="qte_val_min" id="qte_val_min" data-js-slider-input data-js-da-val-min>
                                            </div>
                                            <div id="da-unite">
                                                <span>%</span>
                                            </div>
                                            <div class="slider-item">
                                                <input type="radio" name="qte_min" id="qte_min_1" value="0" required>
                                                <label for="qte_min_1" data-slider-value="0"></label>
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
                                                <input class="slider-input" type="number" min="0" name="qte_val_max" id="qte_val_max" data-js-slider-input data-js-da-val-max>
                                            </div>
                                            <div id="da-unite">
                                                <span>%</span>
                                            </div>
                                            <div class="slider-item">
                                                <input type="radio" name="qte_max" id="qte_max_1" value="5" required>
                                                <label for="qte_max_1" data-slider-value="5"></label>
                                                <input type="radio" name="qte_max" id="qte_max_2" value="10" required>
                                                <label for="qte_max_2" data-slider-value="10"></label>
                                                <input type="radio" name="qte_max" id="qte_max_3" value="20" required>
                                                <label for="qte_max_3" data-slider-value="20"></label>
                                                <input type="radio" name="qte_max" id="qte_max_4" value="50" required>
                                                <label for="qte_max_4" data-slider-value="50"></label>
                                                <input type="radio" name="qte_max" id="qte_max_5" value="+50" required>
                                                <label for="qte_max_5" data-slider-value="+50"></label>
                                                <div class="slider-pos"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Millésime -->
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
                        <div class="rechercher-item">
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
        </div>
    </section>
</body>

</html>