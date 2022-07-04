var $baseUrl_without_parameters = window.location.href.split("?");//[0];
$baseUrl_without_parameters = $baseUrl_without_parameters.length > 0 ? $baseUrl_without_parameters[0] : $baseUrl_without_parameters;

let tableData = [];

let tableSelectionnee = {
    id: -1,
    nomTable: "",
    ligneActive: -1,
    actionCourante: ""
};

let rows;
let input;
let elTableBody;
let elBtnAjouter;
let elBtnAnnuler;
let elActionTexte;
let elBtnConfirmer;
let elBtnModifier;
let elTableEntete;
let elTableColonnes;

let scrollbarWidth = getScrollbarWidth();

const nbMaxLignesTable = 5;
const caretUpClassName = "fa fa-caret-up";
const caretDownClassName = "fa fa-caret-down";

const elCartes = document.querySelectorAll(".carte-admin");

const elTablesVino = document.querySelector(".carte-vino");
const elBouteilles = document.querySelector(".carte-bouteille");
const elCelliers = document.querySelector(".carte-cellier");
const elUsagers = document.querySelector(".carte-usager");

const elSection1 = document.querySelector(".section1");
const elSection2 = document.querySelector(".section2");
const elSection3 = document.querySelector(".section3");
const elSection4 = document.querySelector(".section4");

const elNbBouteilles = document.querySelector(".nb-bouteilles");
const elNbCelliers = document.querySelector(".nb-celliers");
const elNbUsagers = document.querySelector(".nb-usagers");

const elNomTableVino = document.querySelector("[data-js-selection-nom-table]");
const elSelectionVino = document.querySelector("#selection-table-vino");
const elbtnAfficherVino = document.querySelector(".btn-afficher-vino");

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


/**
 * Les événements quand on clique sur une des 4 boîtes du haut.
 * Ça génère la liste des enregistrements associés à la table de la boîte
 */
elBouteilles.addEventListener("click", () => {
    traiterProchaineAction({ "nomTable": "bouteille" });
});

elCelliers.addEventListener("click", () => {
    traiterProchaineAction({ "nomTable": "cellier" });
});

elUsagers.addEventListener("click", () => {
    traiterProchaineAction({ "nomTable": "usager" });
});


/**
 * Active ou désactive une section à l'écran quand on entre/sort d'un mode d'édition du formulaire.
 * @param el Le parent qui contient les éléments à activer/désactiver
 */
function basculerEdition(el) {
    if (el.classList.contains("edition")) {
        el.classList.remove("edition");
    } else {
        el.classList.add("edition");
    }
}


/**
 * Fonction qui ajuste la flèche qui indique le sens du tri d'une colonne
 * @param event 
 */
function basculerFleche(event) {
    let element = event.target;
    let caret, champ, inverse;
    if (element.tagName === "SPAN") {
        caret = element.getElementsByClassName("caret")[0];
        champ = element.id;
    } else {
        caret = element;
        champ = element.parentElement.id;
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


/**
 * Fonction qui efface la flèche indiquant l'ordre de tri.
 * Elle sert à réinitialiser les colonnes sans ordre de tri. 
 */
function effacerFleche() {
    let carets = document.getElementsByClassName("caret");
    for (let caret of carets) {
        caret.className = "caret";
    }
}


/**
 * Fonction qui affiche les lignes pour lesquelles une de leurs valeurs est interceptée par le filtre.
 */
function filtrerDonnees() {
    input = document.getElementById("filtre-table");
    let filter = input.value.toUpperCase();
    rows = elTableBody.getElementsByTagName("tr");
    let flag = false;
    let compteur = 0;

    for (let row of rows) {
        let cells = row.getElementsByTagName("td");

        for (let cell of cells) {
            if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                if (filter) {
                    cell.classList.add("couleur-filtre");
                    row.classList.add("couleur-filtre");
                } else {
                    cell.classList.remove("couleur-filtre");
                    row.classList.remove("couleur-filtre");
                }

                flag = true;
            } else {
                cell.style.backgroundColor = "";
            }
        }

        if (flag) {
            row.style.display = "";
            compteur++;
        } else {
            row.style.display = "none";
        }

        flag = false;
    }

    elTableEntete = document.getElementById("table-entete");

    if (compteur > nbMaxLignesTable) {
        elTableEntete.style = `width: calc(100% - ${scrollbarWidth}px)`;
    } else {
        elTableEntete.style = `width: 100%)`;
    }
}


/**
 * Fonction qui identifie la valeur d'une barre de défilement dans la page.
 * Est appellée quand une table a une barre de défilement afin de faire correspondre l'entête avec le détail.
 * @returns la largeur d'une barre de défilement
 */
function getScrollbarWidth() {
    // Creating invisible container
    const outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.overflow = "scroll"; // forcing scrollbar to appear
    outer.style.msOverflowStyle = "scrollbar"; // needed for WinJS apps
    document.body.appendChild(outer);

    // Creating inner element and placing it in the container
    const inner = document.createElement("div");
    outer.appendChild(inner);

    // Calculating difference between container's full width and the child width
    const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);

    // Removing temporary elements from the DOM
    outer.parentNode.removeChild(outer);

    return scrollbarWidth;
}


/**
 * Fonction qui ajoute les données lues dans la table de détail d'un enregistrement.
 */
function injecterDonnees() {
    elTableBody.innerHTML = "";

    for (let data of tableData) {
        let row = elTableBody.insertRow(-1);

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


/**
 * Fonction qui lit les données de la BD
 * @param reqNom    Le nom de la requête à appeller
 * @param reqBody   L'information à passer avec la requçete
 * @returns         Le contenu html généré
 */
async function lireHtml(reqNom, reqBody = null) {
    document.body.className = "waiting";

    const entete = new Headers();
    entete.append("Content-Type", "text/html");

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

    const data = await reponse.text();
    document.body.className = "";

    return data;
}


/**
 * Fonction qui lit les données de la BD
 * @param reqNom    Le nom de la requête à appeller
 * @param reqBody   L'information à passer avec la requçete
 * @returns         Le contenu json généré
 */
async function lireJson(reqNom, reqBody = null) {
    document.body.className = "waiting";

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
    document.body.className = "";

    return data;
}


function selectionnerLigne(rangee) {
    rows = elTableBody.getElementsByTagName("tr");

    for (let row of rows) {
        row.classList.remove("selected");
    }

    rows[rangee].classList.add("selected");
}


/**
 * Ajoute la classe 'selected' à l'élément fourni en paramètre et l'enlève aux autres
 * @param el L'élément qui doit recevoir la classe
 */
function selectionnerCarte(el) {
    for (let i = 0, l = elCartes.length; i < l; i++) {
        elCartes[i].classList.remove("selected");

    }
    el.classList.add("selected");
}


function traiterProchaineAction(prochaineAction) {

    if (prochaineAction.hasOwnProperty("nomTable")) {
        tableSelectionnee["id"] = -1;
        tableSelectionnee["nomTable"] = prochaineAction["nomTable"];
        tableSelectionnee["ligneActive"] = -1;
        tableSelectionnee["actionCourante"] = "";

        reinitialiserSection4();
        afficherFormulaire();

    } else if (prochaineAction.hasOwnProperty("ligneActive")) {
        const ligneActive = prochaineAction["ligneActive"];

        tableSelectionnee["id"] = elTableBody.rows[ligneActive].cells[0].innerHTML;
        tableSelectionnee["ligneActive"] = ligneActive;
        tableSelectionnee["actionCourante"] = "";

        selectionnerLigne(ligneActive);
        afficherDetail({ "mode": "lire", "id": tableSelectionnee["id"] });

    } else if (prochaineAction.hasOwnProperty("actionCourante")) {
        switch (prochaineAction["actionCourante"]) {
            case "ajouter":
                tableSelectionnee["actionCourante"] = "ajouter";
                afficherDetail({ "mode": "ajouter" });
                break;
            case "annuler":
                gererAnnulation();

                // gererEdition("fin");
                // reinitialiserSection4();

                break;
            case "confirmer":
                // Sauvegarde des données
                ajouterBouteille();

                // Gérer la fin de l'édition de l'enregistrement
                gererEdition("fin");
                reinitialiserSection4();

                break;
            case "lire":
                afficherDetail({ "mode": "lire", "id": tableSelectionnee["id"] });
                break;
            case "modifier":
                tableSelectionnee["actionCourante"] = "modifier";
                afficherDetail({ "mode": "modifier", "id": tableSelectionnee["id"] });
                break;

            default:
                break;
        }
    }
}


function afficherDetail(body) {
    let requete = "";

    if (tableSelectionnee.hasOwnProperty("nomTable")) {
        switch (tableSelectionnee["nomTable"]) {
            case "bouteille":
                requete = "lireDetailBouteille";
                break;

            case "cellier":
                requete = "lireDetailCellier";
                break;

            case "usager":
                requete = "lireDetailUsager";
                break;

            case "vino__appellation":
            case "vino__cepage":
            case "vino__classification":
            case "vino__degre_alcool":
            case "vino__designation":
            case "vino__format":
            case "generique__pays":
            case "vino__produit_du_quebec":
            case "vino__region":
            case "vino__taux_de_sucre":
            case "vino__type_cellier":
            case "vino__type":
                break;
        }
    }

    if (requete) {
        lireHtml(requete, body)
            .then(formulaire => {
                elSection4.innerHTML = "";
                elSection4.insertAdjacentHTML("beforeend", formulaire);

                elBtnModifier = document.querySelector("[data-js-btn-modifier]");
                elBtnConfirmer = document.querySelector("[data-js-btn-confirmer]");
                elBtnAnnuler = document.querySelector("[data-js-btn-annuler]");
                elActionTexte = document.querySelector(".action-texte");

                if (elBtnModifier) {
                    elBtnModifier.addEventListener("click", () => {
                        traiterProchaineAction({ "actionCourante": "modifier" });
                    });

                }

                if (elBtnConfirmer) {
                    elBtnConfirmer.addEventListener("click", () => {
                        traiterProchaineAction({ "actionCourante": "confirmer" });
                    });
                }

                if (elBtnAnnuler) {
                    elBtnAnnuler.addEventListener("click", () => {
                        traiterProchaineAction({ "actionCourante": "annuler" });
                    });
                }

                if (body.mode == "ajouter" || body.mode == "modifier")
                    gererEdition("debut");
            });
    }
}


/**
 * Fonction qui construit la liste qui contient toutes les bouteilles
 */
function afficherFormulaire() {
    let requete = "";

    switch (tableSelectionnee["nomTable"]) {
        case "bouteille":
            requete = "lireFormulaireBouteille";
            selectionnerCarte(elBouteilles);
            break;

        case "cellier":
            requete = "lireFormulaireCellier";
            selectionnerCarte(elCelliers);
            break;

        case "usager":
            requete = "lireFormulaireUsager";
            selectionnerCarte(elUsagers);
            break;

        case "vino__appellation":
        case "vino__cepage":
        case "vino__classification":
        case "vino__degre_alcool":
        case "vino__designation":
        case "vino__format":
        case "generique__pays":
        case "vino__produit_du_quebec":
        case "vino__region":
        case "vino__taux_de_sucre":
        case "vino__type_cellier":
        case "vino__type":
            break;
    }

    if (requete) {
        lireHtml(requete)
            .then(formulaire => {
                elSection3.innerHTML = "";
                elSection3.insertAdjacentHTML("beforeend", formulaire);

                // On ajuste l'entête de la liste pour tenir compte de la barre de défilement
                elTableEntete = document.getElementById("table-entete");
                elTableBody = document.getElementById("table-body");
                const elTr = elTableBody.querySelectorAll("tr");

                if (elTr.length > nbMaxLignesTable) {
                    elTableEntete.style = `width: calc(100% - ${scrollbarWidth}px)`;
                }

                // On ajoute des événements à certains éléments nouvellement créés
                elTableColonnes = document.getElementsByClassName("table-colonne");

                for (let column of elTableColonnes) {
                    column.addEventListener("click", function (event) {
                        basculerFleche(event);
                    });
                }

                input = document.getElementById("filtre-table");

                input.addEventListener("keyup", function (event) {
                    filtrerDonnees();
                });

                rows = elTableBody.getElementsByTagName("tr");

                for (let i = 0, l = rows.length; i < l; i++) {
                    rows[i].addEventListener("click", () => {
                        traiterProchaineAction({ "ligneActive": i });
                    });
                }

                elBtnAjouter = document.querySelector("[data-js-btn-ajouter]");
                elActionTexte = document.querySelector(".action-texte");

                // Quand on clique sur le bouton pour ajouter un nouvel enregistrement.
                elBtnAjouter.addEventListener("click", () => {
                    traiterProchaineAction({ "actionCourante": "ajouter" });
                });
            });
    }
}


async function ajouterBouteille() {

    const lesInputs = document.querySelectorAll("select,input");
    const donnees = {};

    for (let i = 0, l = lesInputs.length; i < l; i++) {
        const element = lesInputs[i];
        donnees[element.name] = element.value;
    }

    donnees["id_bouteille"] = tableSelectionnee["id"];

    document.body.className = "waiting";

    const entete = new Headers();
    entete.append("Content-Type", "application/json");
    entete.append("Accept", "application/json");

    const reqOptions = {
        method: "POST",
        headers: entete,
        body: JSON.stringify(donnees)
    };

    const requete = new Request($baseUrl_without_parameters + "?requete=modifierAdminBouteille", reqOptions);
    const reponse = await fetch(requete);

    if (!reponse.ok) {
        throw new Error(`Erreur HTTP : statut = ${reponse.status}`);
    }

    const data = await reponse.text();
    document.body.className = "";
    console.log(data);
}

function reinitialiserSection4() {
    if (tableSelectionnee["id"] > 0) {
        afficherDetail({ "mode": "lire", "id": tableSelectionnee["id"] });
        tableSelectionnee["actionCourante"] = "";
    }

    else {
        elSection4.innerHTML = "";
    }


}


function gererEdition(pos) {
    if (pos === "debut") {
        // On rend la section 1 inutilisable le temps que dure l'édition
        if (elSection1 && !elSection1.classList.contains("edition")) {
            elSection1.classList.add("edition");
        }

        // On rend la section 2 inutilisable le temps que dure l'édition
        if (elSection2 && !elSection2.classList.contains("edition")) {
            elSection2.classList.add("edition");
        }

        // On rend la section 3 inutilisable le temps que dure l'édition
        if (elSection3 && !elSection3.classList.contains("edition")) {
            elSection3.classList.add("edition");
        }

        // On rend inutilisable les boutons Ajouter et Modifier
        let action = tableSelectionnee["actionCourante"];
        action = action.charAt(0).toUpperCase() + action.slice(1);

        switch (tableSelectionnee["nomTable"]) {
            case "bouteille":
                action += " une bouteille";
                break;

            case "cellier":
                action += " un cellier";
                break;

            case "usager":
                action += " un usager";
                break;
        }

        elActionTexte.innerHTML = action;

        if (elBtnAjouter && !elBtnAjouter.classList.contains("hide")) {
            elBtnAjouter.classList.add("hide");
        }

        if (elBtnModifier && !elBtnModifier.classList.contains("hide")) {
            elBtnModifier.classList.add("hide");
        }

        // On rend utilisable les boutons Confirmer et Annuler
        if (elBtnConfirmer) {
            elBtnConfirmer.classList.remove("hide");
        }

        if (elBtnAnnuler) {
            elBtnAnnuler.classList.remove("hide");
        }

    } else {
        // On rend la section 1 utilisable
        if (elSection1) {
            elSection1.classList.remove("edition");
        }

        // On rend la section 2 utilisable
        if (elSection2) {
            elSection2.classList.remove("edition");
        }

        // On rend la section 3 utilisable
        if (elSection3) {
            elSection3.classList.remove("edition");
        }

        // On rend utilisable les boutons Ajouter et Modifier
        elActionTexte.innerHTML = "";

        if (elBtnAjouter) {
            elBtnAjouter.classList.remove("hide");
        }

        if (elBtnModifier) {
            elBtnModifier.classList.remove("hide");
        }

        // On rend inutilisable les boutons Confirmer et Annuler
        if (elBtnConfirmer && !elBtnConfirmer.classList.contains("hide")) {
            elBtnConfirmer.classList.add("hide");
        }

        if (elBtnAnnuler && !elBtnAnnuler.classList.contains("hide")) {
            elBtnAnnuler.classList.add("hide");
        }

    }
}

function gererAnnulation() {
    const elModalMessage = document.querySelector("[data-js-modal-message]");
    const elBtnDanger = document.querySelector("[data-js-bouton-danger]");
    const elBtnSecondaire = document.querySelector("[data-js-bouton-secondaire]");
    let message = "";

    switch (tableSelectionnee["actionCourante"]) {
        case "ajouter":
            message = "Voulez-vous vraiment annuler l'ajout";
            break;

        case "modifier":
            message = "Voulez-vous vraiment annuler la modification";
            break;
    }

    if (message) {
        switch (tableSelectionnee["nomTable"]) {
            case "bouteille":
                message += " de la bouteille?";
                break;

            case "cellier":
                message += " du cellier?";
                break;

            case "usager":
                message += " de l'usager?";
                break;
        }

    }

    if (!message) {
        message = "Êtes-vous certain?"
    }

    elModalMessage.innerHTML = message;
    elBtnDanger.innerHTML = "Oui";
    elBtnSecondaire.innerHTML = "Non";

    elBtnDanger.addEventListener("click", () => {
        confirmerAnnulation();
    });

    elBtnSecondaire.addEventListener("click", () => {
        fermerModal();
    });

    ouvrirModal();
}

function confirmerAnnulation() {
    gererEdition("fin");
    reinitialiserSection4();
}

function ouvrirModal() {
    const elModal = document.querySelector(".modal");

    if (elModal.classList.contains('modal--ferme')) {
        elModal.classList.replace('modal--ferme', 'modal--ouvre');

        // Ajoute la propriété overflow-y: hidden; sur les éléments html et body afin d'enlever le scroll en Y lorsque le modal est ouvert
        document.documentElement.classList.add('overflow-y--hidden');
        document.body.classList.add('overflow-y--hidden');
    }

}

function fermerModal() {
    const elModal = document.querySelector(".modal");

    if (elModal.classList.contains('modal--ouvre')) {
        elModal.classList.replace('modal--ouvre', 'modal--ferme');

        document.documentElement.classList.remove('overflow-y--hidden');
        document.body.classList.remove('overflow-y--hidden');
    }

}
