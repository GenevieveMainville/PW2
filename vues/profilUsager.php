<?php
include('./controller/ProfilUsager.php');

if (isset($unUsager)) {
    $nom = $unUsager["nom"];
    $adresse = $unUsager["adresse"];
    $ville = $unUsager["ville"];
    $pays_id = $unUsager["pays_id"];
    $telephone =  $unUsager["telephone"];
    $date_naissance =  $unUsager["date_naissance"];
    $courriel = $unUsager["courriel"];
    $utilisateur =  $unUsager["nom_utilisateur"];

    if (isset($date_naissance)) {
        $naissance = explode("-", $date_naissance);

        $annee = $naissance[0];
        $mois = $naissance[1];
        $jour = $naissance[2];
    }
}
?>

<!--PROFIL-->
<section class="main-connexion">
    <div class="section-wrapper wrapper-center">
        <div class="main-section">
            <div class="entete">
                <h2 class="">Mes informations</h2>
            </div>

            <form class="formulaire-profil" action="" method="POST">
                <div class="form-group">
                    <div class="libelle">Nom</div>
                    <input type="text" class="form-control" name="usager_nom" data-js-nom placeholder="Votre nom" value="<?= $nom ?>" />

                    <?php if (isset($erreurs['usager_nom'])) : ?>
                        <span class="message-erreur" data-js-nom-err><?= $erreurs['usager_nom'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-nom-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Adresse</div>
                    <textarea class="form-control" name="usager_adresse" data-js-adresse placeholder="Votre adresse"><?= $adresse ?></textarea>

                    <?php if (isset($erreurs['usager_adresse'])) : ?>
                        <span class="message-erreur" data-js-adresse-err><?= $erreurs['usager_adresse'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-adresse-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Ville</div>
                    <input type="text" class="form-control" name="usager_ville" data-js-ville placeholder="Votre ville" value="<?= $ville ?>" />

                    <?php if (isset($erreurs['usager_ville'])) : ?>
                        <span class="message-erreur" data-js-ville-err><?= $erreurs['usager_ville'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-ville-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Pays</div>
                    <select name="usager_pays_id" class="form-control" data-js-pays>
                        <option value="0">Votre pays</option>

                        <?php
                        foreach ($lesPays as $unPays) {
                        ?>
                            <option value="<?= $unPays['id']; ?>" <?php if ($pays_id == $unPays['id']) {
                                                                        echo ' selected="selected"';
                                                                    } ?>> <?= $unPays['nom'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>

                    <?php if (isset($erreurs['usager_pays_id'])) : ?>
                        <span class="message-erreur" data-js-pays-err><?= $erreurs['usager_pays_id'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-pays-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Téléphone</div>
                    <input type="text" class="form-control" name="usager_telephone" data-js-telephone placeholder="Votre numéro de téléphone" value="<?= $telephone ?>" />

                    <?php if (isset($erreurs['usager_telephone'])) : ?>
                        <span class="message-erreur" data-js-telephone-err><?= $erreurs['usager_telephone'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-telephone-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Date de naissance</div>
                    <div class="date-container">
                        <select name="usager_naissance[jour]" class="form-control" data-js-ddn-jour>
                            <option value="0">Jour</option>

                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                                <option value="<?= $i; ?>" <?php if ($jour == $i) {
                                                                echo ' selected="selected"';
                                                            } ?>> <?= $i ?> </option>
                            <?php
                            }
                            ?>
                        </select>

                        <select name="usager_naissance[mois]" class="form-control" data-js-ddn-mois>
                            <option value="0">Mois</option>

                            <?php
                            $nbMois = count($lesMois);
                            $moisIndice = -1;

                            if (isset($mois) && $mois > 0) {
                                $moisIndice = $mois - 1;
                            }

                            for ($i = 0; $i < $nbMois; $i++) {
                            ?>
                                <option value="<?= $i + 1; ?>" <?php if ($moisIndice == $i) {
                                                                    echo ' selected="selected"';
                                                                } ?>> <?= $lesMois[$i] ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                        <select name="usager_naissance[annee]" class="form-control" data-js-ddn-annee>
                            <option value="0">Année</option>

                            <?php
                            for ($i = 2022; $i >= 1900; $i--) {
                            ?>
                                <option value="<?= $i; ?>" <?php if ($annee == $i) {
                                                                echo ' selected="selected"';
                                                            } ?>> <?= $i ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <?php if (isset($erreurs['usager_naissance'])) : ?>
                        <span class="message-erreur" data-js-ddn-err><?= $erreurs['usager_naissance'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-ddn-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Courriel</div>
                    <input type="text" class="form-control" name="usager_courriel" data-js-courriel placeholder="Votre courriel" value="<?= $courriel ?>" />

                    <?php if (isset($erreurs['usager_courriel'])) : ?>
                        <span class="message-erreur" data-js-courriel-err><?= $erreurs['usager_courriel'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-courriel-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Nom d'utilisateur</div>
                    <input type="text" class="form-control" name="usager_nom_utilisateur" data-js-utilisateur placeholder="Entrez un nom d'utilisateur" value="<?= $utilisateur ?>" />

                    <?php if (isset($erreurs['usager_nom_utilisateur'])) : ?>
                        <span class="message-erreur" data-js-utilisateur-err><?= $erreurs['usager_nom_utilisateur'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-utilisateur-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Mot de passe</div>
                    <input type="password" class="form-control" name="usager_mot_de_passe" data-js-mdp placeholder="Entrez un mot de passe" value="" />

                    <?php if (isset($erreurs['usager_mot_de_passe'])) : ?>
                        <span class="message-erreur" data-js-mdp-err><?= $erreurs['usager_mot_de_passe'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-mdp-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="libelle">Confirmer le mot de passe</div>
                    <input type="password" class="form-control" name="confirmer_mot_de_passe" data-js-confirmer placeholder="Retapez le mot de passe" value="" />

                    <?php if (isset($erreurs['confirmer_mot_de_passe'])) : ?>
                        <span class="message-erreur" data-js-confirmer-err><?= $erreurs['confirmer_mot_de_passe'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-confirmer-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group btn-group">
                    <button type="submit" class="bouton-secondaire" name="modifier_profil" data-js-btn-submit>Modifier mes informations</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="./js/profilUsager.js" defer></script>