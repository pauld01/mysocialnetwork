<?php
    session_start();

    if(!isset($_POST['supprimer'])){
        header('Location: ../profil.php');
        exit;
    }else{
        $pseudo = $_POST['pseudo'];

        include_once('connex.inc.php');
        $idcom = connex('network','myparam');

        $removeRelations = "DELETE FROM relation WHERE pseudo1=\"$pseudo\" OR pseudo2=\"$pseudo\"";
        $relations = mysqli_query($idcom,$removeRelations);

        $removeCommentaires = "DELETE FROM commenter WHERE pseudo=\"$pseudo\"";
        $commentaires = mysqli_query($idcom,$removeCommentaires);

        $removeLikes = "DELETE FROM aimer WHERE pseudo=\"$pseudo\"";
        $likes = mysqli_query($idcom,$removeLikes);

        $removePublications = "DELETE FROM publication WHERE pseudo=\"$pseudo\"";
        $publications = mysqli_query($idcom,$removePublications);

        $removeMessages = "DELETE FROM messagerie WHERE pseudoexp=\"$pseudo\" OR pseudodest=\"$pseudo\"";
        $messages = mysqli_query($idcom,$removeMessages);

        $removeProfil = "DELETE FROM profil WHERE pseudo=\"$pseudo\"";
        $profil = mysqli_query($idcom,$removeProfil);

        $removeVisibiliter = "DELETE FROM visibiliter WHERE pseudo=\"$pseudo\"";
        $visibiliter = mysqli_query($idcom,$removeVisibiliter);

        $removeUtilisateur = "DELETE FROM utilisateur WHERE pseudo=\"$pseudo\"";
        $utilisateur = mysqli_query($idcom,$removeUtilisateur);

        

        if($utilisateur && $profil && $messages && $publications && $likes && $commentaires && $relations){
            echo "<script type=\"text/javascript\"> alert('Votre compte a bien été supprimé nous sommes désolé de vous perdre ! On espère vous revoir vite chez MSN :-) !')</script>";
            
            header('Location: ../deconnexion.php');
            exit;
        }else{
            echo "<script type=\"text/javascript\"> alert('OUPS ! Un problème est survenu et votre compte n'a pas été correctement supprimé...')</script>";
            header('Location: ../profil.php');
            exit;
        }
    }
?>