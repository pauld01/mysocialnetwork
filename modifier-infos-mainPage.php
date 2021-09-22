<?php
    session_start();

    if(!isset($_SESSION['pseudo'])){
        header('Location: index.php');
        exit;
    }
    
    if(isset($_POST['rechercher'])){
        header('Location: recherche.php');
        exit;
    }   
?>

<html lang="fr">
    <head> 
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="modification des infos">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-modifier-profil-mainPage.css">
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
            <div class="icones">
                <div class="container">
                    <img src="images/iconeModifID.png" alt="Modifier mes informations personnelles"/>
                    <div class="img-txt">
                        <span><a href="modifier-infos-ID.php" style="color:white;text-decoration:none;">Modifier mon mail et mon mot de passe </a></span>
                    </div>
                </div>
                <div class="container">
                    <img src="images/iconeModifInfos.png" alt="Modifier mon mail et mon mot de passe"/>
                    <div class="img-txt">
                        <span><a href="modification_de_profil.php" style="color:white;text-decoration:none;">Modifier mes informations personnelles</a></span>
                    </div>
                </div>
            </div>
            <div class="boutons">
                <a href="supprimerCompte.php"><button> SUPPRIMER MON COMPTE </button></a>
            </div>
            <img class="img-socialMedia" src="images/social-media-5187243_1920.png" alt="OUPS ! Un problème est survenu lors de l'affichage de l'image"/>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>