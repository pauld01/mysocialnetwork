<?php
    function confirm_pass($mdp1,$mdp2){
        if (strcmp($mdp1,$mdp2) == 0)
            return true;
        else
            return false;
    }
?>