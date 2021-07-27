<?php
    session_start();
    require_once 'check_is_logged.php';

    $login = $_POST['login'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (empty($login) || empty($password1) || empty($password2) || !ctype_alnum($login) || !ctype_alnum($password1) || !ctype_alnum($password2)) {
        $error = 'Pole może zawierać tylko litery i cyfry';

        if (!ctype_alnum($login))
            $_SESSION['error_newUser_login'] = $error;

        if (!ctype_alnum($password1) || !ctype_alnum($password2))
            $_SESSION['error_newUser_password'] = $error;

        $error = 'Pole nie może być puste';

        if (empty($login))
            $_SESSION['error_newUser_login'] = $error;
    
        if (empty($password1) || empty($password2))
            $_SESSION['error_newUser_password'] = $error;

        header('Location: ../settings/user_settings.php');
        exit();
    }

    if ($password1 != $password2) {
        $_SESSION['error_newUser_password'] = "Podane hasła nie są takie same";

        header('Location: ../settings/user_settings.php');
        exit();
    }

    $errorNewUser = "Nie udało się dodać użytkownika";
    try {
        require_once '../connection/connection.php';

        $connection = openConnection();

        $tsql = "SELECT * FROM uzytkownicy WHERE Uzytkownik='$login'";
        $checkUser = sqlsrv_query($connection, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

        if (!$checkUser) 
            throw new Exception;
        
        $row = sqlsrv_fetch_array($checkUser, SQLSRV_FETCH_ASSOC);

        if (sqlsrv_num_rows($checkUser) > 0 ) {
            $errorNewUser = "Taki login jest już zajęta";
            throw new Exception;
        }

        sqlsrv_free_stmt($checkUser);


        $password = password_hash($password1, PASSWORD_DEFAULT);
        $tsql = "INSERT INTO uzytkownicy (Uzytkownik, Haslo) VALUES ('$login', '$password')";
        $insertUser = sqlsrv_query($connection, $tsql);

        if (!$insertUser) 
            throw new Exception;

        sqlsrv_free_stmt($insertUser);

        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['error_newUser'] = $errorNewUser;
        header('Location: ../settings/user_settings.php');
        exit();
    }

    $_SESSION['confirmation'] = 'Nowy użytkownik został dodany';
    header('Location: ../index.php');

?>