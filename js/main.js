/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */


const BaseURL = document.baseURI;
console.log(BaseURL)
window.addEventListener('load', function () {
    
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });

 let elFicheTitres = document.querySelectorAll('[data-js-fichetitre]');
 elFicheTitres.forEach(function(element){
     element.addEventListener('click',(e)=>{
         e.preventDefault
      
         if (element.nextElementSibling.classList.contains('tiroir-off')) {
            element.firstElementChild.innerHTML = `&#8722;`
          
            element.nextElementSibling.classList.replace('tiroir-off', 'tiroir');
           
           
        }
        else if(element.nextElementSibling.classList.contains('tiroir')){
            element.firstElementChild.innerHTML = `&#43;`
           
            element.nextElementSibling.classList.replace('tiroir', 'tiroir-off');
           
        }
     })
 })




/*
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


        if(liste){ // J'ai ajouté cette condition parceque ça bug quand c'est null
            liste.addEventListener("click", function (evt) {
                console.dir(evt.target)
                if (evt.target.tagName == "LI") {
                    bouteille.nom.dataset.id = evt.target.dataset.id;
                    bouteille.nom.innerHTML = evt.target.innerHTML;

                    liste.innerHTML = "";
                    inputNomBouteille.value = "";

                }
            });
        }

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




    
    */
  
});
