<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>VINO | Gestion de celliers</title>

		<meta charset="utf-8">
		<meta http-equiv="cache-control" content="no-cache">
		<meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">

		<meta name="description" content="VINO | Gestion de celliers">
		<meta name="author" content="Jonathan Martel (jmartel@cmaisonneuve.qc.ca)">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&family=Poiret+One&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
		<link rel="stylesheet" href="./css/styles.css" type="text/css" media="screen">
		<base href="<?php echo BASEURL; ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
		<!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
		<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
		<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>


		<script  src="./js/connexion.js"defer></script>
		<script  src="./js/enregistrement.js" defer></script>
		<script type="module" src="./js/Celliers/celliers.js" defer></script>
		<script src="./js/quantiteBouteille.js" defer></script>
		<script src="./js/modal.js" defer></script>
		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js" ></script>
		<script  src="./js/Scan/scan.js" defer></script>
		<script src="./js/main.js"></script>
	</head>

	
	<body >
		<header>
			<!--NAVIGATION ORDINATEUR-->	
			<nav class="nav">
				<!--LOGO-->	
				<a href="?requete=accueil" class="nav__logo">VINO</a>
				<!--MENU-->	
				<ul class="nav__liste">
					<li><a class="nav__lien" href="#"></a></li>
					<!--Connecté-->
					<?php if($_SESSION){
						if($_SESSION['utilisateur']){?>
					<li><a class="nav__lien" href="?requete=mesCelliers">Mes celliers</a></li>
					<li><a class="nav__lien" href="?requete=rechercher">Mes bouteilles</a></li>
					<li class=" nav__deroule">
						<div class="nav__lien nav__deroule-btn">
							<svg class="nav__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
							<?php echo $_SESSION['utilisateur']['nom']?></div>
							<ul class="nav__deroule-contenu">
								<li><a href="?requete=profil">Mon compte</a></li>
								<li><a href="?requete=listes">Mes listes</a></li>
								<li><a href="?requete=statistiques">Mes Statistiques</a></li>
								<li><a href="?requete=deconnecter">Déconnexion</a></li>
							</ul>
							</li>		
					
					<!--Non Connecté-->
					<?php  }}else if(!$_SESSION) {?>
					<li></li>
					<li><a class="nav__lien" href="?requete=connecter">Connexion</a></li>
					<li><a class="nav__lien" href="?requete=enregistrer">S'enregistrer</a></li>
					<?php };?>
				</ul>
			</nav>
			<!--NAVIGATION MOBILE-->
	<nav class="nav-mobile nav-mobile-wrapper">
			<ul class="nav-mobile__liste ">
				<!--Connecté-->	
				<?php if($_SESSION){
					if($_SESSION['utilisateur']){?>
					<li><i><a href="?requete=accueil"><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"/></svg></a></i></li>
					<li><i><a href="?requete=mesCelliers"><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M336.6 156.5C327.3 148.1 322.6 136.5 327.1 125.3L357.6 49.18C362.7 36.27 377.8 30.36 389.7 37.63C410.9 50.63 430 66.62 446.5 85.02C455.7 95.21 452.9 110.9 441.5 118.5L373.9 163.5C363.6 170.4 349.8 168.1 340.5 159.9C339.2 158.7 337.9 157.6 336.6 156.5H336.6zM297.7 112.6C293.2 123.1 280.9 129.8 268.7 128.6C264.6 128.2 260.3 128 256 128C251.7 128 247.4 128.2 243.3 128.6C231.1 129.8 218.8 123.1 214.3 112.6L183.1 36.82C178.8 24.02 185.5 9.433 198.1 6.374C217.3 2.203 236.4 0 256 0C275.6 0 294.7 2.203 313 6.374C326.5 9.433 333.2 24.02 328 36.82L297.7 112.6zM122.3 37.63C134.2 30.36 149.3 36.27 154.4 49.18L184.9 125.3C189.4 136.5 184.7 148.1 175.4 156.5C174.1 157.6 172.8 158.7 171.5 159.9C162.2 168.1 148.4 170.4 138.1 163.5L70.52 118.5C59.13 110.9 56.32 95.21 65.46 85.02C81.99 66.62 101.1 50.63 122.3 37.63H122.3zM379.5 222.1C376.3 210.7 379.7 198.1 389.5 191.6L458.1 145.8C469.7 138.1 485.6 141.9 491.2 154.7C501.6 178.8 508.4 204.8 510.9 232C512.1 245.2 501.3 255.1 488 255.1H408C394.7 255.1 384.2 245.2 381.8 232.1C381.1 228.7 380.4 225.4 379.5 222.1V222.1zM122.5 191.6C132.3 198.1 135.7 210.7 132.5 222.1C131.6 225.4 130.9 228.7 130.2 232.1C127.8 245.2 117.3 256 104 256H24C10.75 256-.1184 245.2 1.107 232C3.636 204.8 10.43 178.8 20.82 154.7C26.36 141.9 42.26 138.1 53.91 145.8L122.5 191.6zM104 288C117.3 288 128 298.7 128 312V360C128 373.3 117.3 384 104 384H24C10.75 384 0 373.3 0 360V312C0 298.7 10.75 288 24 288H104zM488 288C501.3 288 512 298.7 512 312V360C512 373.3 501.3 384 488 384H408C394.7 384 384 373.3 384 360V312C384 298.7 394.7 288 408 288H488zM104 416C117.3 416 128 426.7 128 440V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V440C0 426.7 10.75 416 24 416H104zM488 416C501.3 416 512 426.7 512 440V488C512 501.3 501.3 512 488 512H408C394.7 512 384 501.3 384 488V440C384 426.7 394.7 416 408 416H488zM272 464C272 472.8 264.8 480 256 480C247.2 480 240 472.8 240 464V192C240 183.2 247.2 176 256 176C264.8 176 272 183.2 272 192V464zM208 464C208 472.8 200.8 480 192 480C183.2 480 176 472.8 176 464V224C176 215.2 183.2 208 192 208C200.8 208 208 215.2 208 224V464zM336 464C336 472.8 328.8 480 320 480C311.2 480 304 472.8 304 464V224C304 215.2 311.2 208 320 208C328.8 208 336 215.2 336 224V464z"/></svg></a></i></li>
					<li><i><button class="bouton" data-js-scan><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M40 32C53.25 32 64 42.75 64 56V456C64 469.3 53.25 480 40 480H24C10.75 480 0 469.3 0 456V56C0 42.75 10.75 32 24 32H40zM128 48V464C128 472.8 120.8 480 112 480C103.2 480 96 472.8 96 464V48C96 39.16 103.2 32 112 32C120.8 32 128 39.16 128 48zM200 32C213.3 32 224 42.75 224 56V456C224 469.3 213.3 480 200 480H184C170.7 480 160 469.3 160 456V56C160 42.75 170.7 32 184 32H200zM296 32C309.3 32 320 42.75 320 56V456C320 469.3 309.3 480 296 480H280C266.7 480 256 469.3 256 456V56C256 42.75 266.7 32 280 32H296zM448 56C448 42.75 458.7 32 472 32H488C501.3 32 512 42.75 512 56V456C512 469.3 501.3 480 488 480H472C458.7 480 448 469.3 448 456V56zM384 48C384 39.16 391.2 32 400 32C408.8 32 416 39.16 416 48V464C416 472.8 408.8 480 400 480C391.2 480 384 472.8 384 464V48z"/></svg></i></button></li>
					<li><i><a href="?requete=rechercher"><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <path d="M507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.25 6.254-6.251 16.38-.0006 22.63l-76.63 76.63c-46.63-19.75-102.4-10.75-140.4 27.25l-158.4 158.4c-25 25-25 65.51 0 90.51l90.51 90.52c25 25 65.51 25 90.51 0l158.4-158.4c38-38 47-93.76 27.25-140.4l76.63-76.63c6.25 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57zM179.3 423.2l-90.51-90.51l122-122l90.51 90.52L179.3 423.2z"/></svg></a></i></li>
					<li><i><a href="?requete=profil"><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg></a></i></li>
						
						<!--Non Connecté-->
					<?php  }}else if(!$_SESSION) {?>
					<li><i><a href="?requete=accueil"><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"/></svg></a></i></li>
					<li><i><a href="?requete=enregistrer"><svg class="nav-mobile__icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM176 128c35.35 0 64 28.65 64 64s-28.65 64-64 64s-64-28.65-64-64S140.7 128 176 128zM272 384h-192C71.16 384 64 376.8 64 368C64 323.8 99.82 288 144 288h64c44.18 0 80 35.82 80 80C288 376.8 280.8 384 272 384zM496 320h-128C359.2 320 352 312.8 352 304S359.2 288 368 288h128C504.8 288 512 295.2 512 304S504.8 320 496 320zM496 256h-128C359.2 256 352 248.8 352 240S359.2 224 368 224h128C504.8 224 512 231.2 512 240S504.8 256 496 256zM496 192h-128C359.2 192 352 184.8 352 176S359.2 160 368 160h128C504.8 160 512 167.2 512 176S504.8 192 496 192z"/></svg></a></i></li>
					<?php };?>
			</ul>
		</nav>
		
		<!--Scan pour ouverture-->			
		</header>
		<div id="reader" ></div>
	<main>
	

	
				

			
		