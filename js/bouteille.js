/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://jmartel.webdev.cmaisonneuve.qc.ca/n61/vino/";

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const nomCellier = urlParams.get('nom_cellier');


var $baseUrl_without_parameters = window.location.href.split('?');//[0];
$baseUrl_without_parameters = $baseUrl_without_parameters.length > 0 ? $baseUrl_without_parameters[0] : $baseUrl_without_parameters;

let etatModification = true;
console.log('hello bouteille', etatModification);
window.addEventListener('load', function () {
    console.log("load bouteille.js");

    /*AJOUT D'UNE BOUTEILLE*/
    const selectBouteilleInput = document.querySelector('[data-js-bouteille-select]');

    /**
     * CR - Début des modifs
     */
    const vino_id = urlParams.get('vino_id');

    if (selectBouteilleInput) {
        if (vino_id) {
            id_bouteille = vino_id;
            elOptBouteille = document.querySelector(`[data-js-id-bouteille="${id_bouteille}"]`);
            selectBouteilleInput.value = elOptBouteille.value;
            afficheBouteille(selectBouteilleInput.value);
        }

        selectBouteilleInput.addEventListener('input', (e) => {
            console.log('selectBouteilleInput', e.target.value);
            afficheBouteille(e.target.value);

        })
    }

    function afficheBouteille(nomBouteille) {
        const requete = new Request($baseUrl_without_parameters + "?requete=getBouteille", { method: 'POST', body: JSON.stringify({ nom: nomBouteille }) });
        fetch(requete)
            .then(response => {
                // if (response.status === 200) {
                //     console.log('got result', response.json());
                // }
                return response.json();
            }).then(function (data) {
                console.log('data', data);
                Object.keys(data).forEach(key => {

                    if (key === 'image_bouteille') {
                        const image_bouteille = document.getElementById(key);
                        if (data['image_bouteille']) {
                            image_bouteille.src = data['image_bouteille'];
                        } else if (data['image_url']) {
                            image_bouteille.src = data['image_url'];
                        } else {
                            image_bouteille.src = $baseUrl_without_parameters + '/assets/img/default_bouteille.png';
                        }
                    }
                    const elements = document.getElementsByName(key);
                    if (elements && elements.length > 0) {
                        elements[0].value = data[key];
                    } else {
                        console.log('not found in form', key);
                    }
                });
            });

    }
    /**
     * CR - Fin des modifs
     */

    const image_inputs = document.getElementsByName('image_bouteille');
    if (image_inputs && image_inputs.length > 0) {
        image_inputs.forEach(el => {
            el.addEventListener('input', (e) => {
                console.log('input changed', e.target.value);
                const newlien = e.target.value;
                const image_bouteille = document.getElementById('image_bouteille');
                if (image_bouteille) {
                    image_bouteille.src = newlien;
                } else {
                    image_bouteille.src = $baseUrl_without_parameters + '/assets/img/default_bouteille.png';
                }
            })
        })
    } else {
        console.log('not found in form', key);
    }
    /*AJOUT D'UN CELLIER*/

    // Swicher entre les vue selon si c'est modification ou bien just le mode view
    // document.querySelectorAll(".input-state").forEach(element => {
    //     element.style.display = "none";
    // });

    const fermerFormulaire = document.getElementById('fermerFormulaire');
    const enregistrerFormulaire = document.getElementById('enregistrerFormulaire');
    const modifier_bouton = document.getElementById('ouvrirFormulaire');
    const askDeleteBtn = document.getElementById("askDeleteBtn");
    const detruireButton = document.getElementById("detruirebtn");
    const annulerDetruirebtn = document.getElementById("annulerDetruirebtn");
    const annulerDetruirebtn2 = document.getElementById("annulerDetruirebtn2");
    const fermerModalAnnulation = document.getElementById("fermerModalAnnulation");

    // if(fermerFormulaire){
    //     fermerFormulaire.disabled = true;
    // }

    if (enregistrerFormulaire) {
        enregistrerFormulaire.disabled = true;
    }

    if (modifier_bouton) {
        modifier_bouton.addEventListener('click', function (e) {
            etatModification = true;
            document.querySelectorAll(".input-state").forEach(element => {
                element.style.display = "block";
            });
            document.querySelectorAll(".label-state").forEach(element => {
                element.style.display = "none";
            });

            if (modifier_bouton) {
                modifier_bouton.disabled = true;
            }
            // if(fermerFormulaire){
            //     fermerFormulaire.disabled = false;
            // }

            if (askDeleteBtn) {
                askDeleteBtn.disabled = true;
            }

            if (enregistrerFormulaire) {
                enregistrerFormulaire.disabled = false;
            }
        });
    }

    if (fermerFormulaire) {

        fermerFormulaire.addEventListener('click', function (e) {
            etatModification = false;
            openModal(modalAnnulation);
            document.querySelectorAll(".input-state").forEach(element => {
                element.style.display = "none";
            });
            document.querySelectorAll(".label-state").forEach(element => {
                element.style.display = "block";
            });

            if (modifier_bouton) {
                modifier_bouton.disabled = false;
            }

            // if(fermerFormulaire){
            //     fermerFormulaire.disabled = true;
            // }

            if (askDeleteBtn) {
                askDeleteBtn.disabled = false;
            }

            if (enregistrerFormulaire) {
                enregistrerFormulaire.disabled = true;
            }

        });

    }

    if (detruireButton) {
        detruireButton.addEventListener('click', function (e) {
            const id_bouteille_input = document.getElementById('id_bouteille_input');
            const id_cellier_input = document.getElementById('id_cellier_input');
            if (id_bouteille_input && id_cellier_input) {
                console.log('id_bouteille_input', id_bouteille_input.value);
                const id_bouteille = id_bouteille_input.value;
                const id_cellier = id_cellier_input.value;
                console.log('id_bouteille', id_bouteille);
                const requete = new Request($baseUrl_without_parameters + "?requete=detruireBouteille",
                    { method: 'POST', body: JSON.stringify({ id_bouteille, id_cellier }) });
                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {
                            console.log('got result', response.json());
                            window.location.replace($baseUrl_without_parameters + "?requete=listeBouteilleCellier&id_cellier=" + e.target.value + "&nom_cellier=" + nomCellier);
                        }
                        return response.json();
                    }).then(function (data) {
                        console.log('data', data);
                    });
            }
        })
    }

    const modalAskDelete = '[modal-confirmation-delete]';
    const modalModificationStatut = '[modal-modification-statut]';
    const modalAnnulation = '[modal-annulation]';

    if (askDeleteBtn) {
        askDeleteBtn.addEventListener('click', () => {
            openModal(modalAskDelete);
        });
    }

    if (annulerDetruirebtn) {
        annulerDetruirebtn.addEventListener('click', () => {
            closeModal(modalAskDelete);
        })
    }

    if (annulerDetruirebtn2) {
        annulerDetruirebtn2.addEventListener('click', () => {
            closeModal(modalModificationStatut);
        })
    }

    if (fermerModalAnnulation) {
        fermerModalAnnulation.addEventListener('click', () => {
            closeModal(modalAnnulation);
        })
    }

    function openModal(modalSelector) {
        const elModal = document.querySelector(modalSelector);
        if (elModal.classList.contains('modal--ferme')) {
            elModal.classList.replace('modal--ferme', 'modal--ouvre');

            // Ajoute la propriété overflow-y: hidden; sur les éléments html et body afin d'enlever le scroll en Y lorsque le modal est ouvert
            document.documentElement.classList.add('overflow-y--hidden');
            document.body.classList.add('overflow-y--hidden');
        }

    }

    function closeModal(modalSelector) {
        const elModal = document.querySelector(modalSelector);
        if (elModal.classList.contains('modal--ouvre')) {
            elModal.classList.replace('modal--ouvre', 'modal--ferme');

            document.documentElement.classList.remove('overflow-y--hidden');
            document.body.classList.remove('overflow-y--hidden');
        }

    }

    const modifStatus = document.getElementById('modifStatus');
    if (modifStatus) {
        if (modifStatus.value) {
            openModal(modalModificationStatut);
        }
    }

    const gobackbtn = document.getElementById('gobackbtn');
    if (gobackbtn) {
        gobackbtn.addEventListener('click', (e) => {
            console.log('gobackbtn', e.target.value);

            if (e.target.value) {
                console.log("e.target.value", e.target.value);
                if (e.target.value === -1) {
                    window.location.replace($baseUrl_without_parameters + "?requete=listeBouteilleCellier");
                } else {
                    window.location.replace($baseUrl_without_parameters + "?requete=listeBouteilleCellier&id_cellier=" + e.target.value + "&nom_cellier=" + nomCellier);
                }
            }
        });
    }

    const gobackbtn2 = document.getElementById('gobackbtn2');
    if (gobackbtn2) {
        gobackbtn2.addEventListener('click', (e) => {
            if (e.target.value) {
                console.log("e.target.value", e.target.value);
                if (e.target.value === -1) {
                    window.location.replace($baseUrl_without_parameters + "?requete=listeBouteilleCellier");
                } else {
                    window.location.replace($baseUrl_without_parameters + "?requete=listeBouteilleCellier&id_cellier=" + e.target.value + "&nom_cellier=" + nomCellier);
                }
            }
        });
    }
});
