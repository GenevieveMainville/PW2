<?php

/**
 * Class MonSQL
 * Classe qui génère ma connection à MySQL à travers un singleton
 *
 *
 * @author Jonathan Martel
 * @version 1.0
 *
 *
 *
 */
class SAQ extends Modele
{

    const DUPLICATION = 'duplication';
    const INSERE = 'Nouvelle bouteille insérée';

    private static $_webpage;
    private $stmt;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * getProduits
     * @param int $nombre
     * @param int $debut
     */
    public function getProduits($nombre = 24, $page = 1)
    {
        $s = curl_init();
        $url = "https://www.saq.com/fr/produits/vin/vin-rouge?p=" . $page . "&product_list_limit=" . $nombre . "&product_list_order=name_asc";

        $this->stmt = $this->_db->prepare("INSERT INTO saq_data2 (code_saq, url_saq) VALUES (?, ?)");

        // Se prendre pour un navigateur pour berner le serveur de la saq...
        curl_setopt_array($s, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
            CURLOPT_ENCODING => 'gzip, deflate',
            CURLOPT_HTTPHEADER => array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
            ),
        ));

        self::$_webpage = curl_exec($s);
        curl_close($s);

        $doc = new DOMDocument();
        $doc->recover = true;
        $doc->strictErrorChecking = false;
        @$doc->loadHTML(self::$_webpage);

        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//div[@class='saq-code']");
        $i = 0;

        foreach ($nodeList as $node) {
            $arr = explode(" ", trim($node->nodeValue));
            $codeSAQ = end($arr);

            $retour = self::ajouteProduit($codeSAQ);
            if ($retour->succes) $i++;
        }

        return $i;
    }

    private function nettoyerEspace($chaine)
    {
        return preg_replace('/\s+/', ' ', $chaine);
    }

    public function recupereInfo()
    {
        $rows = $this->_db->query("SELECT id, url_saq FROM saq_data2 ORDER BY id");

        if ($rows->num_rows) {
            while ($row = $rows->fetch_assoc()) {
                $id = $row['id'];
                $url = $row['url_saq'];
                $html = self::curl_get_contents($url);

                $doc = new DOMDocument();
                $doc->recover = true;
                $doc->strictErrorChecking = false;
                @$doc->loadHTML($html);

                $xp  = new DomXPath($doc);
                $attributs = $xp->query('//ul[@class="list-attributs"]/li');
                $titre = $xp->query('//h1[@class="page-title"]');
                $prix = $xp->query('//span[@class="price"]');
                $src = NULL;

                foreach ($xp->query('//a[@class="MagicZoom"][@href]//img') as $img) {
                    for ($link = $img; $link->tagName !== 'a'; $link = $link->parentNode);
                    $src = $img->getAttribute('src');
                }

                if (isset($src)) {
                    $src = explode(".png", $src)[0] . ".png";
                } else {
                    $src = "https://www.saq.com/media/wysiwyg/placeholder/category/06.png";
                }

                $titre = trim($titre[0]->nodeValue);

                $prix = explode("$", $prix[0]->nodeValue)[0];
                $prix = str_replace(",", ".", $prix);
                $prix = (float)trim($prix);

                $lesAttributs = array();
                foreach ($attributs as $attribut) {
                    $lesAttributs[] = $attribut->nodeValue;
                }

                $bte = array();
                $bte["nom_bouteille"] = $titre;
                $bte["prix_bouteille"] = $prix;
                $bte["image_bouteille"] = $src;
                $bte["pays_nom"] = NULL;
                $bte["region_nom"] = NULL;
                $bte["appellation_nom"] = NULL;
                $bte["designation_nom"] = NULL;
                $bte["classification_nom"] = NULL;
                $bte["cepage_nom"] = NULL;
                $bte["degre_alcool_nom"] = NULL;
                $bte["taux_de_sucre_nom"] = NULL;
                $bte["type_de_vin_nom"] = NULL;
                $bte["particularite"] = NULL;
                $bte["biodynamique"] = NULL;
                $bte["casher"] = NULL;
                $bte["desalcoolise"] = NULL;
                $bte["equitable"] = NULL;
                $bte["faible_taux_alcool"] = NULL;
                $bte["produit_bio"] = NULL;
                $bte["vin_nature"] = NULL;
                $bte["vin_orange"] = NULL;
                $bte["format_nom"] = NULL;
                $bte["producteur"] = NULL;
                $bte["agent"] = NULL;
                $bte["code_cup"] = NULL;
                $bte["produit_du_quebec_nom"] = NULL;
                $bte["id"] = $id;

                for ($i = 0, $l = count($lesAttributs); $i < $l; $i++) {
                    if (strpos($lesAttributs[$i], "Pays") !== false) {
                        $bte["pays_nom"] = trim(explode("Pays", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Région") !== false) {
                        $bte["region_nom"] = trim(explode("Région", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Appellation d'origine") !== false) {
                        $bte["appellation_nom"] = trim(explode("Appellation d'origine", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Désignation réglementée") !== false) {
                        $bte["designation_nom"] = trim(explode("Désignation réglementée", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Classification") !== false) {
                        $bte["classification_nom"] = trim(explode("Classification", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Cépage") !== false) {
                        $bte["cepage_nom"] = trim(explode("Cépage", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Degré d'alcool") !== false) {
                        $bte["degre_alcool_nom"] = trim(explode("Degré d'alcool", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Taux de sucre") !== false) {
                        $bte["taux_de_sucre_nom"] = trim(explode("Taux de sucre", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Couleur") !== false) {
                        $couleur = trim(explode("Couleur", $lesAttributs[$i])[1]);

                        if (str_contains($couleur, "Rouge")) $bte["type_de_vin_nom"] = "Vin rouge";
                        if (str_contains($couleur, "Blanc")) $bte["type_de_vin_nom"] = "Vin blanc";
                        if (str_contains($couleur, "Rosé")) $bte["type_de_vin_nom"] = "Vin rosé";
                    }
                    if (strpos($lesAttributs[$i], "Particularité") !== false) {
                        $bte["particularite"] = trim(explode("Particularité", $lesAttributs[$i])[1]);

                        if (str_contains($bte["particularite"], "Biodynamique")) $bte["biodynamique"] = 1;
                        if (str_contains($bte["particularite"], "Casher")) $bte["casher"] = 1;
                        if (str_contains($bte["particularite"], "Désalcoolisé")) $bte["desalcoolise"] = 1;
                        if (str_contains($bte["particularite"], "Équitable")) $bte["equitable"] = 1;
                        if (str_contains($bte["particularite"], "Faible taux")) $bte["faible_taux_alcool"] = 1;
                        if (str_contains($bte["particularite"], "Produit bio")) $bte["produit_bio"] = 1;
                        if (str_contains($bte["particularite"], "Vin nature")) $bte["vin_nature"] = 1;
                        if (str_contains($bte["particularite"], "Vin orange")) $bte["vin_orange"] = 1;
                    }
                    if (strpos($lesAttributs[$i], "Format") !== false) {
                        $bte["format_nom"] = trim(explode("Format", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Producteur") !== false) {
                        $bte["producteur"] = trim(explode("Producteur", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Agent promotionnel") !== false) {
                        $bte["agent"] = trim(explode("Agent promotionnel", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Code CUP") !== false) {
                        $bte["code_cup"] = trim(explode("Code CUP", $lesAttributs[$i])[1]);
                    }
                    if (strpos($lesAttributs[$i], "Produit du Québec") !== false) {
                        $bte["produit_du_quebec_nom"] = trim(explode("Produit du Québec", $lesAttributs[$i])[1]);
                    }
                }

                $requete = "UPDATE saq_data2 SET nom_bouteille = ?, prix_bouteille = ?, image_bouteille = ?, pays_nom = ?, region_nom = ?, appellation_nom = ?, designation_nom = ?, classification_nom = ?, cepage_nom = ?, degre_alcool_nom = ?, taux_de_sucre_nom = ?, type_de_vin_nom = ?, particularite = ?, biodynamique = ?, casher = ?, desalcoolise = ?, equitable = ?, faible_taux_alcool = ?, produit_bio = ?, vin_nature = ?, vin_orange = ?, format_nom = ?, producteur = ?, agent = ?, code_cup = ?, produit_du_quebec_nom = ? WHERE id = ?";

                if (!($stmt = $this->_db->prepare($requete))) {
                    var_dump("SAQ.recupereInfo: Echec de la préparation: " . $stmt->error . "<br>");
                    return false;
                }

                $stmt->bind_param(
                    "sdsssssssssssiiiiiiiisssssi",
                    $bte["nom_bouteille"],
                    $bte["prix_bouteille"],
                    $bte["image_bouteille"],
                    $bte["pays_nom"],
                    $bte["region_nom"],
                    $bte["appellation_nom"],
                    $bte["designation_nom"],
                    $bte["classification_nom"],
                    $bte["cepage_nom"],
                    $bte["degre_alcool_nom"],
                    $bte["taux_de_sucre_nom"],
                    $bte["type_de_vin_nom"],
                    $bte["particularite"],
                    $bte["biodynamique"],
                    $bte["casher"],
                    $bte["desalcoolise"],
                    $bte["equitable"],
                    $bte["faible_taux_alcool"],
                    $bte["produit_bio"],
                    $bte["vin_nature"],
                    $bte["vin_orange"],
                    $bte["format_nom"],
                    $bte["producteur"],
                    $bte["agent"],
                    $bte["code_cup"],
                    $bte["produit_du_quebec_nom"],
                    $bte["id"]
                );

                $retour = $stmt->execute();
                if (!$retour) {
                    echo ("*** ATTENTION *** Traitement raté pour : " . $url . "<br>");
                    return false;
                }

                echo ("Traitement réussi pour : " . $url . "<br>");
            }
        }

        return true;
    }

    private function curl_get_contents($url)
    {
        $curl_moteur = curl_init();
        curl_setopt($curl_moteur, CURLOPT_URL, $url);
        curl_setopt($curl_moteur, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl_moteur, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        curl_setopt($curl_moteur, CURLOPT_FOLLOWLOCATION, 1);
        $web = curl_exec($curl_moteur);
        curl_close($curl_moteur);
        return $web;
    }

    private function ajouteProduit($codeSAQ)
    {
        $retour = new stdClass();
        $retour->succes = false;
        $retour->raison = '';
        $lienSAQ = "https://www.saq.com/fr/" . $codeSAQ;
        $rows = $this->_db->query("select id from saq_data2 where code_saq = '" . $codeSAQ . "'");

        if ($rows->num_rows < 1) {
            $this->stmt->bind_param("ss", $codeSAQ, $lienSAQ);
            $retour->succes = $this->stmt->execute();
            $retour->raison = self::INSERE;
        } else {
            $retour->succes = false;
            $retour->raison = self::DUPLICATION;
        }

        return $retour;
    }
}
