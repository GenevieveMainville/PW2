
  let elMain = document.querySelector('main'),
      elPied = document.querySelector('footer')

  let elBtnScan = document.querySelector("[data-js-scan]")

  if(elBtnScan){
  elBtnScan.addEventListener('click', (e)=>{
    //display none l'arriere plan
      elMain.classList.add('contenu-scan-on')
      elPied.classList.add('contenu-scan-on')

      //Si le scan est un succès
     function onScanSuccess(decodedText, decodedResult) {
         
          let requete = new Request(BaseURL + "?requete=scan", { method: 'POST', body: '{"scan_resultat": "' + decodedText + '"}' });
          fetch(requete)
          .then(response => {
              if (response.status === 200) {
                 
                  return response
              } else {
                  throw new Error('Erreur');
              }
          })
          .then(response => {
            //Vibration du téléphone si le navigateur le permet
            window.navigator.vibrate(100)
            
            // Dirige vers la bouteille
              location.href = BaseURL+"?requete=bouteille&vino_id="+decodedText;
        
             
              html5qrcode.stop().then((ignore) => {
                  // arret du scan
                }).catch((err) => {
                  console.log(err)
                });
              
          }).catch(error => {
              console.error(error);
          });
       
      }
      
      let html5qrcode = new Html5Qrcode("reader", {
              // lire code bar via navigateur si supporté ** ça ne lisait pas le upc_a sans ceci mais lisait tout les autres codes
          experimentalFeatures: {
              useBarCodeDetectorIfSupported: true
          }
      });
      
      const scanConfig = { fps: 10, qrbox: 250};
      // choix de camera sur mobile
      html5qrcode.start({ facingMode: "environment" }, scanConfig, onScanSuccess);
     
        
      
  })
}