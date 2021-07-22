<?php
    session_start();

    $host = $_POST['host'];
    $name = $_POST['name'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/oms/connection/connection_data.txt")) {
        $remember_host = "";
        $remember_name = "";
        $remember_user = "";
        $remember_password = "";
    } else {
        $readSettings = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/oms/connection/connection_data.txt");
        $split = explode(";", $readSettings);

        $remember_host = $split[0];
        $remember_name = $split[1];
        $remember_user = $split[2];
        $remember_password = $split[3];
    }

    $writeSettings = fopen("../connection/connection_data.txt", "w");
    $writeText = $host.';master;'.$user.';'.$password;
    fwrite($writeSettings, $writeText);
    fclose($writeSettings);

    $errorDatabaseName = 'Błąd utworzenia nowej bazy danych';
    try {
        if (!createNewDatabase($name)) {
            $errorDatabaseName = 'Baza danych o tej nazwie już istnieje';
            throw new Exception;
        }


    } catch (Exception $e) {
        $writeSettings = fopen("../connection/connection_data.txt", "w");
        $writeText = $remember_host.';'.$remember_name.';'.$remember_user.';'.$remember_password;
        fwrite($writeSettings, $writeText);
        fclose($writeSettings);
        $_SESSION['error_databaseName'] = $errorDatabaseName;
        header('Location: connection_settings.php');
        exit();
    }

    $writeSettings = fopen("../connection/connection_data.txt", "w");
    $writeText = $host.';'.$name.';'.$user.';'.$password;
    fwrite($writeSettings, $writeText);
    fclose($writeSettings);

    $_SESSION['confirmation'] = "Utworzono nową bazę danych";
    // header('Location: ../index.php');

    function createNewDatabase($newName) {
        require '../connection/connection.php';

        $connection = openConnection();
        $tsql = "SELECT name FROM master.dbo.sysdatabases";
        $getDatabases = sqlsrv_query($connection, $tsql);

        while ($row = sqlsrv_fetch_array($getDatabases, SQLSRV_FETCH_ASSOC))
            if ($row['name'] == $newName) {
                sqlsrv_free_stmt($getDatabases);
                sqlsrv_close($connection);
                return false;
            }

        sqlsrv_free_stmt($getDatabases);
        sqlsrv_close($connection);
        return true;
    }
    
?>