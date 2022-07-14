import ModalCellier from './ModalCellier.js';  
import CellierValidation from './CellierValidation.js'; 
import { fetchCellier } from './FetchCellier.js'; 
export default class NouveauCellier extends ModalCellier{
    constructor(el){
        super()
        this._el = el
        
        this._elTitreModal = document.querySelector('[data-js-titremodal]')
        this._elContenu = document.querySelector('[data-js-modalcontenu]')
        this._elBtnAjouterCellier =  document.querySelector('[data-js-boutonAjouterCellier]')
        this._elUsager =  document.querySelector("[data-js-usager]")
        this._elNom_cellier = document.querySelector("[name='nom_cellier_modal']")
        this._elType_cellier_id = document.querySelectorAll("[name='type_cellier_id']")
        this._elDescription_cellier =document.querySelector("[name='description_cellier']")
        this.init()

    }
    init = () =>{

        /************************
         * AJOUTER CELLIER
         ************************/
        this._el.addEventListener('click', (e)=>{
            this._elNom_cellier = document.querySelector("[name='nom_cellier_modal']")
            console.log(this._elNom_cellier.value)
                e.preventDefault();
                // Validation
                let validation = new CellierValidation(this._elContenu);
       
                // Si tout est valide
                if (validation.valide){

                    //Assigné les données à transmettre
                    let cellier = {
    
                        "id_usager": this._elUsager.dataset.jsUsager,
                        "nom_cellier": this._elNom_cellier.value,
                        "type_cellier_id": document.querySelector('input[name="type_cellier_id"]:checked').value,
                        "description_cellier": this._elDescription_cellier.value
                    
                    };  
                    console.log(cellier)
                // Requête fetch
                let requete = new Request(BaseURL + "?requete=ajouterNouveauCellier", { method: 'POST', body: JSON.stringify(cellier) });
                fetchCellier(requete, this.ferme())  
             
            }
        })

        /************************
         * ANNULER
         ************************/
        this.annule(this._el)
        
    }

}

