import ModalCellier from './ModalCellier.js';  
import CellierValidation from './CellierValidation.js'; 
import { fetchCellier } from './FetchCellier.js'; 

export default class ModifierCellier extends ModalCellier{
    constructor(el,id){
        super()
        this._el = el;
        this._idCellier = id
        this._elContenu = document.querySelector('[data-js-modalcontenu]')
        this._elUsager =  document.querySelector("[data-js-usager]")
        this._elNom_cellier = document.querySelector("[name='nom_cellier_modal']")
        this._elType_cellier_id = document.querySelectorAll("[name='type_cellier_id']")
        this._elDescription_cellier =document.querySelector("[name='description_cellier']")
        this.init()

    }

    init = () =>{

        /************************
         * MODIFIER
         ************************/
        this._el.addEventListener('click', (e)=>{
            e.preventDefault();

            //Validation
            let validation = new CellierValidation(this._elContenu);

            // Si tout est valide
            if(validation.valide){
                let cellier = {
                    "id_cellier": this._idCellier,
                    "id_usager": this._elUsager.dataset.jsUsager,
                    "nom_cellier": this._elNom_cellier.value,
                    "type_cellier_id": document.querySelector('input[name="type_cellier_id"]:checked').value,
                    "description_cellier": this._elDescription_cellier.value
                }

                // Requête fetch
                let requete = new Request(BaseURL + "?requete=modifierCellier", { method: 'POST', body: JSON.stringify(cellier) }); 
                fetchCellier(requete, this.ferme())  
            }
        })

        /************************
         * ANNULER
         ************************/
        this.annule(this._el)
    }
}