<?php
    session_start();

    $host = $_POST['host'];
    $name = $_POST['name'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $login = $_POST['login'];
    $lpassword1 = $_POST['lpassword1'];
    $lpassword2 = $_POST['lpassword2'];

    if (empty($login) || empty($lpassword1) || empty($lpassword2) || !ctype_alnum($login) || !ctype_alnum($lpassword1) || !ctype_alnum($lpassword2)) {
        $error = 'Pole może zawierać tylko litery i cyfry';

        if (!ctype_alnum($login))
            $_SESSION['error_login'] = $error;

        if (!ctype_alnum($lpassword1) || !ctype_alnum($lpassword2))
            $_SESSION['error_lpassword'] = $error;

        $error = 'Pole nie może być puste';

        if (empty($login))
            $_SESSION['error_login'] = $error;
    
        if (empty($lpassword1) || empty($lpassword2))
            $_SESSION['error_lpassword'] = $error;

        header('Location: connection_settings.php');
        exit();
    }

    if ($lpassword1 != $lpassword2) {
        $_SESSION['error_lpassword'] = "Podane hasła nie są takie same";

        header('Location: connection_settings.php');
        exit();
    }


    $lpassword = password_hash($lpassword1, PASSWORD_DEFAULT);


    if (!file_exists(dirname(__DIR__)."\connection\connection_data.txt")) {
        $remember_host = "";
        $remember_name = "";
        $remember_user = "";
        $remember_password = "";
    } else {
        $readSettings = file_get_contents(dirname(__DIR__)."\connection\connection_data.txt");
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
        require '../connection/connection.php';
        $connection = openConnection();

        if (!createNewDatabase($name, $connection)) {
            $errorDatabaseName = 'Baza danych o tej  nazwie już isnieje';
            throw new Exception;
        }


        $tsql = "CREATE DATABASE $name";
        $newDatabase = sqlsrv_query($connection, $tsql);

        if (!$newDatabase)
            throw new Exception;

        sqlsrv_free_stmt($newDatabase);


        $tsql = "USE $name";
        $useNew = sqlsrv_query($connection, $tsql);
        sqlsrv_free_stmt($useNew);


        $tsql = file_get_contents("sql/create_statusy.sql");
        $createStateTable = sqlsrv_query($connection, $tsql);

        if (!$createStateTable)
            throw new Exception;

        sqlsrv_free_stmt($createStateTable);


        $states = array("Nowe", "Sprawdzanie", "W trakcie", "Do decyzji", "Zakończone", "Niepowodzenie", "Odmowa");

        for ($i = 0; $i < sizeof($states); $i++) {
            $tsql = "INSERT INTO statusy ([ID_status]) VALUES ('$states[$i]')";
            $insertStateTable = sqlsrv_query($connection, $tsql);

            if (!$insertStateTable)
                throw new Exception;

            sqlsrv_free_stmt($insertStateTable);
        }


        $tsql = file_get_contents("sql/create_klienci.sql");
        $createCustomersTable = sqlsrv_query($connection, $tsql);

        if (!$createCustomersTable)
            throw new Exception;

        sqlsrv_free_stmt($createCustomersTable);


        $tsql = file_get_contents("sql/create_zlecenia.sql");
        $createOrdersTable = sqlsrv_query($connection, $tsql);

        if (!$createOrdersTable)
            throw new Exception;

        sqlsrv_free_stmt($createOrdersTable);


        for ($i = 0; $i <=4; $i++) {
            $tsql = file_get_contents("sql/add_constraint".$i.".sql");
            $createConstraints = sqlsrv_query($connection, $tsql);

            if (!$createConstraints)
                throw new Exception;

            sqlsrv_free_stmt($createConstraints);
        }


        $tsql = file_get_contents("sql/create_uzytkownicy.sql");
        $createUsersTable = sqlsrv_query($connection, $tsql);

        if (!$createUsersTable)
            throw new Exception;

        sqlsrv_free_stmt($createUsersTable);


        $tsql = "INSERT INTO [uzytkownicy] ([Uzytkownik], [Haslo]) VALUES ('$login', '$lpassword')";
        $insertUser = sqlsrv_query($connection, $tsql);

        if (!$insertUser)
            print_r(sqlsrv_errors());

        sqlsrv_free_stmt($insertUser);


        sqlsrv_close($connection);

        $writeSettings = fopen("../connection/connection_data.txt", "w");
        $writeText = $host.';'.$name.';'.$user.';'.$password;
        fwrite($writeSettings, $writeText);
        fclose($writeSettings);

    } catch (Exception $e) {
        $writeSettings = fopen("../connection/connection_data.txt", "w");
        $writeText = $remember_host.';'.$remember_name.';'.$remember_user.';'.$remember_password;
        fwrite($writeSettings, $writeText);
        fclose($writeSettings);
        $_SESSION['error_databaseName'] = $errorDatabaseName;
        header('Location: connection_settings.php');
        exit();
    }

    session_unset();
    $_SESSION['confirmation'] = "Utworzono nową bazę danych";
    header('Location: ../index.php');

    function createNewDatabase($newName, $connection) {

        $tsql = "SELECT name FROM master.dbo.sysdatabases";
        $getDatabases = sqlsrv_query($connection, $tsql);

        while ($row = sqlsrv_fetch_array($getDatabases, SQLSRV_FETCH_ASSOC))
            if ($row['name'] == $newName) {
                sqlsrv_free_stmt($getDatabases);
                sqlsrv_close($connection);
                $errorDatabaseName = 'Baza danych o tej nazwie już istnieje';
                return false;
            }

        sqlsrv_free_stmt($getDatabases);

        return true;
    }
    
?>