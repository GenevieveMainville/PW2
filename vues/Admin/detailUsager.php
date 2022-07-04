<?php
$oVino = new Usager();

if (isset($id) && $id > 0) {
    $usager = new Usager();
    $aUsagers = $usager->getAdminUnUsager($id);

    if (isset($aUsagers)) {
        $usagerDetail = $aUsagers[0];
    }
}

$vinoUsager = $oVino->lireTypesUsager();

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
                <td class="pa-8 non-modifiable">Id usager</td>
                <td class="pa-8"><?php echo (isset($usagerDetail) && isset($usagerDetail["id"])) ? $usagerDetail["id"] : "** valeur auto-générée **"; ?></td>
            </tr>
            <tr>
                <td class="pa-8">Nom complet</td>
                <td>
                    <input type="text" name="nom" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["nom"])) echo $usagerDetail["nom"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Adresse</td>
                <td>
                    <input type="text" name="adresse" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["adresse"])) echo $usagerDetail["adresse"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Téléphone</td>
                <td>
                    <input type="text" name="telephone" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["telephone"])) echo $usagerDetail["telephone"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Courriel</td>
                <td>
                    <input type="text" name="courriel" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["courriel"])) echo $usagerDetail["courriel"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Date de naissance</td>
                <td>
                    <input type="text" name="date_naissance" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["date_naissance"])) echo $usagerDetail["date_naissance"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Ville</td>
                <td>
                    <input type="text" name="ville" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["ville"])) echo $usagerDetail["ville"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Nom d'utilisateur</td>
                <td>
                    <input type="text" name="nom_utilisateur" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["nom_utilisateur"])) echo $usagerDetail["nom_utilisateur"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8">Type d'utilisateur</td>
                <td class="pa-8">
                    <select name=" type_utilisateur" id="type_utilisateur" <?= $readonly ?>>
                        <option value="-1">Aucun type d'utilisateur</option>

                        <?php
                        $type_utilisateur = (isset($usagerDetail) && isset($usagerDetail["type_utilisateur"])) ? $usagerDetail["type_utilisateur"] : "";

                        foreach ($vinoUsager as $unUsager) {
                        ?>
                            <option value="<?= $unUsager['id']; ?>" <?php if ($type_utilisateur == $unUsager['id']) {
                                                                        echo ' selected="selected"';
                                                                    } ?>>
                                <?= $unUsager['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pa-8 non-modifiable">Date de création</td>
                <td>
                    <input type="text" name="date_creation" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["date_creation"])) echo $usagerDetail["date_creation"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8 non-modifiable">Date de modification</td>
                <td>
                    <input type="text" name="date_modification" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["date_modification"])) echo $usagerDetail["date_modification"]; ?>"></input>
                </td>
            </tr>
            <tr>
                <td class="pa-8 non-modifiable">Dernier accès</td>
                <td>
                    <input type="text" name="dernier_access" <?= $disabled ?> value="<?php if (isset($usagerDetail) && isset($usagerDetail["dernier_access"])) echo $usagerDetail["dernier_access"]; ?>"></input>
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