 /********************************************************************************************************** */
/*                                     GESTION   -   CELLIER  -  VUE CELLIERS
/*
/*    - Tri des celliers
/*    - Gestions des modals de la page cellier
/*    - Nouveau cellier
/*    - Modifier cellier
/*    - Supprimer cellier                                      
/********************************************************************************************************** */



import NouveauCellier from './NouveauCellier.js';
import ModifierCellier from './ModifierCellier.js';
import SupprimerCellier from './SupprimerCellier.js';
import ModalCellier from './ModalCellier.js';
import TrieCellier from './TrieCellier.js';
import { fetchGetCellier } from './FetchCellier.js';
(() => {

    let elNouveauCellier = document.querySelector('[data-js-nouveaucellier]'),
        elModifierCellier = document.querySelectorAll('[data-js-modifiercellier]'),
        elSupprimerCellier = document.querySelectorAll('[data-js-supprimercellier]'),
        elTitreModal = document.querySelector('[data-js-titremodal]'),
       // elBoutonModal = document.querySelector('[data-js-boutonmodal]'),
        //elModalContenu = document.querySelector('[data-js-modalcontenu]'),
        elChoixTrie = document.querySelector('[data-js-triecellier]')


        
    /*********************************************** */
    /*  TRIE DES CELLIERS 
    /************************************************ */
    if (elChoixTrie) {
        elChoixTrie.addEventListener('change', (e) => {
            new TrieCellier(elChoixTrie.value);
        })
    }


   /*********************************************** */
    /*  CRÉER UN CELLIER
    /************************************************ */
    // Classe Modal
    let modal = new ModalCellier();

    // Créer un cellier
    if (elNouveauCellier) {
        elNouveauCellier.addEventListener('click', (e) => {
            e.preventDefault();
            let titre = "Ajouter un cellier"
            let bouton = `<button  class="bouton-secondaire" data-js-boutonAjouterCellier>Ajouter</button>`
            modal.modal(titre,bouton)
            //Ajout titre
            //elTitreModal.innerHTML = "Ajouter un cellier"
            //Ajout du bouton ajouter
            //elBoutonModal.insertAdjacentHTML("afterbegin", '<button  class="bouton-secondaire" data-js-boutonAjouterCellier>Ajouter</button>')
            modal.ouvre()
            
            let elBoutonModal = document.querySelector('[data-js-boutonmodal]')
            
            new NouveauCellier(elBoutonModal.firstElementChild);
        })
    }



    /*********************************************** */
    /*  MODIFIER UN CELLIER
    /************************************************ */
    for (let i = 0, l = elModifierCellier.length; i < l; i++) {
        elModifierCellier[i].addEventListener('click', (e) => {
            e.preventDefault();
            //Récupérer le nom du cellier
            let elNomCellier = elModifierCellier[i].parentNode.dataset.jsNomcellier
            let elCarte = elModifierCellier[i].parentNode.parentNode.parentNode

            let titre  = `Modifier le cellier "${elNomCellier}"`;
        
            let bouton =  `<button  class="bouton-secondaire" data-js-modifierInfosCellier>Modifier</button>`
            modal.modal(titre,bouton)
            let elModalContenu = document.querySelector('[data-js-modalcontenu]')
            modal.ouvre()
            
            //Contenu des champs du modal
            let elNomCellierChamps = elModalContenu.querySelector("[name='nom_cellier_modal']"),
                elTypeCellierIdChamps = elModalContenu.querySelectorAll("[name='type_cellier_id']"),
                elDescriptionCellierChamps = elModalContenu.querySelector("[name='description_cellier']"),
                elIdCellier = elModifierCellier[i].dataset.jsModifiercellier,
                elCellierType = elCarte.querySelector('[data-js-type]').firstElementChild

            elNomCellierChamps.value = elCarte.querySelector('[data-js-nomcellier]').textContent,
            elDescriptionCellierChamps.value = elCarte.querySelector('[data-js-descriptioncellier]').textContent,

            // Type de cellier (Radio)
            elTypeCellierIdChamps.forEach(function (element) {
                if (elCellierType.classList.contains("cave")) {
                    if (element.value == "1") {
                        element.checked = true;
                    }
                }
                else {
                    element.checked = true;
                }
            })
            let elBoutonModal = document.querySelector('[data-js-boutonmodal]')
            new ModifierCellier(elBoutonModal.firstElementChild, elIdCellier);
        })

    }

    /*********************************************** */
    /* SUPPRESSION D'UN CELLIER
    /************************************************ */
    for (let i = 0, l = elSupprimerCellier.length; i < l; i++) {
        elSupprimerCellier[i].addEventListener('click', (e) => {
            e.preventDefault();
           //Récupérer le nom du cellier
           let elNomCellier = elSupprimerCellier[i].parentNode.dataset.jsNomcellier,
           elIdCellier = elSupprimerCellier[i].dataset.jsSupprimercellier
           modal.modalsupprimer(elNomCellier)
            modal.ouvre()
        

            let selectCellier = document.querySelector('[data-js-selectcellier]'),
                elBoutonModal = document.querySelector('[data-js-boutonmodal]'),
                elBtnDeplacerSupprimer = elBoutonModal.firstElementChild,
                elBtnSupprimer = elBoutonModal.firstElementChild.nextElementSibling
         
            // Requête fetch
            let requete = new Request(BaseURL + "?requete=celliers")
            fetchGetCellier(requete, selectCellier, elIdCellier, elBtnDeplacerSupprimer)

            new SupprimerCellier(elBtnDeplacerSupprimer, elBtnSupprimer, selectCellier, elIdCellier);
        })

    }



})();