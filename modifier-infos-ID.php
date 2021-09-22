<?php
    include_once('outils/connex.inc.php');
    include_once('outils/confirm_mail.php');
    include_once('outils/confirm_mdp.php');
    include_once('outils/verif_mail.php');

    session_start();

    if(!isset($_SESSION['pseudo'])){
        header('Location: index.php');
        exit;
    }
    
    if(isset($_POST['rechercher'])){
        header('Location: recherche.php');
        exit;
    } 
    
    $user = $_SESSION['pseudo'];

    $idcom = connex('network','myparam');
    $requeteInfos = "SELECT tel,mail,mdp,sexe FROM utilisateur WHERE pseudo=\"$user\"";
    $infosUser = mysqli_query($idcom,$requeteInfos);

    while ($info = mysqli_fetch_array($infosUser,MYSQLI_NUM)){
        $tel = $info[0];
        $mail = $info[1];
        $mdp = $info[2];
        $sexe = $info[3];
    }

    if (isset($_POST['update'])){
        if ($mdp == trim($_POST['old-pass-user'])){
            if (confirm_pass($_POST['new-pass-user'],$_POST['confirm_new-pass-user'])){
                $newPass = trim($_POST['new-pass-user']);

                if(isset($_POST['new-eMail-user'])){
                    $newMail = trim($_POST['new-eMail-user']);

                    if (verif_mail($newMail)){
                        if(isset($_POST['phone-user'])){
                            $newTel = trim($_POST['phone-user']);
                            $newSexe = $_POST['sexe'];

                            $requeteUpdateInfos = "UPDATE utilisateur SET tel=\"$newTel\",mail=\"$newMail\",mdp=\"$newPass\",sexe=\"$newSexe\" WHERE pseudo=\"$user\"";
                        }else{
                            $requeteUpdateInfos = "UPDATE utilisateur SET mail=\"$newMail\",mdp=\"$newPass\",sexe=\"$newSexe\" WHERE pseudo=\"$user\"";
                        }
                        
                    }else{
                        echo "<script type=\"text/javascript\"> alert('OUPS ! Cet e-mail existe déjà ! ')</script>";
                    }
                }

            }else{
                echo "<script type=\"text/javascript\"> alert('OUPS ! Les deux champs de nouveau mot de passe ne sont pas identiques ! ')</script>";
            }
        }else{
            echo "<script type=\"text/javascript\"> alert('OUPS ! Il semble que votre ancien mot de passe ne soit pas le bon ! ')</script>";
        }
        $update = mysqli_query($idcom,$requeteUpdateInfos);

        if($update){
            echo "<script type=\"text/javascript\"> alert('Vos informations ont bien été mise à jour ! ')</script>";
            header('Location: profil.php');
            exit;
        }else{
            echo "<script type=\"text/javascript\"> alert('OUPS ! Un problème est survenu, vos infos n'ont pas été mise à jour ! ')</script>";
            header('Location: modifier-infos-mainPage.php');
            exit;
        }
    }
?>

<html lang="fr">
    <head> 
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="modification de l'ID">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-modifier-infos-ID.css">
		<link rel="shortcut icon"  href="images/icone/logoV2_icone-T-32.png" >
    </head>

    <body>
        <header>
            <nav class="menu">
                <a href="accueil.php"><div class="navMenu-Logo" style="background-image: url(images/logo/logoV2-T_s-110.png)"></div></a>
                <h2><pre> Modification des informations </pre></h2>
            </nav>
        </header>
        <article>
            <form method="post" action="modifier-infos-ID.php">
                <div>
                    <label for="eMail"><img class='iconeInscr' src='images/iconesForm/Contact_IconeMail.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="mail" id="eMail" name="new-eMail-user" placeholder="E-mail" value="<?php echo $mail; ?>" required>
                </div>
                <div>
                    <label for="phone"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeTel.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="tel" id="phone" name="phone-user" placeholder="Téléphone" value="<?php if($tel!=null) { echo $tel; }else{ echo '""'; } ?>">
                </div>
                <div>
                    <label for="pass"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeMDP.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <div class="div-pass">
                        <input type="password" id="pass" name="old-pass-user" placeholder="Ancien mot de passe" maxlength="20" required>
                        <input type="password" id="pass" name="new-pass-user" placeholder="Nouveau mot de passe" maxlength="20" >
                        <input type="password" id="pass" name="confirm_new-pass-user" placeholder="Confirmation nouveau mot de passe" maxlength="20" required>
                    </div>
                </div>
                <div>
                    <label for="sexe"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeSexe.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <?php
                        if($sexe == "Homme")
                            echo '<input type="radio" name="sexe" value="Homme" id="homme" checked><label for="homme">Homme</label>';
                        else
                            echo '<input type="radio" name="sexe" value="Homme" id="homme"><label for="homme">Homme</label>';

                        if($sexe == "Femme")
                            echo '<input type="radio" name="sexe" value="Femme" id="femme" checked><label for="femme">Femme</label>';
                        else
                            echo '<input type="radio" name="sexe" value="Femme" id="femme"><label for="femme">Femme</label>';
                            
                        if($sexe == "Autre")
                            echo '<input type="radio" name="sexe" value="Autre" id="autre" checked><label for="autre">Autre</label>';
                        else
                            echo '<input type="radio" name="sexe" value="Autre" id="autre"><label for="autre">Autre</label>';
                    ?>
                </div>
                <div class="boutons">
                    <label for="bouton"></label>
                    <input type="submit" name="update" id="bouton" class="boutonUpdate" value="MODIFIER">
                    <input type="reset" name="effacer" id="bouton" class="boutonRemove" value="EFFACER">
                </div>
            </form>
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>