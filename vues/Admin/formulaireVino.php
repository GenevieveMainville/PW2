<?php
$vino = new Vino();
$aColonnes = $vino->lireTable($nomTable);
$msgPasTrouve = "";

switch ($nomTable) {
    case 'vino__appellation':
        $msgPasTrouve = "Aucune appellation trouvée";
        break;

    case 'vino__cepage':
        $msgPasTrouve = "Aucun cépage trouvé";
        break;

    case 'vino__classification':
        $msgPasTrouve = "Aucune classification trouvée";
        break;

    case 'vino__appellation':
        $msgPasTrouve = "Aucune appellation trouvée";
        break;

    case 'vino__designation':
        $msgPasTrouve = "Aucune désignation trouvée";
        break;

    case 'vino__produit_du_quebec':
        $msgPasTrouve = "Aucun produit du Québec trouvé";
        break;

    case 'vino__region':
        $msgPasTrouve = "Aucune région trouvée";
        break;

    case 'vino__type_de_vin':
        $msgPasTrouve = "Aucune type de vin trouvé";
        break;

    default:
        $msgPasTrouve = "Aucun élément trouvé";
        break;
}
?>

<div>
    <div class="groupe-ajouter">
        <div class="btn-ajouter" title="Ajouter" data-js-btn-ajouter>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
            </svg>
        </div>
    </div>

    <div class="filtre-wrapper filtre-vino">
        <label for="filtre-table">Commencez à taper pour filtrer la table</label>
        <input type="text" id="filtre-table" class="filtre-table" placeholder="Rechercher..." title="Commencez à taper">
    </div>

    <div class="table-container">
        <table class="table-vino">
            <thead>
                <tr id="table-entete">
                    <th><span id="id" class="w3-button table-colonne">Id <i class="caret"></span></th>
                    <th><span id="nom" class="w3-button table-colonne">Nom <i class="caret"></span></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                $nbTrouve = count($aColonnes);

                if ($nbTrouve == 0) {
                ?>
                    <div>
                        <div class="err err-vino">
                            <?= $msgPasTrouve ?>
                        </div>
                    </div>
                    <?php
                } else {
                    foreach ($aColonnes as $uneColonne) {
                    ?>
                        <tr>
                            <td><?= $uneColonne["id"] ?></td>
                            <td><?= $uneColonne["nom"] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>