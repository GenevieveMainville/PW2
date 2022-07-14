<?php
// Ouvrir une nouvelle connexion au serveur MySQL
$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die("Connexion à la base de données non établie.");

// Tableau qui contient la liste des erreurs
global $erreurs;

// Les champs à valider
$utilisateur = $motDePasse = "";

if (isset($_POST["soumettre"])) {
    // On efface les anciennes données de la session PHP
    unset($_SESSION['utilisateur']);

    if (isset($_POST["usager_nom_utilisateur"])) {
        $utilisateur = $_POST["usager_nom_utilisateur"];
    }
    if (isset($_POST["usager_mot_de_passe"])) {
        $motDePasse = $_POST["usager_mot_de_passe"];
    }

    // Ouvrir une nouvelle connexion au serveur MySQL
    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die("Connexion à la base de données non établie.");

    // Vérifier que les valeurs du formulaire ne soient pas vides
    if (!empty($utilisateur) && !empty($motDePasse)) {
        // Nettoyer les données du formulaire avant de les utiliser
        $utilisateur = mysqli_real_escape_string($connection, $utilisateur);
        $motDePasse  = mysqli_real_escape_string($connection, $motDePasse);

        // Effectuer les validations
        $estValide = true;

        // Vérifier si l'utilisateur existe
        $sqlValiderUtilisateur = mysqli_query($connection, "SELECT * FROM usager__detail WHERE nom_utilisateur = '{$utilisateur}' ");
        $utilisateurTrouve = mysqli_num_rows($sqlValiderUtilisateur);

        if ($utilisateurTrouve === 0) {
            $erreurs['usager_non_connecte'] = "Échec de la connexion! Identifiant ou mot de passe invalide!";
            $estValide = false;
        } else {
            // Récupérer les données utilisateur
            $row = mysqli_fetch_array($sqlValiderUtilisateur);
            $id               = $row['id'];
            $nom_utilisateur  = $row['nom_utilisateur'];
            $mot_de_passe     = $row['mot_de_passe'];
            $jeton            = $row['jeton'];
            $type_utilisateur = $row['type_utilisateur'];
        }

        if ($estValide) {
            // Vérifier si le mot de passe a la bonne longueur
            $nbCar = strlen($motDePasse);

            if ($nbCar < 8 || $nbCar > 20) {
                $erreurs['usager_non_connecte'] = "Échec de la connexion! Identifiant ou mot de passe invalide!";
                $estValide = false;
            }
        }

        if ($estValide) {
            // Vérification du mot de passe
            $verifierMdp = password_verify($motDePasse, $mot_de_passe);

            if ($utilisateur == $nom_utilisateur && $verifierMdp) {

                // Stocker les données utilisateur dans la session php
                $_SESSION['utilisateur']['id'] = $id;
                $_SESSION['utilisateur']['nom'] = $nom_utilisateur;
                $_SESSION['utilisateur']['type'] = $type_utilisateur;
                $_SESSION['utilisateur']['jeton'] = $jeton;
                $_SESSION['utilisateur']['estConnecte'] = true;
            } else {
                $erreurs['usager_non_connecte'] = "Échec de la connexion! Identifiant ou mot de passe invalide!";
            }
        }
    } else {
        if (empty($utilisateur)) {
            $erreurs['usager_nom_utilisateur'] = "Vous devez entrer un nom d'utilisateur.";
        }
        if (empty($motDePasse)) {
            $erreurs['usager_mot_de_passe'] = "Vous devez entrer un mot de passe.";
        }
    }
}
