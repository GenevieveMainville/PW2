<?php

/**
 * On retrouve toutes les tables dont le nom commencent par Vino.
 * Comme la majorité sont des tables très simples, on les regroupe ici.
 */

class Vino extends Modele
{
    public function ajouterAppellation($donnees)
    {
        $requete = "INSERT INTO vino__appellation (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterBouteille($donnees)
    {
        $requete =
            "INSERT INTO vino__bouteille (
                                nom_bouteille, description_bouteille, code_saq, code_cup, pays_id, region_id, 
                                type_id, producteur, url_saq, url_img, format_id, appellation_id, designation_id, 
                                classification_id, cepages_id, taux_de_sucre_id, degre_alcool_id, produit_du_quebec_id, 
                                biodynamique, casher, desalcoolise, equitable, faible_taux_alcool, produit_bio, vin_nature, vin_orange) 
                    VALUES (" .
            "'{$donnees->nom_bouteille}'," .
            "'{$donnees->description_bouteille}'," .
            "'{$donnees->code_saq}'," .
            "'{$donnees->code_cup}'," .
            "'{$donnees->pays_id}'," .
            "'{$donnees->region_id}'," .
            "'{$donnees->type_id}'," .
            "'{$donnees->producteur}'," .
            "'{$donnees->url_saq}'," .
            "'{$donnees->url_img}'," .
            "'{$donnees->format_id}'," .
            "'{$donnees->appellation_id}'," .
            "'{$donnees->designation_id}'," .
            "'{$donnees->classification_id}'," .
            "'{$donnees->cepages_id}'," .
            "'{$donnees->taux_de_sucre_id}'," .
            "'{$donnees->degre_alcool_id}'," .
            "'{$donnees->produit_du_quebec_id}'," .
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


    public function ajouterCepage($donnees)
    {
        $requete = "INSERT INTO vino__cepage (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterClassification($donnees)
    {
        $requete = "INSERT INTO vino__classification (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterDegreAlcool($donnees)
    {
        $requete =
            "INSERT INTO vino__degre_alcool (nom, valeur) 
                    VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->valeur}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterDesignation($donnees)
    {
        $requete = "INSERT INTO vino__designation (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterFormat($donnees)
    {
        $requete =
            "INSERT INTO vino__format (nom, valeur_ml, valeur_litre) 
                    VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->valeur_ml}'," .
            "'{$donnees->valeur_litre}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterPays($donnees)
    {
        $requete =
            "INSERT INTO generique__pays (nom, producteur) 
                    VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->producteur}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterProduitQc($donnees)
    {
        $requete = "INSERT INTO vino__produit_du_quebec (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterRegion($donnees)
    {
        $requete = "INSERT INTO vino__region (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterTauxSucre($donnees)
    {
        $requete =
            "INSERT INTO vino__taux_de_sucre (nom, valeur) 
                    VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->valeur}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterTypeCellier($donnees)
    {
        $requete =
            "INSERT INTO vino__type_cellier (nom_type_cellier, nom_commun_type_cellier) 
                    VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->nom_commun}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterTypeVin($donnees)
    {
        $requete = "INSERT INTO vino__type (nom) 
                        VALUES ('{$donnees->nom}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function lireAppellations()
    {
        $requete = "SELECT id, nom FROM vino__appellation ORDER BY id";

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


    public function lireBouteilles()
    {
        $requete = "SELECT id_bouteille AS id, nom_bouteille AS nom, T2.nom AS type_vin, url_saq 
                    FROM vino__bouteille AS T1 LEFT JOIN vino__type AS T2
                    ON T1.type_id = T2.id
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


    public function lireCepages()
    {
        $requete = "SELECT id, nom FROM vino__cepage ORDER BY id";

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


    public function lireClassifications()
    {
        $requete = "SELECT id, nom FROM vino__classification ORDER BY id";

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


    public function lireDegresAlcool()
    {
        $requete = "SELECT id, nom, valeur FROM vino__degre_alcool ORDER BY id";

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


    public function lireDesignations()
    {
        $requete = "SELECT id, nom FROM vino__designation ORDER BY id";

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


    public function lireFormats()
    {
        $requete = "SELECT id, nom, valeur_ml, valeur_litre FROM vino__format ORDER BY id";

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


    public function lirePays()
    {
        $requete = "SELECT id, nom, producteur FROM generique__pays ORDER BY id";

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


    public function lireProduitsQc()
    {
        $requete = "SELECT id, nom FROM vino__produit_du_quebec ORDER BY id";

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


    public function lireRegions()
    {
        $requete = "SELECT id, nom FROM vino__region ORDER BY id";

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


    public function lireTable($nomTable, $id = null)
    {
        $donnees = [];

        switch ($nomTable) {
            case "vino__appellation":
                if (isset($id)) {
                    $donnees = $this->lireUneAppellation($id);
                } else {
                    $donnees = $this->lireAppellations();
                }

                break;

            case "vino__bouteille":
                if (isset($id)) {
                    $donnees = $this->lireUneBouteille($id);
                } else {
                    $donnees = $this->lireBouteilles();
                }

                break;

            case "vino__cepage":
                if (isset($id)) {
                    $donnees = $this->lireUnCepage($id);
                } else {
                    $donnees = $this->lireCepages();
                }

                break;

            case "vino__classification":
                if (isset($id)) {
                    $donnees = $this->lireUneClassification($id);
                } else {
                    $donnees = $this->lireClassifications();
                }

                break;

            case "vino__degre_alcool":
                if (isset($id)) {
                    $donnees = $this->lireUnDegreAlcool($id);
                } else {
                    $donnees = $this->lireDegresAlcool();
                }

                break;

            case "vino__designation":
                if (isset($id)) {
                    $donnees = $this->lireUneDesignation($id);
                } else {
                    $donnees = $this->lireDesignations();
                }

                break;

            case "vino__format":
                if (isset($id)) {
                    $donnees = $this->lireUnFormat($id);
                } else {
                    $donnees = $this->lireFormats();
                }

                break;

            case "generique__pays":
                if (isset($id)) {
                    $donnees = $this->lireUnPays($id);
                } else {
                    $donnees = $this->lirePays();
                }

                break;

            case "vino__produit_du_quebec":
                if (isset($id)) {
                    $donnees = $this->lireUnProduitQc($id);
                } else {
                    $donnees = $this->lireProduitsQc();
                }

                break;

            case "vino__region":
                if (isset($id)) {
                    $donnees = $this->lireUneRegion($id);
                } else {
                    $donnees = $this->lireRegions();
                }

                break;

            case "vino__taux_de_sucre":
                if (isset($id)) {
                    $donnees = $this->lireUnTauxDeSucre($id);
                } else {
                    $donnees = $this->lireTauxDeSucre();
                }

                break;

            case "vino__type_cellier":
                if (isset($id)) {
                    $donnees = $this->lireUnTypeCellier($id);
                } else {
                    $donnees = $this->lireTypesCellier();
                }

                break;

            case "vino__type":
                if (isset($id)) {
                    $donnees = $this->lireUnTypeVin($id);
                } else {
                    $donnees = $this->lireTypesVin();
                }

                break;
        }

        return $donnees;
    }


    public function lireTauxDeSucre()
    {
        $requete = "SELECT id, nom, valeur FROM vino__taux_de_sucre ORDER BY id";

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


    public function lireTypesVin()
    {
        $requete = "SELECT id, nom FROM vino__type ORDER BY id";

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


    public function lireTypesCellier()
    {
        $requete = "SELECT id_type_cellier AS id, nom_type_cellier AS nom, nom_commun_type_cellier AS nom_commun
                    FROM vino__type_cellier 
                    ORDER BY id_type_cellier";

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


    public function lireUnCepage($id)
    {
        $requete = "SELECT id, nom FROM vino__cepage WHERE id = " . $id;

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


    public function lireUnDegreAlcool($id)
    {
        $requete = "SELECT id, nom, valeur FROM vino__degre_alcool WHERE id = " . $id;

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


    public function lireUneAppellation($id)
    {
        $requete = "SELECT id, nom FROM vino__appellation WHERE id = " . $id;

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


    public function lireUneBouteille($id)
    {
        $requete = "SELECT id_bouteille AS id, nom_bouteille AS nom, image_bouteille, code_saq, code_cup, pays_id, region_id, type_id, description_bouteille, producteur, prix_bouteille,
                            url_saq, url_img, format_id, appellation_id, designation_id, classification_id, cepages_id, taux_de_sucre_id, degre_alcool_id, 
                            produit_du_quebec_id, biodynamique, casher, desalcoolise, equitable, faible_taux_alcool, produit_bio, vin_nature, vin_orange
                    FROM vino__bouteille
                    WHERE id_bouteille = " . $id;

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


    public function lireUneClassification($id)
    {
        $requete = "SELECT id, nom FROM vino__classification WHERE id = " . $id;

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


    public function lireUneDesignation($id)
    {
        $requete = "SELECT id, nom FROM vino__designation WHERE id = " . $id;

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


    public function lireUneRegion($id)
    {
        $requete = "SELECT id, nom FROM vino__region WHERE id = " . $id;

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


    public function lireUnFormat($id)
    {
        $requete = "SELECT id, nom, valeur_ml, valeur_litre FROM vino__format WHERE id = " . $id;

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


    public function lireUnPays($id)
    {
        $requete = "SELECT id, nom, producteur FROM generique__pays WHERE id = " . $id;

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


    public function lireUnProduitQc($id)
    {
        $requete = "SELECT id, nom FROM vino__produit_du_quebec WHERE id = " . $id;

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


    public function lireUnTauxDeSucre($id)
    {
        $requete = "SELECT id, nom, valeur FROM vino__taux_de_sucre WHERE id = " . $id;

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


    public function lireUnTypeVin($id)
    {
        $requete = "SELECT id, nom FROM vino__type WHERE id = " . $id;

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


    public function lireUnTypeCellier($id)
    {
        $requete = "SELECT id_type_cellier AS id, nom_type_cellier AS nom, nom_commun_type_cellier AS nom_commun
                    FROM vino__type_cellier 
                    WHERE id_type_cellier = " . $id;

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


    public function modifierAppellation($donnees)
    {
        $requete = "UPDATE vino__appellation SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierBouteille($donnees)
    {
        $requete = "UPDATE vino__bouteille SET 
                            nom_bouteille = '{$donnees->nom_bouteille}',
                            description_bouteille = '{$donnees->description_bouteille}',
                            code_saq = '{$donnees->code_saq}',
                            code_cup = '{$donnees->code_cup}',
                            pays_id = '{$donnees->pays_id}',
                            region_id = '{$donnees->region_id}',
                            type_id = '{$donnees->type_id}',
                            producteur = '{$donnees->producteur}',
                            url_saq = '{$donnees->url_saq}',
                            url_img = '{$donnees->url_img}',
                            format_id = '{$donnees->format_id}',
                            appellation_id = '{$donnees->appellation_id}',
                            designation_id = '{$donnees->designation_id}',
                            classification_id = '{$donnees->classification_id}',
                            cepages_id = '{$donnees->cepages_id}',
                            taux_de_sucre_id = '{$donnees->taux_de_sucre_id}',
                            degre_alcool_id = '{$donnees->degre_alcool_id}',
                            produit_du_quebec_id = '{$donnees->produit_du_quebec_id}',
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


    public function modifierCepage($donnees)
    {
        $requete = "UPDATE vino__cepage SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierClassification($donnees)
    {
        $requete = "UPDATE vino__classification SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierDegreAlcool($donnees)
    {
        $requete = "UPDATE vino__degre_alcool SET 
                            nom = '{$donnees->nom}',
                            valeur = '{$donnees->valeur}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierDesignation($donnees)
    {
        $requete = "UPDATE vino__designation SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierFormat($donnees)
    {
        $requete = "UPDATE vino__format SET 
                            nom = '{$donnees->nom}',
                            valeur_ml = '{$donnees->valeur_ml}',
                            valeur_litre = '{$donnees->valeur_litre}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierPays($donnees)
    {
        $requete = "UPDATE generique__pays SET 
                            nom = '{$donnees->nom}',
                            producteur = '{$donnees->producteur}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierProduitQc($donnees)
    {
        $requete = "UPDATE vino__produit_du_quebec SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierRegion($donnees)
    {
        $requete = "UPDATE vino__region SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierTauxSucre($donnees)
    {
        $requete = "UPDATE vino__taux_de_sucre SET 
                            nom = '{$donnees->nom}',
                            valeur = '{$donnees->valeur}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierTypeCellier($donnees)
    {
        $requete = "UPDATE vino__type_cellier SET 
                            nom_type_cellier = '{$donnees->nom}',
                            nom_commun_type_cellier = '{$donnees->nom_commun}'
                    WHERE id_type_cellier = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierTypeVin($donnees)
    {
        $requete = "UPDATE vino__type SET nom = '{$donnees->nom}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }
}
