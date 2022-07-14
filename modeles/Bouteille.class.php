<?php

/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele
{
    const TABLE = 'vino__bouteille';


    public function ajouterAdminBouteille($donnees)
    {
        $requete = "INSERT INTO usager__bouteille
                        (id_cellier, nom_bouteille, quantite_bouteille, prix_bouteille, description_bouteille, 
                        image_bouteille, date_achat, garde_jusqua, note, commentaires, millesime, favori_bouteille, 
                        essayer_bouteille, achat_bouteille, code_saq, code_cup, pays_nom, region_nom, type_de_vin_nom, producteur, 
                        url_saq, url_img, format_nom, appellation_nom, designation_nom, classification_nom, cepage_nom, 
                        taux_de_sucre_nom, degre_alcool_nom, produit_du_quebec_nom, biodynamique, casher, desalcoolise, 
                        equitable, faible_taux_alcool, produit_bio, vin_nature, vin_orange)
                    VALUES (" .
            "'{$donnees->id_cellier}'," .
            "'{$donnees->nom_bouteille}'," .
            "'{$donnees->quantite_bouteille}'," .
            "'{$donnees->prix_bouteille}'," .
            "'{$donnees->description_bouteille}'," .
            "'{$donnees->url_img}'," .
            "'{$donnees->date_achat}'," .
            "'{$donnees->garde_jusqua}'," .
            "'{$donnees->note}'," .
            "'{$donnees->commentaires}'," .
            "'{$donnees->millesime}'," .
            "'{$donnees->favori_bouteille}'," .
            "'{$donnees->essayer_bouteille}'," .
            "'{$donnees->achat_bouteille}'," .
            "'{$donnees->code_saq}'," .
            "'{$donnees->code_cup}'," .
            "'{$donnees->pays_nom}'," .
            "'{$donnees->region_nom}'," .
            "'{$donnees->type_de_vin_nom}'," .
            "'{$donnees->producteur}'," .
            "'{$donnees->url_saq}'," .
            "'{$donnees->url_img}'," .
            "'{$donnees->format_nom}'," .
            "'{$donnees->appellation_nom}'," .
            "'{$donnees->designation_nom}'," .
            "'{$donnees->classification_nom}'," .
            "'{$donnees->cepage_nom}'," .
            "'{$donnees->taux_de_sucre_nom}'," .
            "'{$donnees->degre_alcool_nom}'," .
            "'{$donnees->produit_du_quebec_nom}'," .
            "'{$donnees->biodynamique}'," .
            "'{$donnees->casher}'," .
            "'{$donnees->desalcoolise}'," .
            "'{$donnees->equitable}'," .
            "'{$donnees->faible_taux_alcool}'," .
            "'{$donnees->produit_bio}'," .
            "'{$donnees->vin_nature}'," .
            "'{$donnees->vin_orange}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function getAdminBouteilles()
    {
        $rows = array();

        $requete = "SELECT id_bouteille, id_cellier, nom_bouteille, url_saq
                    FROM usager__bouteille 
                    ORDER BY id_bouteille";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }


    public function getAdminNbBouteilles()
    {
        $nbTrouve = 0;
        $requete = "SELECT COUNT(*) AS nbTrouve FROM usager__bouteille";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                $row = $res->fetch_assoc();
                $nbTrouve = $row['nbTrouve'];
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $nbTrouve;
    }


    public function getAdminUneBouteille($id_bouteille)
    {
        $rows = array();

        $requete = "SELECT id_bouteille, id_cellier, nom_bouteille, quantite_bouteille, prix_bouteille, description_bouteille, date_achat, 
                            garde_jusqua, note, commentaires, millesime, favori_bouteille, essayer_bouteille, achat_bouteille, code_saq, code_cup, pays_nom, region_nom,
                            type_de_vin_nom, producteur, url_saq, url_img, format_nom, appellation_nom, designation_nom, classification_nom, cepage_nom, taux_de_sucre_nom,
                            degre_alcool_nom, produit_du_quebec_nom, biodynamique, casher, desalcoolise, equitable, faible_taux_alcool, produit_bio, vin_nature, vin_orange,
                            id_vino__bouteille 
                    FROM usager__bouteille
                    WHERE id_bouteille = " . $id_bouteille;

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }


    public function modifierAdminBouteille($donnees)
    {
        $requete = "UPDATE usager__bouteille SET 
                            id_cellier = '{$donnees->id_cellier}',
                            nom_bouteille = '{$donnees->nom_bouteille}',
                            quantite_bouteille = '{$donnees->quantite_bouteille}',
                            prix_bouteille = '{$donnees->prix_bouteille}',
                            description_bouteille = '{$donnees->description_bouteille}',
                            image_bouteille = '{$donnees->url_img}',
                            date_achat = '{$donnees->date_achat}',
                            garde_jusqua = '{$donnees->garde_jusqua}',
                            note = '{$donnees->note}',
                            commentaires = '{$donnees->commentaires}',
                            millesime = '{$donnees->millesime}',
                            favori_bouteille = '{$donnees->favori_bouteille}',
                            essayer_bouteille = '{$donnees->essayer_bouteille}',
                            achat_bouteille = '{$donnees->achat_bouteille}',
                            code_saq = '{$donnees->code_saq}',
                            code_cup = '{$donnees->code_cup}',
                            pays_nom = '{$donnees->pays_nom}',
                            region_nom = '{$donnees->region_nom}',
                            type_de_vin_nom = '{$donnees->type_de_vin_nom}',
                            producteur = '{$donnees->producteur}',
                            url_saq = '{$donnees->url_saq}',
                            url_img = '{$donnees->url_img}',
                            format_nom = '{$donnees->format_nom}',
                            appellation_nom = '{$donnees->appellation_nom}',
                            designation_nom = '{$donnees->designation_nom}',
                            classification_nom = '{$donnees->classification_nom}',
                            cepage_nom = '{$donnees->cepage_nom}',
                            taux_de_sucre_nom = '{$donnees->taux_de_sucre_nom}',
                            degre_alcool_nom = '{$donnees->degre_alcool_nom}',
                            produit_du_quebec_nom = '{$donnees->produit_du_quebec_nom}',
                            biodynamique = '{$donnees->biodynamique}',
                            casher = '{$donnees->casher}',
                            desalcoolise = '{$donnees->desalcoolise}',
                            equitable = '{$donnees->equitable}',
                            faible_taux_alcool = '{$donnees->faible_taux_alcool}',
                            produit_bio = '{$donnees->produit_bio}',
                            vin_nature = '{$donnees->vin_nature}',
                            vin_orange = '{$donnees->vin_orange}'
                    WHERE id_bouteille = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }



    /**
     * Cette méthode récupère la liste des bouteilles d'un cellier d'un usager
     *
     * @param int $id_cellier l'id du cellier de l'usagé
     *
     * @throws Exception Erreur de requête sur la base de données
     *
     * @return Array Les données.
     */
    public function getListeBouteilleCellier($id_cellier)
    {
        $rows = array();

        $requete = "SELECT * FROM usager__bouteille 
                    WHERE usager__bouteille.id_cellier = '$id_cellier' 
                    AND usager__bouteille.quantite_bouteille > 0 
                    ORDER BY id_bouteille DESC ";
        $this->_db->set_charset('utf8');
        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {

                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }
        return $rows;
    }

      /*
       *
       * Récupération des info sur la bouteille par id
       * utilisé dans la fiche bouteille
       *
       */
    public function getOneBouteille($id_bouteille, $id_cellier)
    {
        $rows = array();

        $requete = "SELECT 
					    uc.nom_cellier as nom_cellier,
					    ub.id_cellier, 
						ub.date_achat, 
						ub.garde_jusqua, 
                          ub.id_bouteille,
                          ub.nom_bouteille,
                          ub.image_bouteille,
                          ub.code_saq,
                          ub.code_cup,
       
                          ub.essayer_bouteille,
                          ub.favori_bouteille,
                          ub.achat_bouteille,
       
                          ub.pays_id,
                          ub.region_id,
                          ub.type_de_vin_id,
                          ub.description_bouteille,
                          ub.producteur,
                          ub.prix_bouteille,
                          ub.url_saq,
                          ub.url_img,
                          ub.format_id,
                          ub.appellation_id,
                          ub.designation_id,
                          ub.classification_id,
                          ub.cepage_id,
                          ub.taux_de_sucre_id,
                          ub.degre_alcool_id,
                          ub.produit_du_quebec_id,
       
       
                          ub.biodynamique,
                          ub.casher,
                          ub.desalcoolise,
                          ub.equitable,
                          ub.faible_taux_alcool,
                          ub.produit_bio,
                          ub.vin_nature,
                          ub.vin_orange,
                          ub.quantite_bouteille as quantite,
						 ub.millesime, 
                         ub.commentaires, 
                         ub.prix_bouteille, 
                          ub.note, 
              
                         ub.pays_nom,
                         ub.region_nom,
                         ub.type_de_vin_nom ,
                         ub.format_nom ,
                         ub.appellation_nom ,
                         ub.designation_nom,
                         ub.cepage_nom,
                         ub.taux_de_sucre_nom,
                         ub.degre_alcool_nom ,
                         ub.produit_du_quebec_nom,
                         ub.classification_nom
                        from vino__bouteille b
                        LEFT JOIN usager__bouteille ub ON ub.id_bouteille = b.id_bouteille
                    
						LEFT JOIN usager__cellier uc ON uc.id_cellier = ub.id_cellier
						LEFT JOIN vino__format format ON format.id = ub.format_id
                        LEFT JOIN generique__pays pays ON pays.id = ub.pays_id
                        LEFT JOIN vino__region region ON region.id = ub.region_id
                        LEFT JOIN vino__type typ ON typ.id = ub.type_de_vin_id
                        LEFT JOIN vino__cepage cepages ON cepages.id = ub.cepage_id
                        LEFT JOIN vino__appellation appel ON appel.id = ub.appellation_id
                        LEFT JOIN vino__designation designation ON designation.id = ub.designation_id
                        LEFT JOIN vino__taux_de_sucre ts ON ts.id = ub.taux_de_sucre_id
                        LEFT JOIN vino__degre_alcool da ON da.id = ub.degre_alcool_id
                        LEFT JOIN vino__produit_du_quebec pc ON pc.id = ub.produit_du_quebec_id
                        LEFT JOIN vino__classification classif ON classif.id = ub.classification_id
                       WHERE b.id_bouteille = '" . $id_bouteille . "'";
        if ($id_cellier) {
            $requete = $requete . " AND ub.id_cellier = '" . $id_cellier . "'";
        }
        $this->_db->set_charset('utf8');

        $res =  $this->_db->query($requete) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {

            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {

                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
            //$this->_db->error;
        }
        return $rows;
    }

   /*
   *
   * Récupération des info sur la bouteille par id_vino depuis vino_bouteille
   * Utilisé dans le scan
   */
    public function getOneBouteilleFromVino($vino_bouteille_id)
    {
        $rows = array();
        $requete = "SELECT 
						ub.id_cellier, 
						ub.date_achat, 
						ub.garde_jusqua, 
						ub.note, 
						ub.quantite_bouteille as quantite,
						ub.quantite_bouteille,
						ub.millesime, 
						ub.commentaires, 
						ub.note, 
       
                        ub.pays_revision,
                        ub.region_revision,
                        ub.type_de_vin_revision,
                        ub.format_revision,
                        ub.appellation_revision,
                        ub.designation_revision,
                        ub.classification_revision,
                        ub.cepage_revision,
                        ub.taux_de_sucre_revision,
                        ub.degre_alcool_revision,
                        ub.produit_du_quebec_revision,
       
       
                         pays.nom AS pays_nom,
                         region.nom as region_nom,
                         typ.nom as type_de_vin_nom,
                         format.nom as format_nom,
                         appel.nom as appellation_nom,
                         designation.nom as designation_nom,
                         cepages.nom as cepage_nom,
                         ts.nom as taux_de_sucre_nom,
                         da.nom as degre_alcool_nom,
                         pc.nom as produit_du_quebec_nom,
                         classif.nom as classification_nom,
                        
                        
                         uc.nom_cellier as nom_cellier,
					
                          b.id_bouteille,
                          b.nom_bouteille,
                          b.image_bouteille,
                          b.code_saq,
                          b.code_cup,
                          b.pays_id,
                          b.region_id,
                          b.type_id,
                          b.description_bouteille,
                          b.producteur,
                          b.prix_bouteille,
                          b.url_saq,
                          b.url_img,
                          b.format_id,
                          b.appellation_id,
                          b.designation_id,
                          b.classification_id,
                          b.cepages_id,
                          b.taux_de_sucre_id,
                          b.degre_alcool_id,
                          b.produit_du_quebec_id,
                          b.biodynamique,
                          b.casher,
                          b.desalcoolise,
                          b.equitable,
                          b.faible_taux_alcool,
                          b.produit_bio,
                          b.vin_nature,
                          b.vin_orange,
              
                         pays.nom AS nom_pays,
                         region.nom as nom_region,
                         typ.nom as nom_type,
                         format.nom as nom_format,
                         appel.nom as nom_appellation,
                         designation.nom as nom_designation,
                         cepages.nom as nom_cepages,
                         ts.nom as nom_taux_de_sucre,
                         da.nom as nom_degre_alcool,
                         pc.nom as nom_produit_du_quebec,
                        classif.nom as nom_classification
                        from vino__bouteille b
                        LEFT JOIN usager__bouteille ub ON ub.id_bouteille = b.id_bouteille
                    
						LEFT JOIN usager__cellier uc ON uc.id_cellier = ub.id_cellier
						LEFT JOIN vino__format format ON format.id = b.format_id
                        LEFT JOIN generique__pays pays ON pays.id = b.pays_id
                        LEFT JOIN vino__region region ON region.id = b.region_id
                        LEFT JOIN vino__type typ ON typ.id = b.type_id
                        LEFT JOIN vino__cepage cepages ON cepages.id = b.cepages_id
                        LEFT JOIN vino__appellation appel ON appel.id = b.appellation_id
                        LEFT JOIN vino__designation designation ON designation.id = b.designation_id
                        LEFT JOIN vino__taux_de_sucre ts ON ts.id = b.taux_de_sucre_id
                        LEFT JOIN vino__degre_alcool da ON da.id = b.degre_alcool_id  
                        LEFT JOIN vino__produit_du_quebec pc ON pc.id = b.produit_du_quebec_id
                        LEFT JOIN vino__classification classif ON classif.id = b.classification_id
                       WHERE b.id_bouteille = '" . $vino_bouteille_id . "'";

      
        $res =  $this->_db->query($requete) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {

            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
            //$this->_db->error;
        }
        return $rows;
    }

    /*
   *
   * Récupération des info sur la bouteille par nom
   * Utilisé dans la fiche bouteille dans l'auto-complete
   */
    public function getOneBouteilleByName($nom)
    {
        $rows = array();
        $requete = "SELECT 
						ub.id_cellier, 
						ub.date_achat, 
						ub.garde_jusqua, 
						ub.note, 
						ub.quantite_bouteille as quantite,
						ub.quantite_bouteille,
						ub.millesime, 
						ub.commentaires, 
						ub.note, 
       
                        ub.pays_revision,
                        ub.region_revision,
                        ub.type_de_vin_revision,
                        ub.format_revision,
                        ub.appellation_revision,
                        ub.designation_revision,
                        ub.classification_revision,
                        ub.cepage_revision,
                        ub.taux_de_sucre_revision,
                        ub.degre_alcool_revision,
                        ub.produit_du_quebec_revision,
       
       
                         pays.nom AS pays_nom,
                         region.nom as region_nom,
                         typ.nom as type_de_vin_nom,
                         format.nom as format_nom,
                         appel.nom as appellation_nom,
                         designation.nom as designation_nom,
                         cepages.nom as cepage_nom,
                         ts.nom as taux_de_sucre_nom,
                         da.nom as degre_alcool_nom,
                         pc.nom as produit_du_quebec_nom,
                         classif.nom as classification_nom,
                        
                        
                         uc.nom_cellier as nom_cellier,
					
                          b.id_bouteille,
                          b.nom_bouteille,
                          b.image_bouteille,
                          b.code_saq,
                          b.code_cup,
                          b.pays_id,
                          b.region_id,
                          b.type_id,
                          b.description_bouteille,
                          b.producteur,
                          b.prix_bouteille,
                          b.url_saq,
                          b.url_img,
                          b.format_id,
                          b.appellation_id,
                          b.designation_id,
                          b.classification_id,
                          b.cepages_id,
                          b.taux_de_sucre_id,
                          b.degre_alcool_id,
                          b.produit_du_quebec_id,
                          b.biodynamique,
                          b.casher,
                          b.desalcoolise,
                          b.equitable,
                          b.faible_taux_alcool,
                          b.produit_bio,
                          b.vin_nature,
                          b.vin_orange,
              
                         pays.nom AS nom_pays,
                         region.nom as nom_region,
                         typ.nom as nom_type,
                         format.nom as nom_format,
                         appel.nom as nom_appellation,
                         designation.nom as nom_designation,
                         cepages.nom as nom_cepages,
                         ts.nom as nom_taux_de_sucre,
                         da.nom as nom_degre_alcool,
                         pc.nom as nom_produit_du_quebec,
                        classif.nom as nom_classification
                        from vino__bouteille b
                        LEFT JOIN usager__bouteille ub ON ub.id_bouteille = b.id_bouteille
                    
						LEFT JOIN usager__cellier uc ON uc.id_cellier = ub.id_cellier
						LEFT JOIN vino__format format ON format.id = b.format_id
                        LEFT JOIN generique__pays pays ON pays.id = b.pays_id
                        LEFT JOIN vino__region region ON region.id = b.region_id
                        LEFT JOIN vino__type typ ON typ.id = b.type_id
                        LEFT JOIN vino__cepage cepages ON cepages.id = b.cepages_id
                        LEFT JOIN vino__appellation appel ON appel.id = b.appellation_id
                        LEFT JOIN vino__designation designation ON designation.id = b.designation_id
                        LEFT JOIN vino__taux_de_sucre ts ON ts.id = b.taux_de_sucre_id
                        LEFT JOIN vino__degre_alcool da ON da.id = b.degre_alcool_id  
                        LEFT JOIN vino__produit_du_quebec pc ON pc.id = b.produit_du_quebec_id
                        LEFT JOIN vino__classification classif ON classif.id = b.classification_id
                       WHERE b.nom_bouteille = '" . $nom . "'";
       
        $res =  $this->_db->query($requete) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {

            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {

                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
            //$this->_db->error;
        }
        return $rows;
    }




    /**
     * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
     *
     * @param int $id_usager , id de session de l'usager
     * @param int $id id de la bouteille
     * 
     * @param int $nombre Nombre de bouteille a ajouter ou retirer
     * 
     * @return String Si les id et nombre ne sont pas des caractères numériques
     *
     */
    public function modifierQuantiteBouteilleCellier($id_usager, $id, $nombre, $action)
    {
        if (is_numeric($id_usager) && is_numeric($id) && is_numeric($nombre)) {
            $requete = $this->_db->query("INSERT INTO bouteille_action SET id_usager = '$id_usager', id_bouteille = '$id', quantite_bouteille =  '$nombre', action = '$action'");
            if ($action == "a") {
                $nombre = 1;
            } else {
                $nombre = -1;
            }

            $modele = new Modele();
            $res = $modele->ajusterQuantiteBouteille($id);
        }
    }

    public function deleteUsageBouteille($id_bouteille, $id_cellier)
    {
        $this->_db->set_charset('utf8');

        // On récupere la ligne usager_bouteille pour avoir la quantite à mettre dans l'action
        $query_string_select = "SELECT * FROM usager__bouteille WHERE id_bouteille = " . $id_bouteille . " AND id_cellier = " . $id_cellier;
        $res = MonSQL::getInstance()->query($query_string_select); // or die(mysqli_error(MonSQL::getInstance()));
        $row = [];
        if ($res) {
            $row = $res->fetch_assoc();
        }

        if (isset($row['quantite_bouteille']) && $row['quantite_bouteille']) {
            // On ajoute l'action de suppression
            $query_string_action = "INSERT INTO bouteille_action(
                                    id_usager,
                                    id_bouteille,
                                    date_creation,
                                    action,
                                    quantite_bouteille
                                    ) VALUES (
                                         '" . $_SESSION['utilisateur']['id'] . "',
                                         " . $id_bouteille . ",
                                         '" . date('Y-m-d h:m:s', time()) . "',
                                         'd',
                                        '" . abs($row["quantite_bouteille"]) . "'
                                    )";
            $res = MonSQL::getInstance()->query($query_string_action) or die(mysqli_error(MonSQL::getInstance()));

            // On supprime la ligne usager bouteille
            $delete_quuery = "DELETE from usager__bouteille WHERE id_bouteille = " . $id_bouteille . " AND id_cellier = " . $id_cellier;
            $res = $this->_db->query($delete_quuery);

            return $res;
        }
        return false;
    }

    public function rechercherBouteillesCellier($id_cellier, $filtres)
    {
        $rows = [];
        $requete = "SELECT id_bouteille, id_cellier, description_bouteille, prix_bouteille, date_achat, garde_jusqua, note, commentaires, quantite_bouteille, millesime, id_vino__bouteille, nom_bouteille, image_bouteille, pays_nom, region_nom, type_de_vin_nom ";
        $requete .= "FROM usager__bouteille ";
        $requete .= "WHERE id_cellier = " . $id_cellier;

        if ($filtres) {
            $aTermes = explode(",", $filtres);
            $lesTermes = "";

            foreach ($aTermes as $terme) {
                $lesTermes .= "*" . $terme . "* ";
            }

            if ($lesTermes) {
                $lesTermes = substr($lesTermes, 0, -1);
                $requete .= " AND MATCH( nom_bouteille, millesime, pays_nom, region_nom, type_de_vin_nom, format_nom, cepage_nom ) AGAINST('" . $lesTermes . "' IN BOOLEAN MODE)";
            }
        }

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }




    public function getOneFromUsagerbouteille($id_bouteille)
    {
        $rows = array();
        $requete = "SELECT  *  from vino__bouteille b
                       WHERE b.id_bouteille = '" . $id_bouteille . "'";
        $this->_db->set_charset('utf8');
        $res =  $this->_db->query($requete) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {

            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
            //$this->_db->error;
        }
        return $rows;
    }

      /*
       *
       * Copier un ligne depuis vino_bouteille sur la table usager bouteille
       * Utilisé dans le cas ou on veux ajouter une bouteille danns vinno bouteille directement dans favoris, a essayer, ..
       *  Et ca n'existee pas deja dans usager_bouteille
       */
    public function copierVinoDansUsagerBouteillle($vino_id)
    {
        $this->_db->set_charset('utf8');

        // On récupere la ligne depuis vino_bouteille
        $row = $this->getOneBouteilleFromVino($vino_id);
        $row = $row[0];

        if ($row) {
            //On insere dans usager_bouteille
            $query_string = "INSERT INTO usager__bouteille(
                        id_cellier,
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
                        pays_nom,
                        region_nom,
                        type_de_vin_nom,
                        format_nom,
                        appellation_nom,
                        designation_nom,
                        cepage_nom,
                        taux_de_sucre_nom,
                        degre_alcool_nom,
                        produit_du_quebec_nom,
                        classification_nom,
                        quantite_bouteille ,
                        date_achat ,
                        garde_jusqua ,
                        millesime,
                       id_vino__bouteille
                ) VALUES (
                       NULL,
                       '" . $row['nom_bouteille'] . "',
                      '" . ($row['image_bouteille']) . "',
                      '" . $row['description_bouteille'] . "',
                      " . ($row['code_saq'] ?: 'NULL') . ",
                      " . ($row['code_cup'] ?: 'NULL') . ",
                      '" . $row['prix_bouteille'] . "',
                      '" . $row['url_saq'] . "',
                      '" . $row['producteur'] . "',
                      " . (isset($row['biodynamique']) ? 1 : 0) . ",
                      " . (isset($row['casher']) ? 1 : 0) . ",
                      " . (isset($row['desalcoolise']) ? 1 : 0) . ",
                      " . (isset($row['equitable']) ? 1 : 0) . ",
                      " . (isset($row['faible_taux_alcool']) ? 1 : 0) . ",
                      " . (isset($row['produit_bio']) ? 1 : 0) . ",
                      " . (isset($row['vin_nature']) ? 1 : 0) . ",
                      " . (isset($row['vin_orange']) ? 1 : 0) . ",
                      '" . $row['pays_nom'] . "',
                      '" . $row['region_nom'] . "',
                       '" . $row['type_de_vin_nom'] . "',
                       '" . $row['format_nom'] . "',
                        '" . $row['appellation_nom'] . "',
                       '" . $row['designation_nom'] . "',
                      '" . $row['cepage_nom'] . "',
                       '" . $row['taux_de_sucre_nom'] . "',
                       '" . $row['degre_alcool_nom'] . "',
                      '" . $row['produit_du_quebec_nom'] . "',
                      '" . $row['classification_nom'] . "',
                      1,
                      " . ($row['date_achat'] ? "'" . $row['date_achat'] . "'" :  'NULL') . ",
                      " . ($row['garde_jusqua'] ? "'" . $row['garde_jusqua'] . "'"  : 'NULL') . ",
                     '" . ($row['millesime']) . "',
                     '" . ($row['id_bouteille']) . "'
                )";
            $res =  $this->_db->query($query_string) or die(mysqli_error(MonSQL::getInstance()));
            if ($res) {
                $last_id = MonSQL::getInstance()->insert_id;
                $last_inserted_row = $this->getOneFromUsagerbouteille($last_id, null);
                if ($last_inserted_row && count($last_inserted_row) > 0) {
                    return $last_inserted_row[0];
                }
            }
        }
        return null;
    }

    //Donner une note à une bouteille
    public function noteBouteille($note, $id_bouteille)
    {
        $query_string = "UPDATE  usager__bouteille SET
                            note = '" . $note . "'
                            WHERE id_bouteille=" . $id_bouteille; //

     
        $res =  $this->_db->query($query_string) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {
            return true;
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }
        return false;
    }

    
    // Bouteille favoris (rendre oui ou non)
    public function modifierFavoris($valeur, $id_bouteille, $id_cellier)
    {

        $query_string = "UPDATE  usager__bouteille SET
                            favori_bouteille = " . ($valeur ? 1 : 0);
        $query_string = $query_string . " WHERE id_bouteille=" . $id_bouteille;
        if ($id_cellier) {
            $query_string = $query_string . " AND id_cellier=" . $id_cellier;
        }

      
        $res =  $this->_db->query($query_string) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {
            return true;
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }
        return false;
    }

    // Bouteille à essayer (rendre oui ou non)
    public function modifierAEssayer($valeur, $id_bouteille, $id_cellier)
    {
        $query_string = "UPDATE  usager__bouteille SET
                            essayer_bouteille = " . ($valeur ? 1 : 0);
        $query_string = $query_string . " WHERE id_bouteille=" . $id_bouteille;

        if ($id_cellier) {
            $query_string = $query_string . " AND id_cellier=" . $id_cellier;
        }

   
        $res =  $this->_db->query($query_string) or die(mysqli_error(MonSQL::getInstance()));
        if ($res) {
            return true;
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }
        return false;
    }

    // Bouteille à acheter (rendre oui ou non)
    public function modifierAAcheter($valeur, $id_bouteille, $id_cellier)
    {
        $query_string = "UPDATE  usager__bouteille SET
                            achat_bouteille = " . ($valeur ? 1 : 0);
        $query_string = $query_string . " WHERE id_bouteille=" . $id_bouteille;
        if ($id_cellier) {
            $query_string = $query_string . " AND id_cellier=" . $id_cellier;
        }

        $res =  $this->_db->query($query_string);
        if ($res) {
            return true;
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }
        return false;
    }
}