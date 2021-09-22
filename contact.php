<?php
    session_start();
?>
<html lang="fr">
    <head> 
        <meta charset="UTF-8">
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="contact">  
	
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-contact.css">
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
            <h2><b>N</b>ous contacter</h2>
            <p>En cas de problème, vous pouvez nous contacter grâce à ce formulaire. Pensez à décrire le mieux possible votre problème afin que nous puissions le résoudre le plus rapidement possible !</p>
            <p>Entrez un maximun d'informations et notamment votre <i>pseudo</i> si vous possédez déjà un compte chez nous.</p>
            <form action="mailto:contact@msn.com" method="post" enctype="text/plain" >
                <fieldset>
                    <legend><h4>Formulaire de contact</h4></legend>
                    <div class="aide_infoUser">
                        <img class='iconesAide' src='images/iconesForm/Contact_IconeUser.png' alt="oups un problème est survenu dans l'affichage">
                        <input type="text" name="nom" placeholder="Nom"/> 
                        <input type="text" name="prenom" placeholder="Prenom"/>
                        <input type="text" name="login" placeholder="Pseudo"/>
                    </div>
                    <div class="aide_mail">
                        <img class='iconesAide' src='images/iconesForm/Contact_IconeMail.png' alt="oups un problème est survenu dans l'affichage">
                        <input type="email" placeholder="E-mail" required>
                    </div>
                    <div class="aide_Message">
                        <img class='iconesAide-message' src='images/iconesForm/Contact_IconeMessage.png' alt="oups un problème est survenu dans l'affichage">
                        <textarea name="message" cols="40" rows="5" placeholder="Décrivez votre problème ou votre demande ici" required></textarea><br>
                    </div>
                    <input class="sent-contact" type="submit" value="ENVOYER">
                </fieldset>
            </form>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>