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

    public function getListeBouteille()
    {

        $rows = array();
        $res = $this->_db->query('Select * from ' . self::TABLE);
        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        return $rows;
    }


     /**
     * Cette méthode récupère la liste des bouteilles d'un cellier d'un usager où la quantité de bouteille est plus grande que zéro
     * et liste descendant selon id_bouteille
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

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $row['nom_bouteille'] = trim(utf8_encode($row['nom_bouteille']));
                    $row['description_bouteille'] = trim(utf8_encode($row['description_bouteille']));
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
    
        }
        return $rows;
    }


    public function getOneBouteille($id)
    {

        $rows = array();

        // * CR - DEB - MODIF *
        $requete = 'SELECT 
						c.id as id_bouteille_cellier,
						c.id_bouteille, 
						c.date_achat, 
						c.garde_jusqua, 
						c.notes, 
						c.prix, 
						c.quantite,
						c.millesime, 
						b.id,
						b.nom, 
						b.categorie, 
						b.image, 
						b.code_saq, 
						b.url_saq, 
						b.pays, 
						b.prix_saq, 
                        p.nom AS nom_pays,
						b.description,
						f.nom as format,
						t.nom AS nom_categorie 
						from vino__cellier c 
						INNER JOIN vino__bouteille b ON c.id_bouteille = b.id
						INNER JOIN vino__categorie t ON t.id = b.categorie
						INNER JOIN vino__format f ON f.id = b.format
                        INNER JOIN vino__pays p ON p.id = b.pays
                        WHERE b.id = '. $id ;
        // * CR - FIN - MODIF *

        if (($res = $this->_db->query($requete)) ==     true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $row['nom'] = trim(utf8_encode($row['nom']));
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
     * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
     * 
     * @param string $nom La chaine de caractère à rechercher
     * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return array id et nom de la bouteille trouvée dans le catalogue
     */

    public function autocomplete($nom, $nb_resultat = 10)
    {

        $rows = array();
        $nom = $this->_db->real_escape_string($nom);
        $nom = preg_replace("/\*/", "%", $nom);

        //echo $nom;
        $requete = 'SELECT id, nom FROM vino__bouteille where LOWER(nom) like LOWER("%' . $nom . '%") LIMIT 0,' . $nb_resultat;
        //var_dump($requete);
        if (($res = $this->_db->query($requete)) ==     true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $row['nom'] = trim(utf8_encode($row['nom']));
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de données", 1);
        }


        //var_dump($rows);
        return $rows;
    }


    /**
     * Cette méthode ajoute une ou des bouteilles au cellier
     * 
     * @param Array $data Tableau des données représentants la bouteille.
     * 
     * @return Boolean Succès ou échec de l'ajout.
     */
    public function ajouterBouteilleCellier($data)
    {
        //TODO : Valider les données.
        //var_dump($data);	

        $requete = "INSERT INTO vino__cellier(id_bouteille,date_achat,garde_jusqua,notes,prix,quantite,millesime) VALUES (" .
            "'" . $data->id_bouteille . "'," .
            "'" . $data->date_achat . "'," .
            "'" . $data->garde_jusqua . "'," .
            "'" . $data->notes . "'," .
            "'" . $data->prix . "'," .
            "'" . $data->quantite . "'," .
            "'" . $data->millesime . "')";

        $res = $this->_db->query($requete);

        return $res;
    }


    /**
     * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
     * 
     * @param int $id id de la bouteille
     * @param int $nombre Nombre de bouteille a ajouter ou retirer
     * 
     * @return Boolean Succès ou échec de l'ajout.
     */
    public function modifierQuantiteBouteilleCellier($id, $nombre)
    {
        $erreur = "";
        if(is_numeric($id) && is_numeric($nombre)){
            $requete = "UPDATE usager__bouteille SET quantite_bouteille = GREATEST(quantite_bouteille + " . $nombre . ", 0) WHERE id_bouteille = " . $id;
            $res = $this->_db->query($requete);
            
        }
        else{
            $erreur = "$id et $nombre doivent être numériques.";
            return $erreur;
        }

        return $res;
        

        
    }
    
    
}
