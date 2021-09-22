<?php
    //on prend la date actuel qui correpondra à la date d'inscription à la seconde près
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s');


    include_once('outils/connex.inc.php');
    include_once('outils/confirm_mail.php');
    include_once('outils/confirm_mdp.php');
    include_once('outils/verif_pseudo.php');
    include_once('outils/verif_mail.php');
    
    if (isset($_POST['inscription'])){
        if (confirm_mail($_POST['eMail-user'],$_POST['confirm_eMail-user'])){
            $mail = trim($_POST['eMail-user']);

            if (confirm_pass($_POST['pass-user'],$_POST['confirm_pass-user'])){
                $pass = trim($_POST['pass-user']);

                if (verif_pseudo($_POST['pseudo-user'])){
                    $pseudo = trim($_POST['pseudo-user']);

                    if (verif_mail($mail)){ //si les mails sont identique et que le mail et le pseudo ne sont pas déjà présent dans la base on peut ajouter les informations
                        $nom = trim($_POST['nom-user']);
                        $prenom = trim($_POST['prenom-user']);
                        $tel = trim($_POST['phone-user']);
                        $mail = trim($_POST['eMail-user']);
                        $mdp = trim($_POST['pass-user']);
                        $naissance = $_POST['dateNaissance-user'];
                        $sexe = $_POST['sexe'];

                        $idcom = connex('network','myparam');
                        $requeteUtilisateur = "INSERT INTO utilisateur VALUES('$pseudo','$nom','$prenom','$tel','$mail','$mdp','$naissance','$sexe','$date')";
                        $utilisateur = mysqli_query($idcom,$requeteUtilisateur);

                        if ($utilisateur){
                            echo "<script type=\"text/javascript\"> alert('Bienvenue chez MySocialNetwork votre inscription a bien été prise en compte ! Vous pouvez retourner à l'accueil pour vous connecter ! ')</script>";
                            //on créer un nouveau profil correpondant à l'utilisateur avec son pseudo
                            $requeteProfil = "INSERT INTO `profil` (`pseudo`) VALUES('$pseudo')";
                            $profil = mysqli_query($idcom,$requeteProfil);
                            //on créer le fichier image du profil dans le fichier bd
                            $chemin = 'bd/images/'.$pseudo.'';
                            mkdir($chemin);
                            $chemin = 'bd/images/'.$pseudo.'/photos';
                            mkdir($chemin);
                            $chemin = 'bd/images/'.$pseudo.'/videos';
                            mkdir($chemin);
                            $requeteVisibilier = "INSERT INTO `visibiliter` (`pseudo`) VALUES('$pseudo')";
                            $visibiliter = mysqli_query($idcom,$requeteVisibilier);
                        }
                        else{
                            echo "<script type=\"text/javascript\"> alert('Erreur : ".mysqli_error()."')</script>";  
                        }
                    }
                    else{
                        echo "<script type=\"text/javascript\"> alert('OUPS ! Le mail entré existe déjà sur notre site essayé de vous connecter ou contactez nous dans \"J\'ai besoin d'aide\" ! ')</script>";
                    }
                }
                else{
                    echo "<script type=\"text/javascript\"> alert('OUPS ! Le pseudo entré existe déjà sur notre site essayé avec un autre pseudo ou tentez de vous connecter ! ')</script>";
                }
            }
            else{
                echo "<script type=\"text/javascript\"> alert('OUPS ! Il semble que les deux mots de passe entrés ne soit pas les mêmes ')</script>";
            }
        }
        else{
            echo "<script type=\"text/javascript\"> alert('OUPS ! Il semble que les e-mails entrés ne soit pas les mêmes ')</script>";
        } 
    }
    
?>
<html lang="fr">
    <head> 
        <meta charset="UTF-8">
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="inscription">  
	
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-inscription.css">
		<link rel="shortcut icon"  href="images/icone/logoV2_icone-T-32.png" >
    </head>

    <body>
        <header>
            <nav class="menu">
                <div class="navMenu-Logo" style="background-image: url(images/logo/logoV2-T_s-110.png)"></div>
                <h2><pre> Formulaire d'inscription </pre></h2>
            </nav>
        </header>
       
        <article>
            <form method="post" action="inscriptions.php" enctype="application/x-www-form-urlencoded">
                <div>
                    <label for="user"><img class='iconeInscr' src='images/iconesForm/Contact_IconeUser.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="text" id="user" name="prenom-user" placeholder="Prénom" maxlength="30" required>
                    <input type="text" id="user" name="nom-user" placeholder="Nom" maxlength="30" required>
                    <input type="text" id="user" name="pseudo-user" placeholder="Pseudo" maxlength="15" required>
                </div>
                <div>
                    <label for="phone"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeTel.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="tel" id="phone" name="phone-user" placeholder="Téléphone">
                </div>
                <div>
                    <label for="eMail"><img class='iconeInscr' src='images/iconesForm/Contact_IconeMail.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="mail" id="eMail" name="eMail-user" placeholder="E-mail" required>
                    <input type="mail" id="eMail" name="confirm_eMail-user" placeholder="Confirmation e-mail" required>
                </div>
                <div>
                    <label for="pass"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeMDP.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="password" id="pass" name="pass-user" placeholder="Mot de passe" maxlength="20" required>
                    <input type="password" id="pass" name="confirm_pass-user" placeholder="Confirmation mot de passe" maxlength="20" required>
                </div>
                <div>
                    <label for="naissance"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeDate.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="date" id="naissance" name="dateNaissance-user" value="jj/mm/aaaa">
                </div>
                <div>
                    <label for="sexe"><img class='iconeInscr' src='images/iconesForm/Inscription_IconeSexe.png' alt="oups un problème est survenu dans l'affichage"></label>
                    <input type="radio" name="sexe" value="Homme" id="homme" checked><label for="homme">Homme</label>
                    <input type="radio" name="sexe" value="Femme" id="femme"><label for="femme">Femme</label>
                    <input type="radio" name="sexe" value="Autre" id="autre"><label for="autre">Autre</label>
                </div>
                <div class="boutons">
                    <label for="bouton"></label>
                    <input type="submit" name="inscription" id="bouton" class="boutonInscrire" value="S'INSCRIRE">
                    <input type="reset" name="effacer" id="bouton" class="boutonEfface" value="EFFACER">
                    <input type="button" name="accueil" id="bouton" class="boutonAnnule" onclick="window.location.href = 'index.php';" value="ACCUEIL">
                </div>
                <div class="imgForm">
                    <img class='reseaux' src='images/social-media-3846597_1280.png' alt="oups un problème est survenu dans l'affichage">
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
