<?php

/**
 * Class Cellier
 * Cette classe possède les fonctions de gestion des celliers de l'utilisateur.
 * 
 * @author Genevieve Mainville
 * @version 1.0
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Cellier extends Modele
{
    const TABLE = 'usager__cellier';


    public function ajouterAdminCellier($donnees)
    {
        $requete = "INSERT INTO usager__cellier (id_usager, nom_cellier, description_cellier, type_cellier_id)
                    VALUES (" .
            "'{$donnees->id_usager}'," .
            "'{$donnees->nom_cellier}'," .
            "'{$donnees->description_cellier}'," .
            "'{$donnees->type_cellier_id}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function getAdminCelliers()
    {
        $rows = array();

        $requete = "SELECT id_cellier, id_usager, nom_cellier, type_cellier_id
                    FROM usager__cellier
                    ORDER BY id_cellier";

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


    public function getAdminNbCelliers()
    {
        $nbTrouve = 0;
        $requete = "SELECT COUNT(*) AS nbTrouve FROM usager__cellier";

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


    public function getAdminUnCellier($id_cellier)
    {
        $rows = array();

        $requete = "SELECT id_cellier, id_usager, nom_cellier, description_cellier, type_cellier_id
                    FROM usager__cellier
                    WHERE id_cellier = " . $id_cellier;

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


    public function modifierAdminCellier($donnees)
    {
        $requete = "UPDATE usager__cellier SET 
                            nom_cellier = '{$donnees->nom_cellier}',
                            description_cellier = '{$donnees->description_cellier}',
                            type_cellier_id = '{$donnees->type_cellier_id}'
                    WHERE id_cellier = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    /**
     * Cette méthode récupère la liste des celliers d'un usagé
     * 
     * @param int $id Id de session de l'usagé
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Array Les données.
     */

    public function getListeCellier($id)
    {


        $rows = array();
        $requete = "SELECT usager__cellier.id_cellier, id_usager, nom_cellier, description_cellier, type_cellier_id, 
                    SUM(quantite_bouteille)as bouteille_total, 
                    SUM(prix_bouteille)as prix_total,  vino__type_cellier.nom_commun_type_cellier, vino__type_cellier.id_type_cellier 
                    FROM usager__cellier 
                    INNER JOIN vino__type_cellier on type_cellier_id = vino__type_cellier.id_type_cellier 
                    LEFT OUTER JOIN usager__bouteille on usager__cellier.id_cellier = usager__bouteille.id_cellier 
                    WHERE id_usager = '$id'
                    Group by usager__cellier.id_cellier
                    ORDER BY usager__cellier.id_cellier DESC";

       
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

    /**
     * Cette méthode récupère les informations d'un cellier
     * 
     * @param int $id Id du cellier
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Array Les données.
     */

    public function getUnCellier($id)
    {

        $rows = array();
        $requete = "SELECT *
                    FROM usager__cellier 
                    WHERE id_cellier = '$id'";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    //$row['nom_cellier'] = trim(utf8_encode($row['nom_cellier']));
                    // $row['description_cellier'] = trim(utf8_encode($row['description_cellier']));
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }

    /**
     * Cette méthode crée un nouveau cellier.
     * 
     * @param Array $data Tableau des données représentants le cellier.
     * 
     * @return Boolean Succès de l'ajout.
     * @return Array Échec de l'ajout, tableau de messages d'erreurs.
     */
    public function ajouterNouveauCellier($data)
    {
        // VALIDATION 
        $erreurs = array();
        $estValide = true;

        //Si il ya des données
        if ($data) {
            // VALIDATION NOM
            // Réinitialisation du tableau d'erreur
            unset($erreurs['nom_cellier']);
            $regExp = '/^.+$/';
            $data->nom_cellier = trim($data->nom_cellier);
            if (!preg_match($regExp, $data->nom_cellier)) {
                $erreurs['nom_cellier'] = 'Au moins un caractère.';
                $estValide = false;
            }

            // VALIDATION type_cellier_id
            // Réinitialisation du tableau d'erreur
            unset($erreurs['type_cellier_id']);
            //Si est nul donc aucun choix de radio bouton
            if ($data->type_cellier_id == null) {
                $erreurs['type_cellier_id'] = 'Choisir le type de cellier.';
                $estValide = false;
            }
            $data->description_cellier = trim($data->description_cellier);
            //Si tout est valide
            if ($estValide) {
                $requete = "INSERT INTO usager__cellier(id_usager,nom_cellier,description_cellier,type_cellier_id) VALUES (" .
                    "'" . $data->id_usager . "'," .
                    "'" . $data->nom_cellier . "'," .
                    "'" . $data->description_cellier . "'," .
                    "'" . $data->type_cellier_id . "')";

                $res = $this->_db->query($requete);

                return $res;
            } else {
                return $erreurs;
            }
        }
    }


    /**
     * Cette méthode modifie les informations d'un cellier
     * 
     * @param Array $data Tableau des informations à modifier
     * 
     * @return Boolean Succès ou échec de l'ajout.
     */
    public function modifierCellier($data)
    {
        $id = $data->id_cellier;
        $nom_cellier = $data->nom_cellier;
        $description_cellier = $data->description_cellier;
        $type_cellier_id = $data->type_cellier_id;

        // VALIDATION 
        $erreurs = array();
        $estValide = true;

        //Si il ya des données
        if ($data) {
            // VALIDATION NOM
            // Réinitialisation du tableau d'erreur
            unset($erreurs['nom_cellier']);
            $regExp = '/^.+$/';
            if (!preg_match($regExp, $nom_cellier)) {
                $erreurs['nom_cellier'] = 'Au moins un caractère.';
                $estValide = false;
            }

            // VALIDATION type_cellier_id
            // Réinitialisation du tableau d'erreur
            unset($erreurs['type_cellier_id']);
            //Si est nul donc aucun choix de radio bouton
            if ($type_cellier_id == null) {
                $erreurs['type_cellier_id'] = 'Choisir le type de cellier.';
                $estValide = false;
            }
        }

        if ($estValide) {

            $requete = "UPDATE usager__cellier SET nom_cellier = '$nom_cellier' , description_cellier = '$description_cellier', type_cellier_id = '$type_cellier_id' 
                    WHERE id_cellier = '$id'";

            $res = $this->_db->query($requete);

            return $res;
        } else {
            return $erreurs;
        }
    }


    /**
     * Cette méthode récupère le nombre de cellier que possède un usagé
     * 
     * @param int $id Id de session de l'usagé
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return String Le nombre de cellier.
     */
    public function nombreCellierUsager($id)
    {
        //Requête
        $requete = "SELECT COUNT(id_usager) AS nombre_cellier FROM usager__cellier where id_usager = '$id'";

        if (($res = $this->_db->query($requete)) == true) {

            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {

                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }
        //Extraire la donnée
        $valeur = $rows[0]["nombre_cellier"];
        return $valeur;
    }

    /**
     * Cette méthode déplace toutes les bouteilles d'un cellier dans un autre cellier
     * 
     * @param Int $id id_cellier sélectionné par l'usager
     * 
     *  @param Array $idBouteilles Tableau des id de bouteille à déplacer
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Boolean Succès ou échec de l'ajout.
     */
    public function deplacerBouteillesCellier($id, $bouteilles)
    {
      
            foreach ($bouteilles as $bouteille) {
                if($id === "null"){
                    
                    $id_bouteille = $bouteille['id_bouteille'];
    
                    $requete = "UPDATE usager__bouteille SET id_cellier = null
                        WHERE id_bouteille = '$id_bouteille'";
        
                    $res = $this->_db->query($requete);
                }else{
                    $id_bouteille = $bouteille['id_bouteille'];
    
                    $requete = "UPDATE usager__bouteille SET id_cellier = '$id'
                        WHERE id_bouteille = '$id_bouteille'";
        
                    $res = $this->_db->query($requete);
                }
                
            }
            
        
        
       
        return $res;
    }
    /**
     * Cette méthode supprime le cellier
     * 
     * @param Int $id id_cellier sélectionné par l'usager
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Boolean Succès ou échec de l'ajout.
     */
    public function supprimerCellier($id)
    {
       
        $requete = "DELETE FROM usager__cellier WHERE id_cellier = '$id'";

        $res = $this->_db->query($requete);
        return $res;

        
    }

    /**
     * Cette méthode récupère l'id d'une bouteille selon le code cup envoyé en paramètre
     *
     * @param int $cup, le code cup
     * 
     * @return Array id_bouteille, le id de la bouteille
     *
     */
    public function getBouteilleCUP($cup){
        $rows = array();
        $requete = 'SELECT id_bouteille
                    FROM vino__bouteille 
                    WHERE code_cup =' .$cup;

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                  
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

      
        return $rows[0]['id_bouteille'];
    }
}
