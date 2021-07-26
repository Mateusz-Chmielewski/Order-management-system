<?php

    session_start();
    require_once '../sites/customers/if_exist_display.php';
    if (isset($_SESSION['logged'])) {
        header('Location: ../sites/menu.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/show_all.css">
    <link rel="stylesheet" href="../css/show_customers.css">
</head>
<body>

    <div class="container">
        <div class="form__header">
            Zaloguj <span class="color-green">się</span> 
        </div>

        <form action="log_in.php" method="post">

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="login" class="form__input">Login</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="login" maxlength="20" name="login" placeholder="Login" value="">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_login');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="password" class="form__input">Hasło</label>
                </div>
                <div class="col form__cell">
                    <input type="password" class="form-control" id="password" maxlength="20" name="password" placeholder="Hasło" value="">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_password');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col error"><?php ifExistDisplay('error_log_in'); ?></div>
                <input type="submit" value="Zaloguj się" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Ustawienia" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='../settings/connection_settings.php'">
            </div>

        </form>
    </div>

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>