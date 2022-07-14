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

window.addEventListener('load', function () {

    /*
    *   Caroussel page d'accueil
    *
    */
    
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });


      /*
    *   Tiroirs de la fiche bouteille
    *
    */

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






  
});
