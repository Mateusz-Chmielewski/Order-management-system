<?php
    function openConnection() {
        require_once 'connection_data.php';

        $connectionOptions = array( "Database" => $db_name, "Uid" => $db_user, "PWD" => $db_password, "CharacterSet" => "UTF-8");
        $connection = sqlsrv_connect($db_host, $connectionOptions);

        if (!$connection)
            die(print_r(sqlsrv_errors()));
        else echo "OK";
        
        return $connection;
    }
?>