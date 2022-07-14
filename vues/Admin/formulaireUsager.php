<?php
$usager = new Usager();

$aUsagers = $usager->getAdminUsagers();
$aTypesUsager = $usager->lireTypesUsager();
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

    <div class="filtre-wrapper filtre-usager">
        <label for="filtre-table">Commencez à taper pour filtrer la table</label>
        <input type="text" id="filtre-table" class="filtre-table" placeholder="Rechercher..." title="Commencez à taper">
    </div>

    <div class="table-container">
        <table class="table-usager">
            <thead>
                <tr id="table-entete">
                    <th><span id="id_usager" class="w3-button table-colonne">Id de l'usager <i class="caret"></span></th>
                    <th><span id="nom_usager" class="w3-button table-colonne">Nom de l'usager <i class="caret"></span></th>
                    <th><span id="courriel_usager" class="w3-button table-colonne">Courriel <i class="caret"></span></th>
                    <th><span id="nom_utilisateur" class="w3-button table-colonne">Nom d'utilisateur <i class="caret"></span></th>
                    <th><span id="type_usager" class="w3-button table-colonne">Type d'usager <i class="caret"></span></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                $nbTrouve = count($aUsagers);

                if ($nbTrouve == 0) {
                ?>
                    <div>
                        <div class="err err-usager">
                            Aucun usager trouvé
                        </div>
                    </div>
                    <?php
                } else {
                    foreach ($aUsagers as $unUsager) {
                    ?>
                        <tr>
                            <td><?= $unUsager["id"] ?></td>
                            <td><?= $unUsager["nom"] ?></td>
                            <td><?= $unUsager["courriel"] ?></td>
                            <td><?= $unUsager["nom_utilisateur"] ?></td>
                            <td>
                                <?php
                                $valeur = "Aucun type d'utilisateur";

                                foreach ($aTypesUsager as $unTypeUsager) {
                                    if ($unUsager["type_utilisateur"] == $unTypeUsager['id']) {
                                        $valeur = $unTypeUsager['nom'];
                                    }
                                }

                                echo $valeur;
                                ?>
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