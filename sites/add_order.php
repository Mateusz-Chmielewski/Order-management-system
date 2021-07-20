<?php
    session_start();

    require_once 'customers/if_exist_display.php';
    require_once '../connection/connection.php';
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
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="orderDateYear" class="form__input">Data</label>
                </div>
                <div class="col form__cell">
                    <div class="input-group">
                        <input type="text" class="form-control" id="orderDateYear" maxlength="4" name="orderDateYear" placeholder="YYYY" value="<?php if(!ifExistDisplay('remember_orderDateYear')) echo date('Y'); ?>">
                        <div class="input-group-text"> - </div>
                        <input type="text" class="form-control" id="orderDateMonth" maxlength="2" name="orderDateMonth" placeholder="MM" value="<?php if(!ifExistDisplay('remember_orderDateMonth')) echo date('m'); ?>">
                        <div class="input-group-text"> - </div>
                        <input type="text" class="form-control" id="orderDateDay" maxlength="2" name="orderDateDay" placeholder="DD" value="<?php if(!ifExistDisplay('remember_orderDateDay')) echo date('d'); ?>">
                    </div>
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderDate');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">

                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="orderState" class="form__input">Status</label>
                </div>

                <div class="col form__cell">
                    <select class="form-control" id="orderState" name="orderState">

                        <?php
                            try {
                                
                                $connection = openConnection();
                                $tsql = "SELECT RTRIM(ID_status) as Status FROM statusy ORDER BY wartosc";
                                $getState = sqlsrv_query($connection, $tsql);
            
                                if (!$getState)
                                    throw new Exception;
                                
                                while ($row = sqlsrv_fetch_array($getState, SQLSRV_FETCH_ASSOC)) :
                        ?>

                        <option <?php if(isset($_SESSION['remember_orderState'])) if($_SESSION['remember_orderState'] == $row['Status']) echo 'selected'; ?> ><?php echo $row['Status']; ?></option>

                        <?php
                                endwhile;

                                sqlsrv_free_stmt($getState);
                                sqlsrv_close($connection);
                            
                            } catch (Exception $e) {
                                echo "Błąd pobrania danych <br>";
                            }
                        ?>

                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
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
                <div class="col-3 form__cell__header form__cell bg-silver">
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
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="orderPhone" class="form__input">Telefon</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderPhone" maxlength="15" name="orderPhone" placeholder="111222333" value="<?php ifExistDisplay('remember_orderPhone'); ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="orderMail" class="form__input">Email</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderMail" name="orderMail" placeholder="nazwa@domena.pl" value="<?php ifExistDisplay('remember_orderMail'); ?>">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="orderDevice" class="form__input">Sprzęt</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="orderDevice" name="orderDevice" placeholder="Wpisz nazwę urządzenia" value="<?php ifExistDisplay('remember_orderDevice'); ?>">
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderDevice');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="orderDescription" class="form__input">Opis</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control" id="orderDescription" name="orderDescription" placeholder="Opisz tutaj dokładnie problem z urządzeniem"><?php ifExistDisplay('remember_orderDescription'); ?></textarea>
                    <small class="error">
                        <?php
                            ifExistDisplay('error_orderDescription');
                        ?>
                    </small>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-gray">
                    <label for="orderComment" class="form__input">Uwagi</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control" id="orderComment" name="orderComment" placeholder="Możesz tutaj dodać Uwagi dotyczące zlecenia" ><?php ifExistDisplay('remember_orderComment'); ?></textarea>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="orderNote" class="form__input">Notatka</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control" id="orderNote" name="orderNote" placeholder="Możesz tutaj dodać Notatkę do zlecenia. Nie zostanie ona wydrukowana"><?php ifExistDisplay('remember_orderNote'); ?></textarea>
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