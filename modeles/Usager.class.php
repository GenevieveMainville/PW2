<?php

/**
 * Class Usager
 * Cette classe possède les fonctions de gestion des usagers de l'application Vino.
 * 
 * @author Christian Roy
 * @version 1.0
 * @update 2022-06-28
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Usager extends Modele
{
    public function ajouterAdminUsager($donnees)
    {
        $requete = "INSERT INTO usager__detail (nom, adresse, telephone, courriel, date_naissance, ville, nom_utilisateur, type_utilisateur) 
                        VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->adresse}'," .
            "'{$donnees->telephone}'," .
            "'{$donnees->courriel}'," .
            "'{$donnees->date_naissance}'," .
            "'{$donnees->ville}'," .
            "'{$donnees->nom_utilisateur}'," .
            "'{$donnees->type_utilisateur}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function ajouterUsager($donnees)
    {
        $requete = "INSERT INTO usager__detail (nom, adresse, telephone, courriel, date_naissance, ville, pays_id, nom_utilisateur, mot_de_passe, type_utilisateur, jeton, date_creation, date_modification) 
                        VALUES (" .
            "'{$donnees->nom}'," .
            "'{$donnees->adresse}'," .
            "'{$donnees->telephone}'," .
            "'{$donnees->courriel}'," .
            "'{$donnees->date_naissance}'," .
            "'{$donnees->ville}'," .
            "'{$donnees->pays_id}'," .
            "'{$donnees->nom_utilisateur}'," .
            "'{$donnees->mot_de_passe}'," .
            "'{$donnees->type_utilisateur}'," .
            "'{$donnees->jeton}'," .
            "'{$donnees->date_creation}'," .
            "'{$donnees->date_modification}')";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function getAdminNbUsagers()
    {
        $nbTrouve = 0;
        $requete = "SELECT COUNT(*) AS nbTrouve FROM usager__detail";

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


    public function getAdminUnUsager($id_usager)
    {
        $requete = "SELECT id, nom, adresse, telephone, courriel, date_naissance, ville, nom_utilisateur, type_utilisateur, date_creation, date_modification, dernier_access
                    FROM usager__detail
                    WHERE id = {$id_usager}";

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


    public function getAdminUsagers()
    {
        $rows = array();

        $requete = "SELECT id, nom, courriel, nom_utilisateur, type_utilisateur
                    FROM usager__detail
                    ORDER BY id;";

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


    public function lireTypesUsager()
    {
        $requete = "SELECT id, nom FROM usager__type ORDER BY id";

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


    public function lireUsager($id)
    {
        $requete = "SELECT nom, adresse, telephone, courriel, verification_courriel, 
                            date_naissance, ville, pays_id, nom_utilisateur, mot_de_passe
                    FROM usager__detail
                    WHERE id = " . $id;

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


    public function modifierAdminUsager($donnees)
    {
        $requete = "UPDATE usager__detail SET 
                            nom = '{$donnees->nom}',
                            adresse = '{$donnees->adresse}',
                            telephone = '{$donnees->telephone}',
                            courriel = '{$donnees->courriel}',
                            date_naissance = '{$donnees->date_naissance}',
                            ville = '{$donnees->ville}',
                            nom_utilisateur = '{$donnees->nom_utilisateur}',
                            type_utilisateur = '{$donnees->type_utilisateur}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function modifierUsager($donnees)
    {
        $requete = "UPDATE usager__detail SET 
                            nom = '{$donnees->nom}',
                            adresse = '{$donnees->adresse}',
                            telephone = '{$donnees->telephone}',
                            courriel = '{$donnees->courriel}',
                            date_naissance = '{$donnees->date_naissance}',
                            ville = '{$donnees->ville}',
                            nom_utilisateur = '{$donnees->nom_utilisateur}',
                            mot_de_passe = '{$donnees->mot_de_passe}',
                            date_modification = '{$donnees->date_modification}'
                    WHERE id = '{$donnees->id}'";

        $res = $this->_db->query($requete);
        return $res;
    }


    public function verifierCourriel($courriel)
    {
        $trouve = false;
        $requete = "SELECT * FROM usager__detail WHERE courriel = '{$courriel}'";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                $trouve = true;
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $trouve;
    }


    public function verifierNom($utilisateur)
    {
        $trouve = false;
        $requete = "SELECT * FROM usager__detail WHERE nom_utilisateur = '{$utilisateur}'";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                $trouve = true;
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $trouve;
    }


    public function verifierUtilisateur($id)
    {
        $trouve = false;
        $requete = "SELECT courriel, nom_utilisateur FROM usager__detail WHERE id = '{$id}'";

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
}
