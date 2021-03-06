<?php
    function openConnection() {
        require 'connection_data.php';

        $connectionOptions = array( "Database" => $db_name, "Uid" => $db_user, "PWD" => $db_password, "CharacterSet" => "UTF-8", "ReturnDatesAsStrings" => true);
        $connection = sqlsrv_connect($db_host, $connectionOptions);

        if (!$connection)
            echo '<span class="error">Błąd połączenia z serwerem <br> </span>';
        
        return $connection;
    }
?>