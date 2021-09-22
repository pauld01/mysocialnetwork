<?php
    function confirm_mail($mail1,$mail2){
        if (strcmp(strtoupper($mail1),strtoupper($mail2)) == 0)
            return true;
        else
            return false;
    }
?>