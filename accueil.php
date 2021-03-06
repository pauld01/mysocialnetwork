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
		<meta name="KEYWORDS" content="accueil">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-accueil.css">
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
            <div class="user-publier">
                <div class="user-name">
                    <?php
                        if(!isset($_SESSION['pseudo'])){
                            echo "<h3> Connectez-vous afin de profiter de toutes les fonctionnalit??s de notre site ! </h3>";
                        }else{
                            echo "<h3> Bon retour parmi nous ".$_SESSION['pseudo']."</h3>";
                        }
                    ?>
                </div>
                <form method="post" enctype="multipart/form-data" action="outils/add-publication.php" id="publication">
                    <fieldset>
                        <textarea name="text-publication" rows="5" cols="33" placeholder="Dites ?? tout le monde ce que vous faite" required></textarea>
                        <div class="container">
                            <label for="file" class="label-file"><img class="img-File" src="images/iconePhoto_pub.png" alt="Ajouter une image ?? votre publication !"/>
                            <input type="file" id="file" name="image" accept="image/*"/>
                            <div class="img-txt">
                                <span class="img-file-txt">Ajouter une image</span>
                            </div>
                            </label>
                        </div>
                        <div class="container">
                            <label for="fileVid" class="label-file"><img class="img-File" src="images/iconeVideo_pub.png" alt="Ajouter une image ?? votre publication !"/>
                            <input type="file" id="fileVid" name="video" accept="video/mp4"/>
                            <div class="img-txt">
                                <span class="img-file-txt">Ajouter une vid??o</span>
                            </div>
                            </label>
                        </div>
                    </fieldset>
                    <input type="submit" id="publier" name="publier" value="PUBLIER" />
                </form>
            </div>
            <div class="publications">
            <?php
                include_once('outils/connex.inc.php');
                $user = $_SESSION['pseudo'];
                $idcom = connex('network','myparam');

                $requetePublication = "SELECT * FROM publication WHERE pseudo=\"$user\" OR pseudo IN(SELECT pseudo2 FROM relation WHERE pseudo1=\"$user\") ORDER BY datepub DESC";
                $publications = mysqli_query($idcom,$requetePublication);
                $nbPub = count(mysqli_fetch_all($publications,MYSQLI_NUM));
                $publications = mysqli_query($idcom,$requetePublication);
                echo '<scroll-container>';
                if($nbPub != 0){
                    while ($pub = mysqli_fetch_array($publications,MYSQLI_NUM)){
                        $requeteInfosUser = "SELECT p.pdp, p.pseudo, u.sexe FROM profil p, utilisateur u WHERE p.pseudo=u.pseudo AND p.pseudo=\"$pub[5]\"";
                        $informationsUser = mysqli_query($idcom,$requeteInfosUser);

                        echo '<scroll-page>';
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
                        echo "<h6> publi?? le : $pub[4] </h6>";
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
                            echo "Desol?? votre navigateur ne prend pas en compte ce type de vid??o";
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
                    echo 'Pas encore de pubications, ajoutez en une ou ajoutez des amis pour en d??couvrir !';
                }
                echo '</scroll-container>'; 
                           
                mysqli_free_result($publications);
            ?>
            </div>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>