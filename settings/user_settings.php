<?php
    session_start();

    require_once '../login/check_is_logged.php';
    require_once '../connection/connection.php';
    require_once '../sites/customers/if_exist_display.php';

    try {
        $connection = openConnection();
        $userID =  $_SESSION['logged'];

        $tsql = "SELECT RTRIM(Uzytkownik) as 'Uzytkownik' FROM uzytkownicy WHERE ID_uzytkownika='$userID'";
        $getUser = sqlsrv_query($connection, $tsql);

        if (!$getUser)
            throw new Exception;

        $user = sqlsrv_fetch_array($getUser, SQLSRV_FETCH_ASSOC);

        sqlsrv_free_stmt($getUser);
        sqlsrv_close($connection);

    } catch (Exception $e) {
        $_SESSION['confirmation'] = '<span class="error">Błąd edytowania zlecenia</span>';
        header('Location: ../sites/menu.php');
    }
    
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia użytkownika</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/show_all.css">
    <link rel="stylesheet" href="../css/show_customers.css">
</head>
<body>
    <div class="container">
        <div class="form__header">
            Zmiana <span class="color-green">Loginu</span> 
        </div>

        <form action="../login/new_login.php" method="post">

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="oldLogin" class="form__input">Stary login</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="oldLogin" name="oldLogin" placeholder="Wpisz stary login" value="<?php echo $user['Uzytkownik']; ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_newLogin_oldLogin');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="newLogin" class="form__input">Nowy login</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="newLogin" name="newLogin" placeholder="Wpisz nowy login" value="">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_newLogin_newLogin');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="password" class="form__input">Hasło</label>
                </div>
                <div class="col form__cell">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Wpisz hasło użytkownika" value="">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_newLogin_password');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col error">
                    <?php
                        ifExistDisplay('error_newLogin');
                    ?>
                </div>
                <input type="submit" value="Zmień" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='../index.php'">
            </div>

        </form>

    </div>

    <div class="container">
        <div class="form__header">
            Zmiana <span class="color-green">Hasła</span> 
        </div>

        <form action="../login/new_password.php" method="post">

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="login" class="form__input">Login</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="login" name="login" placeholder="Wpisz login" value="<?php echo $user['Uzytkownik']; ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_newPassword_login');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="oldPassword" class="form__input">Stare hasło</label>
                </div>
                <div class="col form__cell">
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Wpisz stare hasło" value="">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_newPassword_oldPassword');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="newPassword" class="form__input">Nowe hasło</label>
                </div>
                <div class="col form__cell">
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Wpisz nowe hasło" value="">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_newPassword_newPassword');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col error">
                    <?php
                        ifExistDisplay('error_newPassword');
                    ?>
                </div>
                <input type="submit" value="Zmień" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='../index.php'">
            </div>

        </form>

    </div>

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>