<?php include('./Controler.class.php'); ?>

<?php
ob_start();
if(session_id() == ''){ session_start();}
if (!class_exists('Lists')) {
    require_once ('../modeles/Lists.class.php');
}
$debug = false;
$message = null;

$returnpage = "index.php?requete=bouteille";
$id_cellier  = $_POST['id_cellier'] ?: null;
//$nom_cellier = $_POST['nom_cellier'];
$bouteille_id = isset($_POST['id_bouteille'])?$_POST['id_bouteille']: null;

if(isset( $_POST['id_cellier']) &&  $_POST['id_cellier'] != null){
    $returnpage = $returnpage.'&id_cellier='.$id_cellier;
}
if(isset($bouteille_id) && $bouteille_id != null){
    $returnpage = $returnpage.'&id_bouteille='.$bouteille_id;
}

array_walk_recursive($_POST, function (&$value) {
    $value = htmlentities($value);
});

//if(isset($_POST['estCommentaire'])){
//    $query_string = "UPDATE  usager__bouteille SET
//                            commentaires = '".$_POST['commentaires']."'
//                            WHERE id_bouteille=".$_POST['id_bouteille'];//
//    $message = "Le commentaire a bien été ajouté";
//    if($debug){
//        echo "<br>";
//        echo $query_string;
//         echo "<br>";
//    }
//    $res = MonSQL::getInstance()->query($query_string) or die(mysqli_error(MonSQL::getInstance()));
//
//}else{

    /*
     *
     * Récupéération d'id de chaque element des listes par nom
     *
     */
    $list = new Lists();

    $pays = $list->findElementByName('pays', $_POST['pays_nom']);
    if(count($pays) > 0){ $pays_id  = $pays[0]['id'];}// else { $pays_id = $list->creerNouveauElement('pays',  $_POST['pays_nom']);}

    $region = $list->findElementByName('region', $_POST['region_nom']);
    if(count($region) > 0){ $region_id = $region[0]['id'];} //else { $region_id = $list->creerNouveauElement('region',  $_POST['region_nom']);}


    $type = $list->findElementByName('type', $_POST['type_de_vin_nom']);
    if(count($type) > 0){ $type_id = $type[0]['id'];}// else { $type_id = $list->creerNouveauElement('type',  $_POST['type_de_vin_nom']);}

    $format = $list->findElementByName('format', $_POST['format_nom']);
    if(count($format) > 0){ $format_id = $format[0]['id'];}// else { $format_id = $list->creerNouveauElement('format',  $_POST['format_nom']);}

    $appellation = $list->findElementByName('appellation', $_POST['appellation_nom']);
    if(count($appellation) > 0){ $appellation_id = $appellation[0]['id'];} //else { $appellation_id = $list->creerNouveauElement('appellation',  $_POST['appellation_nom']);}

    $designation = $list->findElementByName('designation', $_POST['designation_nom']);
    if(count($designation) > 0){ $designation_id = $designation[0]['id'];}// else { $designation_id = $list->creerNouveauElement('designation',  $_POST['designation_nom']);}

    $cepage = $list->findElementByName('cepages', $_POST['cepage_nom']);
    if(count($cepage) > 0){ $cepages_id = $cepage[0]['id'];} // else { $cepages_id = $list->creerNouveauElement('cepages',  $_POST['cepage_nom']);}

    $taux_de_sucre = $list->findElementByName('taux_de_sucre', $_POST['taux_de_sucre_nom']);
    if(count($taux_de_sucre) > 0){ $taux_de_sucre_id = $taux_de_sucre[0]['id'];} // else { $taux_de_sucre_id = $list->creerNouveauElement('taux_de_sucre',  $_POST['taux_de_sucre_nom']);}

    $degre_alcool = $list->findElementByName('degre_alcool', $_POST['degre_alcool_nom']);
    if(count($degre_alcool) > 0){ $degre_alcool_id = $degre_alcool[0]['id'];} //else { $degre_alcool_id = $list->creerNouveauElement('degre_alcool',  $_POST['degre_alcool_nom']);}

    $produit_du_quebec = $list->findElementByName('produit_du_quebec', $_POST['produit_du_quebec_nom']);
    if(count($produit_du_quebec) > 0){ $produit_du_quebec_id = $produit_du_quebec[0]['id'];}// else { $produit_du_quebec_id = $list->creerNouveauElement('produit_du_quebec',  $_POST['produit_du_quebec_nom']);}

    $classification = $list->findElementByName('classifications', $_POST['classification_nom']);
    if(count($classification) > 0){ $classification_id = $classification[0]['id'];}// else { $classification_id = $list->creerNouveauElement('classifications',  $_POST['classification_nom']);}



    /*
     *
     * Upload fichier
     *
     */
    // repertoire d'upload de fichiers
    $upload_url = null;
    $source=$_FILES['photo']['tmp_name'];
    $time = time();
    $destination="../photos/".$time;
    $extensions_auutorises =  array('jpg','png','jpeg','gif');
    $fileinfo=pathinfo($_FILES['photo']['name']);
    $file_extension = strtolower($fileinfo['extension']);

    if(in_array($file_extension, $extensions_auutorises)){
        if($_FILES['photo']['size'] <= 5000000){
            $destination = __DIR__.'/'.$destination.'.'.$file_extension;
            if( move_uploaded_file($source, $destination)){
                $upload_url = 'photos/'.$time.'.'.$file_extension;
            }
        }else{
            echo("la taille maximum est 500mo");
        }
    }else{
        echo("la forme de l'image doit être jpg, png, jpeg ou gif");
    }
    /*
     * Fin Upload fichier
     * Si $upload_url est non null c'est à dire qu'on a uploader le fichier correctement
     * Si $upload_url est null soit il y a echeck d'upload ou bien y a pas d'upload fichier dans le formulaire
     */

    /*
     * Le code si dessous est testé et marche
     * Le code si dessous concerne les cas suivants
     * Si on essaie d'ajouter une nouvelle bouteille avec une list de celliers chacune avec une quantité définie
     * Si cette bouteille à ajouter existe dans la table vino__table ou pas
     * */

    /*
     * Ajouter une nouvelle bouteille
     * */

    $message = "Opération réussie";

    /*
    *
    *  Boucle sur les cellier pour y gérer les quantités
     * Et confirmer l'insertion ou bien la modification des informations
    *
    */
    foreach ( $_POST['celliers'] as  $key => $cellier){
        $ub = null;
//        if($bouteille_id){
            $ub = $list->getUsagerBouteille( $cellier['id_bouteille'], $cellier['id_cellier']);
//        }

        if($debug){
             echo "<br><br>";
            print_r($ub);
            echo "<br><br>";
        }
        /*
         *
         * Si pas existance de l'usager bouteille on aura une insertion
         * Si existannce on est dans la modification
         *
         */
        if(!$ub){
            if(!isset($cellier['quantite']) || !$cellier['quantite']){
                continue;
            }
            if($cellier['quantite'] <= 0){
                $cellier['quantite'] = 0;
            }
            //Si la quantite est egale à zero on insere sans id_cellier
            $query_string = "INSERT INTO usager__bouteille(
                        id_cellier ,
                        nom_bouteille,
                        image_bouteille ,
                        description_bouteille ,
                        code_saq ,
                        code_cup ,
                        prix_bouteille ,
                        url_saq,
                        producteur ,
                        biodynamique,
                        casher,
                        desalcoolise,
                        equitable,
                        faible_taux_alcool,
                        produit_bio,
                        vin_nature,
                        vin_orange,
                        pays_revision,
                        pays_nom,
                        region_revision,
                        region_nom,
                        type_de_vin_revision,
                        type_de_vin_nom,
                        format_revision,
                        format_nom,
                        appellation_revision,
                        appellation_nom,
                        designation_revision,
                        designation_nom,
                        cepage_revision,
                        cepage_nom,
                        taux_de_sucre_revision,
                        taux_de_sucre_nom,
                        degre_alcool_revision,
                        degre_alcool_nom,
                        produit_du_quebec_revision,
                        produit_du_quebec_nom,
                        classification_revision, 
                        classification_nom, 
                        quantite_bouteille ,
                        date_achat ,
                        garde_jusqua ,
                        millesime,
                        commentaires 
                          
                ) VALUES (
                      ".  ($cellier['quantite'] == 0 ? 'NULL': $cellier['id_cellier']) .",
                       '".$_POST['nom_bouteille']."', 
                      '".(isset($upload_url) && $upload_url!= null ? $upload_url: $_POST['image_bouteille'])."',
                      '".$_POST['description_bouteille']."',
                      ".($_POST['code_saq'] ?: 'NULL').",
                      ".($_POST['code_cup'] ?: 'NULL').",
                      '".$_POST['prix_bouteille']."',
                      '".$_POST['url_saq']."',
                      '".$_POST['producteur']."',
                      ".(isset($_POST['biodynamique'])? 1: 0).",
                      ".(isset($_POST['casher'])? 1: 0).",
                      ".(isset($_POST['desalcoolise'])? 1: 0).",
                      ".(isset($_POST['equitable'])? 1: 0).",
                      ".(isset($_POST['faible_taux_alcool'])? 1: 0).",
                      ".(isset($_POST['produit_bio'])? 1: 0).",
                      ".(isset($_POST['vin_nature'])? 1: 0).",
                      ".(isset($_POST['vin_orange'])? 1: 0).",
                      ".($pays_id ? 'NULL': 1).",
                      '".$_POST['pays_nom']."',
                      
                      ".($region_id? 'NULL': 1).",
                      '".$_POST['region_nom']."',
                      
                      ".($type_id ? 'NULL': 1).",
                       '".$_POST['type_de_vin_nom']."',
                     
                      ".($format_id ? 'NULL': 1).",
                       '".$_POST['format_nom']."',
                       
                      ".($appellation_id ? 'NULL': 1).",
                        '".$_POST['appellation_nom']."',
                        
                      ".($designation_id ? 'NULL': 1).",
                       '".$_POST['designation_nom']."',
                      
                      ".($cepages_id ? 'NULL': 1).",
                      '".$_POST['cepage_nom']."',
                      
                      ".($taux_de_sucre_id ? 'NULL': 1).",
                       '".$_POST['taux_de_sucre_nom']."',
                      
                      ".($degre_alcool_id ? 'NULL': 1).",
                       '".$_POST['degre_alcool_nom']."',
                       
                      ".($produit_du_quebec_id ? 'NULL': 1).",
                      '".$_POST['produit_du_quebec_nom']."',
                      
                      ".($classification_id ? 'NULL': 1).",
                      '".$_POST['classification_nom']."',
                      
                      '".($cellier['quantite'] ?: 0)."',
                      ".($_POST['date_achat'] ? "'".$_POST['date_achat']."'":  'NULL' ).",
                      ".($_POST['garde_jusqua'] ? "'".$_POST['garde_jusqua']."'"  : 'NULL' ).",
                     '".($_POST['millesime'])."',
                     '".($_POST['commentaires'])."'
                )";

            $action ="a";
            $action_quatite = $cellier['quantite'];
        }else{
            $query_string = "UPDATE  usager__bouteille SET ";
            if($cellier['quantite'] <= 0){
                $cellier['quantite'] = 0;
                $query_string = $query_string ." id_cellier=null,";
            }
            //Si la quantite est egale à zero on rend l'id_cellier null
            $query_string = $query_string ."nom_bouteille =  '".$_POST['nom_bouteille']."',
                        image_bouteille =  '".(isset($upload_url) && $upload_url!= null ? $upload_url: $_POST['image_bouteille'])."',
                        description_bouteille  = '".$_POST['description_bouteille']."',
                        code_saq  =  ".($_POST['code_saq'] ?: 'NULL').",
                        code_cup =  ".($_POST['code_cup']?: 'NULL').",
                        prix_bouteille =  '".$_POST['prix_bouteille']."',
                        url_saq =  '".$_POST['url_saq']."',
                        producteur =  '".$_POST['producteur']."',
                        biodynamique  =  ".(isset($_POST['biodynamique']) ? 1: 0).",
                        casher  =  ".(isset($_POST['casher']) ? 1: 0).",
                        desalcoolise =  ".(isset($_POST['desalcoolise']) ? 1: 0).",
                        equitable =  ".(isset($_POST['equitable']) ? 1: 0).",
                        faible_taux_alcool=  ".(isset($_POST['faible_taux_alcool']) ? 1: 0).",
                        produit_bio=  ".(isset($_POST['produit_bio']) ? 1: 0).",
                        vin_nature=  ".(isset($_POST['vin_nature']) ? 1: 0).",
                        vin_orange=  ".(isset($_POST['vin_orange']) ? 1: 0).",
                      
                        pays_revision=  ".($pays_id ? 'NULL': 1).",
                        pays_nom=  '".$_POST['pays_nom']."',
                        region_revision=  ".($region_id ? 'NULL': 1).",
                        region_nom=  '".$_POST['region_nom']."',
                        type_de_vin_revision=  ".($type_id ? 'NULL': 1).",
                        type_de_vin_nom= '".$_POST['type_de_vin_nom']."',
                        format_revision=  ".($format_id ? 'NULL': 1).",
                        format_nom= '".$_POST['format_nom']."',
                        appellation_revision=  ".($appellation_id ? 'NULL': 1).",
                        appellation_nom= '".$_POST['appellation_nom']."',
                        designation_revision=  ".($designation_id ? 'NULL': 1).",
                        designation_nom=  '".$_POST['designation_nom']."',
                        cepage_revision=  ".($cepages_id ? 'NULL': 1).",
                        cepage_nom= '".$_POST['cepage_nom']."',
                        taux_de_sucre_revision=  ".($taux_de_sucre_id ? 'NULL': 1).",
                        taux_de_sucre_nom= '".$_POST['taux_de_sucre_nom']."',
                        degre_alcool_revision=  ".($degre_alcool_id ? 'NULL': 1).",
                        degre_alcool_nom= '".$_POST['degre_alcool_nom']."',
                        produit_du_quebec_revision=  ".($produit_du_quebec_id ?  'NULL': 1).",
                        produit_du_quebec_nom=  '".$_POST['produit_du_quebec_nom']."',
                        classification_revision  =  ".($classification_id ? 'NULL': 1).",
                        classification_nom  =  '".$_POST['classification_nom']."',
                       
                        quantite_bouteille = '".($cellier['quantite'] ?: 0)."',
                        date_achat = ".($_POST['date_achat'] ? "'".$_POST['date_achat']."'":  'NULL' ).",
                        garde_jusqua = ".($_POST['garde_jusqua'] ? "'".$_POST['garde_jusqua']."'"  : 'NULL' ).",
                        millesime = '".($_POST['millesime'])."',
                        commentaires = '".$_POST['commentaires']."'
                        WHERE id_cellier=".$cellier['id_cellier']." AND id_bouteille=".$cellier['id_bouteille'];

            if(isset($_POST['commentaires']) && $_POST['commentaires'] != null && $_POST['id_bouteille']){
                $query_string_commentaire = "UPDATE  usager__bouteille SET commentaires = '".$_POST['commentaires']."' ".
                    "WHERE id_bouteille=".$_POST['id_bouteille'];
                $res = MonSQL::getInstance()->query($query_string_commentaire) or die(mysqli_error(MonSQL::getInstance()));
            }
            echo "<br>".intval($ub[0]['quantite_bouteille'])." -- ".intval($cellier['quantite']). "<br>";
            if(intval($ub[0]['quantite_bouteille']) && intval($cellier['quantite'])){
                $action = intval($ub[0]['quantite_bouteille']) < intval($cellier['quantite']) ? 'a': 'd';
                $action_quatite = intval($cellier['quantite']) - intval($ub[0]['quantite_bouteille']);
            }else{
                $action = null;
                $action_quatite = 0;
            }
        }

        if(isset($cellier['id_cellier']) && $cellier['id_cellier'] != null){
            if($debug){
              echo "<br>";
              echo $query_string;
             echo "<br>";
            }
            $res = MonSQL::getInstance()->query($query_string) or die(mysqli_error(MonSQL::getInstance()));
            if(!$ub){ // Le cas d'ajout d'une nouvelle ligne onn prend la derniere
                $usager_bouteille_id = MonSQL::getInstance()->insert_id;
            }else{// Le cas de la modification d'usager bouteille
                $usager_bouteille_id = $ub[0]['id_bouteille'];
            }


            // lors de l'ajout ou la modification dans l'usager_bouteille on ajoute une ligne dans bouteille_action
            if($action && $action_quatite && $_SESSION['utilisateur']['id'] && $usager_bouteille_id ){
                $query_string_action = "INSERT INTO bouteille_action(
                                    id_usager,
                                    id_bouteille,
                                    date_creation,
                                    action,
                                    quantite_bouteille
                                    ) VALUES (
                                         '".$_SESSION['utilisateur']['id']."',
                                         ".$usager_bouteille_id.",
                                         '".date('Y-m-d h:m:s', time())."',
                                         '".$action."',
                                        '".abs($action_quatite)."'
                                    )";
                $res = MonSQL::getInstance()->query($query_string_action) or die(mysqli_error(MonSQL::getInstance()));
            }
        }

        //On ajoute l'action ici
    }



echo "Traitement terminé avec succès !<br><br>";
ECHO "Redirection ...";


if(isset($message) && $message != null){
   
    $returnpage = $returnpage.'&message='.$message;
}
// exit(header("Location:".$returnpage));
if (headers_sent()) {
    die("Un issue avec la redirection, svp cliquer ici pour retourner à la page précédente: <a href='../index.php?requete=listeBouteilleCellier&id_cellier=$id_cellier'>Page précédente</a>");
}
else{
    //exit(header("Location:../index.php?requete=listeBouteilleCellier&id_cellier=$id_cellier&nom_cellier=$nom_cellier"));
//    exit(header("Location:../index.php?requete=mesCelliers"));

    if(!isset($_POST['id_bouteille']) || !$_POST['id_bouteille']){

        if(isset($_POST['id_cellier']) && $_POST['id_cellier'] != null){
            header('Location:../index.php?requete=listeBouteilleCellier&id_cellier='.$_POST['id_cellier'].'&nom_cellier=null');
         }else{
            header("Location:../index.php?requete=mesCelliers");
        }
    }else{
        header("Location:../".$returnpage);
    }
}
/*
 *
 * Une fonction util pour avoir le base url
 *
 * */
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

    if ($tmpURL !== $_SERVER['HTTP_HOST']){
//        $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';
        $base_url .= $_SERVER['HTTP_HOST'].'/';
        //TODO
        // en serveur faire
        // $base_url .= $_SERVER['HTTP_HOST'].'/';
    }else{
     $base_url .= $tmpURL.'/';
    }
   
    return $base_url;
}
ob_end_flush();
?>