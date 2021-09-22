<?php
    session_start();

    if(!isset($_SESSION['pseudo'])){
        header('Location: index.php');
        exit;
    }  
?>

<html lang="fr">
    <head> 
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="index">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-supprimerCompte.css">
		<link rel="shortcut icon"  href="images/icone/logoV2_icone-T-32.png" >
    </head>
    <body>
    <header>
            <nav class="menu">
                <div class="navMenu-Logo" style="background-image: url(images/logo/logoV2-T_s-110.png)"></div>
                <h2><pre> Voulez-vous vraiment nous quitter ? </pre></h2>
            </nav>
        </header>
        <article>
            <div class="boutons">
                <form method="post" action="outils/remove-user.php">
                    <input type="hidden" name="pseudo" value="<?php echo $_SESSION['pseudo']; ?>" />
                    <input type="submit" class="rouge" name="supprimer" value="OUI" />
                </form>
                <a href="modifier-infos-mainPage.php"><button class="bleu"> NON </button></a>
            </div>
            <img class="img-socialMedia" src="images/adam-jang-8pOTAtyd_Mc-unsplash.jpg" alt="OUPS ! Un problème est survenu lors de l'affichage de l'image"/>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>