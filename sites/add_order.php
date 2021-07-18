<?php
    session_start();

    require_once 'customers/if_exist_display.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy klient</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/show_all.css">
    <link rel="stylesheet" href="../css/show_customers.css">
</head>
<body>
    
    <div class="container">
        <div class="form__header">
            Nowe <span class="color-green">Zlecenie</span> 
        </div>

        <form action="insert_order.php" method="post">

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="orderDate" class="form__input">Data</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderDate" maxlength="20" name="orderDate" placeholder="YYYY-MM-DD" value="<?php ifExistDisplay('remember_orderDate'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderDate');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="orderState" class="form__input">Status</label>
                </div>
                <div class="col form__cell">
                    <select class="form-control" id="orderState" name="orderState" value="<?php ifExistDisplay('remember_orderState'); ?>">
                        <option>Nowe</option>
                        <option>Sprawdzanie</option>
                        <option>W trakcie</option>
                        <option>Do decyzji</option>
                        <option>Zakończone</option>
                        <option>Niepowodzenie</option>
                        <option>Odmowa</option>
                    </select>
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderState');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="orderFirstName" class="form__input">Imie</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderFirstName" maxlength="20" name="orderFirstName" placeholder="Imie" value="<?php ifExistDisplay('remember_orderFirstName'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderFirstName');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="orderLastName" class="form__input">Nazwisko</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderLastName" maxlength="30" name="orderLastName" placeholder="Nazwisko" value="<?php ifExistDisplay('remember_orderLastName'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderLastName');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="orderPhone" class="form__input">Telefon</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderPhone" maxlength="15" name="orderPhone" placeholder="111222333" value="<?php ifExistDisplay('remember_orderPhone'); ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="orderMail" class="form__input">Email</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderMail" name="orderMail" placeholder="nazwa@domena.pl" value="<?php ifExistDisplay('remember_orderMail'); ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="orderDevice" class="form__input">Sprzęt</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderDevice" name="orderDevice" placeholder="Laptop" value="<?php ifExistDisplay('remember_orderDevice'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderDevice');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="orderDescription" class="form__input">Opis</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control" id="orderDescription" name="orderDescription" placeholder="Opisz tutaj dokładnie problem z urządzeniem" value="<?php ifExistDisplay('remember_orderDescription'); ?>"></textarea>
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderDescription');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="orderComment" class="form__input">Uwagi</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control" id="orderComment" name="orderComment" placeholder="Możesz tutaj dodać uwagi dotyczące zlecenia" value="<?php ifExistDisplay('remember_orderComment'); ?>"></textarea>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="orderNote" class="form__input">Notatka</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control" id="orderNote" name="orderNote" placeholder="Możesz tutaj dodać Notatkę do zlecenia. Nie zostanie ona wydrukowana" value="<?php ifExistDisplay('remember_orderNote'); ?>"></textarea>
                </div>
            </div>

            <div class="row form-group">
                <div class="col invisible"></div>
                <input type="submit" value="Dodaj" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='menu.php'">
            </div>

        </form>
    </div>

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>