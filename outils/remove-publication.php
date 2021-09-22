<?php
    session_start();

    if(!isset($_POST['supprimer'])){
        header('Location: ../profil.php');
        exit;
    }else{
        $pseudo = $_POST['pseudo'];
        $idpub = $_POST['idpub'];
        $loc = $_POST['location'];

        include_once('connex.inc.php');
        $idcom = connex('network','myparam');

        $removeCommentaires = "DELETE FROM commenter WHERE idpub=\"$idpub\"";
        $commentaires = mysqli_query($idcom,$removeCommentaires);

        $removeLike = "DELETE FROM aimer WHERE idpub=\"$idpub\"";
        $likes = mysqli_query($idcom,$removeLike);

        $removePublication = "DELETE FROM publication WHERE idpub=\"$idpub\" AND pseudo=\"$pseudo\"";
        $publication = mysqli_query($idcom,$removePublication);
    }

    header('Location: '.$loc.'');
    exit;
?>