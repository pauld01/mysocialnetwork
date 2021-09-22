<?php
    session_start();

    if(!isset($_POST['publier'])){
        header('Location: ../accueil.php');
        exit;
    }else{
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d h:i:s');

        include_once('../outils/connex.inc.php');
        $idcom = connex('network','myparam');
        
        $utilisateur = $_SESSION['pseudo'];
        $texte = mysqli_real_escape_string($idcom,trim($_POST['text-publication']));

        if(empty($_FILES["image"]["name"]) && empty($_FILES["video"]["name"])){
            $requete = "INSERT INTO publication (`texte`,`datepub`,`pseudo`) VALUES('$texte','$date','$utilisateur')";
        }
        else{
            if(!empty($_FILES["image"]["name"]) && empty($_FILES["video"]["name"])){
                $image = 'bd/images/'.$utilisateur.'/photos'.'/'.$_FILES["image"]["name"].'';
                $requete = "INSERT INTO publication (`image`,`texte`,`datepub`,`pseudo`) VALUES('$image','$texte','$date','$utilisateur')";
                $imageToMove = '../bd/images/'.$utilisateur.'/photos'.'/'.$_FILES["image"]["name"].'';
                $moveImg = move_uploaded_file($_FILES["image"]["tmp_name"],$imageToMove);
            }
            else{
                if(!empty($_FILES["video"]["name"]) && empty($_FILES["image"]["name"])){
                    $video = 'bd/images/'.$utilisateur.'/videos'.'/'.$_FILES["video"]["name"].'';
                    $requete = "INSERT INTO publication (`video`,`texte`,`datepub`,`pseudo`) VALUES('$video','$texte','$date','$utilisateur')";
                    $videoToMove = '../bd/images/'.$utilisateur.'/videos'.'/'.$_FILES["video"]["name"].'';
                    $moveVid = move_uploaded_file($_FILES["video"]["tmp_name"],$videoToMove);
                }
                else{
                    $image = 'bd/images/'.$utilisateur.'/photos'.'/'.$_FILES["image"]["name"].'';
                    $video = 'bd/images/'.$utilisateur.'/videos'.'/'.$_FILES["video"]["name"].'';
                    $requete = "INSERT INTO publication (`image`,`video`,`texte`,`datepub`,`pseudo`) VALUES('$image','$video','$texte','$date','$utilisateur')";
                    $imageToMove = '../bd/images/'.$utilisateur.'/photos'.'/'.$_FILES["image"]["name"].'';
                    $videoToMove = '../bd/images/'.$utilisateur.'/videos'.'/'.$_FILES["video"]["name"].'';
                    $moveImg = move_uploaded_file($_FILES["image"]["tmp_name"],$imageToMove);
                    $moveVid = move_uploaded_file($_FILES["video"]["tmp_name"],$videoToMove);
                }

            }
        }
        $resultat = mysqli_query($idcom,$requete);
    }

    header('Location: ../accueil.php');
    exit;
?>