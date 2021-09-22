<?php
    session_start();
?>

<html lang="fr">
    <head> 
        <meta charset="UTF-8">
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="a propos">  
	
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-aPropos.css">
		<link rel="shortcut icon"  href="images/icone/logoV2_icone-T-32.png" >
    </head>

    <body>
        <header>
            <nav class="menu">
                <a href="accueil.php"><div class="navMenu-Logo" style="background-image: url(images/logo/logoV2-T_s-110.png)"></div></a>
                <?php
                if(isset($_SESSION['pseudo'])){
                ?>
                <div class="navMenu-Search">
                    <form method="post" action="recherche.php" id="recherche">
                        <input type="search" name="recherche" placeholder="Rechercher..." required />
                        <input type="submit" name="rechercher" value="RECHERCHER" />
                    </form>
                </div>
                <?php
                }
                ?>
                <div class="navMenu-Nav"> 
                    <?php
                        if(isset($_SESSION['pseudo'])){
                            echo "<a href=\"profil.php\" style=\"color:white;margin:10px;font-family:cursive;\"> Mon profil </a>";
                            echo "<a href=\"modifier-infos-mainPage.php\" style=\"color:white;margin:10px;font-family:cursive;\"> Modifier mes informations </a>";
                            echo "<a href=\"messagerie.php\" style=\"color:white;margin:10px;font-family:cursive;\"> Messagerie </a>";
                            echo "<a href=\"deconnexion.php\" style=\"color:white;margin:10px;font-family:cursive;\"> Deconnexion </a>";
                        }
                        else{
                            echo "<a href=\"index.php\" style=\"color:white;margin:10px;font-family:cursive;\"> Se connecter </a>";
                            echo "<a href=\"inscriptions.php\" style=\"color:white;margin:10px;font-family:cursive;\"> S'inscrire </a>";
                        }
                    ?>
                </div>
            </nav>
        </header>
        <article>
            <div class="text">
                <h2><b class="deb">&Agrave</b> propos</h2>
                <p>Ce site web a été réalisé dans le cadre d'un projet de fin de semestre. Ce projet, dans le cadre de l'unité d'enseignement <b>Programmation Web</b>, fut réalisé avec l'encadrement de l'équipe pédagogique de <a href="https://www.u-picardie.fr/ufr/sciences/informatique/departement-informatique-266829.kjsp">l'Université de Picardie Jules Vernes</a>.</p>
                <p>Toutes les images d'illustration de ce site web ont été vérifiées comme "libre de droit".</p>
                <p>Le logo fut réalisé par Paul DUPLESSI qui en possède ainsi les droits grâce au site <a href="https://www.canva.com/">Canva</a>.</p>
                <img class='logo' src='images/logo/logoV2-T-500.png' alt="oups un problème est survenu dans l'affichage">
            </div>
            
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide</a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>