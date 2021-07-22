<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia połączenia</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/show_all.css">
    <link rel="stylesheet" href="../css/show_customers.css">
</head>
<body>
    <div class="container">
        <div class="form__header">
            Ustawienia <span class="color-green">Połączenia</span> 
        </div>

        <form action="save_connection_data.php" method="post">

            <?php
                require '../connection/connection_data.php';

            ?>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="host" class="form__input">Host</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="host" name="host" placeholder="Wpisz nazwę serwera" value="<?php echo $db_host; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="name" class="form__input">Nazwa</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Wpisz nazwę bazy danych" value="<?php echo $db_name; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="user" class="form__input">Użytkownik</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="user" name="user" placeholder="Wpisz nazwę użytkownika" value="<?php echo $db_user; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="password" class="form__input">Hasło</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Wpisz hasło użytkownika" value="<?php echo $db_password; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col invisible"></div>
                <input type="submit" value="Dodaj" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='../index.php'">
            </div>

        </form>

    </div>

    <div class="container">
        <div class="form__header">
            Nowa <span class="color-green">Baza danych</span> 
        </div>

        <form action="new_database.php" method="post">

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="host" class="form__input">Host</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="host" name="host" placeholder="Wpisz nazwę serwera" value="<?php echo $db_host; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="name" class="form__input">Nazwa</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Zostanie utworzona nowa baza danych o tej nazwie" value="">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="user" class="form__input"></label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="user" name="user" placeholder="Wpisz nazwę użytkownika" value="<?php echo $db_user; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="password" class="form__input">Hasło</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Wpisz hasło użytkownika" value="<?php echo $db_password; ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col invisible"></div>
                <input type="submit" value="Nowa" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='../index.php'">
            </div>

        </form>

    </div>

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>