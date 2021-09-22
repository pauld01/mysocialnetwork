<?php
    session_start();
    $profil=$_SESSION['pseudo'];

    include_once("outils/connex.inc.php");
    $network=connex("network","myparam");

    $requete="SELECT p.idprofil,p.biographie,p.formation,p.ville,p.ville_origine,p.emploi,p.amour,p.loisirs,p.pdp,u.sexe,p.pseudo FROM profil p , utilisateur u WHERE u.pseudo=p.pseudo AND p.pseudo=\"$profil\"";
    $res=@mysqli_query($network,$requete);
    if(!$res){
        echo "<h1>utilisatueur inconnu de la table</h1>";
    }
    else{
        $tab = mysqli_fetch_array($res,MYSQLI_NUM);
    }
          
    $requete2="SELECT * FROM visibiliter WHERE pseudo=\"$profil\"";
    $res2=@mysqli_query($network,$requete2);
    if(!$res2){
        echo "<h1>utilisatueur inconnu de la table</h1>";
    }
    else{
        $visi = mysqli_fetch_array($res2,MYSQLI_NUM);
    }

    if(isset($_POST['valider'])){
        $newBio = mysqli_real_escape_string($network,$_POST['bio']);
        $newFormation = mysqli_real_escape_string($network,$_POST['formation']);
        $newVille = mysqli_real_escape_string($network,trim($_POST['ville_actuelle']));
        $newVilleOrigine = mysqli_real_escape_string($network,$_POST['ville_origine']);
        $newEmploi = mysqli_real_escape_string($network,$_POST['emploi']);
        $newAmour = $_POST['situation_amoureuse'];
        $newLoisir = mysqli_real_escape_string($network,$_POST['loisir']);
        if(!empty($_FILES["pdp"]["name"])){
            $newPdp='bd/images/'.$profil.'/'.$_FILES["pdp"]["name"];
            $resultat=move_uploaded_file($_FILES["pdp"]["tmp_name"],$newPdp);
            $requeteUpdate = "UPDATE profil SET biographie=\"$newBio\",formation=\"$newFormation\",ville=\"$newVille\",ville_origine=\"$newVilleOrigine\",emploi=\"$newEmploi\",amour=\"$newAmour\",loisirs=\"$newLoisir\",pdp=\"$newPdp\"WHERE pseudo=\"$profil\"";
        }
        else{
            $requeteUpdate = "UPDATE profil SET biographie=\"$newBio\",formation=\"$newFormation\",ville=\"$newVille\",ville_origine=\"$newVilleOrigine\",emploi=\"$newEmploi\",amour=\"$newAmour\",loisirs=\"$newLoisir\"WHERE pseudo=\"$profil\"";
        }
        $update = mysqli_query($network,$requeteUpdate);

        $choixVille=$_POST['domv'];
        $choixEmploi=$_POST['emploiv'];
        $choixFormation=$_POST['formationv'];
        $choixVilleOrigine=$_POST['villeoriginev'];
        $choixSituationAmoureuse=$_POST['situationv'];

        $requeteUpdateChoix= "UPDATE visibiliter SET det_ville=\"$choixVille\",det_emploi=\"$choixEmploi\",det_formation=\"$choixFormation\",det_ville_origine=\"$choixVilleOrigine\",det_situation_amoureuse=\"$choixSituationAmoureuse\" WHERE pseudo=\"$profil\"";
        $updateChoix= mysqli_query($network,$requeteUpdateChoix);
        
        if($update && $updateChoix){
            echo "<script type=\"text/javascript\"> alert('Vos informations ont bien été mise à jour ! ')</script>";
            header('Location: modification_de_profil.php');
            exit;
        }
        else{
            echo "<script type=\"text/javascript\"> alert('OUPS ! Un problème est survenu, vos infos n\'ont pas été mise à jour ! ')</script>";
            header('Location: modification_de_profil_modifier.php');
            exit;
        }
    }
    if(isset($_POST['suppression_pdp'])){
        $requeteUpdatePdp = "UPDATE profil SET pdp=null WHERE pseudo=\"$profil\"";
        $updatepdp= mysqli_query($network,$requeteUpdatePdp);
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
        <form action="modification_de_profil_modifier.php" enctype="multipart/form-data" method="POST">
            <h1 class="cate"><b class="cate1">P</b>hoto de profil</h1>

            <div class="container">
                <label for="file" class="label-file">
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
                    <input type="file" id="file" name="pdp" accept="image/*"/>
                    <div class="img-txt">
                        <span class="img-file-txt">Ajouter une photo de profil</span>
                    </div>
                </label>
            </div>
            <?php
                if($tab[8]!=null){
                    echo '<div class="boutton">';
                    echo '<label for="bouton"></label>';
                    echo '<input type="submit" class="boutonReset" name="suppression_pdp" id="bouton" value="Supprimer ma photo de profil">';
                    echo "</div>";
                }
            ?>
            <h2 class="cate"><b class="cate1">B</b>io</h2>
            <?php
                if($tab[1]==null){
                    echo '<textarea rows="7" cols="50" placeholder="Décrivez-vous" name="bio" ></textarea>';
                }
                else{ 
                    echo "<textarea rows='7' cols='50' name='bio' >".$tab[1]."</textarea>";
                }
            ?> 
        </aside>
        <article class="article-mdmpm">
            <div class="ensemble-det-coche">
                <div class="titrecotcot">
                    <h2 class="cate"><b class="cate1">D</b>étails</h2>
                    <h2 class="cate"><b class="cate1">Q</b>ui peut voir mes informations</h2>
                </div>
                <div class="detettable">
                    <div class="det-detail">
                        <?php
                            echo "<br><br>";
                            echo "<div class='info'>";
                            echo '<img class="logo_det" src="images/icones-Profil/adresse.png">';
                            if($tab[3]==null){
                                echo '<input type="text" placeholder="Ville actuelle" name="ville_actuelle" ><br>';
                            }
                            else{
                                echo "<input type='text' name='ville_actuelle' value=$tab[3]><br>";
                            }
                            echo "</div>";

                            echo "<div class=\"info\">";
                            echo '<img class="logo_det" src="images/icones-Profil/travail.png">';
                            if($tab[5]==null){
                                echo '<input type="text" placeholder="Emploi" name="emploi"> <br>';
                            }
                            else{
                                echo "<input type='text' name='emploi' value=$tab[5]><br>";
                            }
                            echo "</div>";

                            echo "<div class='info'>";
                            echo '<img class="logo_det" src="images/icones-Profil/etudes.png">';
                            if($tab[2]==null){
                                echo'<textarea rows="1" cols="40" placeholder="Formation" name="formation"></textarea><br>';
                            }
                            else{
                                echo "<textarea rows='1' cols='40' name='formation'>".$tab[2]."</textarea><br>";
                            }
                            echo "</div>";

                            echo "<div class='info'>";
                            echo '<img class="logo_det" src="images/icones-Profil/ville.png">';
                            if($tab[4]==null){
                                echo '<input type="text" placeholder="Ville d\'origine" name="ville_origine" ><br>';
                            }
                            else{
                                echo "<input type='text' name='ville_origine' value=$tab[4] ><br>";
                            }
                            echo "</div>";

                            echo "<div class=\"info\">";
                            echo "<img class=\"logo_det\" src=\"images/icones-Profil/relations.png\">";
                            if($tab[9]=="Autre"){
                                $situation = array("non renseigné","célibataire","marié(e)","pacsé(e)","en couple","c'est compliqué","fiancé(e)","veuf/veuve","divorcé(e)");
                                if($tab[6]==null){
                                    echo '<select name="situation_amoureuse">';
                                    foreach($situation as $statue){
                                        if($statue == "non renseigné"){
                                            echo "<option value=\"$statue\" selected>$statue</option>";
                                        }
                                        else{
                                            echo "<option value=\"$statue\">$statue</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                                else{
                                    echo '<select name="situation_amoureuse">';
                                    foreach($situation as $statue){
                                        if($statue == $tab[6]){
                                            echo "<option value=\"$statue\" selected>$statue</option>";
                                        }
                                        else{
                                            echo "<option value=\"$statue\">$statue</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                            }
                            elseif($tab[9]=="Homme"){
                                $situation = array("non renseigné","célibataire","marié","pacsé","en couple","c'est compliqué","fiancé","veuf","divorcé");
                                if($tab[6]==null){
                                    echo '<select name="situation_amoureuse">';
                                    foreach($situation as $statue){
                                        if($statue == "non renseigné"){
                                            echo "<option value=\"$statue\" selected>$statue</option>";
                                        }
                                        else{
                                            echo "<option value=\"$statue\">$statue</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                                else{
                                    echo '<select name="situation_amoureuse">';
                                    foreach($situation as $statue){
                                        if($statue == $tab[6]){
                                            echo "<option value=\"$statue\" selected>$statue</option>";
                                        }
                                        else{
                                            echo "<option value=\"$statue\">$statue</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                            }
                            elseif($tab[9]=="Femme"){
                                $situation = array("non renseigné","célibataire","mariée","pacsée","en couple","c'est compliqué","fiancée","veuve","divorcée");
                                if($tab[6]==null){
                                    echo '<select name="situation_amoureuse">';
                                    foreach($situation as $statue){
                                        if($statue == "non renseigné"){
                                            echo "<option value=\"$statue\" selected>$statue</option>";
                                        }
                                        else{
                                            echo "<option value=\"$statue\">$statue</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                                else{
                                    echo '<select name="situation_amoureuse">';
                                    foreach($situation as $statue){
                                        if($statue == $tab[6]){
                                            echo "<option value=\"$statue\" selected>$statue</option>";
                                        }
                                        else{
                                            echo "<option value=\"$statue\">$statue</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                            }
                            echo "</div>";
                        ?> 
                    </div>
                    <div class="info-table">
                        <?php
                            $choix= array("m","a","t");
                            echo "<table>";
                            echo "<tr class='bandeau'><td>moi</td><td>mes amis</td><td>tout le monde</td></tr>";
                            echo "<tr>";
                                foreach($choix as $v){
                                    if($v == $visi[1]){
                                        echo "<td><input type='radio' name='domv' value='$v' checked></td>";
                                    }
                                    else{
                                        echo "<td><input type='radio' name='domv' value='$v'></td>";
                                    }
                                }
                            echo "</tr>";
                            echo "<tr>";
                                foreach($choix as $e){
                                    if($e == $visi[2]){
                                        echo "<td><input type='radio' name='emploiv' value='$e' checked></td>";
                                    }
                                    else{
                                        echo "<td><input type='radio' name='emploiv' value='$e'></td>";
                                    }
                                }
                            echo "</tr>";
                            echo "<tr>";
                                foreach($choix as $a){
                                    if($a == $visi[3]){
                                        echo "<td><input type='radio' name='formationv' value='$a' checked></td>";
                                    }
                                    else{
                                        echo "<td><input type='radio' name='formationv' value='$a'></td>";
                                    }
                                }
                            echo "</tr>";
                            echo "<tr>";
                                foreach($choix as $vo){
                                    if($vo == $visi[4]){
                                        echo "<td><input type='radio' name='villeoriginev' value='$vo' checked></td>";
                                    }
                                    else{
                                        echo "<td><input type='radio' name='villeoriginev' value='$vo'></td>";
                                    }
                                }
                            echo "</tr>";
                            echo "<tr>";
                                foreach($choix as $s){
                                    if($s == $visi[5]){
                                        echo "<td><input type='radio' name='situationv' value='$s' checked></td>";
                                    }
                                    else{
                                        echo "<td><input type='radio' name='situationv' value='$s'></td>";
                                    }
                                }
                            echo "</tr>";
                            echo "</table>";
                        ?>
                    </div>
                </div>
                <div class="det-loisir">
                    <h2 class="cate"><b class="cate1">L</b>oisirs</h2>
                    <?php
                        if($tab[7]==null){
                            echo '<textarea rows="5" cols="50" name="loisir" placeholder="Dites à tout le monde quels sont vos centres d\'intérêt"></textarea>';
                        }
                        else{
                            echo "<textarea rows='5' cols='50' name='loisir'>".$tab[7]."</textarea>";
                        }
                    ?> 
                </div>  
                <div class="boutton">
                    <label for="bouton"></label>
                    <input type="submit" id="bouton" name="valider" class="boutonValider" value="valider">
                    <input type="reset" id="bouton" class="boutonReset" value="Annuler">
                </div>
            </div>  
            </form>
        </article>
        <?php 
            mysqli_free_result($res);
            mysqli_free_result($res2);
        ?>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>    
    </body>
</html>