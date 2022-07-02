<section class="section-wrapper">
    <h3>Statistiques</h3>
    <select data-js-lescelliers>
                <option value="tous">Tous les celliers</option>
                <?php foreach($data as $cellier){?>
                <option value="<?php echo $cellier['id_cellier']?>"><?php echo $cellier['nom_cellier']?></option>
                <?php }?>
            </select>
            
    
    
            <div class="grille grille--2l">
        <!--1-TYPE-->
        <div>
            <h4 class="graphique__titre">Type de bouteille</h4><div data-js-btnsformat>
        </div>
            <ul class="graphique" data-js-graphique>
           
                <li>
                    
                    <div>ROUGE </div>
                    <span class="graphique__qte" ></span>
                    <span class="index" style="width: <?php echo $types['p_rouge'];?>%; background-color: #b11226; ">("<?php echo $types['p_rouge'];?>%")</span>
                    <span class="graphique--police"><?php echo round($types['p_rouge'],2);?>%</span>
                </li>
                <li>
                    <div>BLANC</div>
                    <span class="graphique__qte"></span>
                    <span class="index" style="width: <?php echo $types['p_blanc'];?>%; background-color: #efe1a1;">("<?php echo $types['p_blanc'];?>%")</span>
                    <span class="graphique--police"><?php echo round($types['p_blanc'],2);?>%</span>
                </li>
                <li>
                    <div>ROSÉ</div>
                    <span class="graphique__qte"></span>
                    <span class="index" style="width: <?php echo $types['p_rose'];?>%; background-color: #f4c4bb;">("<?php echo $types['p_rose'];?>%")</span>
                    <span class="graphique--police"><?php echo round($types['p_rose'],2);?>%</span>
                </li>
              
            </ul>
        </div>
       

        <!--3-VALEUR DES DIFFÉRENTS CELLIERS-->
        <div>
            <h4>Valeur des celliers</h4>       
            <ul class="graphique" data-js-graphique>
                <?php foreach($data as $cellier){  ?>
                <li>
                    <div><?php echo $cellier['nom_cellier'] ;?></div>
                    <span class="graphique__qte" ></span>
                    <span class="index" style="width:<?php echo (($cellier['prix_total']*$cellier['bouteille_total'])/$total)*100?>%; background-color: #b11226; ">("<?php echo round(($cellier['prix_total']/$prix_total)*100,2)?>%")</span>
                    <span class="graphique--police"><?php echo $cellier['prix_total']*$cellier['bouteille_total'] ?>$</span>
                </li>
                <?php }?>
                </ul> 
        </div>
        <!--4-AJOUT DE BOUTEILLE-->
        <div>
            <h4 class="graphique__titre">Bouteilles ajoutée</h4>

            <ul class="graphique-vertical">
            <?php foreach ($mois as $cle =>$valeur) { 
                foreach($valeur as $col =>$nbre){ ?>
                <li> 
                    <span class="graphique--police"><?php echo $nbre ?></span>
                    <span class="graphique-vertical--couleur" style="height:<?php echo ($nbre/$bouteilles_achat)*100?>%"></span>
                    <span class="graphique--police"><?php echo $col?></span>
                </li>
            <?php }}?>
            </ul>    
        </div>
        <!--2-BUES-->
        <div>
            <h4 class="graphique__titre">Bouteilles consommées</h4>

            <ul class="graphique-vertical">
            <?php foreach ($moisBue as $cle =>$valeur) { 
                foreach($valeur as $col =>$nbre){ ?>
                <li> 
                    <span class="graphique--police"><?php echo $nbre ?></span>
                    <span class="graphique-vertical--couleur" style="height:<?php echo ($nbre/$bouteilles_bues)*100?>%"></span>
                    <span class="graphique--police"><?php echo $col?></span>
                </li>
            <?php }}?>
            </ul>    
        </div>
        
</section>