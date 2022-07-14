class FetchCellier{
    // Fetch pour exécuter un POST
       fetchCellier = (requete, action)=>{
           fetch(requete)
               .then(response => {
                   if (response.status === 200) {
                 
                       return response.text()
                   } else {
                       throw new Error('Erreur');
                   }
               })
               .then(response => {
                  console.log(response)
                   action
    
                    //Rafraîchir la page
                   location.reload();
      
               }).catch(error => {
                   console.error(error);
               });
       }
   
       // Fetch pour récupérer les celliers d'un usager et injecter dans le modal pour le déplacer/supprimer et supprimer
       fetchGetCellier = (requete, action, id, bouton)=>{
           fetch(requete)
                   .then(response => {
                       if (response.status === 200) {
                   
                           return response.json()
                       } else {
                           throw new Error('Erreur');
                       }
                   })
                   .then(response => {
               
                       for (let key in response) {
                           
                          if(response[key].id_cellier !== id){
                        
                               let option = `<option value="${response[key].id_cellier}">${response[key].nom_cellier}</option>`
                               action.insertAdjacentHTML('beforeend', option);
                    
                          }
                       
                          let nbreCellier = Object.keys(response).length
                          // Griser les boutons déplacer et select si aucune bouteille
                          if(response[key].id_cellier == id && response[key].bouteille_total == null ){
                             bouton.classList.add("carte--inactif")
                             action.classList.add("carte--inactif")
                          }
                          else if(nbreCellier<=1){
                            
                            action.innerHTML = `<option value="null">Aucun cellier</option>`
                            bouton.classList.add("carte--inactif")
                             action.classList.add("carte--inactif")
                          }
                       
                       }    
                   
                   }).catch(error => {
                       console.error(error);
                   });
       }
       
       
   }
   export const { fetchCellier, fetchGetCellier} = new FetchCellier();