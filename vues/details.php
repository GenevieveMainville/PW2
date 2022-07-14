

<!--Page d'accueil non connecté-->
<?php
//    foreach ($product as $key => $value){
//        echo $key . " => ". $value."     -------      \n";
//    }
//    echo "Non". $product['prix'];

if (!isset($pays)) $pays = [];
if (!isset($bouteilles)) $bouteilles = [];
if (!isset($celliers)) $celliers = [];
if (!isset($usager_bouteille)) $usager_bouteille = [];
if (!isset($usager_celliers)) $usager_celliers = [];
if (!isset($regions)) $regions = [];
if (!isset($types)) $types = [];
if (!isset($formats)) $formats = [];
if (!isset($appellations)) $appellations = [];
if (!isset($designations)) $designations = [];
if (!isset($cepages)) $cepages = [];
if (!isset($taux_de_sucres)) $taux_de_sucres = [];
if (!isset($degre_alcools)) $degre_alcools = [];
if (!isset($produit_du_quebecs)) $produit_du_quebecs = [];
if (!isset($classifications)) $classifications = [];


$items = [
    'bouteilles' => $bouteilles,
    'celliers' => $celliers,
    'usager_celliers' => $usager_celliers,
    'pays' => $pays,
    'regions' => $regions,
    'types' => $types,
    'formats' => $formats,
    'appellations' => $appellations,
    'designations' => $designations,
    'cepages' => $cepages,
    'taux_de_sucres' => $taux_de_sucres,
    'degre_alcools' => $degre_alcools,
    'produit_du_quebecs' => $produit_du_quebecs,
    'classifications' => $classifications,
];

$form_values = [
    'id_bouteille'  => null,
    'id_cellier' => null,

    'nom_cellier' => null,
    'nom_bouteille' => null,
    'image_bouteille' => null,
    'description_bouteille' => null,
    'code_saq' => null,
    'code_cup' => null,
    'prix_bouteille' => null,
    'producteur' => null,
    'url_saq'=> null,

    'biodynamique' => false,
    'casher' => false,
    'desalcoolise' => false,
    'equitable' => false,
    'faible_taux_alcool'  => false,
    'produit_bio' => false,
    'vin_nature'  => false,
    'vin_orange'  => false,

    'pays_nom' => null,
    'region_nom' => null,
    'type_de_vin_nom' => null,
    'format_nom' => null,
    'appellation_nom'  => null,
    'designation_nom' => null,
    'cepage_nom' => null,
    'taux_de_sucre_nom'  => null,
    'degre_alcool_nom' => null,
    'produit_du_quebec_nom'  => null,
    'classification_nom'  => null,

    'pays_revision' => null,
    'region_revision' => null,
    'type_de_vin_revision' => null,
    'format_revision' => null,
    'appellation_revision' => null,
    'designation_revision' => null,
    'classification_revision' => null,
    'cepage_revision' => null,
    'taux_de_sucre_revision' => null,
    'degre_alcool_revision' => null,
    'produit_du_quebec_revision' => null,

    'date_achat' => null,
    'garde_jusqua' => null,
    'quantite' => null,
    'millesime' => null,
    'commentaires' => null,
    'note' => null,

    'celliers' => [
         'nom_cellier' => null,
         'quantite' => null
    ]
];

$erreur = "";



if(isset($bouteille) && isset($bouteille['id_bouteille']) && $bouteille != null && $bouteille['id_bouteille'] && strlen($bouteille['nom_bouteille'])){
    $form_values = $bouteille;
    
}else{
  
    $bouteille = null;
}

//print_r($celliers);
//echo "<br>";
//print_r($usager_bouteille[0]); die();
foreach ($celliers as & $cellier_dans_le_compte){
   
    foreach ($usager_bouteille as $ub){
        $nom_cellier = $cellier_dans_le_compte['nom_cellier'];
        if($cellier_dans_le_compte['id_cellier'] == $ub['id_cellier'] && $ub['id_bouteille'] == $bouteille['id_bouteille']){
            $cellier_dans_le_compte['quantite'] = $bouteille ? $ub['quantite_bouteille']: 0;
            $cellier_dans_le_compte['id_bouteille'] = $bouteille ? $ub['id_bouteille']: 0;
        }
    }
}

if(isset($form_values['image_bouteille']) && $form_values['image_bouteille'] != null){

    if(strpos($form_values['image_bouteille'], 'photos') !== false &&
        (substr($form_values['image_bouteille'], 0, 7) != "http://") &&
        (substr($form_values['image_bouteille'], 0, 8) != "https://")
    ){
        // Le cas d'une image local chargé depuis la gallerie
        $form_values['image_bouteille'] = home_base_url().$form_values['image_bouteille'];
    }
}


/*
// fonction pour récupérer l'url absolu
function home_base_url(){
    $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';

    $tmpURL = dirname(__FILE__);

    $tmpURL = str_replace(chr(92),'/',$tmpURL);
    $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
    $tmpURL = ltrim($tmpURL,'/');
    $tmpURL = rtrim($tmpURL, '/');
    if (strpos($tmpURL,'/')){
        $tmpURL = explode('/',$tmpURL);
        $tmpURL = $tmpURL[0];
    }
    if ($tmpURL !== $_SERVER['HTTP_HOST'])
        $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';
    else
        $base_url .= $tmpURL.'/';
    return $base_url;
}


*/
?>

<script src="./js/bouteille.js"  type="text/javascript"></script>
<script src="./js/autocomplete.js"  type="text/javascript"></script>
<!--<script src="./js/Celliers/celliers.js"  type="text/javascript"></script>-->
<!--<script src="./js/Celliers/NouveauCellier.js"  type="text/javascript"></script>-->
<!--<script type="module" src="./js/Celliers/celliers.js" defer></script>-->
<section class="section-wrapper">
    <h2 class="fiche--pb">Informations</h2>

    <?php if(isset($id_bouteille)  || isset($vino_id) ) {?>
        <?php if(!$bouteille) {?>
            <!--  Le cas d'un id de bouteille inntrouvable dans la base de données-->
            <div class="warrning-message">
                Cette bouteille est introuvable
                <?php if(isset($id_cellier)) {?>
                    dans ce cellier
                <?php } ?>
            </div>
        <?php }else{ ?>
            
            <!--  Le cas normal-->
            <!--   Le cas de la modification-->
            <div class="boite-double">
                <div class="boite-double__contenant-form">
                    <div class="product-photo">
                        <img src="<?php echo $form_values['image_bouteille']?>"
                             id="image_bouteille"
                             onerror="document.getElementById('image_bouteille').src = './assets/img/default_bouteille.png'; this.onerror=null;"
                             alt="degustation2">
                    </div>

                </div>
                <form class="formulaire info-details"  action="./controller/AjouterBouteille.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden"
                               name="nom_cellier"
                               value="<?php if(isset($nom_cellier))echo $nom_cellier?>"
                        />
                        <input type="hidden"
                               name="id_bouteille"
                               value="<?php echo $form_values['id_bouteille']?>"
                        />
                        <?php if(isset($id_cellier) && $id_cellier != null) {?>
                            <input type="hidden"
                                   name="id_cellier"
                                   value="<?php echo $id_cellier;?>"
                            />
                        <?php } ?>
                        <!--   block favoris-->

                        

                        <!-- Information sur la bouteille     -->
                        <div class="form-block">
                            <h4 class="fiche__titre">Informations sur la bouteille</h4>
                            <div class="star-container" data-js-etoiles  >
                                    <?php
                                    $note = $form_values['note'];
                                    for($i = 1; $i <= 5; $i++) {
                                        if($i <= $note) { ?>
                                            <span class="star_rated note-input "
                                                  onclick="ratestar(<?php echo $i; ?>, <?php echo $form_values['id_bouteille']?>, <?php echo $form_values['id_cellier']?>)">
                                                &#x2605;
                                            </span>
                                        <?php } else {  ?>
                                            <span
                                                  onclick="ratestar(<?php echo $i; ?>, <?php echo $form_values['id_bouteille']?>, <?php echo $form_values['id_cellier']?>)"
                                                  class="note-input">
                                                &#x2605;
                                            </span>
                                        <?php  }
                                    }
                                    echo '('.$note.'/5)'; ?>
                                </div>
                            <?php if($form_values['id_cellier']) { ?>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Cellier</div>
                                        <div class="value">
                                            <?php echo $form_values['nom_cellier']  ?: 'Non défini'?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--INFOS-->
                            <div>
                                <div class="row-f">
                                    <div class="col info-unit">
                                        <input type="hidden" value="<?php echo $form_values['id_bouteille']?>" name="id_bouteille"/>
                                        <div class="label">Nom de la bouteille(*)</div>
                                        <div class="value label-state" style="<?php if(!isset($id_bouteille)) echo 'display: unset'?>">
                                            <?php echo ($form_values['nom_bouteille'] ?: 'Non défini') ?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="bouteilles"
                                                required
                                                value="<?php echo $form_values['nom_bouteille']?>"
                                                placeholder="Sélectionner ici"
                                                data-js-bouteille-select
                                                class="input select formulaire__champs boite-double__champs"
                                                name="nom_bouteille" id="id_bouteille" >

                                            <datalist id="bouteilles">
                                                <?php foreach ($bouteilles as $element){ ?>
                                                <option value="<?php echo $element['nom_bouteille'] ?>">
                                                    <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Type(*)</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['type_de_vin_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="types"
                                                required
                                                placeholder="Sélectionner ici"
                                                value="<?php echo $form_values['type_de_vin_nom']?>"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="type_de_vin_nom" id="type_de_vin_nom" >

                                            <datalist id="types">
                                                <?php foreach ($types as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Cepages</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['cepage_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="cepages"
                                                placeholder="Sélectionner ici"
                                                value="<?php echo $form_values['cepage_nom']?>"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="cepage_nom" id="cepage_nom" >

                                            <datalist id="cepages">
                                                <?php foreach ($cepages as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Pays(*)</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['pays_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="pays"
                                                required
                                                placeholder="Sélectionner ici"
                                                value="<?php echo $form_values['pays_nom']?>"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="pays_nom" id="pays_nom">

                                            <datalist id="pays">
                                                <?php foreach ($pays as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Region(*)</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['region_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="regions"
                                                required
                                                value="<?php echo $form_values['region_nom']?>"
                                                placeholder="Sélectionner ici"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="region_nom" id="region_nom" >

                                            <datalist id="regions">
                                                <?php foreach ($regions as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Millésime</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['millesime']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="text"
                                                value="<?php echo $form_values['millesime']?>"
                                                placeholder="Sélectionner ici"
                                                class="input formulaire__champs boite-double__champs"
                                                name="millesime"
                                                id="millesime" />
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Degre d'alcool</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['degre_alcool_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="degre_alcools"
                                                value="<?php echo $form_values['degre_alcool_nom']?>"
                                                placeholder="Sélectionner ici"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="degre_alcool_nom" id="degre_alcool_nom" />

                                            <datalist id="degre_alcools">
                                                <?php foreach ($degre_alcools as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Date d'achat</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['date_achat']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="date"
                                                value="<?php echo $form_values['date_achat']?>"
                                                placeholder="Sélectionner ici"
                                                class="input formulaire__champs boite-double__champs"
                                                name="date_achat"
                                                id="date_achat" />
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Garder jusqu'à</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['garde_jusqua']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="date"
                                                value="<?php echo $form_values['garde_jusqua']?>"
                                                placeholder="Sélectionner ici"
                                                class="input formulaire__champs boite-double__champs"
                                                name="garde_jusqua"
                                                id="garde_jusqua" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                <div class="col-6 info-unit">
                                        <div class="label">Format(*)</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['format_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="formats"
                                                required
                                                placeholder="Sélectionner ici"
                                                value="<?php echo $form_values['format_nom']?>"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="format_nom" id="format_nom" >

                                            <datalist id="formats">
                                                <?php foreach ($formats as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                <div class="col-6 info-unit">
                                        <div class="label">Prix(*)</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['prix_bouteille']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="text" name="prix_bouteille"
                                                required
                                                value="<?php echo $form_values['prix_bouteille']?>"
                                                class="input formulaire__champs boite-double__champs"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            
                            <!--Général-->
                            <h4 data-js-fichetitre class=" titre__tiroir">INFORMATIONS GÉNÉRALES
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Producteur</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['producteur']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="text" name="producteur"
                                                    value="<?php echo $form_values['producteur']?>"
                                                    class="input formulaire__champs boite-double__champs"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Appellation</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['appellation_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="appellations"
                                                    placeholder="Sélectionner ici"
                                                    value="<?php echo $form_values['appellation_nom']?>"
                                                    class="input select formulaire__champs boite-double__champs"
                                                    name="appellation_nom" id="appellation_nom" >

                                            <datalist id="appellations">
                                                <?php foreach ($appellations as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Designation</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['designation_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="designations"
                                                    placeholder="Sélectionner ici"
                                                    value="<?php echo $form_values['designation_nom']?>"
                                                    class="input select formulaire__champs boite-double__champs"
                                                    name="designation_nom" id="designation_nom" >

                                            <datalist id="designations">
                                                <?php foreach ($designations as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Classification</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['classification_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="classifications"
                                                    value="<?php echo $form_values['classification_nom']?>"
                                                    placeholder="Sélectionner ici"
                                                    class="input select formulaire__champs boite-double__champs"
                                                    name="classification_nom" id="classification_nom" />

                                            <datalist id="classifications">
                                                <?php foreach ($classifications as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Taux de sucre(*)</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['taux_de_sucre_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="taux_de_sucres"
                                                placeholder="Sélectionner ici"
                                                required
                                                value="<?php echo $form_values['taux_de_sucre_nom']?>"
                                                class="input select formulaire__champs boite-double__champs"
                                                name="taux_de_sucre_nom" id="taux_de_sucre_nom" />

                                            <datalist id="taux_de_sucres">
                                                <?php foreach ($taux_de_sucres as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Produit du quebec</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['produit_du_quebec_nom']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input list="produit_du_quebecs"
                                                    placeholder="Sélectionner ici"
                                                    value="<?php echo $form_values['produit_du_quebec_nom']?>"
                                                    class="input select formulaire__champs boite-double__champs"
                                                    name="produit_du_quebec_nom" id="produit_du_quebec_nom" />

                                            <datalist id="produit_du_quebecs">
                                                <?php foreach ($produit_du_quebecs as $element){ ?>
                                                    <option><?php echo $element['nom'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--IMAGE ET CUP-->
                            <h4 data-js-fichetitre class="titre__tiroir">IMAGE ET CUP
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Code cup</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['code_cup']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="text" name="code_cup"
                                                    value="<?php echo $form_values['code_cup']?>"
                                                    class="input formulaire__champs boite-double__champs"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit fiche--textb">
                                        <div class="label">Url de l'image de la bouteille</div>
                                        <div class="value label-state fiche--flex">
                                            <?php echo $form_values['image_bouteille']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <div class="">
                                       
                                            <div class="value fiche--flex">
                                                <input type="text" name="image_bouteille"
                                                    value="<?php echo $form_values['image_bouteille']?>"
                                                    class="input formulaire__champs boite-double__champs"
                                                    placeholder="Saisir ici">
                                                     <input type="file" style="display: none;" id="id" name="photo">
                                             
                                                   <label for="id" class="fiche--aligne-b"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/></svg></label>
                                            </div>
            
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!--Particularité-->
                            <h4 data-js-fichetitre class="titre__tiroir">PARTICULARITÉS
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Biodynamique</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['biodynamique']) && $form_values['biodynamique'] != null? ($form_values['biodynamique'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state"><input type="checkbox" name="biodynamique"
                                                                                value="<?php echo $form_values['biodynamique']?>"
                                                <?php if ($form_values['biodynamique']) echo "checked='checked'"; ?>
                                                                                class="checkbox"
                                                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Casher</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['casher']) && $form_values['casher'] != null? ($form_values['casher'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state"><input type="checkbox" name="casher"
                                                                                value="<?php echo $form_values['casher']?>"
                                                <?php if ($form_values['casher']) echo "checked='checked'"; ?>
                                                                                class="checkbox"
                                                                                placeholder="Saisir ici">
                                        </div>
                                    </div>

                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Desalcoolise</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['desalcoolise']) && $form_values['desalcoolise'] != null? ($form_values['desalcoolise'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="checkbox" name="desalcoolise"
                                                    value="<?php echo $form_values['desalcoolise']?>"
                                                <?php if ($form_values['desalcoolise']) echo "checked='checked'"; ?>
                                                    class="checkbox"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Equitable</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['equitable']) && $form_values['equitable'] != null? ($form_values['equitable'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="checkbox" name="equitable"
                                                    value="<?php echo $form_values['equitable']?>"
                                                <?php if ($form_values['equitable']) echo "checked='checked'"; ?>
                                                    class="checkbox"  placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Faible taux alcool</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['faible_taux_alcool']) && $form_values['faible_taux_alcool'] != null? ($form_values['faible_taux_alcool'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state"><input type="checkbox" name="faible_taux_alcool"
                                                                                value="<?php echo $form_values['faible_taux_alcool']?>"
                                                <?php if ($form_values['faible_taux_alcool']) echo "checked='checked'"; ?>
                                                                                class="checkbox"
                                                                                placeholder="Saisir ici"></div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Produit bio</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['produit_bio']) && $form_values['produit_bio'] != null? ($form_values['produit_bio'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="checkbox" name="produit_bio"
                                                    value="<?php echo $form_values['produit_bio']?>"
                                                <?php if ($form_values['produit_bio']) echo "checked='checked'"; ?>
                                                    class="checkbox"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Vin nature</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['vin_nature']) && $form_values['vin_nature'] != null? ($form_values['vin_nature'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="checkbox" name="vin_nature"
                                                    value="<?php echo $form_values['vin_nature']?>"
                                                <?php if ($form_values['vin_nature']) echo "checked='checked'"; ?>
                                                    class="checkbox"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Vin orange</div>
                                        <div class="value label-state">
                                            <?php echo isset($form_values['vin_orange']) && $form_values['vin_orange'] != null? ($form_values['vin_orange'] ? 'Oui': 'Non')  : 'Non défini'?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="checkbox" name="vin_orange"
                                                    value="<?php echo $form_values['vin_orange']?>"
                                                <?php if ($form_values['vin_orange']) echo "checked='checked'"; ?>
                                                    class="checkbox"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--INFORMATION SAQ-->
                            <h4 data-js-fichetitre class="titre__tiroir">INFORMATIONS SAQ
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Code saq</div>
                                        <div class="value label-state">
                                            <?php echo $form_values['code_saq']  ?: 'Non défini'?>
                                        </div>
                                        <div class="value input-state"><input type="text" name="code_saq"
                                                                            value="<?php echo $form_values['code_saq']?>"
                                                                            class="input formulaire__champs boite-double__champs"
                                                                            placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit fiche--textb">
                                        <div class="label">Url saq</div>
                                        <div class="value label-state">
                                            <?php if($form_values['url_saq'] )  { ?>
                                                <a href="<?php echo $form_values['url_saq']  ?>" target="_blank"><?php echo $form_values['url_saq']; ?></a>
                                            <?php } else { echo 'Non défini' ;}?>
                                        </div>
                                        <div class="value input-state">
                                            <input type="text" name="url_saq"
                                                    value="<?php echo $form_values['url_saq']?>"
                                                    class="input formulaire__champs boite-double__champs"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--COMMENTAIRES-->
                            <h4 data-js-fichetitre class="titre__tiroir">COMMENTAIRES
                                 <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                 <input type="hidden" name="estCommentaire" value="1" />
                                 <div class='info-details info-unit'>
                                        <div class="comment">
                                        
                                    
                                        <div class="comment-body">
                                            <div class="comment-header input-state" style="display: none;">
                                                <div class="  d-flex" >
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;
                                                    <h5>Ajouter ou modifier un commentaire</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-text new-comment">
                                            <textarea placeholder='Ajouter un nouveau commentaire'
                                                        row-fs="4"
                                                        name="commentaires"
                                                        class="input formulaire__champs boite-double__champs input-state" ><?php echo $form_values['commentaires']?></textarea>
                                            <p class=" label-state">
                                                <?php if(isset($form_values['commentaires'])){
                                                    echo $form_values['commentaires'] ;
                                                }else{ ?>
                                                    Aucun commentaire
                                                <?php }?>
                                            </p>
<!--                                                -->
                                              
                                        </div>
                                        <input type="hidden"
                                            name="id_bouteille"
                                            id="id_bouteille"
                                            value="<?php echo $form_values['id_bouteille']?>" />
                                        <input type="hidden"
                                            name="id_cellier"
                                            id="id_cellier"
                                            value="<?php echo $form_values['id_cellier']?>" />
                                    </div>    
                                    </div>
                            </div>


                            <div class="fiche--bordure">
                               <div class="row-f fiche--mt">
                                   <div class=" info-unit icon-btn
                                    <?php echo isset($form_values['favori_bouteille']) && $form_values['favori_bouteille']
                                       ? "active-icon-btn": ""; ?>"
                                        onclick="modifierFavoris(<?php echo isset($form_values['favori_bouteille']) && $form_values['favori_bouteille'] ? 0: 1; ?>,
                                        <?php echo isset($id_bouteille) ? $id_bouteille: 0; ?>,
                                        <?php echo isset($form_values['id_cellier']) ? $form_values['id_cellier']: 0; ?>,
                                        <?php echo isset($vino_id) ? $vino_id: 0; ?>)"
                                   >
                                       <i class="fa fa-heart" aria-hidden="true"></i>&nbsp;
                                       <?php echo isset($form_values['favori_bouteille']) && $form_values['favori_bouteille']
                                           ? "Favoris": "Ajouter au favoris"; ?>
                                   </div>
                                   <div class="info-unit icon-btn
                                    <?php echo isset($form_values['essayer_bouteille']) && $form_values['essayer_bouteille']
                                       ? "active-icon-btn": ""; ?>"
                                        onclick="modifierAEssayer( <?php echo isset($form_values['essayer_bouteille']) && $form_values['essayer_bouteille'] ? 0: 1; ?>,
                                        <?php echo isset($id_bouteille) ? $id_bouteille: 0; ?>,
                                        <?php echo isset($form_values['id_cellier']) ? $form_values['id_cellier']: 0; ?>,
                                        <?php echo isset($vino_id) ? $vino_id: 0; ?>)"
                                   >
                                       <i class="fa fa-beer" aria-hidden="true"></i>&nbsp;
                                       <?php echo isset($form_values['essayer_bouteille']) && $form_values['essayer_bouteille']
                                           ? "A déguster": "A déguster"; ?>
                                   </div>
                                   <div class=" info-unit icon-btn
                                    <?php echo isset($form_values['achat_bouteille']) && $form_values['achat_bouteille']
                                       ? "active-icon-btn": ""; ?>"
                                        onclick="modifierAAcheter(<?php echo isset($form_values['achat_bouteille']) && $form_values['achat_bouteille'] ? 0: 1; ?>,
                                        <?php echo isset($id_bouteille) ? $id_bouteille: 0; ?>,
                                        <?php echo isset($form_values['id_cellier']) ? $form_values['id_cellier']: 0; ?>,
                                        <?php echo isset($vino_id) ? $vino_id: 0; ?>)"
                                   >
                                       <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;
                                       <?php echo isset($form_values['achat_bouteille']) && $form_values['achat_bouteille']
                                           ? "A acheter": "Ajouter à la liste d'achat"; ?>
                                   </div>
                               </div>
                               <div class="">
                            
                            <div id="button_share">

                                <div class="row-f  fiche--bordure">
                                    <h6 class="info-details info-unit">Partager sur les réseaux sociaux</h6>
                                    <div class="info-unit icon-btn">
                                        <!-- Facebook  -->
                                        <a id="shareFacebook" href="http://www.facebook.com/sharer.php?u=" target="_blank">
                                            <svg class="share-social-media" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48A48 48 0 0 0 0 80v352a48 48                                                                     0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52                                                               4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"/></svg>
                                        </a>&nbsp;&nbsp;
                                        <!-- Twitter -->
                                        <a id="shareTwitter" href="" target="_blank">
                                            <svg class="share-social-media" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5                                                21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-48.9 158.8c.2 2.8.2 5.7.2 8.5 0 86.7-66 186.6-186.6 186.6-37.2                                                      0-71.7-10.8-100.7-29.4 5.3.6 10.4.8 15.8.8 30.7 0 58.9-10.4 81.4-28-28.8-.6-53-19.5-61.3-45.5 10.1 1.5 19.2 1.5                                                                     29.6-1.2-30-6.1-52.5-32.5-52.5-64.4v-.8c8.7 4.9 18.9 7.9 29.6 8.3a65.447 65.447 0 0 1-29.2-54.6c0-12.2 3.2-23.4                                                                     8.9-33.1 32.3 39.8 80.8 65.8 135.2 68.6-9.3-44.5 24-80.6 64-80.6 18.9 0 35.9 7.9 47.9 20.7 14.8-2.8 29-8.3 41.6-15.8-4.9                                                                15.2-15.2 28-28.8 36.1 13.2-1.4 26-5.1 37.8-10.2-8.9 13.1-20.1  24.7-32.9 34z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                           </div>
                           
                     
                        </div>
                                                   <!--            Information liées au cellier-->
                        <div class="form-block" >
                            <h4 class="fiche__titre">Quantité à ajuster</h4>
                            <?php if($celliers && is_array($celliers) && count($celliers)>0) {?>
                                <?php $key = 0; foreach ($celliers as $cellier) {?>
                                    <div class="row-f-r">
                                        <div class="col-6 info-unit">
                                            <div class="fiche--pb">Cellier</div>
                                            <div class="value">
                                                <input type="hidden" value="<?php echo $cellier['id_cellier'] ?>"
                                                       name="celliers<?php echo "[".$key."]"?>[id_cellier]"/>
                                                <input type="hidden" value="<?php if(isset($cellier['id_bouteille'])) echo $cellier['id_bouteille'] ?>"
                                                       name="celliers<?php echo "[".$key."]"?>[id_bouteille]"/>
                                                <?php echo $cellier['nom_cellier']  ?: 'Non défini'?>
                                                <?php echo  $cellier['nom_cellier'] && $cellier['id_cellier'] === $id_cellier ? '(Cellier actuel)': ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-6 info-unit ">
                                            <div class="fiche--pb">Quantité(*)</div>
                                            <div class="value label-state">
                                                <?php echo isset($cellier['quantite'])  ? $cellier['quantite'] : '0'?>
                                            </div>
                                            <div class="value input-state">
                                                <input type="number"
                                                       required
                                                       min="0"
                                                       name="celliers<?php echo "[".$key."]"?>[quantite]"
                                                       value="<?php echo(isset($cellier['quantite']) ? $cellier['quantite'] : 0) ?>"
                                                       class="input "
                                                       placeholder="Saisir ici"></div>
                                        </div>
                                    </div>
                                    <?php $key++; } ?>
                                </div>

                            <?php } else { ?>
                                <div  class="empty-state-message">Il semble que vous n'avez aucun cellier pour le moment</div>
                                <div  class="empty-state-message">
                                    cliquer ici pour ajouter un nouveau cellier
                                </div>
                                    <div class="empty-state-message">
                                        <i class="carte--aligne-centre" >
                                        <svg data-js-nouveaucellier class="carte__lien-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 256C0 114.6                                                  114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280                                                        344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232                                                        168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg>
                                        </i>
                                    </div>
                                </div>
                            <?php }  ?>
                       </div>




                        <div class="row-f submit-bloc fiche--fe">
                     <?php if((isset($id_bouteille) && $id_bouteille != null) || isset($vino_id)) {  ?>
                     
                            <div >
                                    <div id="submit_btns" class="submit_btns">
                                        <button class="bouton-secondaire bouton-danger" type="button" id="askDeleteBtn"
                                                style="display:  <?php if(!$form_values['id_cellier'] || !$form_values['id_bouteille'] || $form_values['vino_id']) {echo "none";}?>"
                                            >Détruire</button>
                                            <?php if(!empty($celliers)) {?>
                                        <button class="bouton-secondaire" type="button" id="ouvrirFormulaire"
                                        >Modifier</button>
                                    </div>
                                     <?php } ?>  
                            </div>
                            <div  >

                                <div  class="submit_btns">
                                    <button class="bouton-primaire" type="button" id="fermerFormulaire"
                                    >Annuler</button>
                                    <button class="bouton-secondaire" id="enregistrerFormulaire">Enregistrer</button>
                                </div>
                            </div>
                        <?php }?>
                        </div> 
                    </form>
          
            </div>
        <?php } ?>
    <?php }else{ ?>
<!--    Le cas d'ajout d'une nouvelle bouteille-->
        <div class="boite-double">
            <div class="boite-double__contenant-form">
                <div class="product-photo">
                    <img src="<?php echo $form_values['image_bouteille']?>"
                         id="image_bouteille"
                         onerror="document.getElementById('image_bouteille').src ='./assets/img/default_bouteille.png'; this.onerror=null;"
                         alt="degustation2">
                </div>
            </div>
            <form class="formulaire info-details"  action="./controller/AjouterBouteille.php" method="POST" enctype="multipart/form-data">

                <?php if(isset($id_cellier) && $id_cellier != null) {?>
                    <input type="hidden"
                           name="id_cellier"
                           value="<?php echo $id_cellier;?>"
                    />
                <?php } ?>
                <div class="form-block">
                    <h4 class="fiche__titre">Informations sur la bouteille</h4>
<!--INFOS-->
                    <div class="row-f">
                        <div class="col info-unit">
                            <div class="label">Nom de la bouteille(*)</div>
                            <div class="value">
                                <input list="bouteilles"
                                       value="<?php echo $form_values['nom_bouteille']?>" 
                                       placeholder="Sélectionner ici"
                                       required
                                       data-js-bouteille-select
                                       class="input select formulaire__champs boite-double__champs"
                                       name="nom_bouteille" id="id_bouteille" >

                                <datalist id="bouteilles">
                                    <?php foreach ($bouteilles as $element){ ?>
                                    <option value="<?php echo $element['nom_bouteille'] ?>">
                                        <?php } ?>
                                </datalist>
                            </div>
                        </div>
                         
                    </div>
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Type(*)</div>
                            <div class="value">
                                <input list="types"
                                       required
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['type_de_vin_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="type_de_vin_nom" id="type_de_vin_nom" >

                                <datalist id="types">
                                    <?php foreach ($types as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Cepages</div>
                            <div class="value">
                                <input list="cepages"
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['cepage_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="cepage_nom" id="cepage_nom" >

                                <datalist id="cepages">
                                    <?php foreach ($cepages as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Pays(*)</div>
                            <div class="value">
                                <input list="pays"
                                       required
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['pays_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="pays_nom" id="pays_nom">

                                <datalist id="pays">
                                    <?php foreach ($pays as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Region(*)</div>
                            <div class="value">
                                <input list="regions"
                                       required
                                       value="<?php echo $form_values['region_nom']?>"
                                       placeholder="Sélectionner ici"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="region_nom" id="region_nom" >

                                <datalist id="regions">
                                    <?php foreach ($regions as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Millésime</div>
                            <div class="value">
                                <input type="text"
                                        value="<?php echo $form_values['millesime']?>"
                                        placeholder="Sélectionner ici"
                                        class="input formulaire__champs boite-double__champs"
                                        name="millesime" id="millesime" />
                            </div>
                        </div>
                        
                        <div class="col-6 info-unit">
                            <div class="label">Degre d'alcool</div>
                            <div class="value">
                                <input list="degre_alcools"
                                       value="<?php echo $form_values['degre_alcool_nom']?>"
                                       placeholder="Sélectionner ici"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="degre_alcool_nom" id="degre_alcool_nom" />

                                <datalist id="degre_alcools">
                                    <?php foreach ($degre_alcools as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Date d'achat</div>
                            <div class="value">
                                <input type="date"
                                        value="<?php echo $form_values['date_achat']?>"
                                        placeholder="Sélectionner ici"
                                        class="input formulaire__champs boite-double__champs"
                                        name="date_achat" id="date_achat" />
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Garder jusqu'à</div>
                            <div class="value">
                                <input type="date"
                                        value="<?php echo $form_values['garde_jusqua']?>"
                                        placeholder="Sélectionner ici"
                                        class="input formulaire__champs boite-double__champs"
                                        name="garde_jusqua" id="garde_jusqua" />
                            </div>
                        </div>
                    </div>
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Format(*)</div>
                            <div class="value">
                                <input list="formats"
                                       required
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['format_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="format_nom" id="format_nom" >

                                <datalist id="formats">
                                    <?php foreach ($formats as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Prix(*)</div>
                            <div class="value">
                                <input type="text"
                                       name="prix_bouteille"
                                       required
                                       value="<?php echo $form_values['prix_bouteille']?>"
                                       class="input formulaire__champs boite-double__champs"
                                       placeholder="Saisir ici">
                            </div>
                        </div>
                    </div>

<!--Général-->
                <h4 data-js-fichetitre class=" titre__tiroir">INFORMATIONS GÉNÉRALES
                    <div>&#43;</div>
                </h4>
                <div class="tiroir-off">
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Producteur</div>
                            <div class="value">
                                <input type="text" name="producteur"
                                       value="<?php echo $form_values['producteur']?>"
                                       class="input formulaire__champs boite-double__champs"
                                       placeholder="Saisir ici">
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Appellation</div>
                            <div class="value">
                                <input list="appellations"
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['appellation_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="appellation_nom" id="appellation_nom" >

                                <datalist id="appellations">
                                    <?php foreach ($appellations as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Designation</div>
                            <div class="value">
                                <input list="designations"
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['designation_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="designation_nom" id="designation_nom" >

                                <datalist id="designations">
                                    <?php foreach ($designations as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Classification</div>
                            <div class="value">
                                <input list="classifications"
                                       value="<?php echo $form_values['classification_nom']?>"
                                       placeholder="Sélectionner ici"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="classification_nom" id="classification_nom" />

                                <datalist id="classifications">
                                    <?php foreach ($classifications as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row-f">
                        <div class="col-6 info-unit">
                            <div class="label">Taux de sucre</div>
                            <div class="value">
                                <input list="taux_de_sucres"
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['taux_de_sucre_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="taux_de_sucre_nom" id="taux_de_sucre_nom" />

                                <datalist id="taux_de_sucres">
                                    <?php foreach ($taux_de_sucres as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-6 info-unit">
                            <div class="label">Produit du quebec</div>
                            <div class="value">
                                <input list="produit_du_quebecs"
                                       placeholder="Sélectionner ici"
                                       value="<?php echo $form_values['produit_du_quebec_nom']?>"
                                       class="input select formulaire__champs boite-double__champs"
                                       name="produit_du_quebec_nom" id="produit_du_quebec_nom" />

                                <datalist id="produit_du_quebecs">
                                    <?php foreach ($produit_du_quebecs as $element){ ?>
                                        <option><?php echo $element['nom'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    
                </div>

<!--IMAGE ET CUP-->
                            <h4 data-js-fichetitre class="titre__tiroir">IMAGE ET CUP
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Code cup</div>
                                        <div class="value">
                                            <input type="text" name="code_cup"
                                                value="<?php echo $form_values['code_cup']?>"
                                                class="input formulaire__champs boite-double__champs"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Url de l'image de la bouteille</div>
                                            <div class="value fiche--flex">
                                                <input type="text" name="image_bouteille"
                                                    value="<?php echo $form_values['image_bouteille']?>"
                                                    class="input formulaire__champs boite-double__champs"
                                                    placeholder="Saisir ici">
                                                     <input type="file" style="display: none;" id="id" name="photo">
                                             
                                                   <label for="id" class="fiche--aligne-b"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/></svg></label>
                                            </div>
                                            <div class="value"style="margin-top: 10px;">
                                         
                                               
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                
            <!--Particularité-->
                            <h4 data-js-fichetitre class="titre__tiroir">PARTICULARITÉS
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Biodynamique</div>
                                        <div class="value">
                                            <input type="checkbox" name="biodynamique"
                                                value="<?php echo $form_values['biodynamique']?>"
                                                <?php if ($form_values['biodynamique']) echo "checked='checked'"; ?>
                                                    class="checkbox"
                                                    placeholder="Saisir ici">
                                        </div>
                                    </div>    
                                    <div class="col-6 info-unit">
                                        <div class="label">Casher</div>
                                        <div class="value">
                                            <input type="checkbox" name="casher"
                                                value="<?php echo $form_values['casher']?>"
                                                <?php if ($form_values['casher']) echo "checked='checked'"; ?>
                                                class="checkbox"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Desalcoolise</div>
                                        <div class="value">
                                            <input type="checkbox" name="desalcoolise"
                                                value="<?php echo $form_values['desalcoolise']?>"
                                                <?php if ($form_values['desalcoolise']) echo "checked='checked'"; ?>
                                                class="checkbox"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Equitable</div>
                                        <div class="value">
                                            <input type="checkbox" name="equitable"
                                                value="<?php echo $form_values['equitable']?>"
                                                <?php if ($form_values['equitable']) echo "checked='checked'"; ?>
                                                class="checkbox"  placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Faible taux alcool</div>
                                        <div class="value"><input type="checkbox" name="faible_taux_alcool"
                                                                            value="<?php echo $form_values['faible_taux_alcool']?>"
                                                <?php if ($form_values['faible_taux_alcool']) echo "checked='checked'"; ?>
                                                                            class="checkbox"
                                                                            placeholder="Saisir ici"></div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Produit bio</div>
                                        <div class="value">
                                            <input type="checkbox" name="produit_bio"
                                                value="<?php echo $form_values['produit_bio']?>"
                                                <?php if ($form_values['produit_bio']) echo "checked='checked'"; ?>
                                                class="checkbox"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>                                
                                </div>
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Vin nature</div>
                                        <div class="value">
                                            <input type="checkbox" name="vin_nature"
                                                value="<?php echo $form_values['vin_nature']?>"
                                                <?php if ($form_values['vin_nature']) echo "checked='checked'"; ?>
                                                class="checkbox"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Vin orange</div>
                                        <div class="value">
                                            <input type="checkbox" name="vin_orange"
                                                value="<?php echo $form_values['vin_orange']?>"
                                                <?php if ($form_values['vin_orange']) echo "checked='checked'"; ?>
                                                class="checkbox"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                    <!--INFORMATION SAQ-->
                            <h4 data-js-fichetitre class="titre__tiroir">INFORMATIONS SAQ
                                <div>&#43;</div>
                            </h4>
                            <div class="tiroir-off">
                                <div class="row-f">
                                    <div class="col-6 info-unit">
                                        <div class="label">Code saq</div>
                                        <div class="value ">
                                            <input type="text" name="code_saq"
                                            value="<?php echo $form_values['code_saq']?>"
                                            class="input formulaire__champs boite-double__champs"
                                            placeholder="Saisir ici">
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit fiche--textb">
                                        <div class="label">Url saq</div>
                                        <div class="value">
                                            <input type="text" name="url_saq"
                                                value="<?php echo $form_values['url_saq']?>"
                                                class="input formulaire__champs boite-double__champs"
                                                placeholder="Saisir ici">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                </div>

                
                    <div class="form-block" >
                        <h4 class="fiche__titre">Quantité à ajouter</h4>

                        <div class="row-f">
                            
                            <?php if(isset($id_cellier) && $id_cellier!=null) {?>
                                <div class="col-6 info-unit">
                                    <div class="label">Quantité(*)</div>
                                    <div class="value">
                                        <input type="hidden" name="celliers[0][id_cellier]"
                                               value="<?php echo $id_cellier?>"
                                        />
                                        <input type="number"
                                               required
                                               min="0"
                                               value="<?php echo $form_values['quantite']?>"
                                               placeholder="Sélectionner ici"
                                               class="input formulaire__champs boite-double__champs"
                                               name="celliers[0][quantite]"
                                               id="quantite" />
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if(!isset($id_cellier) || !$id_cellier) {?>
                        <?php if($celliers && is_array($celliers) && count($celliers)>0) {?>
                            <?php $key = 0; foreach ($celliers as $cellier) {?>
                                <div class="row-f-r">
                                    <div class="col-6 info-unit">
                                        <div class="label">Cellier</div>
                                        <div class="value fiche--pt">
                                            <input type="hidden" value="<?php echo $cellier['id_cellier'] ?>"
                                                   name="celliers<?php echo "[".$key."]"?>[id_cellier]"
                                            />
                                            <input type="hidden" value="<?php if(isset($cellier['id_bouteille'])) echo $cellier['id_bouteille'] ?>"
                                                   name="celliers<?php echo "[".$key."]"?>[id_bouteille]"/>
                                            <?php echo $cellier['nom_cellier']  ?: 'Non défini'?>
                                        </div>
                                    </div>
                                    <div class="col-6 info-unit">
                                        <div class="label">Quantité(*)</div>
                                        <div class="value">
                                            <input type="number"
                                                   required
                                                   min="0"
                                                   name="celliers<?php echo "[".$key."]"?>[quantite]"
                                                   value="0"
                                                   class="input formulaire__champs boite-double__champs"
                                                   placeholder="Saisir ici"></div>
                                    </div>
                                </div>
                                <?php $key++; } ?>
                        <?php } else { ?>
                            <div class="empty-state-message">Il semble que vous n'avez aucun cellier pour le moment</div>
                            <div  class="empty-state-message">
                                cliquer ici pour ajouter un nouveau cellier
                            </div>
                            <div class="empty-state-message">
                                <i class="carte--aligne-centre" >
                                    <svg data-js-nouveaucellier class="carte__lien-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg>
                                </i>
                            </div>
                        <?php } ?>
                    </div>
                <?php }?>

                
                </div>

                <div class="row-f submit-bloc fiche--fe">
                    <div class="col-6 info-unit">
                    </div>
                    <div class="col-6 " >
                    <?php if(!empty($celliers)) {?>
                            <button class="bouton-primaire" type="button" id="fermerFormulaire" >Annuler</button>

                            <button class="bouton-secondaire">Enregistrer</button>
                    <?php } ?>
                    </div>
            </form>
        </div>
    <?php } ?>
</section>


<!--MODAL-->
<div class="modal modal--ferme" modal-confirmation-delete>
    <?php if($erreur !== ""){?>
        <div class="modal__contenu">
            <p><?php echo $erreur?></p>
            <div class="formulaire__champs">
                <button data-js-boutonFerme class="bouton-secondaire">Annuler</button>
            </div>
        </div>
    <?php }else{?>
        <div class="modal__contenu" data-js-usager="<?php echo $_SESSION['utilisateur']['id'];?>" >
            <h4 class="text-center">Voulez vous vraiment supprimer cette bouteille?</h4>

            <div class="submit-bloc">
                <input type="hidden"
                       name="id_bouteille_input"
                       id="id_bouteille_input"
                       value="<?php echo $form_values['id_bouteille']?>" />
                <input type="hidden"
                       name="id_cellier_input"
                       id="id_cellier_input"
                       value="<?php echo $form_values['id_cellier']?>" />
                <button data-js-boutonFerme class="bouton-secondaire" id="annulerDetruirebtn">Annuler</button>
                <button  class="bouton-danger" id="detruirebtn">
                    Oui, supprimer
                </button>
            </div>
        </div>
    <?php }?>
</div>

<div   modal-modification-statut class="modal--ferme modal">
    <?php if($erreur !== ""){?>
        <div class="modal__contenu">
            <p><?php echo $erreur?></p>
            <div class="formulaire__champs">
                <button data-js-boutonFerme class="bouton-secondaire">Annuler</button>
            </div>
        </div>
    <?php }else{?>
        <div class="modal__contenu" data-js-usager="<?php echo $_SESSION['utilisateur']['id'];?>">
            <h4 class="text-center"><?php echo (isset($message) && $message != null ? $message: ''); ?></h4>

            <div class="submit-bloc">
                <button type="button" value="<?php echo ($form_values['id_cellier'] ?: -1) ;?>"  class="bouton-secondaire" id="gobackbtn" data-js-boutonAjouterCellier>Retour sur la page précédente</button>
                <button data-js-boutonFerme class="bouton-secondaire" id="annulerDetruirebtn2">Fermer</button>
            </div>

        </div>
    <?php }?>
</div>

<div   modal-annulation class="modal--ferme modal">
    <?php if($erreur !== ""){?>
        <div class="modal__contenu">
            <p><?php echo $erreur?></p>
            <div class="formulaire__champs">
                <button data-js-boutonFerme class="bouton-secondaire">Annuler</button>
            </div>
        </div>
    <?php }else{?>
        <div class="modal__contenu" data-js-usager="<?php echo $_SESSION['utilisateur']['id'];?>">
            <h4 class="text-center">Annulation réussie, Voulez-vous rester sur catte page?</h4>

            <div class="submit-bloc">
                <button onclick="history.back()" type="button" class="bouton-secondaire">Retour sur la page précédente</button>
                <button data-js-boutonFerme class="bouton-secondaire" id="fermerModalAnnulation">Oui, rester</button>
            </div>

        </div>
    <?php }?>
</div>


<!--MODAL créer cellier-->
<div class="modal modal--ferme" data-js-modal>
	<div class="modal__contenu" data-js-modalcontenu >
      
	</div>
</div>

<input type="hidden" name="modifStatus" id="modifStatus" value='<?php echo isset($message) && $message != null && strlen($message) > 0 ? $message: null ?>'  />
