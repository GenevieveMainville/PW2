import { orders } from './orders.js';

var $baseUrl_without_parameters = window.location.href.split('?');//[0];
$baseUrl_without_parameters = $baseUrl_without_parameters.length > 0 ? $baseUrl_without_parameters[0] : $baseUrl_without_parameters;

var caretUpClassName = 'fa fa-caret-up';
var caretDownClassName = 'fa fa-caret-down';
var tableData = [];
var elTable;

const trier_par = (champ, inverse, primer) => {
    const key = primer ?
        function (x) {
            return primer(x[champ]);
        } :
        function (x) {
            return x[champ];
        };

    inverse = !inverse ? 1 : -1;

    return function (a, b) {
        return a = key(a), b = key(b), inverse * ((a > b) - (b > a));
    };
};

const elCartes = document.querySelectorAll('.card');
const elTablesVino = document.querySelector('.carte-vino');
const elBouteilles = document.querySelector('.carte-bouteille');
const elCelliers = document.querySelector('.carte-cellier');
const elUsagers = document.querySelector('.carte-usager');

elTablesVino.addEventListener('click', () => {
    construireListeVino();
    selectionnerCarte(elTablesVino);
});

elBouteilles.addEventListener('click', () => {
    construireListeBouteilles();
    selectionnerCarte(elBouteilles);
});

elCelliers.addEventListener('click', () => {
    construireListeCelliers();
    selectionnerCarte(elCelliers);
});

elUsagers.addEventListener('click', () => {
    construireListeUsagers();
    selectionnerCarte(elUsagers);
});


function basculerFleche(event) {
    let element = event.target;
    let caret, champ, inverse;
    if (element.tagName === 'SPAN') {
        caret = element.getElementsByClassName('caret')[0];
        champ = element.id
    } else {
        caret = element;
        champ = element.parentElement.id
    }

    let iconClassName = caret.className;
    effacerFleche();
    if (iconClassName.includes(caretUpClassName)) {
        caret.className = `caret ${caretDownClassName}`;
        inverse = false;
    } else {
        inverse = true;
        caret.className = `caret ${caretUpClassName}`;
    }

    tableData.sort(trier_par(champ, inverse));
    injecterDonnees();
}


function construireListeBouteilles() {
    let html = `
                <div>
                    <div class="filtre-wrapper">
                        <label for="filtre-table">Commencez à taper pour filtrer la table</label>
                        <input type="text" id="filtre-table" class="filtre-table" placeholder="Rechercher..." title="Commencez à taper">
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th><span id="id_bouteille" class="w3-button table-column">Id bouteille <i class="caret"></span></th>
                                <th><span id="id_cellier" class="w3-button table-column">Id Cellier <i class="caret"></span></th>
                                <th><span id="nom_bouteille" class="w3-button table-column">Nom de la bouteille <i class="caret"></span></th>
                                <th><span id="url_saq" class="w3-button table-column">Lien vers la SAQ <i class="caret"></span></th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>`;

    lireDonnees('lireAdminBouteilles')
        .then(listeBouteilles => {
            let elNbTrouve = document.querySelector('.nb-bouteilles'),
                nbTrouve = listeBouteilles.length;

            reinitialiserListes();

            // Création de la nouvelle table, si il y a des données
            let tableWrapper = document.querySelector('.table-wrapper');

            elNbTrouve.innerHTML = nbTrouve;
            elNbTrouve.classList.remove('inconnu');

            if (nbTrouve == 0) {
                let tableVide = `
                <div>
                    <div class="err err-bouteille">
                        Aucune bouteille trouvée
                    </div>
                </div>`;

                tableWrapper.insertAdjacentHTML('beforeend', tableVide);
            } else {
                tableWrapper.insertAdjacentHTML('beforeend', html);

                // On ajoute des événements à certains éléments nouvellement créés
                let tableColumns = document.getElementsByClassName('table-column');

                for (let column of tableColumns) {
                    column.addEventListener('click', function (event) {
                        basculerFleche(event);
                    });
                }

                let input = document.getElementById('filtre-table');

                input.addEventListener('keyup', function (event) {
                    filtrerDonnees();
                });

                elTable = document.getElementById('table-body');

                // Injection des données
                tableData = [...listeBouteilles];
                injecterDonnees();

                let rows = elTable.getElementsByTagName("tr");

                for (let row of rows) {
                    row.addEventListener("click", () => {
                        const idBouteille = row.firstElementChild.innerHTML;
                        const body = { 'id_bouteille': idBouteille };
                        const requete = "lireAdminUneBouteille";

                        lireDonnees(requete, body)
                            .then(donnees => {
                                afficherDonnees(donnees[0]);
                            });

                    });
                }
            }
        });
}


function afficherDonnees(donnees) {
    let html = `
                <div class="col-md-12 detail-boutons">
                    <div class="detail-btn" title="Ajouter">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
                        </svg>
                    </div>
                    <div class="detail-btn" title="Modifier">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
                        </svg>
                    </div>
                </div>

                <div>
                    <table>
                        <thead>
                            <tr>
                                <th><span>Nom du champ</span></th>
                                <th><span>Valeur</span></th>
                            </tr>
                        </thead>
                        <tbody id="detail-body"></tbody>
                    </table>
                </div>`;

    let elDetailWrapper = document.querySelector('.detail-wrapper');
    elDetailWrapper.innerHTML = "";
    elDetailWrapper.insertAdjacentHTML('beforeend', html);

    let elDetail = document.getElementById('detail-body');
    elDetail.innerHTML = "";

    for (let i = 0, l = Object.keys(donnees).length; i < l; i++) {
        // tr
        let row = elDetail.insertRow(-1);

        // td
        let elem = row.insertCell(-1);
        let cle = Object.keys(donnees)[i];

        elem.innerHTML = cle;

        // td
        elem = row.insertCell(-1);
        let donnee = Object.values(donnees)[i];

        if (donnee) {
            if (donnee.startsWith("http")) {
                donnee = `
                        <div class="lien-externe">
                            <span>${donnee}</span>
                            <a href="${donnee}" target="_blank"
                                title="Ouvre le document lié dans une nouvelle fenêtre ou un nouvel onglet">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M172.5 131.1C228.1 75.51 320.5 75.51 376.1 131.1C426.1 181.1 433.5 260.8 392.4 318.3L391.3 319.9C381 334.2 361 337.6 346.7 327.3C332.3 317 328.9 297 339.2 282.7L340.3 281.1C363.2 249 359.6 205.1 331.7 177.2C300.3 145.8 249.2 145.8 217.7 177.2L105.5 289.5C73.99 320.1 73.99 372 105.5 403.5C133.3 431.4 177.3 435 209.3 412.1L210.9 410.1C225.3 400.7 245.3 404 255.5 418.4C265.8 432.8 262.5 452.8 248.1 463.1L246.5 464.2C188.1 505.3 110.2 498.7 60.21 448.8C3.741 392.3 3.741 300.7 60.21 244.3L172.5 131.1zM467.5 380C411 436.5 319.5 436.5 263 380C213 330 206.5 251.2 247.6 193.7L248.7 192.1C258.1 177.8 278.1 174.4 293.3 184.7C307.7 194.1 311.1 214.1 300.8 229.3L299.7 230.9C276.8 262.1 280.4 306.9 308.3 334.8C339.7 366.2 390.8 366.2 422.3 334.8L534.5 222.5C566 191 566 139.1 534.5 108.5C506.7 80.63 462.7 76.99 430.7 99.9L429.1 101C414.7 111.3 394.7 107.1 384.5 93.58C374.2 79.2 377.5 59.21 391.9 48.94L393.5 47.82C451 6.731 529.8 13.25 579.8 63.24C636.3 119.7 636.3 211.3 579.8 267.7L467.5 380z"/></svg>
                            </a>
                        </div>`;
            }
        } else {
            donnee = "** Valeur non définie **"
        }

        elem.innerHTML = donnee;
    }
}


function construireListeCelliers() {
    let html = `
                <div>
                    <div class="filtre-wrapper">
                        <label for="filtre-table">Commencez à taper pour filtrer la table</label>
                        <input type="text" id="filtre-table" class="filtre-table" placeholder="Rechercher..." title="Commencez à taper">
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th><span id="id_cellier" class="w3-button table-column">Id cellier <i class="caret"></span></th>
                                <th><span id="id_usager" class="w3-button table-column">Id usager <i class="caret"></span></th>
                                <th><span id="nom_cellier" class="w3-button table-column">Nom du cellier <i class="caret"></span></th>
                                <th><span id="type_cellier" class="w3-button table-column">type de cellier <i class="caret"></span></th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>`;

    lireDonnees('lireAdminCelliers')
        .then(listeCelliers => {
            let elNbTrouve = document.querySelector('.nb-celliers'),
                nbTrouve = listeCelliers.length;

            reinitialiserListes();

            // Création de la nouvelle table, si il y a des données
            let tableWrapper = document.querySelector('.table-wrapper');

            elNbTrouve.innerHTML = nbTrouve;
            elNbTrouve.classList.remove('inconnu');

            if (nbTrouve == 0) {
                let tableVide = `
                <div>
                    <div class="err err-cellier">
                        Aucun cellier trouvé
                    </div>
                </div>`;

                tableWrapper.insertAdjacentHTML('beforeend', tableVide);
            } else {
                tableWrapper.insertAdjacentHTML('beforeend', html);

                // On ajoute des événements à certains éléments nouvellement créés
                let tableColumns = document.getElementsByClassName('table-column');

                for (let column of tableColumns) {
                    column.addEventListener('click', function (event) {
                        basculerFleche(event);
                    });
                }

                let input = document.getElementById('filtre-table');

                input.addEventListener('keyup', function (event) {
                    filtrerDonnees();
                });

                elTable = document.getElementById('table-body');

                // Injection des données
                tableData = [...listeCelliers];
                injecterDonnees();

                let rows = elTable.getElementsByTagName("tr");

                for (let row of rows) {
                    row.addEventListener("click", () => {
                        const idCellier = row.firstElementChild.innerHTML;
                        const body = { 'id_cellier': idCellier };
                        const requete = "lireAdminUnCellier";

                        lireDonnees(requete, body)
                            .then(donnees => {
                                afficherDonnees(donnees[0]);
                            });

                    });
                }
            }
        });
}


function construireListeUsagers() {
    let html = `
                <div>
                    <div class="filtre-wrapper">
                        <label for="filtre-table">Commencez à taper pour filtrer la table</label>
                        <input type="text" id="filtre-table" class="filtre-table" placeholder="Rechercher..." title="Commencez à taper">
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th><span id="id_usager" class="w3-button table-column">Id de l'usager <i class="caret"></span></th>
                                <th><span id="nom_usager" class="w3-button table-column">Nom de l'usager <i class="caret"></span></th>
                                <th><span id="courriel_usager" class="w3-button table-column">Courriel <i class="caret"></span></th>
                                <th><span id="nom_utilisateur" class="w3-button table-column">Nom d'utilisateur <i class="caret"></span></th>
                                <th><span id="type_usager" class="w3-button table-column">Type d'usager <i class="caret"></span></th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>`;

    lireDonnees('lireAdminUsagers')
        .then(listeUsagers => {
            let elNbTrouve = document.querySelector('.nb-usagers'),
                nbTrouve = listeUsagers.length;

            reinitialiserListes();

            // Création de la nouvelle table, si il y a des données
            let tableWrapper = document.querySelector('.table-wrapper');

            elNbTrouve.innerHTML = nbTrouve;
            elNbTrouve.classList.remove('inconnu');

            if (nbTrouve == 0) {
                let tableVide = `
                <div>
                    <div class="err err-usager">
                        Aucun usager trouvé
                    </div>
                </div>`;

                tableWrapper.insertAdjacentHTML('beforeend', tableVide);
            } else {
                tableWrapper.insertAdjacentHTML('beforeend', html);

                // On ajoute des événements à certains éléments nouvellement créés
                let tableColumns = document.getElementsByClassName('table-column');

                for (let column of tableColumns) {
                    column.addEventListener('click', function (event) {
                        basculerFleche(event);
                    });
                }

                let input = document.getElementById('filtre-table');

                input.addEventListener('keyup', function (event) {
                    filtrerDonnees();
                });

                elTable = document.getElementById('table-body');

                // Injection des données
                tableData = [...listeUsagers];
                injecterDonnees();

                let rows = elTable.getElementsByTagName("tr");

                for (let row of rows) {
                    row.addEventListener("click", () => {
                        const idUsager = row.firstElementChild.innerHTML;
                        const body = { 'id_usager': idUsager };
                        const requete = "lireAdminUnUsager";

                        lireDonnees(requete, body)
                            .then(donnees => {
                                afficherDonnees(donnees[0]);
                            });

                    });
                }
            }
        });
}


function construireListeVino() {
    let elNbTrouve = document.querySelector('.nb-tables-vino'),
        nbTrouve = 13;

    reinitialiserListes();

    elNbTrouve.innerHTML = nbTrouve;
    elNbTrouve.classList.remove('inconnu');
}


function effacerFleche() {
    let carets = document.getElementsByClassName('caret');
    for (let caret of carets) {
        caret.className = "caret";
    }
}


function filtrerDonnees() {
    let input = document.getElementById('filtre-table');
    let filter = input.value.toUpperCase();
    let rows = elTable.getElementsByTagName("tr");
    let flag = false;

    for (let row of rows) {
        let cells = row.getElementsByTagName("td");

        for (let cell of cells) {
            if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                if (filter) {
                    cell.style.backgroundColor = 'yellow';
                } else {
                    cell.style.backgroundColor = "";
                }

                flag = true;
            } else {
                cell.style.backgroundColor = "";
            }
        }

        if (flag) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

        flag = false;
    }
}


function injecterDonnees() {
    elTable.innerHTML = "";

    for (let data of tableData) {
        let row = elTable.insertRow(-1);

        for (let i = 0, l = Object.keys(data).length; i < l; i++) {
            let elem = row.insertCell(-1);
            let donnee = Object.values(data)[i];

            if (donnee.startsWith("http")) {
                donnee = `
                        <div class="lien-externe">
                            <span>${donnee}</span>
                            <a href="${donnee}" target="_blank"
                                title="Ouvre le document lié dans une nouvelle fenêtre ou un nouvel onglet">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M172.5 131.1C228.1 75.51 320.5 75.51 376.1 131.1C426.1 181.1 433.5 260.8 392.4 318.3L391.3 319.9C381 334.2 361 337.6 346.7 327.3C332.3 317 328.9 297 339.2 282.7L340.3 281.1C363.2 249 359.6 205.1 331.7 177.2C300.3 145.8 249.2 145.8 217.7 177.2L105.5 289.5C73.99 320.1 73.99 372 105.5 403.5C133.3 431.4 177.3 435 209.3 412.1L210.9 410.1C225.3 400.7 245.3 404 255.5 418.4C265.8 432.8 262.5 452.8 248.1 463.1L246.5 464.2C188.1 505.3 110.2 498.7 60.21 448.8C3.741 392.3 3.741 300.7 60.21 244.3L172.5 131.1zM467.5 380C411 436.5 319.5 436.5 263 380C213 330 206.5 251.2 247.6 193.7L248.7 192.1C258.1 177.8 278.1 174.4 293.3 184.7C307.7 194.1 311.1 214.1 300.8 229.3L299.7 230.9C276.8 262.1 280.4 306.9 308.3 334.8C339.7 366.2 390.8 366.2 422.3 334.8L534.5 222.5C566 191 566 139.1 534.5 108.5C506.7 80.63 462.7 76.99 430.7 99.9L429.1 101C414.7 111.3 394.7 107.1 384.5 93.58C374.2 79.2 377.5 59.21 391.9 48.94L393.5 47.82C451 6.731 529.8 13.25 579.8 63.24C636.3 119.7 636.3 211.3 579.8 267.7L467.5 380z"/></svg>
                            </a>
                        </div>`;
            }

            elem.innerHTML = donnee;

        }
    }

    filtrerDonnees();
}


async function lireDonnees(reqNom, reqBody = null) {
    const entete = new Headers();
    entete.append("Content-Type", "application/json");
    entete.append("Accept", "application/json");

    const reqOptions = {
        method: "POST",
        headers: entete
    };

    if (reqBody) {
        reqOptions["body"] = JSON.stringify(reqBody);
    }

    const requete = new Request($baseUrl_without_parameters + "?requete=" + reqNom, reqOptions);
    const reponse = await fetch(requete);

    if (!reponse.ok) {
        throw new Error(`Erreur HTTP : statut = ${reponse.status}`);
    }

    const data = await reponse.json();
    return data;
}


// Ajoute la classe 'selected' à l'élément courant et l'enlève aux autres
function selectionnerCarte(el) {
    for (let i = 0, l = elCartes.length; i < l; i++) {
        elCartes[i].classList.remove("selected");

    }
    el.classList.add("selected");
}


function reinitialiserListes() {
    const tableWrapper = document.querySelector('.table-wrapper');
    const elDetailWrapper = document.querySelector('.detail-wrapper');

    tableWrapper.innerHTML = "";
    elDetailWrapper.innerHTML = "";

}
