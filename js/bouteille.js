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

function ratestar(note, id_bouteille, id_cellier) {
    supprimerMessageFromUrl();
   
    if(note && id_bouteille){
        const requete = new Request($baseUrl_without_parameters + "?requete=noteBouteille", { method: 'POST', body: JSON.stringify({note: note, id_bouteille: id_bouteille, id_cellier: id_cellier }) });
        fetch(requete).then(response => {
            return response.json();
        }).then(function (data) {
            console.log('resultat', data);
        }).finally(() => {
           // for($i = 1; $i <= 5; $i++)
           location.reload();
           // injecterEtoile()
        });
    }
}

function modifierAAcheter(valeur, id_bouteille, id_cellier, vino_id){
    supprimerMessageFromUrl();
    // if( id_bouteille){
        const requete = new Request($baseUrl_without_parameters + "?requete=modifierAAcheter",
            { method: 'POST', body: JSON.stringify(
                {valeur: valeur, id_bouteille: id_bouteille, id_cellier: id_cellier, vino_id: vino_id }) });
        fetch(requete).then(response => {
            return response.json();
        }).then(function (data) {
            console.log('resultat', data);
            if(data && data.id_bouteille ){
                if(vino_id){
                    window.location.replace($baseUrl_without_parameters + "?requete=bouteille&id_bouteille="+data['id_bouteille']);
                }else{
                    location.reload();
                }
            }
        }).finally(() => {

        });
    // }
}

function modifierAEssayer(valeur, id_bouteille, id_cellier, vino_id){
    supprimerMessageFromUrl();
    // if(id_bouteille){
        const requete = new Request($baseUrl_without_parameters + "?requete=modifierAEssayer",
            { method: 'POST', body: JSON.stringify(
                {valeur: valeur, id_bouteille: id_bouteille, id_cellier: id_cellier, vino_id: vino_id }) });
        fetch(requete).then(response => {
            return response.json();
        }).then(function (data) {
            console.log('resultat', data);
            if(data && data.id_bouteille ){
                if(vino_id){
                    window.location.replace($baseUrl_without_parameters + "?requete=bouteille&id_bouteille="+data['id_bouteille']);
                }else{
                    location.reload();
                }
            }
        }).finally(() => {

        });
    // }
}

function modifierFavoris(valeur, id_bouteille, id_cellier, vino_id){
    supprimerMessageFromUrl();
    // if(id_bouteille){
        const requete = new Request($baseUrl_without_parameters + "?requete=modifierFavoris",
            { method: 'POST', body: JSON.stringify(
                {valeur: valeur, id_bouteille: id_bouteille, id_cellier: id_cellier, vino_id: vino_id }) });
        fetch(requete).then(response => {
            return response.json();
        }).then(function (data) {
            console.log('resultat', data);
            if(data && data.id_bouteille ){
                if(vino_id){
                    window.location.replace($baseUrl_without_parameters + "?requete=bouteille&id_bouteille="+data['id_bouteille']);
                }else{
                    location.reload();
                }
            }
        }).finally(() => {

        });
    // }
}

function supprimerMessageFromUrl(){
    const url = new URL(location);
    url.searchParams.delete('message');
    history.replaceState(null, null, url);
}

window.addEventListener('load', function () {
    console.log("load bouteille.js");

    /*AJOUT D'UNE BOUTEILLE*/
    const selectBouteilleInput = document.querySelector('[data-js-bouteille-select]');

    /**
     * CR - Début des modifs
     */

    if (selectBouteilleInput) {

        selectBouteilleInput.addEventListener('input', (e) => {
            console.log('selectBouteilleInput', e.target.value);
            // afficheBouteille(e.target.value);

            const requete = new Request($baseUrl_without_parameters + "?requete=getBouteille", { method: 'POST', body: JSON.stringify({nom: e.target.value}) });
            fetch(requete)
                .then(response => {
                    // if (response.status === 200) {
                    //     console.log('got result', response.json());
                    // }
                    return response.json();
                })
                .then(function (data) {
                    console.log('data', data);
                    if (data) {
                        Object.keys(data).forEach(key => {

                            if (key === 'image_bouteille') {
                                const image_bouteille = document.getElementById(key);
                                console.log()
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
        const shareFacebook = document.getElementById("shareFacebook");
        const shareTwitter = document.getElementById("shareTwitter");
        const favoriBtn = document.getElementById("favoriBtn");
        const essayerBtn = document.getElementById("essayerBtn");
        const acheterBtn = document.getElementById("acheterBtn");
        const noteEtoiles = document.getElementsByClassName("noteEtoiles");
        // const noteEtoiles_vide = document.getElementById("noteEtoiles_vide");
        const retourBtn = document.querySelector('[data-js-retour]');

        if(retourBtn){
            retourBtn.addEventListener('click', function (){
               history.back();
            });
        }
        if(noteEtoiles){
            console.log('noteEtoiles', noteEtoiles);
            Array.from(noteEtoiles).forEach(el => {
                el.addEventListener('click', function (e){
                   const valeur =  Number(el.getAttribute('data-etoile-value'));
                   const id_bouteille =  Number(el.getAttribute('data-idBouteille'));
                   const id_cellier =  Number(el.getAttribute('data-idCellier'));
                   console.log('ratestar', valeur, id_bouteille, id_cellier);
                   ratestar(valeur, id_bouteille, id_cellier);
                });
            })

        }
        // if(noteEtoiles_vide){
        //     noteEtoiles_vide.addEventListener('click', function (e){
        //        const valeur =  Number(noteEtoiles_vide.getAttribute('data-etoile-value'));
        //        const id_bouteille =  Number(noteEtoiles_vide.getAttribute('data-idBouteille'));
        //        const id_cellier =  Number(noteEtoiles_vide.getAttribute('data-idCellier'));
        //        console.log('ratestar', valeur, id_bouteille, id_cellier);
        //        ratestar(valeur, id_bouteille, id_cellier);
        //     });
        // }
        if(favoriBtn){
            favoriBtn.addEventListener('click', function (e){
               const valeur =  Number(favoriBtn.getAttribute('data-favoriBouteille'));
               const id_bouteille =  Number(favoriBtn.getAttribute('data-idBouteille'));
               const id_cellier =  Number(favoriBtn.getAttribute('data-idCellier'));
               const vino_id =  Number(favoriBtn.getAttribute('data-vinoId'));
               modifierFavoris(valeur, id_bouteille, id_cellier, vino_id);
            });
        }
        if(essayerBtn){
            essayerBtn.addEventListener('click', function (e){
               const valeur =  Number(essayerBtn.getAttribute('data-essayerBouteille'));
               const id_bouteille =  Number(essayerBtn.getAttribute('data-idBouteille'));
               const id_cellier =  Number(essayerBtn.getAttribute('data-idCellier'));
               const vino_id =  Number(essayerBtn.getAttribute('data-vinoId'));
               modifierAEssayer(valeur, id_bouteille, id_cellier, vino_id);
            });
        }
        if(acheterBtn){
            acheterBtn.addEventListener('click', function (e){
               const valeur =  Number(acheterBtn.getAttribute('data-achatBouteille'));
               const id_bouteille =  Number(acheterBtn.getAttribute('data-idBouteille'));
               const id_cellier =  Number(acheterBtn.getAttribute('data-idCellier'));
               const vino_id =  Number(acheterBtn.getAttribute('data-vinoId'));
               modifierAAcheter(valeur, id_bouteille, id_cellier, vino_id);
            });
        }

        document.querySelectorAll(".cellier-block").forEach(element => {
            element.style.display = "none";
        });

        if (shareFacebook) {
            // shareFacebook.setAttribute("href", "http://www.facebook.com/sharer.php?u="+encodeURIComponent($baseUrl_without_parameters));
            shareFacebook.setAttribute("href", "http://www.facebook.com/sharer.php?u=" + encodeURIComponent($baseUrl_without_parameters));
        }
        if (shareFacebook) {
            shareTwitter.setAttribute("href", "https://twitter.com/share?url=" + encodeURIComponent(window.location.href));
        }

        if (fermerFormulaire) {
            // fermerFormulaire.disabled = true;
            fermerFormulaire.style.display = 'none';
        }

        if (enregistrerFormulaire) {
            // enregistrerFormulaire.disabled = true;
            enregistrerFormulaire.style.display = 'none';
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
                document.querySelectorAll(".cellier-block").forEach(element => {
                    element.style.display = "block";
                });

                if (modifier_bouton) {
                    // modifier_bouton.disabled = true;
                    modifier_bouton.style.display = "none";
                }
                if (fermerFormulaire) {
                    // fermerFormulaire.disabled = false;
                    fermerFormulaire.style.display = 'block';
                }

                if (askDeleteBtn) {
                    // askDeleteBtn.disabled = true;
                    askDeleteBtn.style.display = "none";
                }

                if (enregistrerFormulaire) {
                    enregistrerFormulaire.style.display = "block";
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
                document.querySelectorAll(".cellier-block").forEach(element => {
                    element.style.display = "none";
                });

                if (modifier_bouton) {
                    // modifier_bouton.disabled = false;
                    modifier_bouton.style.display = 'block';
                }

                if (fermerFormulaire) {
                    // fermerFormulaire.disabled = true;
                    fermerFormulaire.style.display = 'none';
                }

                if (askDeleteBtn) {
                    askDeleteBtn.style.display = 'block';
                    // askDeleteBtn.disabled = false;
                }

                if (enregistrerFormulaire) {
                    // enregistrerFormulaire.disabled = true;
                    enregistrerFormulaire.style.display = 'none';
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
                        {method: 'POST', body: JSON.stringify({id_bouteille, id_cellier})});
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

        // document.querySelector(".note-input").
    }
);