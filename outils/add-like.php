<?php
    session_start();

    if(!isset($_POST['liker'])){
        header('Location: ../accueil.php');
        exit;
    }else{
        include_once('../outils/connex.inc.php');
        $utilisateur = $_SESSION['pseudo'];
        $publication = $_POST['pub-like'];
        $loc = $_POST['location'];

        $idcom = connex('network','myparam');

        $requete = "INSERT INTO aimer VALUES('$utilisateur','$publication')";

        $resultat = mysqli_query($idcom,$requete);
    }
    
    header('Location: '.$loc.'');
    exit;
?>