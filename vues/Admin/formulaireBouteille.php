<?php
$bte = new Bouteille();
$aBouteilles = $bte->getAdminBouteilles();
?>

<div>
    <div class="groupe-ajouter">
        <div class="btn-ajouter" title="Ajouter" data-js-btn-ajouter="bouteille">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
            </svg>
        </div>
    </div>

    <div class="filtre-wrapper filtre-bouteille">
        <label for="filtre-table">Commencez à taper pour filtrer la table</label>
        <input type="text" id="filtre-table" class="filtre-table" placeholder="Rechercher..." title="Commencez à taper">
    </div>

    <div class="table-container">
        <table class="table-bouteille">
            <thead>
                <tr id="table-entete">
                    <th><span id="id_bouteille" class="w3-button table-colonne">Id bouteille <i class="caret"></span></th>
                    <th><span id="id_cellier" class="w3-button table-colonne">Id Cellier <i class="caret"></span></th>
                    <th><span id="nom_bouteille" class="w3-button table-colonne">Nom de la bouteille <i class="caret"></span></th>
                    <th><span id="url_saq" class="w3-button table-colonne">Lien vers la SAQ <i class="caret"></span></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                $nbTrouve = count($aBouteilles);

                if ($nbTrouve == 0) {
                ?>
                    <div>
                        <div class="err err-bouteille">
                            Aucune bouteille trouvée
                        </div>
                    </div>
                    <?php
                } else {
                    foreach ($aBouteilles as $uneBouteille) {
                    ?>
                        <tr>
                            <td><?= $uneBouteille["id_bouteille"] ?></td>
                            <td><?= $uneBouteille["id_cellier"] ?></td>
                            <td><?= $uneBouteille["nom_bouteille"] ?></td>
                            <td>
                                <div class="lien-externe">
                                    <span><?= $uneBouteille["url_saq"] ?></span>
                                    <a href="<?= $uneBouteille["url_saq"] ?>" target="_blank" title="Ouvre le document lié dans une nouvelle fenêtre ou un nouvel onglet">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path d="M172.5 131.1C228.1 75.51 320.5 75.51 376.1 131.1C426.1 181.1 433.5 260.8 392.4 318.3L391.3 319.9C381 334.2 361 337.6 346.7 327.3C332.3 317 328.9 297 339.2 282.7L340.3 281.1C363.2 249 359.6 205.1 331.7 177.2C300.3 145.8 249.2 145.8 217.7 177.2L105.5 289.5C73.99 320.1 73.99 372 105.5 403.5C133.3 431.4 177.3 435 209.3 412.1L210.9 410.1C225.3 400.7 245.3 404 255.5 418.4C265.8 432.8 262.5 452.8 248.1 463.1L246.5 464.2C188.1 505.3 110.2 498.7 60.21 448.8C3.741 392.3 3.741 300.7 60.21 244.3L172.5 131.1zM467.5 380C411 436.5 319.5 436.5 263 380C213 330 206.5 251.2 247.6 193.7L248.7 192.1C258.1 177.8 278.1 174.4 293.3 184.7C307.7 194.1 311.1 214.1 300.8 229.3L299.7 230.9C276.8 262.1 280.4 306.9 308.3 334.8C339.7 366.2 390.8 366.2 422.3 334.8L534.5 222.5C566 191 566 139.1 534.5 108.5C506.7 80.63 462.7 76.99 430.7 99.9L429.1 101C414.7 111.3 394.7 107.1 384.5 93.58C374.2 79.2 377.5 59.21 391.9 48.94L393.5 47.82C451 6.731 529.8 13.25 579.8 63.24C636.3 119.7 636.3 211.3 579.8 267.7L467.5 380z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>