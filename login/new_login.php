<?php
    session_start();
    require_once 'check_is_logged.php';

    $oldLogin = $_POST['oldLogin'];
    $newLogin = $_POST['newLogin'];
    $password = $_POST['password'];

    if (empty($oldLogin) || empty($newLogin) || empty($password) || !ctype_alnum($oldLogin) || !ctype_alnum($newLogin) || !ctype_alnum($password)) {
        $error = 'Pole może zawierać tylko litery i cyfry';

        if (!ctype_alnum($oldLogin))
            $_SESSION['error_newLogin_oldLogin'] = $error;

        if (!ctype_alnum($newLogin))
            $_SESSION['error_newLogin_newLogin'] = $error;

        if (!ctype_alnum($password))
            $_SESSION['error_newLogin_password'] = $error;

        $error = 'Pole nie może być puste';

        if (empty($oldLogin))
            $_SESSION['error_newLogin_oldLogin'] = $error;

        if (empty($newLogin))
            $_SESSION['error_newLogin_newLogin'] = $error;
    
        if (empty($password))
            $_SESSION['error_newLogin_password'] = $error;

        header('Location: ../settings/user_settings.php');
        exit();
    }

    $errorNewLogin = "Nie udało się zmienić loginu";
    try {
        require_once '../connection/connection.php';

        $connection = openConnection();

        $tsql = "SELECT * FROM uzytkownicy WHERE Uzytkownik='$newLogin'";
        $checkUser = sqlsrv_query($connection, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

        if (!$checkUser) 
            throw new Exception;
        
        $row = sqlsrv_fetch_array($checkUser, SQLSRV_FETCH_ASSOC);

        if (sqlsrv_num_rows($checkUser) > 0 ) {
            $errorNewLogin = "Taki login jest już zajęta";
            throw new Exception;
        }

        sqlsrv_free_stmt($checkUser);

        $tsql = "SELECT * FROM uzytkownicy WHERE Uzytkownik='$oldLogin'";
        $getUser = sqlsrv_query($connection, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

        if (!$getUser) 
            throw new Exception;
        
        $row = sqlsrv_fetch_array($getUser, SQLSRV_FETCH_ASSOC);

        if (sqlsrv_num_rows($getUser) < 1 || !password_verify($password, $row['Haslo'])) {
            $errorNewLogin = "Błędny login lub hasło";
            throw new Exception;
        }

        sqlsrv_free_stmt($getUser);

        $tsql = "UPDATE uzytkownicy SET Uzytkownik = '$newLogin' WHERE Uzytkownik='$oldLogin'";
        $setLogin = sqlsrv_query($connection, $tsql);

        if (!$setLogin) 
            throw new Exception;

        sqlsrv_free_stmt($setLogin);
        session_unset();
        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['error_newLogin'] = $errorNewLogin;
        header('Location: ../settings/user_settings.php');
        exit();
    }

    session_start();
    $_SESSION['error_log_in'] = '<span class="confirmation">Login został zmieniony</span>';
    header('Location: ../index.php');

?>