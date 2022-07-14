export default class ModalCellier{
    constructor(){
        this._elModal = document.querySelector('[data-js-modal]')
        this._elAnnulercellier = document.querySelector('[data-js-annulercellier]')
        this._elModalContenu = document.querySelector('[data-js-modalcontenu]')
    }
    

     ouvre = () =>{
        if (this._elModal.classList.contains('modal--ferme')) {
            this._elModal.classList.replace('modal--ferme', 'modal--ouvre');
        
            // Ajoute la propriété overflow-y: hidden; sur les éléments html et body afin d'enlever le scroll en Y lorsque le modal est ouvert
            document.documentElement.classList.add('overflow-y--hidden');
            document.body.classList.add('overflow-y--hidden');
        }
    }
    
    ferme = () =>{
        if (this._elModal.classList.contains('modal--ouvre')) {
            this._elModal.classList.replace('modal--ouvre', 'modal--ferme');
            
            // Enlève la propriété overflow-y: hidden; sur les éléments html et body afin de rendre de nouveau possible le scroll en Y lorsque le modal est fermé
            document.documentElement.classList.remove('overflow-y--hidden');
            document.body.classList.remove('overflow-y--hidden');
        }
    }
    annule = (bouton) =>{
        this._elAnnulercellier.addEventListener('click', (e) => {
            e.preventDefault();
            this.ferme()
            if(bouton)
                bouton.remove()
        });
    }

    modal = (titre,bouton) =>{
        this._elModalContenu.innerHTML = `
            <!--TITRE-->
            <h4 data-js-titremodal>${titre}</h4>
            <!--CHAMPS-->
             <!--Nom cellier-->
            <div class="formulaire__champs">
                <label>Nom du cellier:</label>
                <input type="text" name="nom_cellier_modal" class="modal__input" value="" required>
                <small class="carte__erreur" data-js-erreurnom></small>
            </div>
            <div class="formulaire__champs">
                <!--Type cellier-->
                <label class="radio"> Cellier 
                    <input type="radio" class="carte__radio-btn" class="modal__input" name="type_cellier_id" value="1">
                    <i class="carte--aligne-centre"><svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M336.6 156.5C327.3 148.1 322.6 136.5 327.1 125.3L357.6 49.18C362.7 36.27 377.8 30.36 389.7 37.63C410.9 50.63 430 66.62 446.5 85.02C455.7 95.21 452.9 110.9 441.5 118.5L373.9 163.5C363.6 170.4 349.8 168.1 340.5 159.9C339.2 158.7 337.9 157.6 336.6 156.5H336.6zM297.7 112.6C293.2 123.1 280.9 129.8 268.7 128.6C264.6 128.2 260.3 128 256 128C251.7 128 247.4 128.2 243.3 128.6C231.1 129.8 218.8 123.1 214.3 112.6L183.1 36.82C178.8 24.02 185.5 9.433 198.1 6.374C217.3 2.203 236.4 0 256 0C275.6 0 294.7 2.203 313 6.374C326.5 9.433 333.2 24.02 328 36.82L297.7 112.6zM122.3 37.63C134.2 30.36 149.3 36.27 154.4 49.18L184.9 125.3C189.4 136.5 184.7 148.1 175.4 156.5C174.1 157.6 172.8 158.7 171.5 159.9C162.2 168.1 148.4 170.4 138.1 163.5L70.52 118.5C59.13 110.9 56.32 95.21 65.46 85.02C81.99 66.62 101.1 50.63 122.3 37.63H122.3zM379.5 222.1C376.3 210.7 379.7 198.1 389.5 191.6L458.1 145.8C469.7 138.1 485.6 141.9 491.2 154.7C501.6 178.8 508.4 204.8 510.9 232C512.1 245.2 501.3 255.1 488 255.1H408C394.7 255.1 384.2 245.2 381.8 232.1C381.1 228.7 380.4 225.4 379.5 222.1V222.1zM122.5 191.6C132.3 198.1 135.7 210.7 132.5 222.1C131.6 225.4 130.9 228.7 130.2 232.1C127.8 245.2 117.3 256 104 256H24C10.75 256-.1184 245.2 1.107 232C3.636 204.8 10.43 178.8 20.82 154.7C26.36 141.9 42.26 138.1 53.91 145.8L122.5 191.6zM104 288C117.3 288 128 298.7 128 312V360C128 373.3 117.3 384 104 384H24C10.75 384 0 373.3 0 360V312C0 298.7 10.75 288 24 288H104zM488 288C501.3 288 512 298.7 512 312V360C512 373.3 501.3 384 488 384H408C394.7 384 384 373.3 384 360V312C384 298.7 394.7 288 408 288H488zM104 416C117.3 416 128 426.7 128 440V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V440C0 426.7 10.75 416 24 416H104zM488 416C501.3 416 512 426.7 512 440V488C512 501.3 501.3 512 488 512H408C394.7 512 384 501.3 384 488V440C384 426.7 394.7 416 408 416H488zM272 464C272 472.8 264.8 480 256 480C247.2 480 240 472.8 240 464V192C240 183.2 247.2 176 256 176C264.8 176 272 183.2 272 192V464zM208 464C208 472.8 200.8 480 192 480C183.2 480 176 472.8 176 464V224C176 215.2 183.2 208 192 208C200.8 208 208 215.2 208 224V464zM336 464C336 472.8 328.8 480 320 480C311.2 480 304 472.8 304 464V224C304 215.2 311.2 208 320 208C328.8 208 336 215.2 336 224V464z"/></svg></i>
                </label>
                <label class="radio"> Réfrigérateur
                    <input type="radio" class="carte__radio-btn" class="modal__input" name="type_cellier_id" value="2">
                    <i class="carte--aligne-centre"><span  class="material-symbols-outlined carte__vertical-icon">kitchen</span></i>
                </label>
                <small class="carte__erreur"data-js-erreurradio></small>
            </div>
            <!--Description cellier-->
            <div class="formulaire__champs">
                <label>Description:</label>
                <input type="text" name="description_cellier" class="modal__input" value="">
            </div>
            <!--BOUTON--> 
            <div class="formulaire__champs" data-js-boutonmodal>
                ${bouton}
                <button data-js-annulercellier class="bouton-secondaire">Annuler</button>
            </div> 
        `
    }

    modalsupprimer = (titre) =>{

        this._elModalContenu.innerHTML = `<h4 class=""><span class="carte__erreur">Supprimer le cellier</span> "${titre}" ?</h4>

        <p class="modal__texte">Cette action entraînera la suppression du cellier et de toutes ces bouteilles</p>
        
        <div>
            <h4 class="carte__entete carte--haut">Déplacer les bouteilles dans un autre cellier?</h4>
            <label class="modal__texte" for="celliers">Choisir un cellier :
                <select data-js-selectcellier >
                    <option value="null">--Choisir--</option>
                </select>
                <small class="carte__erreur"data-js-erreurchoix></small>
            </label>
        </div>
        
        <form class="formulaire__champs" data-js-boutonmodal>
            <button  class="bouton-secondaire" data-js-supprimerdeplacer>Déplacer et supprimer</button>
            <button  class="bouton-secondaire" data-js-supprimeruncellier>Supprimer</button>
            <button data-js-annulercellier class="bouton-secondaire">Annuler</button>
        </form> 
        `
    }
 
}