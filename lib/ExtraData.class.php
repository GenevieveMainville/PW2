<?php

/**
 * Class ExtraData
 */
class ExtraData extends Modele
{
    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    public function lireFichier()
    {
        if (!($stmt = $this->_db->prepare("INSERT INTO saq_data (link, pays, region, appellation, designation, classification, cepage, degre_alcool, taux_de_sucre, couleur, particularite, format, producteur, agent, code_saq, code_cup, produit_qc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"))) {
            throw new Exception("Echec de la préparation", 1);
        }

        // fichier json
        $filenames = [
            "./files/run_results38.json"
        ];

        foreach ($filenames as $filename) {
            // Lire le fichier JSON dans du PHP
            $data = file_get_contents($filename);

            // Convert the JSON String into PHP Array
            $array = json_decode($data, true);
            $longData = sizeof($array["saq_urls"]);

            for ($i = 0; $i < $longData; $i++) {
                $myString = $array["saq_urls"][$i]["selection1"][0]['name'];
                $myArray = explode('{*}', $myString);

                $link = $array["saq_urls"][$i]["link"];
                $pays = "";
                $region = "";
                $appellation = "";
                $designation = "";
                $classification = "";
                $cepage = "";
                $degre_alcool = "";
                $taux_de_sucre = "";
                $couleur = "";
                $particularite = "";
                $format = "";
                $producteur = "";
                $agent = "";
                $code_saq = "";
                $code_cup = "";
                $produit_qc = "";

                $longSelection = sizeof($myArray);

                for ($j = 0; $j < $longSelection; $j++) {
                    $title = $myArray[$j];
                    if ($j < $longSelection - 1) $data = $myArray[$j + 1];

                    switch ($title) {
                        case "Pays":
                            $pays = $data;
                            break;

                        case "Région":
                            $region = $data;
                            break;

                        case "Appellation d'origine":
                            $appellation = $data;
                            break;

                        case "Désignation réglementée":
                            $designation = $data;
                            break;

                        case "Classification":
                            $classification = $data;
                            break;

                        case "Cépage":
                            $cepage = $data;
                            break;

                        case "Degré d'alcool":
                            $degre_alcool = $data;
                            break;

                        case "Taux de sucre":
                            $taux_de_sucre = $data;
                            break;

                        case "Couleur":
                            $couleur = $data;
                            break;

                        case "Particularité":
                            $particularite = $data;
                            break;

                        case "Format":
                            $format = $data;
                            break;

                        case "Producteur":
                            $producteur = $data;
                            break;

                        case "Agent promotionnel":
                            $agent = $data;
                            break;

                        case "Code SAQ":
                            $code_saq = $data;
                            break;

                        case "Code CUP":
                            $code_cup = $data;
                            break;

                        case "Produit du Québec":
                            $produit_qc = $data;
                            break;
                    }
                }

                $retour = false;

                $stmt->bind_param(
                    "sssssssssssssssss",
                    $link,
                    $pays,
                    $region,
                    $appellation,
                    $designation,
                    $classification,
                    $cepage,
                    $degre_alcool,
                    $taux_de_sucre,
                    $couleur,
                    $particularite,
                    $format,
                    $producteur,
                    $agent,
                    $code_saq,
                    $code_cup,
                    $produit_qc
                );

                $retour = $stmt->execute();
            }

            echo "Le fichier " . $filename . " a été traité.<br>";
        }

        echo "Tout est terminé !<br>";
        return true;
    }

    public function traiterDonnees()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $requete = 'SELECT id_bouteille, url_SAQ from vino__bouteille ORDER BY id_bouteille';
        $compteur = 0;
        $reussi = false;

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                echo "Nombre de lignes totales: " . $res->num_rows . "<br>";
                while ($row = $res->fetch_assoc()) {
                    $url_SAQ = $row['url_SAQ'];

                    $reussi = $this->mettreAJourDonnees($url_SAQ);
                    if (!$reussi) break;
                    $compteur++;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        echo "Nombre de lignes traitées: " . $compteur . "<br>";
        return $reussi;
    }

    private function mettreAJourDonnees($url_SAQ)
    {
        $row = $this->_db->query("SELECT * from saq_data WHERE link = '" . $url_SAQ . "'");

        if ($row->num_rows == 1) {
            $dataSaq = $row->fetch_assoc();
            $requete = 'UPDATE vino__bouteille SET region_id = ?, appellation_id = ?, designation_id = ?, classification_id = ?, cepages_id = ?, taux_de_sucre_id = ?, degre_alcool_id = ?, producteur = ?, code_cup = ?, biodynamique = ?, casher = ?, desalcoolise = ?, equitable = ?, faible_taux_alcool = ?, produit_bio = ?, vin_nature = ?, vin_orange = ?, produit_du_quebec_id = ? WHERE url_saq = ?';

            if (!($stmt = $this->_db->prepare($requete))) {
                echo ("mettreAJourDonnees: Echec de la préparation: " . $stmt->error . "<br>");
                return false;
            }

            $region = $dataSaq['region_id'];
            $appellation  = $dataSaq['appellation_id'];
            $designation = $dataSaq['designation_id'];
            $classification = $dataSaq['classification_id'];
            $cepage = $dataSaq['cepage_id'];
            $degre_alcool = $dataSaq['degre_alcool_id'];
            $taux_de_sucre = $dataSaq['taux_de_sucre_id'];
            $producteur = $dataSaq['producteur'];
            $code_cup = $dataSaq['code_cup'];
            $produit_qc = $dataSaq['produit_qc_id'];

            $particularite = $dataSaq['particularite'];
            $myArray = explode(',', $particularite);
            $nbParticularites = sizeof($myArray);

            $biodynamique = 0;
            $casher = 0;
            $desalcoolise = 0;
            $equitable = 0;
            $faible_taux_alcool = 0;
            $produit_bio = 0;
            $vin_nature = 0;
            $vin_orange = 0;

            for ($i = 0; $i < $nbParticularites; $i++) {
                $laChaine = $myArray[$i];

                if (strpos($laChaine, "Biodynamique")) $biodynamique = 1;
                if (strpos($laChaine, "Casher")) $casher = 1;
                if (strpos($laChaine, "Désalcoolisé")) $desalcoolise = 1;
                if (strpos($laChaine, "Équitable")) $equitable = 1;
                if (strpos($laChaine, "Faible taux")) $faible_taux_alcool = 1;
                if (strpos($laChaine, "Produit bio")) $produit_bio = 1;
                if (strpos($laChaine, "Vin nature")) $vin_nature = 1;
                if (strpos($laChaine, "Vin orange")) $vin_orange = 1;
            }

            $stmt->bind_param(
                "iiiiiiissiiiiiiiiis",
                $region,
                $appellation,
                $designation,
                $classification,
                $cepage,
                $taux_de_sucre,
                $degre_alcool,
                $producteur,
                $code_cup,
                $biodynamique,
                $casher,
                $desalcoolise,
                $equitable,
                $faible_taux_alcool,
                $produit_bio,
                $vin_nature,
                $vin_orange,
                $produit_qc,
                $url_SAQ
            );

            $retour = $stmt->execute();
            if (!$retour) return false;
        }

        return true;
    }
}
