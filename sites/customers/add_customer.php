<?php
    session_start();

    require_once '../../login/check_is_logged.php';
    require_once 'if_exist_display.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy klient</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/site.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/show_all.css">
    <link rel="stylesheet" href="../../css/show_customers.css">
</head>
<body>
    
    <div class="container">
        <div class="form__header">
            Nowy <span class="color-green">Klient</span> 
        </div>

        <form action="insert_customer.php" method="post">
            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="customerFirstName" class="form__input">Imie</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="customerFirstName" maxlength="20" name="customerFirstName" placeholder="Imie" value="<?php ifExistDisplay('remember_customerFirstName'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_customerFirstName');
                        ?>
                    </small>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="customerLastName" class="form__input">Nazwisko</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="customerLastName" maxlength="30" name="customerLastName" placeholder="Nazwisko" value="<?php ifExistDisplay('remember_customerLastName'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_customerLastName');
                        ?>
                    </small>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="customerPhone" class="form__input">Telefon</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="customerPhone" maxlength="15" name="customerPhone" placeholder="111222333" value="<?php ifExistDisplay('remember_customerPhone'); ?>">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="customerMail" class="form__input">Email</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="customerMail" name="customerMail" placeholder="nazwa@domena.pl" value="<?php ifExistDisplay('remember_customerMail'); ?>">
                </div>
            </div>
            <div class="row form-group">
                <div class="col invisible"></div>
                <div class="col error"><?php ifExistDisplay('error_customer') ?></div>
                <input type="submit" value="Dodaj" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='show_customers.php'">
            </div>
        </form>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>