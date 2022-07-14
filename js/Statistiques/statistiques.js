(() => {

    let elCelliersChoix = document.querySelector('[data-js-lescelliers]'),
        btnsFormat = document.querySelectorAll('[data-js-btnsformat]'),
        elGraphique = document.querySelector('[data-js-graphique]')
// console.log(elGraphique.firstElementChild)
        if (elCelliersChoix) {
            elCelliersChoix.addEventListener('change', (e) => {
                console.log(e.target.value)
                
                
            })
        }    
})();