<?php
    session_start();

    if(!isset($_POST['supprimer'])){
        header('Location: ../profil.php');
        exit;
    }else{
        $pseudo = $_POST['pseudo'];
        $idcommentaire = $_POST['idcom'];
        $loc = $_POST['location'];

        include_once('connex.inc.php');
        $idcom = connex('network','myparam');

        $removeCommentaires = "DELETE FROM commenter WHERE pseudo=\"$pseudo\" AND idcom=\"$idcommentaire\"";
        $commentaires = mysqli_query($idcom,$removeCommentaires);
    }

    header('Location: '.$loc.'');
    exit;
?>