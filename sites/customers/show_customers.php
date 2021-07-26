<?php
    session_start();
    require_once 'if_exist_display.php';
    require_once '../../login/check_is_logged.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Klienci</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/site.css">
    <link rel="stylesheet" href="../../css/show_all.css">
    <link rel="stylesheet" href="../../css/show_customers.css">
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col"></div>
            <button class="col-2 bg-green data__button btn mx-2">Konto</button>
            <button class="col-2 bg-silver data__button btn mx-2" onclick="window.location.href='../../settings/print_settings.php'">Dane do wydruku</button>
            <button class="col-2 bg-gray data__button btn mx-2" onclick="window.location.href='../../settings/connection_settings.php'">Ustawienia</button>
            <button class="col-2 bg-black data__button btn mx-2" onclick="window.location.href='../../login/log_out.php'">Wyloguj</button>
        </div>

        <div class="dashboard">
            <div class="row text-center">
                <div class="col dashboard__button bg-green " onclick="window.location.href='../add_order.php'">
                    Nowe zlecenie
                </div>
                <div class="col dashboard__button bg-silver" onclick="window.location.href='add_customer.php'">
                    Nowy Klient
                </div>  
                <div class="col dashboard__button bg-gray">
                    Sortuj według
                </div>
                <div class="col dashboard__button bg-black" onclick="window.location.href='../menu.php'">
                    Wyświetl Zlecenia
                </div>
            </div>
        </div>

        <div class="confirmation">
            <?php
                ifExistDisplay('confirmation');
            ?>
        </div>

        <div class="label-header">
            <div class="row text-center">
                <div class="col-2 label-header__cell bg-green">
                    Imię
                </div>
                <div class="col-2 label-header__cell bg-green">
                    Nazwisko
                </div>
                <div class="col-1 label-header__cell bg-green date">
                    Numer telefonu
                </div>
                <div class="col label-header__cell bg-green">
                    Email
                </div>
                <div class="col-3 label-header__cell bg-green more-options" id="setWidth">
                    Więcej opcji
                </div>
            </div>
        </div>
        <div class="data">

            <?php
                require_once '../../connection/connection.php';

                try {
                    
                    $connection = openConnection();
                    $tsql = "SELECT * FROM klienci ORDER BY Nazwisko";
                    $getCustomers = sqlsrv_query($connection, $tsql);

                    if (!$getCustomers)
                        throw new Exception;
                    
                    while ($row = sqlsrv_fetch_array($getCustomers, SQLSRV_FETCH_ASSOC)) :
            ?>
            
            <div class="row text-center">
                <div class="col-2 data__cell">
                    <?php echo $row['Imie']; ?>
                </div>
                <div class="col-2 data__cell">
                    <?php echo $row['Nazwisko']; ?>
                </div>
                <div class="col-1 date data__cell">
                    <?php echo $row['Telefon']; ?>
                </div>
                <div class="col data__cell">
                    <?php echo $row['Mail']; ?>
                </div>
                <div class="col-1 bg-silver data__button" id="getWidth" onclick="window.location.href='edit_customer.php?ID=<?php echo $row['ID_klienta']; ?>'">
                    Edytuj
                </div>
                <div class="col-1 bg-gray data__button" id="bdelete<?php echo $row['ID_klienta']; ?>" onclick="showConfirmDelete('delete<?php echo $row['ID_klienta']; ?>')">
                    Usuń
                </div>
                <div class="col-1 bg-black data__button" onclick="window.location.href='../add_order.php?ID=<?php echo $row['ID_klienta']; ?>'">
                    Nowe
                </div>
            </div>
            
            <div id="delete<?php echo $row['ID_klienta']; ?>" class="row text-center data__more">
                <div class="col data__cell invisible"></div>
                <div class="col-1 data__button bg-green" onclick="window.location.href='delete_customer.php?ID=<?php echo $row['ID_klienta']; ?>'">
                    Potwierdź
                </div>
                <div class="col-1 data__cell invisible"></div>
            </div>

            <?php
                endwhile;

                sqlsrv_free_stmt($getCustomers);
                sqlsrv_close($connection);

                } catch (Exception $e) {
                    echo "Błąd połączenia z serverem <br>";
                }
            ?>
        </div>
    </div>
    
    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/set_more-option_width.js"></script>
    <script src="../../js/show_confirm_delete.js"></script>
    
</body>
</html> 