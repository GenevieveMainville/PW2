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
    public function getAdminUsagers()
    {
        $rows = array();

        $requete = "SELECT T1.id as id_usager, T1.nom as nom_usager, T1.courriel as courriel_usager, T1.nom_utilisateur, T2.nom AS type_usager
                    FROM usager__detail AS T1 
                    LEFT JOIN usager__type AS T2 
                    ON T1.type_utilisateur = T2.id
                    ORDER BY T1.id;";

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
