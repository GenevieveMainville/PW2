<section class="section-wrapper carte carte--bg-couleur">
<div class="carte__entete-bouton">
<h3 class="carte__entete">Mes Bouteilles</h3>
    <a href="?requete=ajouterNouvelleBouteilleCellier&id_cellier=<?php echo $id_cellier;?>"><i class="carte--aligne-centre" > <svg class="carte__lien-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg></i></a>
</div>
    
    <div class="carte__contenant">
        <ul>
<?php
foreach ($data as $cle => $bouteille) {
?>
            <li class="carte__contenu ">
                <div class="carte__lien carte--flex">
                    <div class="carte__img">
                        <img src="<?php echo $bouteille['image_bouteille']; ?>" alt="bouteille">
                    </div>
                    <div class="carte__description">
                        <h4 class="carte__titre"><?php echo $bouteille['nom_bouteille']; ?></h4>
                       
                        <ul class="carte__detail-info">
                            <li class="carte__texte" >
                                <?php echo $bouteille['description_bouteille'];?>
                            </li>
                            <li>
                            <a href="?requete=ajouterBouteilleCellier&id_cellier=<?php echo $id_cellier;?>"><i class="carte--aligne-centre" > <svg class="carte__lien-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg></i></a>
                            </li>
                           
                        </ul>
                       
                    </div>
                </div>
            </li>
<?php
}
?>
           
        </ul>
    </div>
    
</section>