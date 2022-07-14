import ModalCellier from './ModalCellier.js';  
import CellierValidation from './CellierValidation.js'; 
import { fetchCellier } from './FetchCellier.js'; 

export default class SupprimerCellier extends ModalCellier{
    constructor(btnDeplacerSupprimer,btnSupprimer,selectCellier,idCellier){
        super()
        this._btnDeplacerSupprimer = btnDeplacerSupprimer;
        this._btnSupprimer = btnSupprimer;
        this._selectCellier = selectCellier
        this._idCellier = idCellier
        this._elErreurchoix = this._selectCellier.nextElementSibling
        
        this.init()

    }
    init = () =>{

        /************************
         * DÉPLACER ET SUPPRIMER
         ************************/ 
        this._btnDeplacerSupprimer.addEventListener('click', (e)=>{
            e.preventDefault();

            let valide = true
            
            // Validation si click sur déplacer et supprimer mais que l'usager n'a pas choisi de cellier
            if(this._selectCellier.value !== "0"){
                this._elErreurchoix.textContent = '';
            }
            else{
                // Sinon message d'erreur
                this._elErreurchoix.textContent = 'Choisir un cellier.';
                valide = false;
            }
         
     
           // Si valide
            if(valide){
                let cellierAdeplacer = {
                    "id_cellierChoisi" : this._selectCellier.value,
                    "id_cellierSupprime": this._idCellier
                }
               // Requete
                let requete = new Request(BaseURL + "?requete=deplacerSupprimer", { method: 'POST', body: JSON.stringify(cellierAdeplacer)});
                fetchCellier(requete,this.ferme())
            }
          

        })


        /************************
         * SUPPRIMER
         ************************/
        this._btnSupprimer.addEventListener('click', (e)=>{
            e.preventDefault();

            
            let cellierAdeplacer = {
                "id_cellierChoisi" : this._selectCellier.value,
                "id_cellierSupprime": this._idCellier
            }
            //Requête
            let requete = new Request(BaseURL + "?requete=supprimerCellier", { method: 'POST', body: JSON.stringify(cellierAdeplacer)});
            fetchCellier(requete,this.ferme())

        })

        /************************
         * Annuler
         ************************/
        this.annule(this._el)
        
    }

    

}