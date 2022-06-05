<section class="section-wrapper">

</section>

<div class="cellier">
    <?php
    foreach ($data as $cle => $bouteille) {

    ?>
        <!-- * CR - DEB - MODIF * -->
        <div class="bouteille" data-quantite="">
            <div class="img">
                <img src="<?php echo $bouteille['image'] ?>">
            </div>
            <div class="description">
                <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
                <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                <p class="pays">Pays : <?php echo $bouteille['nom_pays'] ?></p>
                <p class="type">Catégorie : <?php echo $bouteille['nom_categorie'] ?></p>
                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
            </div>
            <div class="options" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                <button>Modifier</button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>

            </div>
        </div>
        <!-- * CR - FIN - MODIF -->
    <?php


    }

    ?>
</div>