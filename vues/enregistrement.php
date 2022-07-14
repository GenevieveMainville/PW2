<?php include('./controller/Enregistrement.php'); ?>

<!--HERO-->
<div class="hero hero--pad-haut">
    <div class="hero__titre">vino
        <div class="hero__stitre">Gestion de celliers</div>
    </div>
    <!--Image hero-->
    <div class="hero__img-wrapper">
        <img class="hero__img--hauteur " src="./assets/img/unebouteille.jpg" alt="hero">
    </div>
</div>

<!--ENREGISTREMENT-->
<section class="main-connexion">
    <div class="section-wrapper wrapper-center">
        <div class="main-section">
            <div class="entete">
                <h2 class="">Vino - Enregistrement</h2>
            </div>

            <form class="formulaire" action="" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="usager_nom" data-js-nom placeholder="Votre nom" value="<?php echo $nom ?>" />

                    <?php if (isset($erreurs['usager_nom'])) : ?>
                        <span class="message-erreur" data-js-nom-err><?= $erreurs['usager_nom'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-nom-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="usager_adresse" data-js-adresse placeholder="Votre adresse"><?php echo $adresse ?></textarea>

                    <?php if (isset($erreurs['usager_adresse'])) : ?>
                        <span class="message-erreur" data-js-adresse-err><?= $erreurs['usager_adresse'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-adresse-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="usager_ville" data-js-ville placeholder="Votre ville" value="<?php echo $ville ?>" />

                    <?php if (isset($erreurs['usager_ville'])) : ?>
                        <span class="message-erreur" data-js-ville-err><?= $erreurs['usager_ville'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-ville-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
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
                    <input type="text" class="form-control" name="usager_telephone" data-js-telephone placeholder="Votre numéro de téléphone" value="<?php echo $telephone ?>" />

                    <?php if (isset($erreurs['usager_telephone'])) : ?>
                        <span class="message-erreur" data-js-telephone-err><?= $erreurs['usager_telephone'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-telephone-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
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
                    <input type="text" class="form-control" name="usager_courriel" data-js-courriel placeholder="Votre courriel" value="<?php echo $courriel ?>" />

                    <?php if (isset($erreurs['usager_courriel'])) : ?>
                        <span class="message-erreur" data-js-courriel-err><?= $erreurs['usager_courriel'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-courriel-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="usager_nom_utilisateur" data-js-utilisateur placeholder="Entrez un nom d'utilisateur" value="<?php echo $utilisateur ?>" />

                    <?php if (isset($erreurs['usager_nom_utilisateur'])) : ?>
                        <span class="message-erreur" data-js-utilisateur-err><?= $erreurs['usager_nom_utilisateur'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-utilisateur-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="usager_mot_de_passe" data-js-mdp placeholder="Entrez un mot de passe" value="" />

                    <?php if (isset($erreurs['usager_mot_de_passe'])) : ?>
                        <span class="message-erreur" data-js-mdp-err><?= $erreurs['usager_mot_de_passe'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-mdp-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="confirmer_mot_de_passe" data-js-confirmer placeholder="Retapez le mot de passe" value="" />

                    <?php if (isset($erreurs['confirmer_mot_de_passe'])) : ?>
                        <span class="message-erreur" data-js-confirmer-err><?= $erreurs['confirmer_mot_de_passe'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-confirmer-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="conditions-wrapper">
                        <input type="checkbox" name="accepter_conditions" id="accepter_conditions" <?php if ($conditions) echo ' checked="checked"'; ?> data-js-conditions />
                        <label for="accepter_conditions">J'accepte les termes et conditions d'utilisation du site</label>
                    </div>

                    <?php if (isset($erreurs['accepter_conditions'])) : ?>
                        <span class="message-erreur" data-js-conditions-err><?= $erreurs['accepter_conditions'] ?></span>
                    <?php else : ?>
                        <span class="aucune-erreur" data-js-conditions-err>&nbsp;</span>
                    <?php endif; ?>
                </div>

                <div class="form-group btn-group">
                    <button type="submit" class="bouton-secondaire" name="soumettre" data-js-btn-submit>M'enregistrer</button>
                </div>
                <div>
                    <p>Vous avez déjà un compte? <a href="./index.php?requete=connecter">Connectez-vous</a></p>
                </div>
            </form>
        </div>
    </div>
</section>