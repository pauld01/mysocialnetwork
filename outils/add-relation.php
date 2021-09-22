<?php
    session_start();

    $pseudo1 = $_POST['pseudo-1'];
    $pseudo2 = $_POST['pseudo-2'];

    include_once('connex.inc.php');
    $idcom = connex('network','myparam');
    
    $addRelation = "INSERT INTO relation VALUES('$pseudo1','$pseudo2')";
    $add = mysqli_query($idcom,$addRelation);
    
    header('Location: ../voir-profil.php?pseudo='.$pseudo2);
    exit;
?>