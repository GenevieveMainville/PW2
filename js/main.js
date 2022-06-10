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
const BaseURL = document.baseURI;
console.log(BaseURL);
window.addEventListener('load', function () {
    console.log("load");

    
    document.querySelectorAll(".btnBoire").forEach(function (element) {
       
       
        element.addEventListener("click", function (evt) {
            let id =element.parentElement.dataset.jsId;
            let requete = new Request(BaseURL + "?requete=reduireQteBouteille", { method: 'POST', body: '{"id": ' + id + '}' });


            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                        return response;
                    } else {
                        throw new Error('Erreur');
                    }
                })
                .then(response => {
                    let carteBouteille = document.querySelectorAll('[data-js-bouteille]')
                    nombreBouteille = element.previousElementSibling.textContent
                   for (let i = 0, l = carteBouteille.length; i < l; i++){
                        if(carteBouteille[i].dataset.jsBouteille == id){
                            if(nombreBouteille == 1){
                                console.log(carteBouteille[i])
                                carteBouteille[i].remove();
                            }
                        }
                   }
                    
                    
                    if(nombreBouteille >= 1){
                        element.previousElementSibling.innerHTML = `<span data-js-quantite>${nombreBouteille-1}</span>`;
                        
                    }
                    
                }).catch(error => {
                    console.error(error);
                });
               
        })

    
})

    document.querySelectorAll(".btnAjouter").forEach(function (element) {
     
        element.addEventListener("click", function (evt) {
            let id =element.parentElement.dataset.jsId;
            let requete = new Request(BaseURL + "?requete=ajouterQteBouteille", { method: 'POST', body: '{"id": ' + id + '}' });

            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                        return response;
                    } else {
                        throw new Error('Erreur');
                    }
                })
                .then(response => {
                    nombreBouteille = parseInt(element.nextElementSibling.textContent);
                    element.nextElementSibling.innerHTML = `<span data-js-quantite>${(nombreBouteille)+1}</span>`
        
                }).catch(error => {
                    console.error(error);
                });
        })

    });

    let inputNomBouteille = document.querySelector("[name='nom_bouteille']");

    let liste = document.querySelector('.listeAutoComplete');

    if (inputNomBouteille) {
        inputNomBouteille.addEventListener("keyup", function (evt) {
            console.log(evt);
            let nom = inputNomBouteille.value;
            liste.innerHTML = "";
            if (nom) {
                let requete = new Request(BaseURL + "index.php?requete=autocompleteBouteille", { method: 'POST', body: '{"nom": "' + nom + '"}' });
                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {
                            return response.json();
                        } else {
                            throw new Error('Erreur');
                        }
                    })
                    .then(response => {
                        console.log(response);


                        response.forEach(function (element) {
                            liste.innerHTML += "<li data-id='" + element.id + "'>" + element.nom + "</li>";
                        })
                    }).catch(error => {
                        console.error(error);
                    });
            }


        });

        let bouteille = {
            nom: document.querySelector(".nom_bouteille"),
            millesime: document.querySelector("[name='millesime']"),
            quantite: document.querySelector("[name='quantite']"),
            date_achat: document.querySelector("[name='date_achat']"),
            prix: document.querySelector("[name='prix']"),
            garde_jusqua: document.querySelector("[name='garde_jusqua']"),
            notes: document.querySelector("[name='notes']"),
        };


        liste.addEventListener("click", function (evt) {
            console.dir(evt.target)
            if (evt.target.tagName == "LI") {
                bouteille.nom.dataset.id = evt.target.dataset.id;
                bouteille.nom.innerHTML = evt.target.innerHTML;

                liste.innerHTML = "";
                inputNomBouteille.value = "";

            }
        });

        let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
        if (btnAjouter) {
            btnAjouter.addEventListener("click", function (evt) {
                var param = {
                    "id_bouteille": bouteille.nom.dataset.id,
                    "date_achat": bouteille.date_achat.value,
                    "garde_jusqua": bouteille.garde_jusqua.value,
                    "notes": bouteille.date_achat.value,
                    "prix": bouteille.prix.value,
                    "quantite": bouteille.quantite.value,
                    "millesime": bouteille.millesime.value,
                };
                let requete = new Request(BaseURL + "index.php?requete=ajouterNouvelleBouteilleCellier", { method: 'POST', body: JSON.stringify(param) });
                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {
                            return response.json();
                        } else {
                            throw new Error('Erreur');
                        }
                    })
                    .then(response => {
                        console.log(response);

                    }).catch(error => {
                        console.error(error);
                    });

            });
        }

    }

    /*AJOUT D'UN CELLIER*/

    let elBtnAjouterCellier =  document.querySelector('[data-js-boutonAjouterCellier]'),
        usager =  document.querySelector("[data-js-usager]"),    
        erreurnom =  document.querySelector("[data-js-erreurNom]"),
        erreurradio =  document.querySelector("[data-js-erreurRadio]") 
       
    if(elBtnAjouterCellier){

        elBtnAjouterCellier.addEventListener('click', (e) => {

            e.preventDefault();
            // Récupération des champs
            let nom_cellier = document.querySelector("[name='nom_cellier']"),
                type_cellier_id = document.querySelectorAll("[name='type_cellier_id']"),
                description_cellier = document.querySelector("[name='description_cellier']").value,
                radio = false,
                estValide = true
                // Si le nom du cellier n'est pas vide
                if(nom_cellier.value !== ""){
                
                    erreurnom.textContent = '';
                    // Assigné la valeur à la variable
                    nom_cellier = nom_cellier.value
                }
                else{
                    // Sinon message d'erreur
                    erreurnom.textContent = "Ce champs est obligatoire";
                    estValide = false;
                }
                //Pour chaque radio bouton
                type_cellier_id.forEach(element => {
                    
                    if(element.checked){
                        radio = true;
                    }
                    
                });
                // Si un bouton a été sélectionné
                if(radio){
                    
                        erreurradio.textContent = '';
                        // Assigner la valeur
                        type_cellier_id = document.querySelector('input[name="type_cellier_id"]:checked').value;
                }
                else{
                    // Sinon message d'erreur
                    erreurradio.textContent = 'Choisir un type.';
                    estValide = false;
                }
                
                // Si tout est valide
                if(estValide){
                    //Assigné les données à transmettre
                    let cellier = {
        
                        "id_usager": usager.dataset.jsUsager,
                        "nom_cellier": nom_cellier,
                        "type_cellier_id": type_cellier_id,
                        "description_cellier": description_cellier
                    };  
                    
                    // Requête fetch
                    let requete = new Request(BaseURL + "?requete=ajouterNouveauCellier", { method: 'POST', body: JSON.stringify(cellier) });
                    console.log(requete)
                            fetch(requete)
                                .then(response => {
                                    if (response.status === 200) {
                                        // si ok fermeture du modal
                                        elModal = document.querySelector('[data-js-modal]')
                                        if (elModal.classList.contains('modal--ouvre')) {
                                            elModal.classList.replace('modal--ouvre', 'modal--ferme');
                                            
                                            document.documentElement.classList.remove('overflow-y--hidden');
                                            document.body.classList.remove('overflow-y--hidden');
                                        }
                                        // Rafraîchir la page
                                        location.reload();
                                        return response.json();
                                    } else {
                                        throw new Error('Erreur');
                                    }
                                })
                                .then(response => {
                                    console.log(response);
                                    
                                }).catch(error => {
                                    console.error(error);
                                });
                }

            });

    }
});
