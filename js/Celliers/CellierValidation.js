export default class CellierValidation{
    constructor(el){
        this._el = el;
        this._elErreurnom =  this._el.querySelector("[data-js-erreurNom]")
        this._elErreurradio =  this._el.querySelector("[data-js-erreurRadio]")
        this._elNom_cellier = this._el.querySelector("[name='nom_cellier_modal']")
        this._elType_cellier_id = this._el.querySelectorAll("[name='type_cellier_id']")
        this._elDescription_cellier = this._el.querySelector("[name='description_cellier']")
        this._radio = false
        this._estValide = true
        this.id_cellier = ""
        this.initValidation()

    }
    initValidation = () =>{
        if(this._elNom_cellier.value !== ""){     
            this._elErreurnom.textContent = '';
        }
        else{
            // Sinon message d'erreur
            this._elErreurnom.textContent = "Ce champs est obligatoire";
            this._estValide = false;
        }

        //Pour chaque radio bouton
        this._elType_cellier_id.forEach(element => {    
            if(element.checked){
                this._radio = true;
            } 
        });

        // Si un bouton a été sélectionné
        if(this._radio){
            this._elErreurradio.textContent = '';
        }
        else{
            // Sinon message d'erreur
            this._elErreurradio.textContent = 'Choisir un type.';
            this._estValide = false;
        }
    }

  
    get valide() {
        return this._estValide;
    }

}