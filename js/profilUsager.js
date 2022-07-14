(() => {

    // Le formulaire qui contient les champs à valider
    const elFormulaire = document.querySelector('.formulaire-profil');

    // Pour les validations
    const elNom = document.querySelector('[data-js-nom]');
    const elAdresse = document.querySelector('[data-js-adresse]');
    const elVille = document.querySelector('[data-js-ville]');
    const elUtilisateur = document.querySelector('[data-js-utilisateur]');
    const elUsagerMdp = document.querySelector('[data-js-mdp]');
    const elConfirmerMdp = document.querySelector('[data-js-confirmer]');
    const elPays = document.querySelector('[data-js-pays]');
    const elTelephone = document.querySelector('[data-js-telephone]');
    const elJour = document.querySelector('[data-js-ddn-jour]');
    const elMois = document.querySelector('[data-js-ddn-mois]');
    const elAnnee = document.querySelector('[data-js-ddn-annee]');
    const elCourriel = document.querySelector('[data-js-courriel]');

    let erreur;

    if (elFormulaire) {
        elFormulaire.addEventListener('submit', (e) => {
            // Pour afficher les messages d'erreur
            let erreursTrouvees = false;
            let elErreur;

            // Nom
            erreur = "";

            if (elNom.value.length === 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre nom.";
            }

            elErreur = document.querySelector('[data-js-nom-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Adresse
            erreur = "";

            if (elAdresse.value.length === 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre adresse.";
            }

            elErreur = document.querySelector('[data-js-adresse-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Ville
            erreur = "";

            if (elVille.value.length === 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre ville.";
            }

            elErreur = document.querySelector('[data-js-ville-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Pays
            const valeurPays = elPays.options[elPays.selectedIndex].value;
            erreur = "";

            if (valeurPays <= 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre pays.";
            }

            elErreur = document.querySelector('[data-js-pays-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Téléphone
            erreur = "";

            if (elTelephone.value.length === 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre téléphone.";
            }

            elErreur = document.querySelector('[data-js-telephone-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Date de naissance
            erreur = "";

            if (elJour.value <= 0 || elMois.value <= 0 || elAnnee.value <= 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre date de naissance.";
            }

            elErreur = document.querySelector('[data-js-ddn-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Courriel
            erreur = "";

            if (elCourriel.value.length === 0) {
                erreursTrouvees = true;
                erreur = "Vous devez entrer votre courriel.";
            } else {
                const res = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                $courrielValide = res.test(String(elCourriel.value).toLowerCase());

                if (!$courrielValide) {
                    erreursTrouvees = true;
                    erreur = "Le format du courriel est invalide.";
                }
            }

            elErreur = document.querySelector('[data-js-courriel-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Utilisateur
            erreur = "";

            if (elUtilisateur.value.length > 0) {
                const premiereLettre = elUtilisateur.value[0];

                // Valide si 1ere lettre en majuscule
                const premiereLettreEnMajuscule = (premiereLettre === premiereLettre.toUpperCase());

                // Regex pour valider si un nombre est inclut
                const utilisateurAvecChiffre = /\d/.test(elUtilisateur.value);

                if (!premiereLettreEnMajuscule || !utilisateurAvecChiffre) {
                    erreursTrouvees = true;
                    erreur = "Le nom d'utilisateur doit débuter avec une majuscule et contenir au moins un chiffre.";
                }
            } else {
                erreursTrouvees = true;
                erreur = "Vous devez entrer un nom d'utilisateur.";
            }

            elErreur = document.querySelector('[data-js-utilisateur-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            // Mot de passe
            erreur = "";

            if (elUsagerMdp.value.length > 0) {
                const mdpMauvaiseLongueur = (elUsagerMdp.value.length < 8 || elUsagerMdp.value.length > 20);

                if (mdpMauvaiseLongueur) {
                    erreursTrouvees = true;
                    erreur = "Le mot de passe doit contenir entre 8 et 20 caractères.";

                } else if (elConfirmerMdp.value.length === 0) {
                    erreursTrouvees = true;
                    erreur = "Vous devez confirmer le mot de passe.";
                } else if (elUsagerMdp.value !== elConfirmerMdp.value) {
                    erreursTrouvees = true;
                    erreur = "Le mot de passe ne correspond pas.";
                }
            }

            elErreur = document.querySelector('[data-js-mdp-err]');
            elErreur.innerHTML = erreur;

            if (erreur) {
                elErreur.classList.remove('aucune-erreur');
                elErreur.classList.add('message-erreur');
            } else {
                elErreur.classList.remove('message-erreur');
                elErreur.classList.add('aucune-erreur');
            }

            if (erreursTrouvees) {
                e.preventDefault();
            }
        });
    }
})();