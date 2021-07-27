<?php
    session_start();

    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password) || !ctype_alnum($login) || !ctype_alnum($password)) {
        $error = 'Pole może zawierać tylko litery i cyfry';

        if (!ctype_alnum($login))
            $_SESSION['error_login'] = $error;

        if (!ctype_alnum($password))
            $_SESSION['error_password'] = $error;

        $error = 'Pole nie może być puste';

        if (empty($login))
            $_SESSION['error_login'] = $error;
    
        if (empty($password))
            $_SESSION['error_password'] = $error;

        header('Location: login_form.php');
        exit();
    }

    $errorLogIn = "Błąd logowania";
    try {
        require_once '../connection/connection.php';

        $connection = openConnection();
        $tsql = "SELECT * FROM uzytkownicy WHERE Uzytkownik='$login'";
        $getUser = sqlsrv_query($connection, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

        if (!$getUser) 
            throw new Exception;
        
        $row = sqlsrv_fetch_array($getUser, SQLSRV_FETCH_ASSOC);

        if (sqlsrv_num_rows($getUser) < 1 || !password_verify($password, $row['Haslo'])) {
            $errorLogIn = "Błędny login lub hasło";
            throw new Exception;
        }

        $_SESSION['logged'] = $row['ID_uzytkownika'];

        sqlsrv_free_stmt($getUser);

        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['error_log_in'] = $errorLogIn;
        header('Location: login_form.php');
        exit();
    }

    $_SESSION['confirmation'] = "Zostałeś pomyślnie zalogowany";
    header('Location: ../index.php');
?>