<?php
$oVino = new Vino();

if (isset($id) && $id > 0) {
    $aBouteilles = $oVino->lireUneBouteille($id);

    if (isset($aBouteilles)) {
        $vinoBouteille = $aBouteilles[0];
    }
}

$vinoAppellations = $oVino->lireAppellations();
$vinoCepages = $oVino->lireCepages();
$vinoClassifications = $oVino->lireClassifications();
$vinoDegresAlcool = $oVino->lireDegresAlcool();
$vinoDesignations = $oVino->lireDesignations();
$vinoFormats = $oVino->lireFormats();
$vinoPays = $oVino->lirePays();
$vinoProduitsQc = $oVino->lireProduitsQc();
$vinoRegions = $oVino->lireRegions();
$vinoTauxDeSucre = $oVino->lireTauxDeSucre();
$vinoTypesVin = $oVino->lireTypesVin();

if (!isset($mode)) {
    $mode = "lire";
}

$readonly = ($mode == "lire") ? "readonly" : "";
$disabled = ($mode == "lire") ? "disabled" : "";
?>

<div class="groupe-action">
    <div class="action-texte">
    </div>
    <div class="action-boutons">
        <div class="btn-modifier" title="Modifier" data-js-btn-modifier>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
            </svg>
        </div>

        <div class="btn-confirmer hide" title="Confirmer" data-js-btn-confirmer>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z" />
            </svg>
        </div>

        <div class="btn-annuler hide" title="Annuler" data-js-btn-annuler>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M376.6 427.5c11.31 13.58 9.484 33.75-4.094 45.06c-5.984 4.984-13.25 7.422-20.47 7.422c-9.172 0-18.27-3.922-24.59-11.52L192 305.1l-135.4 162.5c-6.328 7.594-15.42 11.52-24.59 11.52c-7.219 0-14.48-2.438-20.47-7.422c-13.58-11.31-15.41-31.48-4.094-45.06l142.9-171.5L7.422 84.5C-3.891 70.92-2.063 50.75 11.52 39.44c13.56-11.34 33.73-9.516 45.06 4.094L192 206l135.4-162.5c11.3-13.58 31.48-15.42 45.06-4.094c13.58 11.31 15.41 31.48 4.094 45.06l-142.9 171.5L376.6 427.5z" />
            </svg>
        </div>
    </div>
</div>

<div class="detail-container">
    <table>
        <thead>
            <tr>
                <th><span>Nom du champ</span></th>
                <th><span>Valeur</span></th>
            </tr>
        </thead>
        <tbody id="detail-body">
            <tr>
                <td class="pa-8 non-modifiable">Id bouteille</td>
                <td class="pa-8" name="id_bouteille"><?php echo (isset($vinoBouteille) && isset($vinoBouteille['id'])) ? $vinoBouteille['id'] : "** valeur auto-générée **"; ?></td>
            </tr>
            <tr>
                <td class="pa-8">Nom de la bouteille</td>
                <td>
                    <input type="text" name="nom_bouteille" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['nom'])) echo $vinoBouteille['nom']; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Description</td>
                <td>
                    <input type="text" name="description_bouteille" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['description_bouteille'])) echo $vinoBouteille['description_bouteille']; ?>"></input>
                </td>

            </tr>
            <tr>
                <td class="pa-8">Code saq</td>
                <td>
                    <input type="text" name="code_saq" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['code_saq'])) echo $vinoBouteille['code_saq']; ?>"></input>
                </td>

            </tr>
            <tr>
                <td class="pa-8">Code cup</td>
                <td>
                    <input type="text" name="code_cup" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['code_cup'])) echo $vinoBouteille['code_cup']; ?>"></input>
                </td>

            </tr>
            <tr>
                <td class="pa-8">Pays</td>
                <td class="pa-8">
                    <select name="pays_id" id="pays_id" <?= $readonly ?>>
                        <option value="">Aucun pays</option>

                        <?php
                        $pays_id = (isset($vinoBouteille) && isset($vinoBouteille['pays_id'])) ? $vinoBouteille['pays_id'] : "";

                        foreach ($vinoPays as $unPays) {
                        ?>
                            <option value="<?= $unPays['id']; ?>" <?php if ($pays_id == $unPays['id']) {
                                                                        echo ' selected="selected"';
                                                                    } ?>>
                                <?= $unPays['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Région</td>
                <td class="pa-8">
                    <select name="region_id" id="region_id" <?= $readonly ?>>
                        <option value="">Aucune région</option>

                        <?php
                        $region_id = (isset($vinoBouteille) && isset($vinoBouteille['region_id'])) ? $vinoBouteille['region_id'] : "";

                        foreach ($vinoRegions as $uneRegion) {
                        ?>
                            <option value="<?= $uneRegion['id']; ?>" <?php if ($region_id == $uneRegion['id']) {
                                                                            echo ' selected="selected"';
                                                                        } ?>>
                                <?= $uneRegion['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Type de vin</td>
                <td class="pa-8">
                    <select name="type_id" id="type_id" <?= $readonly ?>>
                        <option value="">Aucun type de vin</option>

                        <?php
                        $type_id = (isset($vinoBouteille) && isset($vinoBouteille['type_id'])) ? $vinoBouteille['type_id'] : "";

                        foreach ($vinoTypesVin as $unType) {
                        ?>
                            <option value="<?= $unType['id']; ?>" <?php if ($type_id == $unType['id']) {
                                                                        echo ' selected="selected"';
                                                                    } ?>>
                                <?= $unType['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Producteur</td>
                <td>
                    <input type="text" name="producteur" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['producteur'])) echo $vinoBouteille['producteur']; ?>"></input>
                </td>

            </tr>
            <tr>
                <td class="pa-8">Url SAQ</td>
                <td>
                    <input type="text" name="url_saq" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['url_saq'])) echo $vinoBouteille['url_saq']; ?>"></input>
                </td>

            </tr>
            <tr>
                <td class="pa-8">Url de l'image</td>
                <td>
                    <input type="text" name="url_img" <?= $disabled ?> value="<?php if (isset($vinoBouteille) && isset($vinoBouteille['url_img'])) echo $vinoBouteille['url_img']; ?>"></input>
                </td>

            </tr>
            <tr>
                <td class="pa-8">Format</td>
                <td class="pa-8">
                    <select name="format_id" id="format_id" <?= $readonly ?>>
                        <option value="">Aucun format</option>

                        <?php
                        $format_id = (isset($vinoBouteille) && isset($vinoBouteille['format_id'])) ? $vinoBouteille['format_id'] : "";

                        foreach ($vinoFormats as $unFormat) {
                        ?>
                            <option value="<?= $unFormat['id']; ?>" <?php if ($format_id == $unFormat['id']) {
                                                                        echo ' selected="selected"';
                                                                    } ?>>
                                <?= $unFormat['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Appellation</td>
                <td class="pa-8">
                    <select name="appellation_id" id="appellation_id" <?= $readonly ?>>
                        <option value="">Aucune appellation</option>

                        <?php
                        $appellation_id = (isset($vinoBouteille) && isset($vinoBouteille['appellation_id'])) ? $vinoBouteille['appellation_id'] : "";

                        foreach ($vinoAppellations as $uneAppellation) {
                        ?>
                            <option value="<?= $uneAppellation['id']; ?>" <?php if ($appellation_id == $uneAppellation['id']) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                <?= $uneAppellation['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Designation</td>
                <td class="pa-8">
                    <select name="designation_id" id="designation_id" <?= $readonly ?>>
                        <option value="">Aucune designation</option>

                        <?php
                        $designation_id = (isset($vinoBouteille) && isset($vinoBouteille['designation_id'])) ? $vinoBouteille['designation_id'] : "";

                        foreach ($vinoDesignations as $uneDesignation) {
                        ?>
                            <option value="<?= $uneDesignation['id']; ?>" <?php if ($designation_id == $uneDesignation['id']) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                <?= $uneDesignation['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td <?= $disabled ?>>
            </tr>
            <tr>
                <td class="pa-8">Classification</td>
                <td class="pa-8">
                    <select name="classification_id" id="classification_id" <?= $readonly ?>>
                        <option value="">Aucune classification</option>

                        <?php
                        $classification_id = (isset($vinoBouteille) && isset($vinoBouteille['classification_id'])) ? $vinoBouteille['classification_id'] : "";

                        foreach ($vinoClassifications as $uneClassification) {
                        ?>
                            <option value="<?= $uneClassification['id']; ?>" <?php if ($classification_id == $uneClassification['id']) {
                                                                                    echo ' selected="selected"';
                                                                                } ?>>
                                <?= $uneClassification['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Cépage</td>
                <td class="pa-8">
                    <select name="cepages_id" id="cepages_id" <?= $readonly ?>>
                        <option value="">Aucun cepage</option>

                        <?php
                        $cepages_id = (isset($vinoBouteille) && isset($vinoBouteille['cepages_id'])) ? $vinoBouteille['cepages_id'] : "";

                        foreach ($vinoCepages as $unCepage) {
                        ?>
                            <option value="<?= $unCepage['id']; ?>" <?php if ($cepages_id == $unCepage['id']) {
                                                                        echo ' selected="selected"';
                                                                    } ?>>
                                <?= $unCepage['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Taux de sucre</td>
                <td class="pa-8">
                    <select name="taux_de_sucre_id" id="taux_de_sucre_id" <?= $readonly ?>>
                        <option value="">Aucun taux de sucre</option>

                        <?php
                        $taux_de_sucre_id = (isset($vinoBouteille) && isset($vinoBouteille['taux_de_sucre_id'])) ? $vinoBouteille['taux_de_sucre_id'] : "";

                        foreach ($vinoTauxDeSucre as $unTauxDeSucre) {
                        ?>
                            <option value="<?= $unTauxDeSucre['id']; ?>" <?php if ($taux_de_sucre_id == $unTauxDeSucre['id']) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                <?= $unTauxDeSucre['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Degré d'alcool</td>
                <td class="pa-8">
                    <select name="degre_alcool_id" id="degre_alcool_id" <?= $readonly ?>>
                        <option value="">Aucun degré d'alcool</option>

                        <?php
                        $degre_alcool_id = (isset($vinoBouteille) && isset($vinoBouteille['degre_alcool_id'])) ? $vinoBouteille['degre_alcool_id'] : "";

                        foreach ($vinoDegresAlcool as $unDegreAlcool) {
                        ?>
                            <option value="<?= $unDegreAlcool['id']; ?>" <?php if ($degre_alcool_id == $unDegreAlcool['id']) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                <?= $unDegreAlcool['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Produit du Québec</td>
                <td class="pa-8">
                    <select name="produit_du_quebec_id" id="produit_du_quebec_id" <?= $readonly ?>>
                        <option value="">Aucun produit du Québec</option>

                        <?php
                        $produit_du_quebec_id = (isset($vinoBouteille) && isset($vinoBouteille['produit_du_quebec_id'])) ? $vinoBouteille['produit_du_quebec_id'] : -1;

                        foreach ($vinoProduitsQc as $unProduitQc) {
                        ?>
                            <option value="<?= $unProduitQc['id']; ?>" <?php if ($produit_du_quebec_id == $unProduitQc['id']) {
                                                                            echo ' selected="selected"';
                                                                        } ?>>
                                <?= $unProduitQc['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Biodynamique</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="biodynamique" id="biodynamique" <?php if (isset($vinoBouteille) && isset($vinoBouteille['biodynamique'])) echo "value=" . $vinoBouteille['biodynamique']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Casher</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="casher" id="casher" <?php if (isset($vinoBouteille) && isset($vinoBouteille['casher'])) echo "value=" . $vinoBouteille['casher']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Désalcoolisé</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="desalcoolise" id="desalcoolise" <?php if (isset($vinoBouteille) && isset($vinoBouteille['desalcoolise'])) echo "value=" . $vinoBouteille['desalcoolise']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Équitable</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="equitable" id="equitable" <?php if (isset($vinoBouteille) && isset($vinoBouteille['equitable'])) echo "value=" . $vinoBouteille['equitable']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Faible taux d'alcool</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="faible_taux_alcool" id="faible_taux_alcool" <?php if (isset($vinoBouteille) && isset($vinoBouteille['faible_taux_alcool'])) echo "value=" . $vinoBouteille['faible_taux_alcool']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Produit bio</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="produit_bio" id="produit_bio" <?php if (isset($vinoBouteille) && isset($vinoBouteille['produit_bio'])) echo "value=" . $vinoBouteille['produit_bio']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Vin nature</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="vin_nature" id="vin_nature" <?php if (isset($vinoBouteille) && isset($vinoBouteille['vin_nature'])) echo "value=" . $vinoBouteille['vin_nature']; ?>>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Vin orange</td>
                <td class="pa-8">
                    <label>
                        <input type="checkbox" <?= $disabled ?> class="plus-gros" name="vin_orange" id="vin_orange" <?php if (isset($vinoBouteille) && isset($vinoBouteille['vin_orange'])) echo "value=" . $vinoBouteille['vin_orange']; ?>>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!--MODAL-->
<div class="modal modal--ferme">
    <div class="modal__contenu">
        <h4 class="text-center" data-js-modal-message></h4>

        <div class="submit-bloc">
            <button data-js-bouton-danger class="bouton-danger"></button>
            <button data-js-bouton-secondaire class="bouton-secondaire"></button>
        </div>
    </div>
</div>