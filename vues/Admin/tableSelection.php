<div>
    <span class="selection-nom-table" data-js-selection-nom-table></span>
</div>
<div class="vino-selection">
    <label for="selection-table-vino">Sélectionner la table à visualiser</label>
    <select id="selection-table-vino">
        <option value="vino__appellation">Appellation (<?= count($aAppellations) ?> lignes)</option>
        <option value="vino__bouteille">Bouteille (<?= count($aBouteilles) ?> lignes)</option>
        <option value="vino__cepage">Cepage (<?= count($aCepages) ?> lignes)</option>
        <option value="vino__classification">Classification (<?= count($aClassifications) ?> lignes)</option>
        <option value="vino__degre_alcool">Degré d'alcool (<?= count($aDegresAlcool) ?> lignes)</option>
        <option value="vino__designation">Désignation (<?= count($aDesignations) ?> lignes)</option>
        <option value="vino__format">Format (<?= count($aFormats) ?> lignes)</option>
        <option value="generique__pays">Pays (<?= count($aPays) ?> lignes)</option>
        <option value="vino__produit_du_quebec">Produit du Québec (<?= count($aProduitsQc) ?> lignes)</option>
        <option value="vino__region">Région (<?= count($aRegions) ?> lignes)</option>
        <option value="vino__taux_de_sucre">Taux de sucre (<?= count($aTauxDeSucre) ?> lignes)</option>
        <option value="vino__type_cellier">Type de cellier (<?= count($aTypesCellier) ?> lignes)</option>
        <option value="vino__type">Type de vin (<?= count($aTypesVin) ?> lignes)</option>
    </select>
    <button class="bouton-primaire btn-afficher-vino">Afficher la table</button>
</div>