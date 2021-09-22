<?php
    session_start();
    $profil=$_SESSION['pseudo'];
    include_once("outils/connex.inc.php");
    $network=connex("network","myparam");
    $requete="SELECT p.idprofil,p.biographie,p.formation,p.ville,p.ville_origine,p.emploi,p.amour,p.loisirs,p.pdp,u.sexe,p.pseudo FROM profil p , utilisateur u WHERE u.pseudo=p.pseudo AND p.pseudo=\"$profil\"";
    $res=@mysqli_query($network,$requete);
    if(!$res){
        echo "<h1>utilisatueur inconnu de la base</h1>";
    }
    else{
        $tab = mysqli_fetch_array($res,MYSQLI_NUM); 
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="content_style_type" content="text/css">
        <link type="text/css" rel="stylesheet" href="styles/modification_de_profil.css">
        <title>MySocialNetwork</title>
        <link rel="shortcut icon" href="images/icone/logoV2_icone-T-32.png">
    </head>
    <body>
        <header>
            <nav class="menu">
                <a href="accueil.php"><div class="navMenu-Logo" style="background-image: url(images/logo/logoV2-T_s-110.png)"></div></a>
                <h1 class="title">Modifier mon profil</h1>
                <?php echo "<h1 class='id'>$tab[10]</h1>";?>
            </nav>
        </header>
        <aside>
            <h1 class="cate"><b class="cate1">P</b>hoto de profil</h1>
            <?php
                if($tab[8]==null){
                    if($tab[9]=="Autre"){
                        echo'<img class="img-File" src="images/pdp/pdp_native.png">';
                    }
                    elseif($tab[9]=="Homme"){
                        echo'<img class="img-File" src="images/pdp/hommeV2.png">';
                    }
                    elseif($tab[9]=="Femme"){
                        echo'<img class="img-File" src="images/pdp/femmeV2.png">';
                    }
                }
                else{
                    echo "<img class='img-File' src=\"$tab[8]\"/>";
                }
            ?>
            <h2 class="cate"><b class="cate1">B</b>io</h2>
            <?php
                if($tab[1]==null){
                    echo '<p class="texte">non renseigné</p>';
                }
                else{ 
                    echo "<p class='texte'>$tab[1]</p>";
                }
            ?>
        </aside>
        <article class="article-mdmp">
            <div class="detettable-mdmp">
                <div class="det-detail-mdp"> 
                    <h2 class="cate"><b class="cate1">D</b>étails</h2>
                    <?php
                        echo "<div class='info'>";
                            echo "<fieldset>";
                                echo '<legend class="det-legend-left"><img class="logo_det" src="images/icones-Profil/adresse.png"></legend>';
                                if($tab[3]==null){
                                    echo '<p class="texte">non renseigné</p>';
                                }
                                else{
                                    echo "<p class='texte'>$tab[3]</p>";
                                }
                            echo "</fieldset>";
                        echo "</div>";
                        echo "<div class=\"info\">";
                            echo "<fieldset>";
                                echo '<legend class="det-legend-center"><img class="logo_det" src="images/icones-Profil/travail.png"></legend>';
                                if($tab[5]==null){
                                    echo '<p class="texte">non renseigné</p>';
                                }
                                else{
                                    echo "<p class='texte'>$tab[5]</p>";
                                }
                                echo "</fieldset>";
                        echo "</div>";
                        echo "<div class='info'>";
                            echo "<fieldset>";
                                echo '<legend class="det-legend-right"><img class="logo_det" src="images/icones-Profil/etudes.png"></legend>';
                                if($tab[2]==null){
                                    echo'<p class="texte">non renseigné</p>';
                                }
                                else{
                                    echo "<p class='texte'>$tab[2]</p>";
                                }
                            echo "</fieldset>";
                        echo "</div>";
                        echo "<div class='info'>";
                            echo "<fieldset>";
                                echo '<legend class="det-legend-center"><img class="logo_det" src="images/icones-Profil/ville.png"></legend>';
                                if($tab[4]==null){
                                    echo '<p class="texte">non renseigné</p>';
                                }
                                else{
                                    echo "<p class='texte'>$tab[4]</p>";
                                }
                            echo "</fieldset>";
                        echo "</div>";
                        echo "<div class=\"info\">";
                            echo "<fieldset>";
                                echo '<legend class="det-legend-left"><img class="logo_det" src="images/icones-Profil/relations.png"></legend>';
                                if($tab[6]==null){
                                    echo "<p class='texte'>non renseigné</p>";
                                }
                                else{
                                    echo "<p class='texte'>$tab[6]</p>";
                                }
                            echo "</fieldset>";
                        echo "</div>";
                    ?>
                </div>
                <div class="det-loisir-mdp">
                    <fieldset>
                        <legend><h2 class="cate"><b class="cate1">L</b>oisirs</h2><legend>
                        <?php
                            if($tab[7]==null){
                                echo '<p class="texte">non renseigné</p>';
                            }
                            else{
                                echo "<p class='texte'>$tab[7]</p>";
                            }
                        ?>  
                    </fieldset>
                </div>
            </div>
            <div class="boutton-mdmp">
                <form enctype="multipart/form-data" action="modification_de_profil_modifier.php" method="POST">
                <label for="bouton"></label>
                <input type="submit" id="bouton" class="boutonModifier" value="Modifier mon profil">
                </form>
            </div>
        </article>
        <?php mysqli_free_result($res); ?>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer> 
    </body>
</html>