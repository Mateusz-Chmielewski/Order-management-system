<?php
    $sqlState = " Status!='Niepowodzenie' AND Status!='Zakończone' AND Status!='Odmowa'";
    $showState = "Niezakończone";

    if (isset($_POST['state'])) {
        $showState = $_POST['state'];
        
        if ($showState == "Wszystkie")
            $sqlState = " 1=1 ";
        elseif ($showState == "Niezakończone")
            $sqlState = " Status!='Niepowodzenie' AND Status!='Zakończone' AND Status!='Odmowa'";
        else
            $sqlState = " Status='$showState' ";
    }

?>