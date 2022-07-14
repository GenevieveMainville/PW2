
/*
* Ce fichier conncerne les inputs auto completes danns la fiche bouteille
* On y ajoute un listener suur chaque input/list pour récupérer la liste qui correspond au lettres saisies dans l'input
* */

window.addEventListener( 'load', function() {

    // onn appelle la fonction qui écoute les listes suivantes
    listentoAutocompleteInput('id_bouteille', 'bouteilles');
    listentoAutocompleteInput('pays_nom', 'pays');
    listentoAutocompleteInput('region_nom', 'regions');
    listentoAutocompleteInput('type_de_vin_nom', 'types');
    listentoAutocompleteInput('format_nom', 'formats');
    listentoAutocompleteInput('appellation_nom', 'appellations');
    listentoAutocompleteInput('cepage_nom', 'cepages');
    listentoAutocompleteInput('designation_nom', 'designations');
    listentoAutocompleteInput('taux_de_sucre_nom', 'taux_de_sucres');
    listentoAutocompleteInput('degre_alcool_nom', 'degre_alcools');
    listentoAutocompleteInput('produit_du_quebec_nom', 'produit_du_quebecs');
    listentoAutocompleteInput('classification_nom', 'classifications');

    //La fonction qui écoute les inputs
    function listentoAutocompleteInput(input, list){


        const elementList = document.getElementById(list);
        // on override comportement par défaut des data-list pour faire notre custom automplete
       
        if(elementList){
            const initialOptions = elementList.children;
            let initialOptionValue = [];
            for ( let i = 0; i < initialOptions.length; i++ ) initialOptionValue.push(initialOptions[i].value);
            let customOptions;
            const inputElement =  document.getElementById(input);
           
            if(inputElement){
                inputElement.addEventListener('input',  event => {
                    
                    const inputValue = inputElement.value;
                    const actualOptions =  [...initialOptions] ;//document.getElementsByTagName("option");
                    if ( inputValue !== '' && inputValue !== 'undefined') {
                        customOptions = '';
                        for ( let i = 0; i < actualOptions.length; i++ ) {
                       
                            if ( actualOptions[i].value.toLowerCase().startsWith(inputValue.toLowerCase())) {
                                customOptions += '<option value="' + actualOptions[i].value + '" />';
                            }
                        }
                        document.getElementById(list).innerHTML = customOptions;
                    } else {
                        customOptions = '';
                        for ( let i = 0; i < initialOptionValue.length; i++ ) {
                            customOptions += '<option value="' + initialOptionValue[i] + '" />';
                        }
                        document.getElementById(list).innerHTML = customOptions;
                    }
                });
            }
        }
    }
});
