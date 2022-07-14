<section class="section-wrapper carte--bg-couleur carte--hauteur">
    <div class="carte__entete-bouton">
        <h3 data-js-usager="<?php echo $_SESSION['utilisateur']['id'];?>">Mes celliers</h3>
        <i class="carte--aligne-centre" > <svg data-js-nouveaucellier class="carte__lien-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg></i>
    </div>

    <!--BARRE DE TRI DES CELLIERS-->
    <?php if($data){?>
    <section class="barre">
        <div class="barre__contenant">
            <label>Trier par
                <select data-js-triecellier>
                    <option value="0">- Choisir -</option>
                    <option value="1">Nom du cellier</option>
                    <option value="2">Type de cellier</option>
                    <option value="3">Valeur du cellier</option>
                    <option value="4">Nombre de bouteille</option>  
                </select> 
            </label>
            <div class="barre__icones">
                <i class="barre__icone" data-js-btntriecellier="desc"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM390.6 246.6l-112 112C272.4 364.9 264.2 368 256 368s-16.38-3.125-22.62-9.375l-112-112c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L256 290.8l89.38-89.38c12.5-12.5 32.75-12.5 45.25 0S403.1 234.1 390.6 246.6z"/></svg></i>
                <i class="barre__icone" data-js-btntriecellier="asc"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM390.6 310.6c-12.5 12.5-32.75 12.5-45.25 0L256 221.3L166.6 310.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l112-112C239.6 147.1 247.8 144 256 144s16.38 3.125 22.62 9.375l112 112C403.1 277.9 403.1 298.1 390.6 310.6z"/></svg></i>
            </div>
        </div>
    </section>

    <!--CARTE DES CELLIERS-->
    <div class="carte__contenant" >
        <div class="carte--flex carte" data-js-contenant>
            <?php
            foreach ($data as $cle => $cellier) { ?>
            <div class="carte__lien--largeur carte--flex" data-js-carte="<?php echo $cellier["id_cellier"];?>">  
                <!--LIEN vers page des bouteilles du cellier-->
                <a class="carte__lien carte__lien--largeur" href="?requete=listeBouteilleCellier&id_cellier=<?php echo $cellier["id_cellier"];?>&nom_cellier=<?php echo $cellier["nom_cellier"];?>">
                    <div class="carte__contenu ">
                    
                        <!--ENTETE de la carte-->
                        <div class="carte--flex carte__titre ">

                            <!--ICONE type cellier-->
                            <div class="carte--flex " data-js-type="<?php echo $cellier["type_cellier_id"];?>">
                                <?php if($cellier['nom_commun_type_cellier'] == "cellier"){;?>
                                    <i class="carte--aligne-centre carte--droite cave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M336.6 156.5C327.3 148.1 322.6 136.5 327.1 125.3L357.6 49.18C362.7 36.27 377.8 30.36 389.7 37.63C410.9 50.63 430 66.62 446.5 85.02C455.7 95.21 452.9 110.9 441.5 118.5L373.9 163.5C363.6 170.4 349.8 168.1 340.5 159.9C339.2 158.7 337.9 157.6 336.6 156.5H336.6zM297.7 112.6C293.2 123.1 280.9 129.8 268.7 128.6C264.6 128.2 260.3 128 256 128C251.7 128 247.4 128.2 243.3 128.6C231.1 129.8 218.8 123.1 214.3 112.6L183.1 36.82C178.8 24.02 185.5 9.433 198.1 6.374C217.3 2.203 236.4 0 256 0C275.6 0 294.7 2.203 313 6.374C326.5 9.433 333.2 24.02 328 36.82L297.7 112.6zM122.3 37.63C134.2 30.36 149.3 36.27 154.4 49.18L184.9 125.3C189.4 136.5 184.7 148.1 175.4 156.5C174.1 157.6 172.8 158.7 171.5 159.9C162.2 168.1 148.4 170.4 138.1 163.5L70.52 118.5C59.13 110.9 56.32 95.21 65.46 85.02C81.99 66.62 101.1 50.63 122.3 37.63H122.3zM379.5 222.1C376.3 210.7 379.7 198.1 389.5 191.6L458.1 145.8C469.7 138.1 485.6 141.9 491.2 154.7C501.6 178.8 508.4 204.8 510.9 232C512.1 245.2 501.3 255.1 488 255.1H408C394.7 255.1 384.2 245.2 381.8 232.1C381.1 228.7 380.4 225.4 379.5 222.1V222.1zM122.5 191.6C132.3 198.1 135.7 210.7 132.5 222.1C131.6 225.4 130.9 228.7 130.2 232.1C127.8 245.2 117.3 256 104 256H24C10.75 256-.1184 245.2 1.107 232C3.636 204.8 10.43 178.8 20.82 154.7C26.36 141.9 42.26 138.1 53.91 145.8L122.5 191.6zM104 288C117.3 288 128 298.7 128 312V360C128 373.3 117.3 384 104 384H24C10.75 384 0 373.3 0 360V312C0 298.7 10.75 288 24 288H104zM488 288C501.3 288 512 298.7 512 312V360C512 373.3 501.3 384 488 384H408C394.7 384 384 373.3 384 360V312C384 298.7 394.7 288 408 288H488zM104 416C117.3 416 128 426.7 128 440V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V440C0 426.7 10.75 416 24 416H104zM488 416C501.3 416 512 426.7 512 440V488C512 501.3 501.3 512 488 512H408C394.7 512 384 501.3 384 488V440C384 426.7 394.7 416 408 416H488zM272 464C272 472.8 264.8 480 256 480C247.2 480 240 472.8 240 464V192C240 183.2 247.2 176 256 176C264.8 176 272 183.2 272 192V464zM208 464C208 472.8 200.8 480 192 480C183.2 480 176 472.8 176 464V224C176 215.2 183.2 208 192 208C200.8 208 208 215.2 208 224V464zM336 464C336 472.8 328.8 480 320 480C311.2 480 304 472.8 304 464V224C304 215.2 311.2 208 320 208C328.8 208 336 215.2 336 224V464z"/></svg></i>
                                <?php }else{;?>
                                    <i class="carte--aligne-centre carte--droite refrigerateur"><span class="material-symbols-outlined">kitchen</span></i>
                                <?php };?>
                                
                                <!--NOM cellier-->
                                <h4 data-js-nomcellier><?php echo $cellier['nom_cellier'];?></h4>
                            </div>

                            <!--BOUTON de la carte-->
                            <form class="carte--flex" data-js-nomcellier="<?php echo $cellier["nom_cellier"];?>" >
                                <!--Modifier-->
                                <button class="bouton" data-js-modifiercellier="<?php echo $cellier["id_cellier"];?>" ><i class="carte__icone-petit"><svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/></svg></i></button>
                                <!--Supprimer-->
                                <button class="bouton" data-js-supprimercellier="<?php echo $cellier["id_cellier"];?>"><i class="carte__icone-petit"><svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM168 232C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H168z"/></svg></i></button>                
                            </form>
                        </div>

                        <!--CONTENU de la carte-->
                        <ul class="carte__liste">
                            <!--DESCRIPTION cellier-->
                            <li class="carte__detail">
                                <p data-js-descriptioncellier class="carte__texte">
                                <?php if($cellier['description_cellier']){
                                echo $cellier['description_cellier'];};?>
                                </p>
                            </li>
                            <!--DÉTAIL du cellier-->
                            <li class="carte__detail carte__detail-info">
                                
                                <!--NOMBRE de bouteille-->
                                <div class="carte__detail" data-js-nbouteille>
                                    <?php if($cellier['bouteille_total'] !== null && $cellier['bouteille_total'] !== "0"){?>
                                    <i><svg class="carte__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.25 6.254-6.251 16.38-.0006 22.63l-76.63 76.63c-46.63-19.75-102.4-10.75-140.4 27.25l-158.4 158.4c-25 25-25 65.51 0 90.51l90.51 90.52c25 25 65.51 25 90.51 0l158.4-158.4c38-38 47-93.76 27.25-140.4l76.63-76.63c6.25 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57zM179.3 423.2l-90.51-90.51l122-122l90.51 90.52L179.3 423.2z"/></svg></i>
                                    <p class="carte__texte carte__texte--esg">
                                        <?php echo $cellier['bouteille_total'];?>
                                    </p>
                                </div>
                                <!--VALEUR du cellier-->
                                <div class="carte__detail" data-js-valeur>
                                    <?php if($cellier['prix_total']){?>
                                    <i><svg class="carte__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 64C547.3 64 576 92.65 576 128V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V128C0 92.65 28.65 64 64 64H512zM128 384C128 348.7 99.35 320 64 320V384H128zM64 192C99.35 192 128 163.3 128 128H64V192zM512 384V320C476.7 320 448 348.7 448 384H512zM512 128H448C448 163.3 476.7 192 512 192V128zM288 352C341 352 384 309 384 256C384 202.1 341 160 288 160C234.1 160 192 202.1 192 256C192 309 234.1 352 288 352z"/></svg></i>
                                    <p class="carte__texte carte__texte--esg" >
                                        <?php $total = $cellier['prix_total']*$cellier['bouteille_total']; echo round($total,2);?>$<?php };?>
                                    </p>
                                </div>
                                <?php }else{;?>
                                    <p class="carte__texte">Aucune bouteille</p>
                                    <?php }?>
                            </li>
                        </ul>       
                    </div>
                </a>       
            </div>   
            <?php
            };}else{?>
            <p>Aucun cellier</p>
            <?php };?>
        </div>
    </div>
   
</section>


<!--MODAL-->

<div class="modal modal--ferme" data-js-modal>
	<div class="modal__contenu" data-js-modalcontenu >
      
	</div>
</div>



