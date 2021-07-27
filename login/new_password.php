<?php
    session_start();
    require_once 'check_is_logged.php';

    $login = $_POST['login'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    if (empty($login) || empty($oldPassword) || empty($newPassword) || !ctype_alnum($login) || !ctype_alnum($oldPassword) || !ctype_alnum($newPassword)) {
        $error = 'Pole może zawierać tylko litery i cyfry';

        if (!ctype_alnum($login))
            $_SESSION['error_newPassword_login'] = $error;

        if (!ctype_alnum($oldPassword))
            $_SESSION['error_newPassword_oldPassword'] = $error;

        if (!ctype_alnum($newPassword))
            $_SESSION['error_newPassword_newPassword'] = $error;

        $error = 'Pole nie może być puste';

        if (empty($login))
            $_SESSION['error_newPassword_login'] = $error;

        if (empty($oldPassword))
            $_SESSION['error_newPassword_oldPassword'] = $error;
    
        if (empty($newPassword))
            $_SESSION['error_newPassword_newPassword'] = $error;

        header('Location: ../settings/user_settings.php');
        exit();
    }

    $errorNewPassword = "Nie udało się zmienić hasła";
    try {
        require_once '../connection/connection.php';

        $connection = openConnection();

        $tsql = "SELECT * FROM uzytkownicy WHERE Uzytkownik='$login'";
        $getUser = sqlsrv_query($connection, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

        if (!$getUser) 
            throw new Exception;
        
        $row = sqlsrv_fetch_array($getUser, SQLSRV_FETCH_ASSOC);

        if (sqlsrv_num_rows($getUser) < 1 || !password_verify($oldPassword, $row['Haslo'])) {
            $errorNewPassword = "Błędny login lub hasło";
            throw new Exception;
        }

        sqlsrv_free_stmt($getUser);

        $password = password_hash($newPassword, PASSWORD_DEFAULT);
        $tsql = "UPDATE uzytkownicy SET Haslo = '$password' WHERE Uzytkownik='$login'";
        $setPassword = sqlsrv_query($connection, $tsql);

        if (!$setPassword) 
            throw new Exception;

        sqlsrv_free_stmt($setPassword);
        session_unset();
        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['error_newPassword'] = $errorNewPassword;
        header('Location: ../settings/user_settings.php');
        exit();
    }

    session_start();
    $_SESSION['error_log_in'] = '<span class="confirmation">Hasło zostało zmienione</span>';
    header('Location: ../index.php');

?>