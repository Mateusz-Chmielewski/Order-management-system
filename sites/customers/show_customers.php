<?php
    session_start();
    require_once 'if_exist_display.php';
    require_once '../../login/check_is_logged.php';
    require_once 'search_customer.php';
    require_once 'sort_customer.php';
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

        <form action="" method="post">
            <div class="row form-group">
                <div class="col btn">
                    <input type="text" class="form-control" id="search" name="search" value="<?php echo $showSearch; ?>">    
                </div>
                <input type="submit" value="Szukaj" class="col-1 bg-green data__button btn">
                <div class="col-2 bg-green data__button btn " onclick="window.location.href='../../settings/user_settings.php'">Konto</div>
                <div class="col-2 bg-silver data__button btn " onclick="window.location.href='../../settings/print_settings.php'">Dane do wydruku</div>
                <div class="col-2 bg-gray data__button btn " onclick="window.location.href='../../settings/connection_settings.php'">Ustawienia</div>
                <div class="col-2 bg-black data__button btn " onclick="window.location.href='../../login/log_out.php'">Wyloguj</div>
            </div>

            <div class="dashboard">
                <div class="row text-center">
                    <div class="col dashboard__button bg-green " onclick="window.location.href='../add_order.php'">
                        Nowe zlecenie
                    </div>
                    <div class="col dashboard__button bg-silver" onclick="window.location.href='add_customer.php'">
                        Nowy Klient
                    </div>  
                    <div class="col dashboard__button bg-gray" onclick="showStateForm('sorts_customer', 'Sortuj wed??ug')" id="bsorts_customer">
                        Sortuj wed??ug
                    </div>
                    <div class="col dashboard__button bg-black" onclick="window.location.href='../menu.php'">
                        Wy??wietl Zlecenia
                    </div>
                </div>
            </div>

            <div class="row text-center data__more" id="sorts_customer">
                <div class="col-6"></div>
                <div class="col-3 data__state" >
                    <select class="form-control" id="sort" name="sort">

                        <option <?php if($showSort == "Nazwisko malej??co") echo 'selected'; ?>>Nazwisko malej??co</option>
                        <option <?php if($showSort == "Nazwisko rosn??co") echo 'selected'; ?>>Nazwisko rosn??co</option>
                        <option <?php if($showSort == "Imi?? malej??co") echo 'selected'; ?>>Imi?? malej??co</option>
                        <option <?php if($showSort == "Imi?? rosn??co") echo 'selected'; ?>>Imi?? rosn??co</option>

                    </select>
                </div>
                <input type="submit" value="Wybierz" class="col-1 bg-green data__button btn">
                <div class="col"></div>
            </div>

        </form>

        <div class="confirmation">
            <?php
                ifExistDisplay('confirmation');
            ?>
        </div>

        <div class="label-header">
            <div class="row text-center">
                <div class="col-2 label-header__cell bg-green">
                    Imi??
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
                    Wi??cej opcji
                </div>
            </div>
        </div>
        <div class="data">

            <?php
                require_once '../../connection/connection.php';

                try {
                    
                    $connection = openConnection();
                    $tsql = "SELECT * FROM klienci WHERE $sqlSearch ORDER BY $sqlSort";
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
                    Usu??
                </div>
                <div class="col-1 bg-black data__button" onclick="window.location.href='../add_order.php?ID=<?php echo $row['ID_klienta']; ?>'">
                    Nowe
                </div>
            </div>
            
            <div id="delete<?php echo $row['ID_klienta']; ?>" class="row text-center data__more">
                <div class="col data__cell invisible"></div>
                <div class="col-1 data__button bg-green" onclick="window.location.href='delete_customer.php?ID=<?php echo $row['ID_klienta']; ?>'">
                    Potwierd??
                </div>
                <div class="col-1 data__cell invisible"></div>
            </div>

            <?php
                endwhile;

                sqlsrv_free_stmt($getCustomers);
                sqlsrv_close($connection);

                } catch (Exception $e) {
                    echo "B????d po????czenia z serverem <br>";
                }
            ?>
        </div>
    </div>
    
    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/set_more-option_width.js"></script>
    <script src="../../js/show_confirm_delete.js"></script>
    <script src="../../js/show_state_form.js"></script>
    
</body>
</html> 