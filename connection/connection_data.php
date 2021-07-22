<?php
    
    $file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/oms/connection/connection_data.txt");
    $split = explode(";", $file);

    $db_host = $split[0];
    $db_name = $split[1];
    $db_user = $split[2];
    $db_password = $split[3];

?>