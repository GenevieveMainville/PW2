
      let elMain = document.querySelector('main'),
      elPied = document.querySelector('footer')

  let elBtnScan = document.querySelector("[data-js-scan]")
  if(elBtnScan){
  elBtnScan.addEventListener('click', (e)=>{
      elMain.classList.add('contenu-scan-on')
      elPied.classList.add('contenu-scan-on')
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
              location.href = BaseURL+"?requete=bouteille&vino_id="+decodedText;
        
             
              html5qrcode.stop().then((ignore) => {
                  // QR Code scanning is stopped.
                }).catch((err) => {
                  // Stop failed, handle it.
                });
              
          }).catch(error => {
              console.error(error);
          });
       
      }
      
      let html5qrcode = new Html5Qrcode("reader", {
          
          experimentalFeatures: {
              useBarCodeDetectorIfSupported: true
          }
      });
      
      const scanConfig = { fps: 10, qrbox: 250};
      // If you want to prefer front camera
      html5qrcode.start({ facingMode: "environment" }, scanConfig, onScanSuccess);
     
        
      
  })
}