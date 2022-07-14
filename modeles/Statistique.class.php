<?php

/**
 * Class Statistique
 * Cette classe possède les fonctions de statistiques des celliers et bouteilles des utilisateurs.
 * 
 * @author Genevieve Mainville
 * @version 1.0
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Statistique extends Modele
{

    /**
     * Cette méthode récupère le pourcentage de chaque type de vin d'un usager
     * 
     * @param int $id_usager Id de session de l'usager
     * @param int $id_cellier Id du cellier 
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Array Le pourcentage de chaque type
     */
    public function getTypeVinCellier($id_usager, $id_cellier){
        $nbre_bouteilles_rouge = 0;
        $nbre_bouteilles_blanc = 0;
        $nbre_bouteilles_rose = 0;
        $nbre_bouteilles_totales = 0;
        $p_rouge = 0;
        $p_blanc = 0;
        $p_rose = 0;

        $rows = array();
        if($id_usager){
            $res = $this->_db->query("SELECT quantite_bouteille, type_de_vin_nom FROM usager__bouteille WHERE id_cellier IN (SELECT id_cellier FROM usager__cellier WHERE id_usager = '$id_usager')");
           
        }
        else if($id_cellier !== 0 || $id_cellier !== null ){
            $res = $this->_db->query("SELECT type_de_vin_nom FROM usager__bouteille WHERE id_cellier IN ('$id_cellier')"); 
        }

        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
                $rows[] = $row; 
            }
        }
        //Nombre de bouteille de chaque type
        foreach($rows as $type){
            $nbre_bouteilles_totales += $type['quantite_bouteille'];
            
            if($type['type_de_vin_nom'] == 'Vin rouge'){
                $nbre_bouteilles_rouge += $type['quantite_bouteille'];
            }
            else if($type['type_de_vin_nom'] == 'Vin blanc'){
                $nbre_bouteilles_blanc += $type['quantite_bouteille'];
            }
            else if($type['type_de_vin_nom'] == "Vin rosé"){
                $nbre_bouteilles_rose += $type['quantite_bouteille'];
            }

        }
       // Pourcentage de chaque type
        if($nbre_bouteilles_rouge !== 0){
            $p_rouge= ($nbre_bouteilles_rouge/$nbre_bouteilles_totales)*100;
            
        }
        if($nbre_bouteilles_blanc!== 0){
            $p_blanc= ($nbre_bouteilles_blanc/$nbre_bouteilles_totales)*100;
        }
        if($nbre_bouteilles_rose!== 0){
            $p_rose= ($nbre_bouteilles_rose/$nbre_bouteilles_totales)*100;
        }
           
            $rows = ["p_rouge" =>$p_rouge,"p_blanc" =>$p_blanc,"p_rose" =>$p_rose,"n_rouge" =>$nbre_bouteilles_rouge,"n_blanc" =>$nbre_bouteilles_blanc,"n_rose" =>$nbre_bouteilles_rose];
        
       
        return $rows;
    }

    
    /**
     * Cette méthode récupère les données des bouteilles des usager par cellier
     * 
     * @param int $id_usager Id de session de l'usager
     * @param int $id_cellier Id du cellier 
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Array Les données
     */
    public function getInfosBouteilleUsager($id_usager, $id_cellier){
        $rows = array();
        if($id_usager){
            $res = $this->_db->query("SELECT * FROM usager__bouteille WHERE id_cellier IN (SELECT id_cellier FROM usager__cellier WHERE id_usager = '$id_usager')");
           
        }
        else if($id_cellier !== 0 || $id_cellier !== null ){
            $res = $this->_db->query("SELECT * FROM usager__bouteille WHERE id_cellier IN ('$id_cellier')"); 
        }

        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
               
                $rows[] = $row;
            }
        }
        
        return $rows;
    }

    /**
     * Cette méthode récupère les bouteilles bues par l'usager
     * 
     * @param int $id_usager Id de session de l'usager
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Array Les données
     */
    public function getBouteilleBues($id_usager){

        $rows = array();

        $res = $this->_db->query("SELECT * FROM bouteille_action WHERE id_usager = '$id_usager' AND action = 'd'");
           
        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
                // separe la date en annee, mois , jour
                $row['date_creation'] = explode("-", $row['date_creation']);
                $rows[] = $row; 

            }
        }
        return $rows;
    }   
    
    /**
     * Cette méthode récupère les bouteilles ajoutées par l'usager
     * 
     * @param int $id_usager Id de session de l'usager
     * 
     * @throws Exception Erreur de requête sur la base de données 
     * 
     * @return Array Les données
     */
    public function getBouteilleAjouts($id_usager){

        $rows = array();

        $res = $this->_db->query("SELECT * FROM bouteille_action WHERE id_usager = '$id_usager' AND action = 'a'");
           
        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
                // separe la date en annee, mois , jour
                $row['date_creation'] = explode("-", $row['date_creation']);
                $rows[] = $row; 

            }
        }
        return $rows;
    }    
    
    
}