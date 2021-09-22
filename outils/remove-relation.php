<?php
    session_start();

    $pseudo1 = $_POST['pseudo-1'];
    $pseudo2 = $_POST['pseudo-2'];

    include_once('connex.inc.php');
    $idcom = connex('network','myparam');
    
    $removeRelation = "DELETE FROM relation WHERE pseudo1=\"$pseudo1\" AND pseudo2=\"$pseudo2\"";
    $remove = mysqli_query($idcom,$removeRelation);
    
    header('Location: ../voir-profil.php?pseudo='.$pseudo2);
    exit;
?>