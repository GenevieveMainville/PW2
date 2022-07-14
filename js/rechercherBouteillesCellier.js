let $baseUrl_without_parameters = window.location.href.split('?');//[0];
$baseUrl_without_parameters = $baseUrl_without_parameters.length > 0 ? $baseUrl_without_parameters[0] : $baseUrl_without_parameters;

const elIdCellier = document.querySelector('[data-js-id-cellier]').value;


const elBtnRechercheCellier = document.querySelector('[data-js-rechercher-bouteilles-cellier]');
elBtnRechercheCellier.addEventListener("click", rechercherBouteillesCellier);

const elBtnRechercheAvancee = document.querySelector('[data-js-recherche-avancee-bouteilles]');
elBtnRechercheAvancee.addEventListener("click", () => {
    window.location.replace($baseUrl_without_parameters + "?requete=rechercher&id_cellier=" + elIdCellier);
});


function rechercherBouteillesCellier() {
    const elTermes = document.querySelector("[data-js-termes]").value;
    const elCarteContenant = document.querySelector('[data-js-carte-contenant]');

    const entete = new Headers();
    entete.append("Content-Type", "application/json");
    entete.append("Accept", "application/json");

    const reqOptions = {
        method: "POST",
        headers: entete,
        body: JSON.stringify({ 'id_cellier': elIdCellier, 'filtres': elTermes })
    };

    const requete = new Request($baseUrl_without_parameters + "?requete=rechercherBouteillesCellier", reqOptions);

    fetch(requete)
        .then(response => {
            if (response.status === 200) {
                return response.json()
            } else {
                throw new Error('Erreur');
            }
        })
        .then(donnees => {
            if (donnees['erreur']) {
                console.log(donnees['erreur']);
            } else if (donnees['liste']) {
                const data = donnees['liste'];
                elCarteContenant.innerHTML = "";

                if (!data.length) {
                    elCarteContenant.innerHTML = `<p class="aucune-bouteille">Aucune bouteille trouvée</p>`;
                } else {
                    data.forEach(bouteille => {
                        let id_cellier = bouteille["id_cellier"];
                        let id_bouteille = bouteille["id_bouteille"];
                        let image_bouteille = bouteille["image_bouteille"];
                        let nom_bouteille = bouteille["nom_bouteille"];
                        let description_bouteille = bouteille["description_bouteille"];
                        let millesime_bouteille = bouteille["millesime"];
                        let quantite_bouteille = bouteille["quantite_bouteille"];
                        let date_achat = bouteille["date_achat"];
                        let prix_bouteille = bouteille["prix_bouteille"];
                        let note = bouteille["note"];

                        console.log(note);

                        if (note) {
                            note = `Ma note est de ${note}/5`;
                        } else {
                            note = "Aucune note encore attribuée";
                        }

                        let carteBouteille = `
                                            <a class="carte__lien" href="?requete=details&id_cellier=${id_cellier}">
                                                <div class="carte__contenu" data-js-bouteille="${id_bouteille}">
                                                    <div class="carte__lien carte--flex">
                                                        <div class="carte__img">
                                                            <img src="${image_bouteille}" alt="bouteille">
                                                        </div>
                                                        
                                                        <div class="carte__description">
                                                            <div>
                                                                <div class="carte--flex carte__titre">
                                                                    <h4 class="">${nom_bouteille} - ${millesime_bouteille}</h4>
                                                                </div>

                                                                <div>
                                                                    <div class="carte__texte">
                                                                        ${description_bouteille}
                                                                    </div>
                                                                    <div class="carte__texte">
                                                                        Acheté le ${date_achat}
                                                                    </div>
                                                                    <div class="carte__texte">
                                                                        Au prix de ${prix_bouteille}
                                                                    </div>
                                                                    <div class="carte__texte">
                                                                        ${note}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <ul class="carte--haut">
                                                                <li class="carte--aligne-droite">
                                                                    <form data-js-id="${id_bouteille}">
                                                                        <i><svg class="carte__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.25 6.254-6.251 16.38-.0006 22.63l-76.63 76.63c-46.63-19.75-102.4-10.75-140.4 27.25l-158.4 158.4c-25 25-25 65.51 0 90.51l90.51 90.52c25 25 65.51 25 90.51 0l158.4-158.4c38-38 47-93.76 27.25-140.4l76.63-76.63c6.25 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57zM179.3 423.2l-90.51-90.51l122-122l90.51 90.52L179.3 423.2z"></path></svg></i>    

                                                                        <button class="bouton btnAjouter">
                                                                            <i class="carte__icone-petit--espace"><svg class="carte__icone-petit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"></path></svg></i>
                                                                        </button>

                                                                        <span data-js-quantite="">${quantite_bouteille}</span>
                                                                        
                                                                        <button class="bouton btnBoire">
                                                                            <i class="carte__icone-petit--espace"><svg class="carte__icone-petit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM168 232C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H168z"></path></svg></i>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>`;

                        elCarteContenant.insertAdjacentHTML("beforeend", carteBouteille);
                    });
                }
            }

        }).catch(erreur => {
            console.error(erreur);
        });
}