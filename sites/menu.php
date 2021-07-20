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
    <title>System zarządzania zleceniami</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/show_all.css">
</head>
<body>
    <div class="container">

        <div class="dashboard">
            <div class="row text-center">
                <div class="col dashboard__button bg-green " onclick="window.location.href='add_order.php'">
                    Nowe zlecenie
                </div>
                <div class="col dashboard__button bg-silver">
                    Status
                </div>
                <div class="col dashboard__button bg-gray">
                    Sortus według
                </div>
                <div class="col dashboard__button bg-black" onclick="window.location.href='customers/show_customers.php'">
                    Wyświetl Klientów
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
                <div class="col-1 label-header__cell bg-green">
                    Nr zlecenia
                </div>
                <div class="col-1 label-header__cell bg-green date">
                    Data
                </div>
                <div class="col-1 label-header__cell bg-green status">
                    Status
                </div>
                <div class="col label-header__cell bg-green">
                    Imię
                </div>
                <div class="col-2 label-header__cell bg-green">
                    Nazwisko
                </div>
                <div class="col-1 label-header__cell bg-green date">
                    Numer telefonu
                </div>
                <div class="col-2 label-header__cell bg-green">
                    Sprzęt
                </div>
                <div class="col-1 label-header__cell bg-green">
                    Więcej opcji
                </div>
            </div>
        </div>
        <div class="data">

            <?php
                require_once '../connection/connection.php';

                try {
                    
                    $connection = openConnection();
                    $tsql = "SELECT * FROM zlecenia INNER JOIN klienci ON zlecenia.Klient = klienci.ID_klienta ORDER BY ID_zlecenia DESC";
                    $getOrders = sqlsrv_query($connection, $tsql);

                    if (!$getOrders)
                        throw new Exception;
                    
                    while ($row = sqlsrv_fetch_array($getOrders, SQLSRV_FETCH_ASSOC)) :
            ?>
            
            <div class="row text-center">

                <div class="col-1 allign-center data__cell">
                    <?php echo $row['ID_zlecenia']; ?>
                </div>
                <div class="col-1 date data__cell">
                    <?php echo $row['Data']; ?>
                </div>
                <div class="col-1 status data__cell">
                    <?php echo $row['Status']; ?>
                </div>
                <div class="col data__cell">
                    <?php echo $row['Imie']; ?>
                </div>
                <div class="col-2 data__cell">
                    <?php echo $row['Nazwisko']; ?>
                </div>
                <div class="col-1 date data__cell">
                    <?php echo $row['Telefon']; ?>
                </div>
                <div class="col-2 data__cell">
                    <?php echo $row['Sprzet']; ?>
                </div>
                <div class="col-1 bg-green data__button" onclick="showMore('more<?php echo $row['ID_zlecenia']; ?>')">
                    <div id="dmore<?php echo $row['ID_zlecenia']; ?>">Więcej</div>
                </div>

            </div>
            
            <div id="more<?php echo $row['ID_zlecenia']; ?>" class="data__more">

                <div class="row text-center">
                    <div class="col-1 data__cell invisible"></div>
                    <div class="mail col-3 data__cell ">
                        <?php echo $row['Mail']; ?>
                    </div>
                    <div class="col data__cell">
                        <?php echo $row['Opis']; ?>
                    </div>
                    <div class="col-1 bg-green data__button">
                        Status
                    </div>
                    <div class="col-1 bg-silver data__button" onclick="window.location.href='edit_order.php?ID=<?php echo $row['ID_zlecenia']; ?>'">
                        Edytuj
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-1 data__cell invisible"></div>
                    <div class="col data__cell">
                        <?php echo $row['Uwagi']; ?>
                    </div>
                    <div id="delete<?php echo $row['ID_zlecenia']; ?>" class="col-1 data__button bg-green data__more__button" onclick="window.location.href='delete_order.php?ID=<?php echo $row['ID_zlecenia']; ?>'">
                        Potwierdź
                    </div>
                    <div class="col-1 bg-gray data__button" id="bdelete<?php echo $row['ID_zlecenia']; ?>" onclick="showConfirmDelete('delete<?php echo $row['ID_zlecenia']; ?>')">
                        Usuń
                    </div>
                </div>

                <div id="delete<?php echo $row['ID_zlecenia']; ?>" class="row text-center data__more">
                    <div class="col data__cell invisible"></div>
                    
                </div>

                <div class="row text-center">
                    <div class="col-1 data__cell invisible"></div>
                    <div class="col data__cell">
                        <?php echo $row['Notatka']; ?>
                    </div>
                    <div class="col-1 bg-black data__button">
                        Drukuj
                    </div>
                </div>
            </div>

            <?php
                
                endwhile;

                sqlsrv_free_stmt($getOrders);
                sqlsrv_close($connection);

                } catch (Exception $e) {
                    echo "Błąd pobrania danych <br>";
                }

            ?>

        </div>
    </div>
    

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/show_more.js"></script>
    <script src="../js/show_confirm_delete.js"></script>
    
</body>
</html>