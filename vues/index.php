
<div class="hero hero--pad-haut">
	<div class="hero__titre">vino
		<div class="hero__stitre">Gestion de celliers</div>	
	</div>
	<!--Image hero-->
	<div class="hero__img-wrapper">
		<img class="hero__img--hauteur " src="./assets/img/unebouteille.jpg" alt="hero">
	</div>
</div>


<section class="section-wrapper banderole">
<h4 class="vignette__entete">Aperçu - Statistiques globales</h4><br>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
			<a class="banderole__contenant" href="?requete=statistiques">
				<i class="banderole__icone">
					<svg class="banderole__icone--grosseur" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M336.6 156.5C327.3 148.1 322.6 136.5 327.1 125.3L357.6 49.18C362.7 36.27 377.8 30.36 389.7 37.63C410.9 50.63 430 66.62 446.5 85.02C455.7 95.21 452.9 110.9 441.5 118.5L373.9 163.5C363.6 170.4 349.8 168.1 340.5 159.9C339.2 158.7 337.9 157.6 336.6 156.5H336.6zM297.7 112.6C293.2 123.1 280.9 129.8 268.7 128.6C264.6 128.2 260.3 128 256 128C251.7 128 247.4 128.2 243.3 128.6C231.1 129.8 218.8 123.1 214.3 112.6L183.1 36.82C178.8 24.02 185.5 9.433 198.1 6.374C217.3 2.203 236.4 0 256 0C275.6 0 294.7 2.203 313 6.374C326.5 9.433 333.2 24.02 328 36.82L297.7 112.6zM122.3 37.63C134.2 30.36 149.3 36.27 154.4 49.18L184.9 125.3C189.4 136.5 184.7 148.1 175.4 156.5C174.1 157.6 172.8 158.7 171.5 159.9C162.2 168.1 148.4 170.4 138.1 163.5L70.52 118.5C59.13 110.9 56.32 95.21 65.46 85.02C81.99 66.62 101.1 50.63 122.3 37.63H122.3zM379.5 222.1C376.3 210.7 379.7 198.1 389.5 191.6L458.1 145.8C469.7 138.1 485.6 141.9 491.2 154.7C501.6 178.8 508.4 204.8 510.9 232C512.1 245.2 501.3 255.1 488 255.1H408C394.7 255.1 384.2 245.2 381.8 232.1C381.1 228.7 380.4 225.4 379.5 222.1V222.1zM122.5 191.6C132.3 198.1 135.7 210.7 132.5 222.1C131.6 225.4 130.9 228.7 130.2 232.1C127.8 245.2 117.3 256 104 256H24C10.75 256-.1184 245.2 1.107 232C3.636 204.8 10.43 178.8 20.82 154.7C26.36 141.9 42.26 138.1 53.91 145.8L122.5 191.6zM104 288C117.3 288 128 298.7 128 312V360C128 373.3 117.3 384 104 384H24C10.75 384 0 373.3 0 360V312C0 298.7 10.75 288 24 288H104zM488 288C501.3 288 512 298.7 512 312V360C512 373.3 501.3 384 488 384H408C394.7 384 384 373.3 384 360V312C384 298.7 394.7 288 408 288H488zM104 416C117.3 416 128 426.7 128 440V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V440C0 426.7 10.75 416 24 416H104zM488 416C501.3 416 512 426.7 512 440V488C512 501.3 501.3 512 488 512H408C394.7 512 384 501.3 384 488V440C384 426.7 394.7 416 408 416H488zM272 464C272 472.8 264.8 480 256 480C247.2 480 240 472.8 240 464V192C240 183.2 247.2 176 256 176C264.8 176 272 183.2 272 192V464zM208 464C208 472.8 200.8 480 192 480C183.2 480 176 472.8 176 464V224C176 215.2 183.2 208 192 208C200.8 208 208 215.2 208 224V464zM336 464C336 472.8 328.8 480 320 480C311.2 480 304 472.8 304 464V224C304 215.2 311.2 208 320 208C328.8 208 336 215.2 336 224V464z"/></svg>
				</i>
				<div>
					<div class="banderole__titre">Celliers</div>
					
					<div class="banderole__texte">
						<?php if(isset($nombre_cellier)) echo $nombre_cellier ?>
					</div>
				</div>
			</a>
		</div>
        <div class="swiper-slide">
			<a class="banderole__contenant" href="?requete=statistiques">
				<i class="banderole__icone">
					<svg class="banderole__icone--grosseur" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.25 6.254-6.251 16.38-.0006 22.63l-76.63 76.63c-46.63-19.75-102.4-10.75-140.4 27.25l-158.4 158.4c-25 25-25 65.51 0 90.51l90.51 90.52c25 25 65.51 25 90.51 0l158.4-158.4c38-38 47-93.76 27.25-140.4l76.63-76.63c6.25 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57zM179.3 423.2l-90.51-90.51l122-122l90.51 90.52L179.3 423.2z"/></svg>
				</i>
				<div>
					<div class="banderole__titre">Bouteilles</div>
					<div class="banderole__texte">
						<?php if(isset($bouteille_total)) echo $bouteille_total?>
					</div>
				</div>
			</a>
		</div>
        <div class="swiper-slide">
			<a class="banderole__contenant" href="?requete=statistiques">
				<i class="banderole__icone">
					<svg class="banderole__icone--grosseur" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M320 96H192L144.6 24.88C137.5 14.24 145.1 0 157.9 0H354.1C366.9 0 374.5 14.24 367.4 24.88L320 96zM192 128H320C323.8 130.5 328.1 133.3 332.1 136.4C389.7 172.7 512 250.9 512 416C512 469 469 512 416 512H96C42.98 512 0 469 0 416C0 250.9 122.3 172.7 179 136.4C183.9 133.3 188.2 130.5 192 128V128zM276.1 224C276.1 212.9 267.1 203.9 255.1 203.9C244.9 203.9 235.9 212.9 235.9 224V230C230.3 231.2 224.1 232.9 220 235.1C205.1 241.9 192.1 254.5 188.9 272.8C187.1 283 188.1 292.9 192.3 301.8C196.5 310.6 203 316.8 209.6 321.3C221.2 329.2 236.5 333.8 248.2 337.3L250.4 337.9C264.4 342.2 273.8 345.3 279.7 349.6C282.2 351.4 283.1 352.8 283.4 353.7C283.8 354.5 284.4 356.3 283.7 360.3C283.1 363.8 281.2 366.8 275.7 369.1C269.6 371.7 259.7 373 246.9 371C240.9 370 230.2 366.4 220.7 363.2C218.5 362.4 216.3 361.7 214.3 361C203.8 357.5 192.5 363.2 189 373.7C185.5 384.2 191.2 395.5 201.7 398.1C202.9 399.4 204.4 399.9 206.1 400.5C213.1 403.2 226.4 407.4 235.9 409.6V416C235.9 427.1 244.9 436.1 255.1 436.1C267.1 436.1 276.1 427.1 276.1 416V410.5C281.4 409.5 286.6 407.1 291.4 405.9C307.2 399.2 319.8 386.2 323.1 367.2C324.9 356.8 324.1 346.8 320.1 337.7C316.2 328.7 309.9 322.1 303.2 317.3C291.1 308.4 274.9 303.6 262.8 299.9L261.1 299.7C247.8 295.4 238.2 292.4 232.1 288.2C229.5 286.4 228.7 285.2 228.5 284.7C228.3 284.3 227.7 283.1 228.3 279.7C228.7 277.7 230.2 274.4 236.5 271.6C242.1 268.7 252.9 267.1 265.1 268.1C269.5 269.7 283 272.3 286.9 273.3C297.5 276.2 308.5 269.8 311.3 259.1C314.2 248.5 307.8 237.5 297.1 234.7C292.7 233.5 282.7 231.5 276.1 230.3L276.1 224z"/></svg>
				</i>
				<div>
					<div class="banderole__titre">Valeurs</div>
					<div class="banderole__texte">
						<?php if(isset($total)) echo $total ?>$
					</div>
				</div>
			</a>
		</div>
        <div class="swiper-slide">
			<a class="banderole__contenant" href="?requete=statistiques">
				<i class="banderole__icone">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M232 464h-40.01v-117.3c68.52-15.88 118-79.86 111.4-154.1L287.5 14.5C286.8 6.25 279.9 0 271.8 0H48.23C40.1 0 33.22 6.25 32.47 14.5L16.6 192.6c-6.625 74.25 42.88 138.2 111.4 154.2V464H87.98c-22.13 0-40.01 17.88-40.01 40c0 4.375 3.625 8 8.002 8h208c4.377 0 8.002-3.625 8.002-8C272 481.9 254.1 464 232 464zM180.4 300.2c-13.64 3.16-27.84 3.148-41.48-.0371C91.88 289.2 60.09 245.2 64.38 197.1L77.7 48h164.6L255.6 197.2c4.279 48.01-27.5 91.93-74.46 102.8L180.4 300.2z"/></svg>				</i>
				<div>
					<div class="banderole__titre">Bues</div>
					<div class="banderole__texte">
						<?php if(isset( $bouteillesBues)) echo $bouteillesBues ?>
					</div>
				</div>
			</a>
		</div>
        <div class="swiper-slide">
			<a class="banderole__contenant" href="?requete=statistiques">
				<i class="banderole__icone">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M232 464h-40.01v-117.3c68.51-15.88 118-79.86 111.4-154.1L287.5 14.5C286.8 6.25 279.9 0 271.8 0H48.23C40.1 0 33.22 6.25 32.47 14.5L16.6 192.6c-6.626 74.25 42.88 138.2 111.4 154.2V464H87.98c-22.13 0-40.01 17.88-40.01 40c0 4.375 3.626 8 8.002 8h208c4.376 0 8.002-3.625 8.002-8C272 481.9 254.1 464 232 464zM77.72 48h164.6L249.4 128H70.58L77.72 48z"/></svg>				</i>
				<div>
					<div class="banderole__titre">Achetées</div>
					<div class="banderole__texte">
						<?php if(isset( $bouteillesAchetees)) echo $bouteillesAchetees ?>
					</div>
				</div>
			</a>
		</div>
	</div>  

	
	<div class="caroussel__pagination">
	<div class="swiper-pagination"></div>
	</div>
</div>

</section>

		<section  class="section-wrapper vignette vignette--bgcouleur">

			<h4 class="vignette__entete">Gérer mes collections</h4>
			<br>

			<div class="grille grille--4">
				<a href="?requete=mesCelliers">
					<figure class="vignette__wrapper">
						<img class="vignette__img" src="./assets/img/cellier2.jpg" alt="cellier">
						<figcaption class="vignette__titre">Mes celliers</figcaption>
					</figure>
				</a>
				
				<a href="?requete=bouteille">
					<figure class="vignette__wrapper">
						<img class="vignette__img" src="./assets/img/bouchonblanc.jpg" alt="bouteilles">
						<figcaption class="vignette__titre">Ajouter une bouteille</figcaption>
					</figure>
				</a>
				
				<a href="?requete=rechercher">
					<figure class="vignette__wrapper">
						<img class="vignette__img" src="./assets/img/bouteilles1.jpg" alt="bouteille">
						<figcaption class="vignette__titre">Mes bouteilles</figcaption>
					</figure>
				</a>	
				<a href="?requete=listes">
					<figure class="vignette__wrapper">
						<img class="vignette__img" src="./assets/img/etagere.jpg" alt="bouteilles">
						<figcaption class="vignette__titre">Mes listes</figcaption>
					</figure>
				</a>
				
</div>
</section>

		<section class="section-wrapper vignette">
			<h4 class="vignette__entete">Gérer mon compte</h4>
			<br>
			<div class="grille grille--4">
				<a href="?requete=profil">
					<figure class="vignette__wrapper">
						<img class="vignette__img" src="./assets/img/degustation2.jpg" alt="cellier">
						<figcaption class="vignette__titre">Mes informations</figcaption>
					</figure>
				</a>
				

				<a href="?requete=statistiques">
					<figure class="vignette__wrapper">
						<img class="vignette__img" src="./assets/img/bouteilleblancrouge.jpg" alt="cellier">
						<figcaption class="vignette__titre">Mes statistiques</figcaption>
					</figure>
				</a>
			</div>	
		</section>


		
    
    