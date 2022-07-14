<section class="section-wrapper carte carte--bg-couleur" data-js-usager="<?php echo $id_usager?>">

    <!--ENTETE Titre et bouton (+)-->
    <div class="carte__entete-bouton">
        <h3 class="carte__entete"><?php echo $nom_cellier ?></h3>
            
            
        <input type="hidden" value="<?php echo $id_cellier; ?>" data-js-id-cellier>

        <!--BOUTON ajouter une nouvelle bouteille-->
        <a href="?requete=bouteille&id_cellier=<?php echo $id_cellier; ?>&nom_cellier=<?php echo $nom_cellier ?>">
            <i class="carte--aligne-centre"> 
                <svg class="carte__lien-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z" />
                </svg>
            </i>
        </a>
    </div>

    <!--RECHERCHE-->
    <div class="recherche-termes">
        <div class="recherche-termes__container">
            <input type="text" class="recherche-termes__donnees" data-js-termes placeholder="Nom, millesime, pays, region, type de vin, format ou cepage" title="Nom, millesime, pays, region, type de vin, format ou cepage">
            <div class="recherche-termes__boutons">
                <button class="bouton bouton-primaire" data-js-rechercher-bouteilles-cellier title="Rechercher parmi les bouteilles de ce cellier">Filtrer</button>
                <button class="bouton bouton-secondaire" data-js-recherche-avancee-bouteilles title="Rechercher parmi toutes les bouteilles">Recherche avancée</button>
            </div>
        </div>
        <p class="recherche-termes__note">Note: au moins 3 caractères; des chiffres et des lettres seulement; pas de mots composés; pas de caractères spéciaux</p>
    </div>

    <!--CARTE BOUTEILLE-->
    <div class="carte__contenant" data-js-carte-contenant>
        <?php
        if (isset($data)) {
            foreach ($data as $cle => $bouteille) {
        ?>

        <!--LIEN vers la fiche bouteille-->
        <a class="carte__lien" href="?requete=bouteille&id_bouteille=<?php echo $bouteille['id_bouteille']; ?>&id_cellier=<?php echo $id_cellier; ?>&nom_cellier=<?php echo $nom_cellier; ?>">
            <div class="carte__contenu" data-js-bouteille="<?php echo $bouteille['id_bouteille']; ?>">
                <div class="carte__lien carte--flex">
                    <!--IMAGE bouteille-->
                    <div class="carte__img">
                        <?php if($bouteille['image_bouteille']){ ?>

                        <img src="<?php echo $bouteille['image_bouteille']; ?>" alt="bouteille">
                        <?php }else{?>
                            <img src="./assets/img/default_bouteille.png">
                            <?php }?>
                    </div>

                    <!--DÉTAILS bouteille-->
                    <div class="carte__description">
                        <div>
                            <!--NOM - MILLESIME bouteille-->
                            <div class="carte--flex carte__titre">
                                <h4 class=""><?php echo $bouteille['nom_bouteille']; ?> - <?php echo $bouteille['millesime']; ?></h4>
                            </div>
                            <div>
                                <!--DESCRIPTION bouteille-->
                                <div class="carte__texte">
                                    <?php echo $bouteille['description_bouteille']; ?>
                                </div>
                                <!--DATE d'Achat-->
                                <div class="carte__texte">
                                    Acheté le <?php echo $bouteille['date_achat']; ?>
                                </div>
                                <!--PRIX bouteille-->
                                <div class="carte__texte">
                                    Au prix de <?php echo $bouteille['prix_bouteille']; ?>
                                </div>
                                <!--NOTE bouteille-->
                                <div class="carte__texte">
                                    Ma note est de <?php echo $bouteille['note']; ?>/5
                                </div>
                            </div>
                        </div>
                        <!--AJOUT OU BOIRE BOUTEILLE-->
                        <ul class="carte--haut">
                            <li class="carte--aligne-droite">
                                <form data-js-id="<?php echo $bouteille['id_bouteille']; ?>">
                                    <!--ICONE bouteille-->
                                    <i>
                                        <svg class="carte__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path d="M507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.25 6.254-6.251 16.38-.0006 22.63l-76.63 76.63c-46.63-19.75-102.4-10.75-140.4 27.25l-158.4 158.4c-25 25-25 65.51 0 90.51l90.51 90.52c25 25 65.51 25 90.51 0l158.4-158.4c38-38 47-93.76 27.25-140.4l76.63-76.63c6.25 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57zM179.3 423.2l-90.51-90.51l122-122l90.51 90.52L179.3 423.2z"></path>
                                        </svg>
                                    </i>
                                    <!--BOUTON Ajouter-->
                                    <button class="bouton btnAjouter">
                                        <i class="carte__icone-petit--espace">
                                            <svg class="carte__icone-petit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"></path>
                                            </svg>
                                        </i>
                                    </button>
                                    <!--QUANTITE bouteille-->
                                    <span data-js-quantite=""><?php echo $bouteille['quantite_bouteille']; ?></span>
                                    <!--BOUTON Boire-->
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
            };
        } else {
            ?>
            <p class="aucune-bouteille">Aucune bouteille trouvée</p>
        <?php
        }
        ?>
    </div>


</section>
<div class="carte__remp carte--bg-couleur "></div>

</section>

<script src="./js/rechercherBouteillesCellier.js" defer></script>