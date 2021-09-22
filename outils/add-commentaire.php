<?php
    session_start();

    if(!isset($_POST['commenter'])){
        header('Location: ../accueil.php');
        exit;
    }else{
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s');

        include_once('../outils/connex.inc.php');
        $idcom = connex('network','myparam');

        $utilisateur = $_SESSION['pseudo'];
        $publication = $_POST['pub-comment'];
        $texte = mysqli_real_escape_string($idcom,trim($_POST['com']));
        $loc = $_POST['location'];

        $addCom = "INSERT INTO commenter (`pseudo`,`idpub`,`texte`,`date_com`) VALUES('$utilisateur','$publication','$texte','$date')";

        $com = mysqli_query($idcom,$addCom);
    }
    
    header('Location: '.$loc.'');
    exit;
?>