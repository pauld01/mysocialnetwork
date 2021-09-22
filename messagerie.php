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
		<meta name="KEYWORDS" content="messagerie">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-messagerie.css">
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
            <div class="scroll-message_sentMessage">
                <scroll-container class="scroll-messages">
                    <?php
                        include_once('outils/connex.inc.php');

                        $idcom = connex('network','myparam');
                        $user = $_SESSION['pseudo'];

                        if(isset($_GET['openMessage'])){
                            $dest = $_GET['destinataire'];
                            
                            $requeteMessages = "SELECT * FROM messagerie WHERE pseudoexp IN(\"$user\",\"$dest\") AND pseudodest IN(\"$dest\",\"$user\") ORDER BY datemessage DESC";
                            $messages = mysqli_query($idcom,$requeteMessages);

                            while ($mess = mysqli_fetch_array($messages,MYSQLI_NUM)){
                                if($mess[1] == $user){
                                    echo '<scroll-page class="expediteur">';
                                    echo $mess[4];
                                    echo "<div class=\"message-expediteur-date-pseudo\">";
                                    echo "<h6> $user </h6>";
                                    echo "<h6> $mess[3] </h6>";
                                    echo "</div>";
                                    echo '</scroll-page>';
                                }else{
                                    echo '<scroll-page class="destinataire">';
                                    echo $mess[4];
                                    echo "<div class=\"message-destinataire-date-pseudo\">";
                                    echo "<h6> $dest </h6>";
                                    echo "<h6> $mess[3] </h6>";
                                    echo "</div>";
                                    echo '</scroll-page>';
                                } 
                            }
                    ?>
                </scroll-container>
                <form method="post" action="outils/add-message.php">
                    <input type="hidden" name="destinataireMessage" value="<?php echo $dest; ?>">
                    <input type="hidden" name="expediteurMessage" value="<?php echo $user; ?>">
                    <textarea id="message" name="message" rows="3" cols="30" placeholder="Message à <?php echo $dest; ?>...."></textarea>
                    <input type="submit" name="sent" value="SENT">
                 </form>
                <?php
                    }
                ?>
            </div>
            <scroll-container class="scroll-amis">
                <?php
                    $searchFriends = "SELECT p.pseudo,p.pdp,u.sexe FROM utilisateur u, profil p WHERE u.pseudo=p.pseudo AND p.pseudo IN(SELECT pseudo2 FROM relation WHERE pseudo1=\"$user\")";
                    $friends = mysqli_query($idcom,$searchFriends);
                    $nbFriends = count(mysqli_fetch_all($friends,MYSQLI_NUM));

                    if($nbFriends != 0){
                        $friends = mysqli_query($idcom,$searchFriends);
                        while($friend = mysqli_fetch_array($friends,MYSQLI_NUM)){
                            echo "<scroll-page class=\"amis\">";
                            if($friend[1] != null)
                                echo '<img class="pdp" src="'.$friend[1].'"/>';
                            else{
                                if($friend[2] == "Femme")
                                    echo '<img class="pdp-F" src="images/pdp/femme.png"/>';
                                elseif($friend[2] == "Homme")
                                    echo '<img class="pdp-H" src="images/pdp/homme.png"/>';
                                else
                                    echo '<img class="pdp" src="images/pdp/autre.png"/>';
                            }
                            echo "<h5>".$friend[0]."</h5>";
                            ?>
                            <a href="voir-profil.php?pseudo=<?php echo $friend[0]; ?>"> <button class="voirProfil"> Voir </button></a>
                            <form method="get" action="messagerie.php">
                                <input type="hidden" name="destinataire" value="<?php echo $friend[0]; ?>">
                                <input type="submit" name="openMessage" value="Envoyer un message">
                            </form>
                            <?php
                            echo "</scroll-page>";
                            echo "<hr>";
                        }
                    }else{
                        echo "Pas encore d'amis pour le moment...";
                    }
                ?>
            </scroll-container>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>