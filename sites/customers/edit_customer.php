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
    <title>Edytuj klienta</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/site.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/show_all.css">
    <link rel="stylesheet" href="../../css/show_customers.css">
</head>
<body>
    <?php
        $customerID = $_GET['ID'];
        require_once '../../connection/connection.php';

        try {
            $connection = openConnection();
            $tsql = "SELECT RTRIM(Imie) as Imie, RTRIM(Nazwisko) as Nazwisko, RTRIM(Telefon) as Telefon, RTRIM(Mail) as Mail FROM klienci WHERE ID_klienta='$customerID'";
            $getCustomer = sqlsrv_query($connection, $tsql);

            if (!$getCustomer)
                throw new Exception;
            
            $row = sqlsrv_fetch_array($getCustomer, SQLSRV_FETCH_ASSOC);

            sqlsrv_free_stmt($getCustomer);
            sqlsrv_close($connection);
    ?>
    
    <div class="container">
        <div class="form__header">
            Edytuj <span class="color-green">Klienta</span> 
        </div>

        <form action="update_customer.php?ID=<?php echo $customerID; ?>" method="post">
            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="customerFirstName" class="form__input">Imie</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="customerFirstName" maxlength="20" name="customerFirstName" placeholder="Imie" value="<?php echo $row['Imie']; ?>">
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
                    <input type="text" class="form-control" id="customerLastName" maxlength="30" name="customerLastName" placeholder="Nazwisko" value="<?php echo $row['Nazwisko']; ?>">
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
                    <input type="text" class="form-control" id="customerPhone" maxlength="15" name="customerPhone" placeholder="111222333" value="<?php echo $row['Telefon']; ?>">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-black">
                    <label for="customerMail" class="form__input">Email</label>
                </div>
                <div class="col form__cell">
                    <input type="text" class="form-control" id="customerMail" name="customerMail" placeholder="nazwa@domena.pl" value="<?php echo $row['Mail']; ?>">
                </div>
            </div>
            <div class="row form-group">
                <div class="col invisible"></div>
                <div class="col error"><?php ifExistDisplay('error_customer') ?></div>
                <input type="submit" value="Edytuj" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='show_customers.php'">
            </div>
        </form>
    </div>

    <?php
        } catch (Exception $e) {
            $_SESSION['confirmation'] = '<span class="error">Błąd edytowania klienta</span>';
            header('Location: show_customers.php');
        }
    ?>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>