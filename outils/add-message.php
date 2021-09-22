<?php
    session_start();

    if(!isset($_POST['sent'])){
        header('Location: ../messagerie.php');
        exit;
    }else{
        $expediteur = $_POST['expediteurMessage'];
        $destinataire = $_POST['destinataireMessage'];

        if(!empty($_POST['message'])){
            include_once('../outils/connex.inc.php');
            $idcom = connex('network','myparam');

            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');

            $texte = mysqli_real_escape_string($idcom,trim($_POST['message']));
        
            $requete = "INSERT INTO messagerie (`pseudoexp`,`pseudodest`,`datemessage`,`message`) VALUES('$expediteur','$destinataire','$date','$texte')";
            $resultat = mysqli_query($idcom,$requete);
  
        }
        header('Location: ../messagerie.php?destinataire='.$destinataire.'&openMessage=Envoyer+un+message');
        exit;
        
    }

    
?>