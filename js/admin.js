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
let elNomTableVino;
let elTableColonnes;
let elbtnAfficherVino;

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


ajusterElementsResponsive();

/**
 * Les événements quand on clique sur une des 4 boîtes du haut.
 * Ça génère la liste des enregistrements associés à la table de la boîte
 */
elTablesVino.addEventListener("click", () => {
    afficherSection2();
});

elBouteilles.addEventListener("click", () => {
    cacherSection2();
    selectionnerCarte(elBouteilles);

    traiterProchaineAction({ "nomTable": "bouteille" });
});

elCelliers.addEventListener("click", () => {
    cacherSection2();
    selectionnerCarte(elCelliers);

    traiterProchaineAction({ "nomTable": "cellier" });
});

elUsagers.addEventListener("click", () => {
    cacherSection2();
    selectionnerCarte(elUsagers);

    traiterProchaineAction({ "nomTable": "usager" });
});


/**
 * Fonction qui construit le formulaire détaillant toutes les infos de l'enregistrement sélectionné.
 */
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
            case "vino__bouteille":
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
                body["nomTable"] = tableSelectionnee["nomTable"];
                requete = "lireDetailVino";
                break;

            default:
                elSection4.innerHTML = "";
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

                let elBtnsAjouter = document.querySelectorAll("[data-js-btn-ajouter]");
                elBtnAjouter = elBtnsAjouter[0];

                for (let i = 0, l = elBtnsAjouter.length; i < l; i++) {
                    elBtnsAjouter[i].addEventListener("click", () => {
                        traiterProchaineAction({ "actionCourante": "ajouter" });
                    });
                }

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

                if (body.mode == "ajouter" || body.mode == "modifier") {
                    gererEdition("debut");
                }

                ajusterElementsResponsive();

            });
    }
}


/**
 * Fonction qui construit le formulaire détaillant toues les enregistrements de la table sélectionnée.
 */
function afficherFormulaire() {
    let body = "",
        requete = "";

    elNomTableVino = document.querySelector("[data-js-selection-nom-table]");
    const elTableVino = document.querySelector("#selection-table-vino");
    let nomTableVino;

    if (elNomTableVino) {
        elNomTableVino.innerHTML = "";

    }

    switch (tableSelectionnee["nomTable"]) {
        case "bouteille":
            requete = "lireFormulaireBouteille";
            break;

        case "cellier":
            requete = "lireFormulaireCellier";
            break;

        case "usager":
            requete = "lireFormulaireUsager";
            break;

        case "vino__appellation":
        case "vino__bouteille":
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
            nomTableVino = elTableVino.value;
            elNomTableVino.innerHTML = "Table: " + nomTableVino;

            body = { "nomTable": tableSelectionnee["nomTable"] };
            requete = "lireFormulaireVino";
            break;
        default:
            elSection3.innerHTML = "";
            break;
    }

    if (requete) {
        lireHtml(requete, body)
            .then(formulaire => {
                elSection3.innerHTML = "";
                elSection3.insertAdjacentHTML("beforeend", formulaire);

                // On ajuste l'entête de la liste pour tenir compte de la barre de défilement
                elTableEntete = document.getElementById("table-entete");
                elTableBody = document.getElementById("table-body");

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

                conserverDonnees();

                rows = elTableBody.getElementsByTagName("tr");

                for (let i = 0, l = rows.length; i < l; i++) {
                    rows[i].addEventListener("click", () => {
                        traiterProchaineAction({ "ligneActive": i });
                    });
                }

                let elBtnsAjouter = document.querySelectorAll("[data-js-btn-ajouter]");
                elBtnAjouter = elBtnsAjouter[0];
                elActionTexte = document.querySelector(".action-texte");

                // Quand on clique sur le bouton pour ajouter un nouvel enregistrement.
                for (let i = 0, l = elBtnsAjouter.length; i < l; i++) {
                    elBtnsAjouter[i].addEventListener("click", () => {
                        traiterProchaineAction({ "actionCourante": "ajouter" });
                    });
                }
            });
    }
}


/**
 * Affiche la 2e section, soit celle qui montre la liste des tables Vino
 */
function afficherSection2() {
    let requete = "lireTableSelection";
    selectionnerCarte(elTablesVino);

    tableSelectionnee["id"] = -1;
    tableSelectionnee["nomTable"] = "";
    tableSelectionnee["ligneActive"] = -1;
    tableSelectionnee["actionCourante"] = "";

    lireHtml(requete)
        .then(formulaire => {
            elSection2.classList.remove("hide");
            elSection2.innerHTML = "";
            elSection3.innerHTML = "";
            elSection4.innerHTML = "";

            elSection2.insertAdjacentHTML("beforeend", formulaire);

            elbtnAfficherVino = document.querySelector(".btn-afficher-vino");

            // Quand on clique sur le bouton pour afficher une table.
            elbtnAfficherVino.addEventListener("click", () => {
                const elTableVino = document.querySelector("#selection-table-vino");
                const nomTableVino = elTableVino.value;

                traiterProchaineAction({ "nomTable": nomTableVino });
            });
        });
}


/**
 * On ajuste certains éléments pour qu'ils soient utilisable dans tous les formats d'écran
 */
function ajusterElementsResponsive() {
    const elSelect = elSection4.querySelectorAll("select");
    const elLiens = elSection4.querySelectorAll(".lien-image-saq");

    for (let i = 0, l = elSelect.length; i < l; i++) {
        elSelect[i].addEventListener("click", () => ajusterHauteurListe(elSelect[i], "click"));
        elSelect[i].addEventListener("change", () => ajusterHauteurListe(elSelect[i], "change"));
        elSelect[i].addEventListener("blur", () => ajusterHauteurListe(elSelect[i], "blur"));
    }

    for (let i = 0, l = elLiens.length; i < l; i++) {
        const contenu = elLiens[i].innerText;
        const lesParties = contenu.split("/");
        const nomFichier = lesParties[lesParties.length - 1];

        elLiens[i].innerText = nomFichier;
    }
}


/**
 * On ajuste la hauteur de l'élément selon l'événement généré.
 * @param el  L'élément à ajuster
 * @param evt L'événement qui génère la demande
 */
function ajusterHauteurListe(el, evt) {
    switch (evt) {
        case "click":
            if (el.options.length > 8) {
                el.size = 8;
            } else {
                el.size = el.options.length;
            }
            break;
        case "change":
        case "blur":
            el.size = 0;
            break;
    }
}


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
        inverse = true;
    } else {
        inverse = false;
        caret.className = `caret ${caretUpClassName}`;
    }

    tableData.sort(trier_par(champ, inverse));
    injecterDonnees();
}


/**
 * Force la section 2 (liste des tables Vino) à disparaître quand on clique une des 4 sections principales.
 */
function cacherSection2() {
    if (!elSection2.classList.contains("hide")) {
        elSection2.classList.add("hide");
    }

}


/**
 * Met fin au processus d'édition lorsqu'on clique sur Annuler et qu'on confirme.
 */
function confirmerAnnulation() {
    gererEdition("fin");
    reinitialiserSection4();
}


/**
 * On conserve les données des tables de la section 3 afin de s'en servir pour le tri.
 */
function conserverDonnees() {
    elTableColonnes = document.querySelectorAll(".table-colonne");
    let lesEntetes = [];

    for (let column of elTableColonnes) {
        let champ = column.id;
        lesEntetes.push(champ);
    }

    tableData = [];
    rows = elTableBody.getElementsByTagName("tr");

    for (let i = 0, l = rows.length; i < l; i++) {
        let cells = rows[i].getElementsByTagName("td");
        let oData = {};

        for (let j = 0, k = cells.length; j < k; j++) {
            oData[lesEntetes[j]] = cells[j].textContent;
        }

        tableData.push(oData);
    }
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
 * Fait disparaître le modal lorsque l'utilisateur a répondu à la question.
 */
function fermerModal() {
    const elModal = document.querySelector(".modal");

    if (elModal.classList.contains('modal--ouvre')) {
        elModal.classList.replace('modal--ouvre', 'modal--ferme');

        document.documentElement.classList.remove('overflow-y--hidden');
        document.body.classList.remove('overflow-y--hidden');
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
        } else {
            row.style.display = "none";
        }

        flag = false;
    }
}


/**
 * Gère la demande d'annulation faite par l'usager.
 */
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


/**
 * Gère la demande d'édition faite par l'usager.
 */
function gererEdition(pos) {
    let action = tableSelectionnee["actionCourante"];
    let elGroupeSAQ = document.querySelector(".groupe-ajouter-saq");

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
        let messageAction = action.charAt(0).toUpperCase() + action.slice(1);

        switch (tableSelectionnee["nomTable"]) {
            case "bouteille":
                messageAction += " une bouteille";
                break;

            case "cellier":
                messageAction += " un cellier";
                break;

            case "usager":
                messageAction += " un usager";
                break;
        }

        elActionTexte.innerHTML = messageAction;

        if (elBtnAjouter && !elBtnAjouter.classList.contains("hide")) {
            elBtnAjouter.classList.add("hide");
        }

        if (elBtnModifier && !elBtnModifier.classList.contains("hide")) {
            elBtnModifier.classList.add("hide");
        }

        //groupe-ajouter-saq
        if (action == "ajouter" && elGroupeSAQ) {
            elGroupeSAQ.classList.remove("hide");
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

        //groupe-ajouter-saq
        if (action == "ajouter" && elGroupeSAQ && !elGroupeSAQ.classList.contains("hide")) {
            elGroupeSAQ.classList.add("hide");
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
    if (!document.body.classList.contains("waiting")) {
        document.body.classList.add("waiting");

    }

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
    document.body.classList.remove("waiting");

    return data;
}


/**
 * Fonction qui lit les données de la BD
 * @param reqNom    Le nom de la requête à appeller
 * @param reqBody   L'information à passer avec la requçete
 * @returns         Le contenu json généré
 */
async function lireJson(reqNom, reqBody = null) {
    if (!document.body.classList.contains("waiting")) {
        document.body.classList.add("waiting");
    }


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
    document.body.classList.remove("waiting");

    return data;
}


/**
 * Fonction qui affiche un modal lorsqu'une question sur l'édition est posée à l'utilisateur
 */
function ouvrirModal() {
    const elModal = document.querySelector(".modal");

    if (elModal.classList.contains('modal--ferme')) {
        elModal.classList.replace('modal--ferme', 'modal--ouvre');

        // Ajoute la propriété overflow-y: hidden; sur les éléments html et body afin d'enlever le scroll en Y lorsque le modal est ouvert
        document.documentElement.classList.add('overflow-y--hidden');
        document.body.classList.add('overflow-y--hidden');
    }

}


/**
 * Fonction qui force la mise à jour des statistiques affichées lorsqu'on ajoute un enregistrement dans une table.
 */
function rafraichirPageInfo() {

    const elSelect = document.querySelector('#selection-table-vino');

    rafraichirSection1();

    if ((elSelect)) {
        rafraichirSection2();
    }

    rafraichirSection3();
}


/**
 * Fonction qui force la mise à jour des statistiques de la section 1 lorsqu'on ajoute un enregistrement dans une table.
 */
function rafraichirSection1() {
    let body = "",
        requete = "obtenirTablesNbEnrg";

    lireJson(requete, body)
        .then(donnees => {
            const elNbBouteilles = document.querySelector(".nb-bouteilles");
            const elNbCelliers = document.querySelector(".nb-celliers");
            const elNbUsagers = document.querySelector(".nb-usagers");

            elNbBouteilles.innerHTML = donnees["nbBouteilles"];
            elNbCelliers.innerHTML = donnees["nbCelliers"];
            elNbUsagers.innerHTML = donnees["nbUsagers"];
        });
}


/**
 * Fonction qui force la mise à jour des statistiques de la section 2 lorsqu'on ajoute un enregistrement dans une table.
 */
function rafraichirSection2() {
    let requete = "obtenirVinoTablesNbEnrg";

    lireJson(requete)
        .then(donnees => {
            const elSelect = document.querySelector('#selection-table-vino');

            for (var nomTable in donnees) {
                if (donnees.hasOwnProperty(nomTable)) {
                    const valeur = donnees[nomTable];
                    const elOption = elSelect.querySelector('option[value="' + nomTable + '"]');

                    switch (nomTable) {
                        case "vino__appellation":
                            elOption.text = "Appellation (" + valeur + ") lignes";
                            break;
                        case "vino__bouteille":
                            elOption.text = "Bouteille (" + valeur + ") lignes";
                            break;
                        case "vino__cepage":
                            elOption.text = "Cepage (" + valeur + ") lignes";
                            break;
                        case "vino__classification":
                            elOption.text = "Classification (" + valeur + ") lignes";
                            break;
                        case "vino__degre_alcool":
                            elOption.text = "Degré d'alcool (" + valeur + ") lignes";
                            break;
                        case "vino__designation":
                            elOption.text = "Désignation (" + valeur + ") lignes";
                            break;
                        case "vino__format":
                            elOption.text = "Format (" + valeur + ") lignes";
                            break;
                        case "generique__pays":
                            elOption.text = "Pays (" + valeur + ") lignes";
                            break;
                        case "vino__produit_du_quebec":
                            elOption.text = "Produit du Québec (" + valeur + ") lignes";
                            break;
                        case "vino__region":
                            elOption.text = "Région (" + valeur + ") lignes";
                            break;
                        case "vino__taux_de_sucre":
                            elOption.text = "Taux de sucre (" + valeur + ") lignes";
                            break;
                        case "vino__type_cellier":
                            elOption.text = "Type de cellier (" + valeur + ") lignes";
                            break;
                        case "vino__type":
                            elOption.text = "Type de vin (" + valeur + ") lignes";
                            break;
                    }
                }
            }
        });
}


/**
 * Fonction qui force la mise à jour des statistiques de la section 3 lorsqu'on ajoute un enregistrement dans une table.
 */
function rafraichirSection3() {
    let body = "",
        requete = "";

    elNomTableVino = document.querySelector("[data-js-selection-nom-table]");
    const elTableVino = document.querySelector("#selection-table-vino");
    let nomTableVino;

    if (elNomTableVino) {
        elNomTableVino.innerHTML = "";

    }

    switch (tableSelectionnee["nomTable"]) {
        case "bouteille":
            requete = "lireFormulaireBouteille";
            break;

        case "cellier":
            requete = "lireFormulaireCellier";
            break;

        case "usager":
            requete = "lireFormulaireUsager";
            break;

        case "vino__appellation":
        case "vino__bouteille":
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
            nomTableVino = elTableVino.value;
            elNomTableVino.innerHTML = "Table: " + nomTableVino;

            body = { "nomTable": tableSelectionnee["nomTable"] };
            requete = "lireFormulaireVino";
            break;
        default:
            elSection3.innerHTML = "";
            break;
    }

    if (requete) {
        lireHtml(requete, body)
            .then(formulaire => {
                elSection3.innerHTML = "";
                elSection3.insertAdjacentHTML("beforeend", formulaire);

                // On ajuste l'entête de la liste pour tenir compte de la barre de défilement
                elTableEntete = document.getElementById("table-entete");
                elTableBody = document.getElementById("table-body");

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

                let elBtnsAjouter = document.querySelectorAll("[data-js-btn-ajouter]");
                elBtnAjouter = elBtnsAjouter[0];
                elActionTexte = document.querySelector(".action-texte");

                // Quand on clique sur le bouton pour ajouter un nouvel enregistrement.
                for (let i = 0, l = elBtnsAjouter.length; i < l; i++) {
                    elBtnsAjouter[i].addEventListener("click", () => {
                        traiterProchaineAction({ "actionCourante": "ajouter" });
                    });
                }

                const lastRow = rows[rows.length - 1];
                lastRow.click();

                rows[rows.length - 1].scrollIntoView(false);
            });
    }
}


/**
 * Fonction qui force la mise à jour des statistiques de la section 4 lorsqu'on ajoute un enregistrement dans une table.
 */
function reinitialiserSection4() {
    if (tableSelectionnee["id"] > 0) {
        afficherDetail({ "mode": "lire", "id": tableSelectionnee["id"] });
        tableSelectionnee["actionCourante"] = "";
    }

    else {
        elSection4.innerHTML = "";
    }
}


/**
 * Sauvegarde les données d'un enregistrement, suite à un ajout ou une modification.
 */
async function sauvegarderDonnees() {

    // Method
    let methode = "POST";

    if (tableSelectionnee["actionCourante"] == "ajouter") {
        methode = "PUT"
    }

    // Headers
    const entete = new Headers();
    entete.append("Content-Type", "application/json");
    entete.append("Accept", "application/json");

    // Body
    const nomTable = tableSelectionnee["nomTable"];
    const action = tableSelectionnee["actionCourante"];

    const lesInputs = document.querySelectorAll("select,input");
    const donnees = {};

    for (let i = 0, l = lesInputs.length; i < l; i++) {
        const element = lesInputs[i];
        donnees[element.name] = element.value;
    }

    donnees["id"] = tableSelectionnee["id"];
    const body = { "nomTable": nomTable, "action": action, "donnees": donnees };

    const reqOptions = {
        method: methode,
        headers: entete,
        body: JSON.stringify(body)
    };

    if (!document.body.classList.contains("waiting")) {
        document.body.classList.add("waiting");
    }

    const requete = new Request($baseUrl_without_parameters + "?requete=sauvegarderAdminDonnees", reqOptions);
    const reponse = await fetch(requete);

    if (!reponse.ok) {
        throw new Error(`Erreur HTTP : statut = ${reponse.status}`);
    }

    const data = await reponse.text();

    rafraichirPageInfo();
    document.body.classList.remove("waiting");
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


/**
 * Ajoute la classe 'selected' à la rangée fournie en paramètre et l'enlève aux autres
 * @param el L'élément qui doit recevoir la classe
 */
function selectionnerLigne(rangee) {
    rows = elTableBody.getElementsByTagName("tr");

    for (let row of rows) {
        row.classList.remove("selected");
    }

    rows[rangee].classList.add("selected");
}


/**
 * Traite la prochaine action à faire basée sur ce que l'utilisateur a demandé.
 * @param prochaineAction Un objet qui identifit la prochaine action à faire
 */
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
                let elUrl = document.querySelector('input[name="url_saq"');
                let body = { "mode": "ajouter" };

                if (elUrl && elUrl.value) {
                    body["url"] = elUrl.value;
                }

                tableSelectionnee["actionCourante"] = "ajouter";
                afficherDetail(body);
                break;

            case "annuler":
                gererAnnulation();
                break;

            case "confirmer":
                // Sauvegarde des données
                sauvegarderDonnees();

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
