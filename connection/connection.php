<?php
    function openConnection() {
        require_once 'connection_data.php';

        $connectionOptions = array( "Database" => $db_name, "Uid" => $db_user, "PWD" => $db_password, "CharacterSet" => "UTF-8");
        $connection = sqlsrv_connect($db_host, $connectionOptions);

        if (!$connection)
            echo '<span class="error">Błąd połączenia z serwerem</span>';
        
        return $connection;
    }
?>