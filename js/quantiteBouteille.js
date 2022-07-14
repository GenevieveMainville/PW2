
(() => {
    /********************************************************************************************************** */
   /*                       CELLIER - GESTION QUANTITÉ D'UNE BOUTEILLE 
                    À PARTIR DE LA PAGE CELLIERS, AJOUTER OU BOIRE UNE BOUTEILLE       *GM                     */
   /********************************************************************************************************** */
   
   // RÉDUIRE LA QTÉ D'UNE BOUTEILLE DANS UN CELLIER 
   
   document.querySelectorAll(".btnBoire").forEach(function (element) {
          
      // Au click du bouton diminué (-)
       element.addEventListener("click", function (e) {
      
           e.preventDefault();
           let idUsager = document.querySelector('[data-js-usager]').dataset.jsUsager
           // id_bouteille
           let id =element.parentElement.dataset.jsId;
      
           let requete = new Request(BaseURL + "?requete=reduireQteBouteille", { method: 'POST', body: '{"id_usager": ' + idUsager + ',"id": ' + id + '}' });
  
           // Requête fetch
           fetch(requete)
               .then(response => {
                   if (response.status === 200) {
                       return response;
                   } else {
                       throw new Error('Erreur');
                   }
               })
               .then(response => {
                   // Récuperation des cartes bouteille
                   let carteBouteille = document.querySelectorAll('[data-js-bouteille]')
  
                   // Récupération du nombre de bouteille dans le <span></span>
                   nombreBouteille = element.previousElementSibling.textContent
  
                   // Pour chaque carte bouteille
                   for (let i = 0, l = carteBouteille.length; i < l; i++){
                       // Si le dataset de l'id_bouteille correspond au id_bouteille du  click
                       if(carteBouteille[i].dataset.jsBouteille == id){
                           // Si le nombre de bouteille est égal à 1
                           if(nombreBouteille == 1){
                               // Suppression à l'écran de la carte bouteille car le nombre de bouteille tombe à zéro
                               carteBouteille[i].remove();
                           }
                       }
                   }
                   // Si le nombre de bouteille est supérieur ou égal à 1
                   if(nombreBouteille >= 1){
                       // Insertion dans le DOM de la nouvelle quantité
                       element.previousElementSibling.innerHTML = `<span data-js-quantite>${nombreBouteille-1}</span>`; 
                   }
               }).catch(error => {
                   console.error(error);
               });  
       })
   })
  
  // AJOUTER LA QTÉ D'UNE BOUTEILLE DANS UN CELLIER 
   document.querySelectorAll(".btnAjouter").forEach(function (element) {
       
       // Au click du bouton ajouter (+)
       element.addEventListener("click", function (e) {
           e.preventDefault();
           let idUsager = document.querySelector('[data-js-usager]').dataset.jsUsager
           // id_bouteille
           let id =element.parentElement.dataset.jsId;
  
           let requete = new Request(BaseURL + "?requete=ajouterQteBouteille", { method: 'POST', body: '{"id_usager": ' + idUsager + ',"id": ' + id + '}' });
  
           // Requête fetch
           fetch(requete)
               .then(response => {
                   if (response.status === 200) {
                       return response;
                   } else {
                       throw new Error('Erreur');
                   }
               })
               .then(response => {
  
                   // Récupération de l'id_bouteille dans le <span></span>
                   nombreBouteille = parseInt(element.nextElementSibling.textContent);
                    // Insertion dans le DOM de la nouvelle quantité
                   element.nextElementSibling.innerHTML = `<span data-js-quantite>${(nombreBouteille)+1}</span>`
       
               }).catch(error => {
                   console.error(error);
               });
       })
  
   });
      
   
   
   })();