<?php
    function countLike($pub){
        include_once('connex.inc.php');

        $idcom = connex('network','myparam');

        $requete = "SELECT * FROM aimer WHERE idpub=\"$pub\"";
        $like = mysqli_query($idcom,$requete);
        $nbLike = count(mysqli_fetch_all($like,MYSQLI_NUM));

        return $nbLike;
    }
?>