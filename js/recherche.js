var $baseUrl_without_parameters = window.location.href.split('?');//[0];
$baseUrl_without_parameters = $baseUrl_without_parameters.length > 0 ? $baseUrl_without_parameters[0] : $baseUrl_without_parameters;

/**
 * Traiter les appellations du vin
 */
function traiterAppellation() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-appellation');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elAppellation.length; i < l; i++) {
        if (elAppellation[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elAppellationTous.checked = (nbSelections === elAppellation.length);
}


/**
 * Traiter les bouteilles
 */
function traiterBouteille() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-bouteille');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elBouteille.length; i < l; i++) {
        if (elBouteille[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elBouteilleTous.checked = (nbSelections === elBouteille.length);
}


/**
 * Traiter les celliers
 */
function traiterCellier() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-cellier');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elCellier.length; i < l; i++) {
        if (elCellier[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elCellierTous.checked = (nbSelections === elCellier.length);
}


/**
 * Traiter les cépages de vin
 */
function traiterCepage() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-cepage');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elCepage.length; i < l; i++) {
        if (elCepage[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elCepageTous.checked = (nbSelections === elCepage.length);
}


/**
 * Traiter les classifications de vin
 */
function traiterClassification() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-classification');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elClassification.length; i < l; i++) {
        if (elClassification[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elClassificationTous.checked = (nbSelections === elClassification.length);
}


/**
 * Traiter les degrés d'alcool
 */
function traiterDegreAlcool() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-degre-alcool');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elDegreAlcool.length; i < l; i++) {
        if (elDegreAlcool[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elDegreAlcoolTous.checked = (nbSelections === elDegreAlcool.length);
}


/**
 * Traiter les désignations de vin
 */
function traiterDesignation() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-designation');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elDesignation.length; i < l; i++) {
        if (elDesignation[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elDesignationTous.checked = (nbSelections === elDesignation.length);
}


/**
 * Traiter les formats de bouteille
 */
function traiterFormat() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-format');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elFormat.length; i < l; i++) {
        if (elFormat[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elFormatTous.checked = (nbSelections === elFormat.length);
}


/**
 * Traiter les dates de garde
 */
function traiterGardeJusqua() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-garde-jusqua');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elGardeJusqua.length; i < l; i++) {
        if (elGardeJusqua[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elGardeJusquaTous.checked = (nbSelections === elGardeJusqua.length);
}


/**
 * Traiter les listes
 */
function traiterListes() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-listes');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elListe.length; i < l; i++) {
        if (elListe[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elListeToutes.checked = (nbSelections === elListe.length);
}


/**
 * Traiter les notes
 */
function traiterNote() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-note');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elNote.length; i < l; i++) {
        if (elNote[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elNoteTous.checked = (nbSelections === elNote.length);
}


/**
 * Traiter les millésimes
 */
function traiterMillesime() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-millesime');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elMillesime.length; i < l; i++) {
        if (elMillesime[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elMillesimeTous.checked = (nbSelections === elMillesime.length);
}


/**
 * Traiter les pays
 */
function traiterPays() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-pays');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elPays.length; i < l; i++) {
        if (elPays[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elPaysTous.checked = (nbSelections === elPays.length);
}


/**
 * Traiter les prix
 */
function traiterPrix() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-prix');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elPrix.length; i < l; i++) {
        if (elPrix[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elPrixTous.checked = (nbSelections === elPrix.length);
}


/**
 * Traiter le produit du Québec
 */
function traiterProduitsQc() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-produit-qc');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elProduitsQc.length; i < l; i++) {
        if (elProduitsQc[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elProduitsQcTous.checked = (nbSelections === elProduitsQc.length);
}


/**
 * Traiter les régions
 */
function traiterRegion() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-region');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elRegion.length; i < l; i++) {
        if (elRegion[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elRegionTous.checked = (nbSelections === elRegion.length);
}


/**
 * Traiter les taux de sucre
 */
function traiterTauxDeSucre() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-taux-de-sucre');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elTauxDeSucre.length; i < l; i++) {
        if (elTauxDeSucre[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elTauxDeSucreTous.checked = (nbSelections === elTauxDeSucre.length);
}


/**
 * Traiter le type de cellier
 */
function traiterTypeCellier() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-type-cellier');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elTypeCelliers.length; i < l; i++) {
        if (elTypeCelliers[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elTypeCellierTous.checked = (nbSelections === elTypeCelliers.length);
}


/**
 * Traiter le type de vin
 */
function traiterTypeVin() {
    let nbSelections = 0;
    const elNbSelections = document.querySelector('.nb-type-de-vin');
    const elInnerSelection = elNbSelections.querySelector('.nb-selections');

    for (let i = 0, l = elTypeVins.length; i < l; i++) {
        if (elTypeVins[i].checked) nbSelections++;
    }

    if (nbSelections === 0) {
        if (!elInnerSelection.classList.contains("hide")) {
            elInnerSelection.classList.add("hide");
        }
    } else {
        elInnerSelection.innerHTML = nbSelections;
        elInnerSelection.classList.remove("hide");
    }

    elTypeVinTous.checked = (nbSelections === elTypeVins.length);
}

/*************************************************
 * Lancer le traitement des listes de checkboxes *
 *************************************************/

/**
 * Traiter la liste de checkboxes des appellations
 */
let elAppellation = document.querySelectorAll('[data-js-appellation]');
let elAppellationTous = document.querySelector('[data-js-appellation-tous]');

if (elAppellation.length > 0) {
    elAppellation.forEach(uneAppellation => {
        uneAppellation.addEventListener('change', traiterAppellation);
    });

    elAppellationTous.addEventListener('change', () => {
        elAppellation.forEach(uneAppellation => {
            uneAppellation.checked = elAppellationTous.checked;
        });

        traiterAppellation();
    });
}

/**
 * Traiter la liste de checkboxes des bouteilles
 */
let elBouteille = document.querySelectorAll('[data-js-bouteille]');
let elBouteilleTous = document.querySelector('[data-js-bouteille-tous]');

if (elBouteille.length > 0) {
    elBouteille.forEach(uneBouteille => {
        uneBouteille.addEventListener('change', traiterBouteille);
    });

    elBouteilleTous.addEventListener('change', () => {
        elBouteille.forEach(uneBouteille => {
            uneBouteille.checked = elBouteilleTous.checked;
        });

        traiterBouteille();
    });
}


/**
 * Traiter la liste de checkboxes des celliers
 */
let elCellier = document.querySelectorAll('[data-js-cellier]');
let elCellierTous = document.querySelector('[data-js-cellier-tous]');

if (elCellier.length > 0) {
    elCellier.forEach(unCellier => {
        unCellier.addEventListener('change', traiterCellier);
    });

    elCellierTous.addEventListener('change', () => {
        elCellier.forEach(unCellier => {
            unCellier.checked = elCellierTous.checked;
        });

        traiterCellier();
    });
}


/**
 * Traiter la liste de checkboxes des cepages
 */
let elCepage = document.querySelectorAll('[data-js-cepage]');
let elCepageTous = document.querySelector('[data-js-cepage-tous]');

if (elCepage.length > 0) {
    elCepage.forEach(unCepage => {
        unCepage.addEventListener('change', traiterCepage);
    });

    elCepageTous.addEventListener('change', () => {
        elCepage.forEach(unCepage => {
            unCepage.checked = elCepageTous.checked;
        });

        traiterCepage();
    });
}


/**
 * Traiter la liste de checkboxes des classifications
 */
let elClassification = document.querySelectorAll('[data-js-classification]');
let elClassificationTous = document.querySelector('[data-js-classification-tous]');

if (elClassification.length > 0) {
    elClassification.forEach(uneClassification => {
        uneClassification.addEventListener('change', traiterClassification);
    });

    elClassificationTous.addEventListener('change', () => {
        elClassification.forEach(uneClassification => {
            uneClassification.checked = elClassificationTous.checked;
        });

        traiterClassification();
    });
}


/**
 * Traiter la liste de checkboxes des degrés d'alcool
 */
let elDegreAlcool = document.querySelectorAll('[data-js-degre-alcool]');
let elDegreAlcoolTous = document.querySelector('[data-js-degre-alcool-tous]');

if (elDegreAlcool.length > 0) {
    elDegreAlcool.forEach(unDegreAlcool => {
        unDegreAlcool.addEventListener('change', traiterDegreAlcool);
    });

    elDegreAlcoolTous.addEventListener('change', () => {
        elDegreAlcool.forEach(unDegreAlcool => {
            unDegreAlcool.checked = elDegreAlcoolTous.checked;
        });

        traiterDegreAlcool();
    });
}


/**
 * Traiter la liste de checkboxes des désignations
 */
let elDesignation = document.querySelectorAll('[data-js-designation]');
let elDesignationTous = document.querySelector('[data-js-designation-tous]');

if (elDesignation.length > 0) {
    elDesignation.forEach(uneDesignation => {
        uneDesignation.addEventListener('change', traiterDesignation);
    });

    elDesignationTous.addEventListener('change', () => {
        elDesignation.forEach(uneDesignation => {
            uneDesignation.checked = elDesignationTous.checked;
        });

        traiterDesignation();
    });
}


/**
 * Traiter la liste de checkboxes des formats
 */
let elFormat = document.querySelectorAll('[data-js-format]');
let elFormatTous = document.querySelector('[data-js-format-tous]');

if (elFormat.length > 0) {
    elFormat.forEach(uneFormat => {
        uneFormat.addEventListener('change', traiterFormat);
    });

    elFormatTous.addEventListener('change', () => {
        elFormat.forEach(uneFormat => {
            uneFormat.checked = elFormatTous.checked;
        });

        traiterFormat();
    });
}


/**
 * Traiter la liste de checkboxes des dates de garde
 */
let elGardeJusqua = document.querySelectorAll('[data-js-garde-jusqua]');
let elGardeJusquaTous = document.querySelector('[data-js-garde-jusqua-tous]');

if (elGardeJusqua.length > 0) {
    elGardeJusqua.forEach(uneGarde => {
        uneGarde.addEventListener('change', traiterGardeJusqua);
    });

    elGardeJusquaTous.addEventListener('change', () => {
        elGardeJusqua.forEach(uneGarde => {
            uneGarde.checked = elGardeJusquaTous.checked;
        });

        traiterGardeJusqua();
    });
}


/**
 * Traiter la liste de checkboxes des listes
 */
let elListe = document.querySelectorAll('[data-js-liste]');
let elListeToutes = document.querySelector('[data-js-listes-toutes]');

if (elListe.length > 0) {
    elListe.forEach(uneListe => {
        uneListe.addEventListener('change', traiterListes);
    });

    elListeToutes.addEventListener('change', () => {
        elListe.forEach(uneListe => {
            uneListe.checked = elListeToutes.checked;
        });

        traiterListes();
    });
}


/**
 * Traiter la liste de checkboxes des notes
 */
let elNote = document.querySelectorAll('[data-js-note]');
let elNoteTous = document.querySelector('[data-js-note-tous]');

if (elNote.length > 0) {
    elNote.forEach(uneGarde => {
        uneGarde.addEventListener('change', traiterNote);
    });

    elNoteTous.addEventListener('change', () => {
        elNote.forEach(uneGarde => {
            uneGarde.checked = elNoteTous.checked;
        });

        traiterNote();
    });
}


/**
 * Traiter la liste de checkboxes des millésimes
 */
let elMillesime = document.querySelectorAll('[data-js-millesime]');
let elMillesimeTous = document.querySelector('[data-js-millesime-tous]');

if (elMillesime.length > 0) {
    elMillesime.forEach(uneGarde => {
        uneGarde.addEventListener('change', traiterMillesime);
    });

    elMillesimeTous.addEventListener('change', () => {
        elMillesime.forEach(uneGarde => {
            uneGarde.checked = elMillesimeTous.checked;
        });

        traiterMillesime();
    });
}


/**
 * Traiter la liste de checkboxes des pays
 */
let elPays = document.querySelectorAll('[data-js-pays]');
let elPaysTous = document.querySelector('[data-js-pays-tous]');

if (elPays.length > 0) {
    elPays.forEach(unPays => {
        unPays.addEventListener('change', traiterPays);
    });

    elPaysTous.addEventListener('change', () => {
        elPays.forEach(unPays => {
            unPays.checked = elPaysTous.checked;
        });

        traiterPays();
    });
}


/**
 * Traiter la liste de checkboxes des prix
 */
let elPrix = document.querySelectorAll('[data-js-prix]');
let elPrixTous = document.querySelector('[data-js-prix-tous]');

if (elPrix.length > 0) {
    elPrix.forEach(unPrix => {
        unPrix.addEventListener('change', traiterPrix);
    });

    elPrixTous.addEventListener('change', () => {
        elPrix.forEach(unPrix => {
            unPrix.checked = elPrixTous.checked;
        });

        traiterPrix();
    });
}


/**
 * Traiter la liste de checkboxes des produits du Québec
 */
let elProduitsQc = document.querySelectorAll('[data-js-produit-qc]');
let elProduitsQcTous = document.querySelector('[data-js-produit-qc-tous]');

if (elProduitsQc.length > 0) {
    elProduitsQc.forEach(produitsQc => {
        produitsQc.addEventListener('change', traiterProduitsQc);
    });

    elProduitsQcTous.addEventListener('change', () => {
        elProduitsQc.forEach(produitQc => {
            produitQc.checked = elProduitsQcTous.checked;
        });

        traiterProduitsQc();
    });
}


/**
 * Traiter la liste de checkboxes des regions
 */
let elRegion = document.querySelectorAll('[data-js-region]');
let elRegionTous = document.querySelector('[data-js-region-tous]');

if (elRegion.length > 0) {
    elRegion.forEach(uneRegion => {
        uneRegion.addEventListener('change', traiterRegion);
    });

    elRegionTous.addEventListener('change', () => {
        elRegion.forEach(uneRegion => {
            uneRegion.checked = elRegionTous.checked;
        });

        traiterRegion();
    });
}


/**
 * Traiter la liste de checkboxes des taux de sucre
 */
let elTauxDeSucre = document.querySelectorAll('[data-js-taux-de-sucre]');
let elTauxDeSucreTous = document.querySelector('[data-js-taux-de-sucre-tous]');

if (elTauxDeSucre.length > 0) {
    elTauxDeSucre.forEach(unTauxDeSucre => {
        unTauxDeSucre.addEventListener('change', traiterTauxDeSucre);
    });

    elTauxDeSucreTous.addEventListener('change', () => {
        elTauxDeSucre.forEach(unTauxDeSucre => {
            unTauxDeSucre.checked = elTauxDeSucreTous.checked;
        });

        traiterTauxDeSucre();
    });
}

/**
 * Traiter la liste de checkboxes des types de cellier
 */
let elTypeCelliers = document.querySelectorAll('[data-js-type-cellier]');
let elTypeCellierTous = document.querySelector('[data-js-type-cellier-tous]');

if (elTypeCelliers.length > 0) {
    elTypeCelliers.forEach(typeCellier => {
        typeCellier.addEventListener('change', traiterTypeCellier);
    });

    elTypeCellierTous.addEventListener('change', () => {
        elTypeCelliers.forEach(typeCellier => {
            typeCellier.checked = elTypeCellierTous.checked;
        });

        traiterTypeCellier();
    });
}


/**
 * Traiter la liste de checkboxes des types de vin
 */
let elTypeVins = document.querySelectorAll('[data-js-type-de-vin]');
let elTypeVinTous = document.querySelector('[data-js-type-de-vin-tous]');

if (elTypeVins.length > 0) {
    elTypeVins.forEach(typeVin => {
        typeVin.addEventListener('change', traiterTypeVin);
    });

    elTypeVinTous.addEventListener('change', () => {
        elTypeVins.forEach(typeVin => {
            typeVin.checked = elTypeVinTous.checked;
        });

        traiterTypeVin();
    });
}


/******************************************************************
 * Gestion (ouvrir/fermer) des sections de recherche en accordéon *
 ******************************************************************/
let acc = document.querySelectorAll(".accordeon");

for (let i = 0, l = acc.length; i < l; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        const panel = this.nextElementSibling;

        if (panel.style.height) {
            panel.style.height = null;
        } else {
            panel.style.height = panel.scrollHeight + "px";
        }
    });
}


/************************************
 * Lancer le traitement des sliders *
 ************************************/
let elInputQteMin = document.querySelector('[data-js-qte-val-min]'),
    elValeursQteMin = document.querySelectorAll('input[name="qte_min"]'),
    elInputQteMax = document.querySelector('[data-js-qte-val-max]'),
    elValeursQteMax = document.querySelectorAll('input[name="qte_max"]'),
    elQteIcone = document.querySelector('[data-js-quantite-icone]');

function ajusterSlider(elInput, elValeurs) {
    elValeurs.forEach(elValeur => {
        if (elInput.value === elValeur.value) {
            elValeur.checked = true;
        }
    });
}


function traiterSlider(elInput, elValeurs) {
    elValeurs.forEach(elValeur => {
        elValeur.addEventListener('change', (e) => {
            elInput.value = e.target.value;
            validerQuantites(elInput, elInputQteMin, elInputQteMax);
        });
    });
}


traiterSlider(elInputQteMin, elValeursQteMin);
traiterSlider(elInputQteMax, elValeursQteMax);


function validerQuantites(el, elMin, elMax) {
    let valMin = elMin.value.trim();
    let valMax = elMax.value.trim();

    elMin.classList.remove("slider-erreur");
    elMax.classList.remove("slider-erreur");

    elQteIcone.classList.remove("erreur");

    if (valMin && valMax && parseInt(valMin) > parseInt(valMax)) {
        el.classList.add("slider-erreur");
        elQteIcone.classList.add("erreur");
    }

    if (!elQteIcone.classList.contains("hide")) {
        elQteIcone.classList.add("hide");
    }

    if (valMin || valMax) {
        elQteIcone.classList.remove("hide");
    }
}


/**
 * Force certains inputs à n'accepter que des entiers positifs
 * Provient de: https://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
 */
let elSliderInputs = document.querySelectorAll('[data-js-slider-input="entier"]');


elSliderInputs.forEach(unSlider => {
    setInputFilter(unSlider, function (value) {
        return /^\d*$/.test(value);
    }, "Doit être un entier >= 0");
});


function setInputFilter(textbox, inputFilter, errMsg) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function (event) {
        textbox.addEventListener(event, function (e) {
            if (inputFilter(this.value)) {
                // Accepted value
                if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                    this.classList.remove("slider-erreur");
                    this.setCustomValidity("");
                }
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;

                if (this.name === "qte_val_min" || this.name === "qte_val_max") {
                    validerQuantites(this, elInputQteMin, elInputQteMax);

                    if (this.name === "qte_val_min") {
                        ajusterSlider(elInputQteMin, elValeursQteMin);
                    }

                    if (this.name === "qte_val_max") {
                        ajusterSlider(elInputQteMax, elValeursQteMax);
                    }

                }
            } else if (this.hasOwnProperty("oldValue")) {
                // Rejected value - restore the previous one
                this.classList.add("slider-erreur");
                this.setCustomValidity(errMsg);
                this.reportValidity();
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                // Rejected value - nothing to restore
                this.value = "";
            }
        });
    });
}


/*********************************
 *  Réinitialisation des données *
 *********************************/
const elBtnReinit = document.querySelector('[data-js-reinit]');

elBtnReinit.addEventListener("click", (e) => {
    e.preventDefault();
    initDonnees();
});


function initDonnees() {
    let elRechercheWrapper = document.querySelector('.recherche-wrapper'),
        elCheckboxes = elRechercheWrapper.querySelectorAll('input[type="checkbox"]'),
        elBtnsRadio = elRechercheWrapper.querySelectorAll('input[type="radio"]'),
        elChoixGroupe = elRechercheWrapper.querySelectorAll('.choix-groupe'),
        elChoixContainer = elRechercheWrapper.querySelectorAll('.choix-container'),
        elQteIcone = document.querySelector('[data-js-quantite-icone]'),
        elInputQteMin = document.querySelector('[data-js-qte-val-min]'),
        elInputQteMax = document.querySelector('[data-js-qte-val-max]');


    // les checkbox
    elCheckboxes.forEach(unCheckbox => {
        if (unCheckbox.checked) unCheckbox.click();

    });

    // les boutons radio
    elBtnsRadio.forEach(unBtnRadion => {
        unBtnRadion.checked = false;
    });

    // les listes
    elChoixGroupe.forEach(unGroupe => {
        unGroupe.innerHTML = "";

    });

    elChoixContainer.forEach(unContainer => {
        if (!unContainer.classList.contains('hide')) {
            unContainer.classList.add('hide');
        }
    });

    // Les icones et erreurs pour la quantité
    elQteIcone.classList.remove("erreur");
    elInputQteMin.classList.remove("slider-erreur");
    elInputQteMax.classList.remove("slider-erreur");

    if (!elQteIcone.classList.contains("hide")) {
        elQteIcone.classList.add("hide");
    }

    //
    let elNbSelections = elRechercheWrapper.querySelectorAll('.nb-selections');

    elNbSelections.forEach(uneSelection => {
        uneSelection.innerHTML = "";

        if (!uneSelection.classList.contains('hide')) {
            uneSelection.classList.add('hide');
        }
    });

    //
    let elSliderInputs = document.querySelectorAll('[data-js-slider-input]');

    elSliderInputs.forEach(unSlider => {
        unSlider.value = "";
    });


    // Fermer les accordéons
    let elAccordeons = elRechercheWrapper.querySelectorAll('.accordeon');

    elAccordeons.forEach(unAccordeon => {
        const panel = unAccordeon.nextElementSibling;

        if (panel.style.height) {
            unAccordeon.click();
        }
    });
}


const elBtnRechercher = document.querySelector('[data-js-rechercher]');
elBtnRechercher.addEventListener("click", rechercher);

const elBtnReInit = document.querySelector('[data-js-reinit]');
elBtnReInit.addEventListener("click", rechercher);

const elBtnTrier = document.querySelector('[data-js-trier]');
elBtnTrier.addEventListener("click", rechercher);


function rechercher() {
    // On identifie l'ordre de tri des bouteilles lors de l'affichage.
    const selectTri = document.querySelector('.tri-select-options').value;
    const optionTri = document.querySelector('option[value="' + selectTri + '"]');

    const champTri = optionTri.dataset.jsChamp;
    const champOrdre = optionTri.dataset.jsOrdre;
    const aTri = { 'champ': champTri, 'ordre': champOrdre };

    // On passe à travers chacun des filtres pour récupérer les valeurs à traiter.
    let aDonnees = {},
        listeSelection = "";

    // Les listes
    let elListe = document.querySelectorAll('[data-js-liste]'),
        aListes = [];

    elListe.forEach(uneListe => {
        if (uneListe.checked) {
            aListes.push(uneListe.dataset.jsListe);
        }
    });

    listeSelection = aListes.toString();

    if (listeSelection) {
        aDonnees['les_listes'] = listeSelection;
    }

    // Cellier
    let elCellier = document.querySelectorAll('[data-js-cellier]'),
        aCelliers = [];

    elCellier.forEach(unCellier => {
        if (unCellier.checked) {
            aCelliers.push(unCellier.dataset.jsCellier);
        }
    });

    listeSelection = aCelliers.toString();

    if (listeSelection) {
        aDonnees['id_cellier'] = listeSelection;
    }

    // Type de cellier
    let elTypeCellier = document.querySelectorAll('[data-js-type-cellier]'),
        aTypeCelliers = [];

    elTypeCellier.forEach(unTypeCellier => {
        if (unTypeCellier.checked) {
            aTypeCelliers.push("'" + unTypeCellier.dataset.jsTypeCellier + "'");
        }
    });

    listeSelection = aTypeCelliers.toString();

    if (listeSelection) {
        aDonnees['type_cellier'] = listeSelection;
    }

    // Bouteille
    let elBouteille = document.querySelectorAll('[data-js-bouteille]'),
        aBouteilles = [];

    elBouteille.forEach(uneBouteille => {
        if (uneBouteille.checked) {
            aBouteilles.push("'" + uneBouteille.dataset.jsBouteille + "'");
        }
    });

    listeSelection = aBouteilles.toString();

    if (listeSelection) {
        aDonnees['bouteille'] = listeSelection;
    }

    // Type de vin
    let elTypeVin = document.querySelectorAll('[data-js-type-de-vin]'),
        aTypeVins = [];

    elTypeVin.forEach(unTypeDeVin => {
        if (unTypeDeVin.checked) {
            aTypeVins.push("'" + unTypeDeVin.dataset.jsTypeDeVin + "'");
        }
    });

    listeSelection = aTypeVins.toString();

    if (listeSelection) {
        aDonnees['type_de_vin_nom'] = listeSelection;
    }

    // Pays
    let elPays = document.querySelectorAll('[data-js-pays]'),
        aPays = [];

    elPays.forEach(unPays => {
        if (unPays.checked) {
            aPays.push("'" + unPays.dataset.jsPays + "'");
        }
    });

    listeSelection = aPays.toString();

    if (listeSelection) {
        aDonnees['pays_nom'] = listeSelection;
    }

    // Région
    let elRegion = document.querySelectorAll('[data-js-region]'),
        aRegions = [];

    elRegion.forEach(uneRegion => {
        if (uneRegion.checked) {
            aRegions.push("'" + uneRegion.dataset.jsRegion + "'");
        }
    });

    listeSelection = aRegions.toString();

    if (listeSelection) {
        aDonnees['region_nom'] = listeSelection;
    }

    // Prix
    let elPrix = document.querySelectorAll('[data-js-prix]'),
        aPrix = [];

    elPrix.forEach(unPrix => {
        if (unPrix.checked) {
            aPrix.push("'" + unPrix.dataset.jsPrix + "'");
        }
    });

    listeSelection = aPrix.toString();

    if (listeSelection) {
        aDonnees['prix_bouteille'] = listeSelection;
    }

    // Format de la bouteille
    let elFormat = document.querySelectorAll('[data-js-format]'),
        aFormats = [];

    elFormat.forEach(unFormat => {
        if (unFormat.checked) {
            aFormats.push("'" + unFormat.dataset.jsFormat + "'");
        }
    });

    listeSelection = aFormats.toString();

    if (listeSelection) {
        aDonnees['format_nom'] = listeSelection;
    }

    // Quantité
    let elQteValMin = document.querySelector('[data-js-qte-val-min]'),
        elQteValMax = document.querySelector('[data-js-qte-val-max]')
    aQuantite = [];

    if (elQteValMin) {
        if (elQteValMin.value) {
            aQuantite.push(elQteValMin.value);
        } else {
            aQuantite.push("min");
        }
    }

    if (elQteValMax) {
        if (elQteValMax.value) {
            aQuantite.push(elQteValMax.value);
        } else {
            aQuantite.push("max");
        }
    }

    listeSelection = aQuantite.toString();

    if (listeSelection) {
        aDonnees['quantite_bouteille'] = listeSelection;
    }

    // Millésime
    let elMillesime = document.querySelectorAll('[data-js-millesime]'),
        aMillesime = [];

    elMillesime.forEach(unMillesime => {
        if (unMillesime.checked) {
            aMillesime.push("'" + unMillesime.dataset.jsMillesime + "'");
        }
    });

    listeSelection = aMillesime.toString();

    if (listeSelection) {
        aDonnees['millesime'] = listeSelection;
    }

    // Note
    let elNote = document.querySelectorAll('[data-js-note]'),
        aNote = [];

    elNote.forEach(uneNote => {
        if (uneNote.checked) {
            aNote.push("'" + uneNote.dataset.jsNote + "'");
        }
    });

    listeSelection = aNote.toString();

    if (listeSelection) {
        aDonnees['note'] = listeSelection;
    }

    // Garde jusqu'à
    let elGardeJusqua = document.querySelectorAll('[data-js-garde-jusqua]'),
        aGardeJusqua = [];

    elGardeJusqua.forEach(uneGardeJusqua => {
        if (uneGardeJusqua.checked) {
            aGardeJusqua.push("'" + uneGardeJusqua.dataset.jsGardeJusqua + "'");
        }
    });

    listeSelection = aGardeJusqua.toString();

    if (listeSelection) {
        aDonnees['garde_jusqua'] = listeSelection;
    }

    // Produit du Québec
    let elProduitQc = document.querySelectorAll('[data-js-produit-qc]'),
        aProduitQc = [];

    elProduitQc.forEach(unProduitDuQc => {
        if (unProduitDuQc.checked) {
            aProduitQc.push("'" + unProduitDuQc.dataset.jsProduitQc + "'");
        }
    });

    listeSelection = aProduitQc.toString();

    if (listeSelection) {
        aDonnees['produit_du_quebec_nom'] = listeSelection;
    }

    // Appellation
    let elAppellation = document.querySelectorAll('[data-js-appellation]'),
        aAppellation = [];

    elAppellation.forEach(uneAppellation => {
        if (uneAppellation.checked) {
            aAppellation.push("'" + uneAppellation.dataset.jsAppellation + "'");
        }
    });

    listeSelection = aAppellation.toString();

    if (listeSelection) {
        aDonnees['appellation_nom'] = listeSelection;
    }

    // Cépage
    let elCepage = document.querySelectorAll('[data-js-cepage]'),
        aCepage = [];

    elCepage.forEach(unCepage => {
        if (unCepage.checked) {
            aCepage.push("'" + unCepage.dataset.jsCepage + "'");
        }
    });

    listeSelection = aCepage.toString();

    if (listeSelection) {
        aDonnees['cepage_nom'] = listeSelection;
    }

    // Classification
    let elClassification = document.querySelectorAll('[data-js-classification]'),
        aClassification = [];

    elClassification.forEach(uneClassification => {
        if (uneClassification.checked) {
            aClassification.push("'" + uneClassification.dataset.jsClassification + "'");
        }
    });

    listeSelection = aClassification.toString();

    if (listeSelection) {
        aDonnees['classification_nom'] = listeSelection;
    }

    // Désignation
    let elDesignation = document.querySelectorAll('[data-js-designation]'),
        aDesignation = [];

    elDesignation.forEach(uneDesignation => {
        if (uneDesignation.checked) {
            aDesignation.push("'" + uneDesignation.dataset.jsDesignation + "'");
        }
    });

    listeSelection = aDesignation.toString();

    if (listeSelection) {
        aDonnees['designation_nom'] = listeSelection;
    }

    // Taux de sucre
    let elTauxDeSucre = document.querySelectorAll('[data-js-taux-de-sucre]'),
        aTauxDeSucre = [];

    elTauxDeSucre.forEach(unTauxDeSucre => {
        if (unTauxDeSucre.checked) {
            aTauxDeSucre.push("'" + unTauxDeSucre.dataset.jsTauxDeSucre + "'");
        }
    });

    listeSelection = aTauxDeSucre.toString();

    if (listeSelection) {
        aDonnees['taux_de_sucre_nom'] = listeSelection;
    }

    // Degré d'alcool
    let elDegreAlcool = document.querySelectorAll('[data-js-degre-alcool]'),
        aDegreAlcool = [];

    elDegreAlcool.forEach(unDegreAlcool => {
        if (unDegreAlcool.checked) {
            aDegreAlcool.push("'" + unDegreAlcool.dataset.jsDegreAlcool + "'");
        }
    });

    listeSelection = aDegreAlcool.toString();

    if (listeSelection) {
        aDonnees['degre_alcool_nom'] = listeSelection;
    }

    /**
     * Récupération et affichage des données
     */
    const entete = new Headers();
    entete.append("Content-Type", "application/json");
    entete.append("Accept", "application/json");

    const reqOptions = {
        method: "POST",
        headers: entete,
        body: JSON.stringify({ 'tri': aTri, 'filtres': aDonnees })
    };
    const requete = new Request($baseUrl_without_parameters + "?requete=rechercherBouteilles", reqOptions);

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
                const bouteilles = donnees['liste'];
                const nbBouteilles = bouteilles.length;

                let qteWrapper = document.querySelector('[ data-js-qte-wrapper]');

                if (nbBouteilles) {
                    qteWrapper.innerHTML = `
                        <span>Résultat: </span>
                        <span data-js-qte-deb>1</span>
                        <span>-</span>
                        <span data-js-qte-fin>${nbBouteilles}</span>
                        <span>sur</span>
                        <span data-js-qte-max>${nbBouteilles}</span>`;
                } else {
                    qteWrapper.innerHTML = `<span>Résultat: </span><span>Aucune bouteille trouvée</span>`;
                }

                const elCarteContenant = document.querySelector('[data-js-carte-contenant]');
                elCarteContenant.innerHTML = "";

                if (nbBouteilles) {
                    bouteilles.forEach(bouteille => {
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
                } else {
                    elCarteContenant.innerHTML = `
                        <div class="aucune-bouteille-wrapper">
                            <p class="aucune-bouteille">Aucune bouteille trouvée</p>
                        </div>`;
                }

            }

        }).catch(erreur => {
            console.error(erreur);
        });
}

/**
 * Ouverture/fermeture de la boîte de filtres de recherche
 */
const elOuvrirFiltres = document.querySelector('[data-js-ouvrir-filtres]');
const elFermerFiltres = document.querySelector('[data-js-fermer-filtres]');
const elMenuRecherche = document.querySelector('[data-js-menu-recherche]');
const elCarteContenant = document.querySelector('[data-js-carte-contenant]');

elOuvrirFiltres.addEventListener("click", () => {
    elFermerFiltres.classList.remove("ferme");

    if (!elMenuRecherche.classList.contains("ouvert")) {
        elMenuRecherche.classList.add("ouvert");
    }

    if (!elOuvrirFiltres.classList.contains("ferme")) {
        elOuvrirFiltres.classList.add("ferme");
    }

    if (!elCarteContenant.classList.contains("ferme")) {
        elCarteContenant.classList.add("ferme");
    }
});

elFermerFiltres.addEventListener("click", () => {
    elMenuRecherche.classList.remove("ouvert");
    elOuvrirFiltres.classList.remove("ferme");
    elCarteContenant.classList.remove("ferme");

    if (!elFermerFiltres.classList.contains("ferme")) {
        elFermerFiltres.classList.add("ferme");
    }
});


/**
 * La page peut être appellée avec l'id d'un cellier, on le sélectionne si c'est le cas.
 * On montre aussi dans les filtres qu'un cellier a été sélectionné.
 */
const elIdAppellant = document.querySelector('[data-js-id-appellant]');
const valIdAppellant = elIdAppellant.dataset.jsIdAppellant;
const elAccCellier = document.querySelector('[data-js-accordeon-cellier]');

if (valIdAppellant > 0) {
    const elPagePrecedente = document.querySelector('[data-js-page-precedente]');
    const elParent = elPagePrecedente.closest('.page-precedente-container');

    elParent.classList.remove("ferme");

    elPagePrecedente.addEventListener('click', () => {
        window.location.replace(document.referrer);
    });

    if (elCellier.length > 0) {
        elCellier.forEach(unCellier => {
            let idCellier = unCellier.dataset.jsCellier;

            if (idCellier === valIdAppellant) {
                unCellier.checked = true;
                traiterCellier();
                elOuvrirFiltres.click();
                elAccCellier.click();
            }
        });
    }
}


/**
 * La page peut être appellée avec des listes à afficher, on les sélectionne si c'est le cas.
 * On montre aussi dans les filtres que les listes ont été sélectionnées.
 */
const elFavoriListe = document.querySelector('[data-js-liste="favori"]');
const elFavori = document.querySelector('[data-js-favori]');
const valFavori = elFavori.dataset.jsFavori;

const elEssayerListe = document.querySelector('[data-js-liste="essayer"]');
const elEssayer = document.querySelector('[data-js-essayer]');
const valEssayer = elEssayer.dataset.jsEssayer;

const elAchatListe = document.querySelector('[data-js-liste="achat"]');
const elAchat = document.querySelector('[data-js-achat]');
const valAchat = elAchat.dataset.jsAchat;

const elAccListes = document.querySelector('[data-js-accordeon-listes]');

if (valFavori > 0 || valEssayer > 0 || valAchat > 0) {
    const elPagePrecedente = document.querySelector('[data-js-page-precedente]');
    const elParent = elPagePrecedente.closest('.page-precedente-container');

    elParent.classList.remove("ferme");

    elPagePrecedente.addEventListener('click', () => {
        window.location.replace(document.referrer);
    });

    if (valFavori > 0) {
        elFavoriListe.checked = true;
    }

    if (valEssayer > 0) {
        elEssayerListe.checked = true;
    }

    if (valAchat > 0) {
        elAchatListe.checked = true;
    }

    traiterListes();
    elOuvrirFiltres.click();
    elAccListes.click();
}
