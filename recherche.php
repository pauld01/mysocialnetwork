<?php
    session_start();

    if(!isset($_SESSION['pseudo'])){
        header('Location: index.php');
        exit;
    }
    
    $user = $_SESSION['pseudo'];
?>

<html lang="fr">
    <head> 
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="recherche">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-recherche.css">
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
            <?php
                include_once('outils/connex.inc.php');
                $idcom = connex('network','myparam');
                
                if(!empty($_POST['recherche'])){
                    echo '<scroll-container>';
                    $search = trim($_POST['recherche']);

                    $requeteRechercheUser = "SELECT u.pseudo,p.pdp,u.sexe FROM utilisateur u, profil p WHERE u.pseudo=p.pseudo AND u.pseudo LIKE(\"%$search%\") AND u.pseudo NOT IN('$user')";
                    $rechercheUser = mysqli_query($idcom,$requeteRechercheUser);
                    $nbUser = count(mysqli_fetch_all($rechercheUser,MYSQLI_NUM));

                    if($nbUser != 0){
                        $rechercheUser = mysqli_query($idcom,$requeteRechercheUser);

                        while ($user = mysqli_fetch_array($rechercheUser,MYSQLI_NUM)){
                            echo '<scroll-page>';
                            if($user[1] != null)
                                echo '<img class="pdp" src="'.$user[1].'"/>';
                            else{
                                if($user[2] == "Femme")
                                    echo '<img class="pdp-F" src="images/pdp/femme.png"/>';
                                elseif($user[2] == "Homme")
                                    echo '<img class="pdp-H" src="images/pdp/homme.png"/>';
                                else
                                    echo '<img class="pdp" src="images/pdp/autre.png"/>';
                            }  
                            echo "<h6> $user[0] </h6>";
                            ?>
                            <a href="voir-profil.php?pseudo=<?php echo $user[0]; ?>"> <button> Voir le profil </button> </a>
                            <?php
                            echo '</scroll-page>';
                        }
                        
                    }else{
                        echo 'Aucun utilisateur ne correspond à votre recherche <br>';
                    }
                    mysqli_free_result($rechercheUser);
                    
                    //
                    $requeteRecherchePublication = "SELECT * FROM publication WHERE pseudo LIKE(\"%$search%\") OR texte LIKE(\"%$search%\") ORDER BY datepub DESC";
                    $recherchePublication = mysqli_query($idcom,$requeteRecherchePublication);
                    $nbPub = count(mysqli_fetch_all($recherchePublication,MYSQLI_NUM));
                    $recherchePublication = mysqli_query($idcom,$requeteRecherchePublication);

                    if($nbPub != 0){
                        while ($pub = mysqli_fetch_array($recherchePublication,MYSQLI_NUM)){
                            $requeteInfosUser = "SELECT p.pdp, p.pseudo, u.sexe FROM profil p, utilisateur u WHERE p.pseudo=u.pseudo AND p.pseudo=\"$pub[5]\"";
                            $informationsUser = mysqli_query($idcom,$requeteInfosUser);

                            echo '<scroll-page class="publications">';
                            echo '<div class="publications-infos-user">';
                            while ($infos = mysqli_fetch_array($informationsUser,MYSQLI_NUM)){
                                if($infos[0] != null)
                                    echo '<img class="pdp" src="'.$infos[0].'"/>';
                                else{
                                    if($infos[2] == "Femme")
                                        echo '<img class="pdp-F" src="images/pdp/femme.png"/>';
                                    elseif($infos[2] == "Homme")
                                        echo '<img class="pdp-H" src="images/pdp/homme.png"/>';
                                    else
                                        echo '<img class="pdp" src="images/pdp/autre.png"/>';
                                }  

                            }
                                echo "<div class=\"publications-infos-user-date\">";
                                    echo "<h4> $pub[5] </h4>";
                                    echo "<h6> publié le : $pub[4] </h6>";
                                echo "</div>";
                            echo "</div>";
                            echo '<div class="publications-text">';
                                echo "<p> $pub[3] </p>";
                            echo "</div>";
                            echo '<div class="publications-contents">';
                            if($pub[1] != null){
                                echo '<img src="'.$pub[1].'"/>';
                            }
                            if($pub[2] != null){
                                echo '<video controls width="200">';
                                echo '<source src="'.$pub[2].'" type="video/mp4">';
                                echo "Desolé votre navigateur ne prend pas en compte ce type de vidéo";
                                echo '</video>';
                            }
                            echo "</div>";
                            echo "<div class=\"commentaires-like-post\">"
                        ?>
                        <form method="post" action="outils/add-commentaire.php" id="commentaire">
                            <input type="hidden" name="pub-comment" value="<?php echo $pub[0]; ?>" />
                            <input type="hidden" name="location" value="../accueil.php" />
                            <input type="text" id="texte-commentaire" name="com" max-length="400" placeholder="Laisse un petit commentaire ici..." required/>
                            <input type="submit" id="commenter" name="commenter" value="COMMENTER" />
                        </form>
                        <?php
                        $requeteLikes = "SELECT * FROM aimer WHERE pseudo=\"$user\" AND idpub=\"$pub[0]\"";
                        $likes = mysqli_query($idcom,$requeteLikes);
                        $nbLikes = count(mysqli_fetch_all($likes,MYSQLI_NUM));
                        if ($nbLikes == 0){
                        ?>
                        <form method="post" action="outils/add-like.php" id="like">
                            <input type="hidden" name="pub-like" value="<?php echo $pub[0]; ?>" />
                            <input type="hidden" name="location" value="../accueil.php" />
                            <input type="submit" id="liker" name="liker" value="J'AIME" />
                        <?php
                        }else{
                        ?>
                        <form method="post" action="outils/remove-like.php" id="like">
                            <input type="hidden" name="pub-like" value="<?php echo $pub[0]; ?>" />
                            <input type="hidden" name="location" value="../accueil.php" />
                            <input type="submit" id="liker" name="dislike" value="JE N'AIME PLUS" />
                        <?php
                        }
                        include_once('outils/count-like.php');
                        echo "<p class=\"nombre-aimer\"> Personnes qui aiment : ",countLike($pub[0]),"</p>"; 
                        echo "</form>";
                        echo "</div>";
                        $requeteCommentaire= "SELECT * FROM commenter WHERE idpub=\"$pub[0]\" ORDER BY date_com";
                        $commentaires = mysqli_query($idcom,$requeteCommentaire);
                        $nbCom = count(mysqli_fetch_all($commentaires,MYSQLI_NUM));
                        if ($nbCom != 0){
                            $commentaires = mysqli_query($idcom,$requeteCommentaire);
                            echo "<scroll-container>";
                            while ($com = mysqli_fetch_array($commentaires,MYSQLI_NUM)){
                                echo '<scroll-page>';
                                $requeteInfoUserCom= "SELECT p.pdp, p.pseudo, u.sexe FROM profil p, utilisateur u WHERE p.pseudo=u.pseudo AND p.pseudo=\"$com[1]\"";
                                $informationsCom = mysqli_query($idcom,$requeteInfoUserCom);
                                while ($infosCom = mysqli_fetch_array($informationsCom,MYSQLI_NUM)){
                                    if($infosCom[0] != null)
                                        echo '<img class="com-pdp" src="'.$infosCom[0].'"/>';
                                    else{
                                        if($infosCom[2] == "Femme")
                                            echo '<img class="com-pdp-F" src="images/pdp/femme.png"/>';
                                        elseif($infosCom[2] == "Homme")
                                            echo '<img class="com-pdp-H" src="images/pdp/homme.png"/>';
                                        else
                                            echo '<img class="com-pdp" src="images/pdp/autre.png"/>';
                                    }
                                    echo "<b>$com[1]</b> : ";  
                                }
                                echo "$com[3]";
                                if (($com[1] == $user) || ($pub[5] == $user)){
                                ?>
                                <form method="post" action="outils/remove-commentaire.php" id="remove-publication">
                                    <input type="hidden" name="pseudo" value="<?php echo $com[1]; ?>" />
                                    <input type="hidden" name="idcom" value="<?php echo $com[0]; ?>" />
                                    <input type="hidden" name="location" value="../accueil.php" />
                                    <input type="submit" name="supprimer" value="Supprimer" />
                                </form>
                                <?php
                                }
                                echo '</scroll-page>';
                                echo "<hr>";
                                mysqli_free_result($informationsCom);  
                            }                          
                            echo "</scroll-container>";
                        }
                        echo '</scroll-page>';
                        mysqli_free_result($commentaires);  
                    }
                    mysqli_free_result($informationsUser);  
                }else{
                    echo 'Aucune publication ne correspond à votre recherche <br>';
                }
                mysqli_free_result($recherchePublication);

                echo '</scroll-container>'; 
            }
                
            ?>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>