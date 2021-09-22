<?php
    session_start();
    include_once('outils/connex.inc.php');

    $pseudo = false;

    if(isset($_SESSION['pseudo'])){
        header('Location: accueil.php');
        exit;
    }

    if(isset($_POST['connexion'])){
        $id = trim($_POST['login']);
        $pwd = trim($_POST['pass']);

        $modeleMail = "/^(([^ @])+)@((([a-z])?([[:digit:]])?(_|-)?)+)\.([a-zA-Z]{2,3})$/";

        $idcom = connex('network','myparam');

        if(preg_match($modeleMail,$id)){
            $requete = "SELECT * FROM utilisateur WHERE mail='$id' AND mdp='$pwd'";
        }
        else{
            $requete = "SELECT * FROM utilisateur WHERE pseudo='$id' AND mdp='$pwd'";
        }

        $resultat = mysqli_query($idcom,$requete);

        if(mysqli_num_rows($resultat) == 0){
            echo "<script type=\"text/javascript\"> alert('OUPS ! Il semble que l\'identifiant ou le mot de passe entré ne corresponde pas ! ')</script>";
        }
        else{
            $tab = mysqli_fetch_array($resultat,MYSQLI_NUM);
            $_SESSION['pseudo'] = $tab[0];
            $_SESSION['pwd'] = $tab[5];

            header('Location: accueil.php');
            exit;
        }
    }
?>
<html lang="fr">
    <head> 
		<meta name="AUTHOR" content="Paul DUPLESSI & Steven CARLIER">  
		<meta name="KEYWORDS" content="index">  
		<meta charset="UTF-8">
				
		<title> MySocialNetwork	</title>
		
		<link rel="stylesheet" type="text/css" href="styles/Style-index.css">
		<link rel="shortcut icon"  href="images/icone/logoV2_icone-T-32.png" >
    </head>

    <body>
        <header>
            <h2><pre> Bienvenue sur MySocialNetwork </pre></h2>
        </header>
        <article>
            <div class="connex">
                <form method="post" action="index.php">
                    <fieldset>
                        <h3> Connexion </h3>
                        <div class="ident">
                            <div class="identID">
                                <img class='iconeID' src='images/iconesForm/iconeID-connexion.png' alt="oups un problème est survenu dans l'affichage">
                                <input type="text" name="login" placeholder="Pseudo ou e-mail" required/><br/>
                            </div>
                            <div class="identMDP">
                                <img class='iconeMDP' src='images/iconesForm/iconeMDP-connexion.png' alt="oups un problème est survenu dans l'affichage">
                                <input type="password" name="pass" placeholder="Mot de passe" required/><br/><br/>
                            </div> 
                            <input type="submit" name="connexion" value="SE CONNECTER"/>
                        </div>
                    </fieldset>
                    <h5>Si vous ne possédez pas de compte vous pouvez vous en <a href="inscriptions.php"> créer un </a></h5>
                </form>
            </div>
            <img class='logo' src='images/logo/logoV2-T-1000.png' alt="oups un problème est survenu dans l'affichage">
        </article>
        <footer>
			<div>
				<a href="contact.php"> J'ai besoin d'aide </a> | <a href="a-propos.php"> &Agrave propos</a>
			</div>
		</footer>
    </body>
</html>