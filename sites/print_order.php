<?php
    session_start();

    require_once 'customers/if_exist_display.php';
    require_once '../connection/connection.php';

    $orderID = $_GET['ID'];
        
    try {
                                
        $connection = openConnection();
        $tsql = "SELECT Data, RTRIM(Status) as Status, RTRIM(Imie) as Imie, RTRIM(Nazwisko) as Nazwisko, RTRIM(Telefon) as Telefon, RTRIM(Mail) as Mail, Sprzet, Opis, Uwagi, Notatka 
                 FROM zlecenia INNER JOIN klienci ON zlecenia.Klient = klienci.ID_klienta WHERE ID_zlecenia='$orderID'";
        $getOrder = sqlsrv_query($connection, $tsql);

        if (!$getOrder)
            throw new Exception;
            
        $row = sqlsrv_fetch_array($getOrder, SQLSRV_FETCH_ASSOC);

        sqlsrv_free_stmt($getOrder);
        sqlsrv_close($connection);
        
    } catch (Exception $e) {
        echo "Błąd pobrania danych <br>";
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drukuj zlecenie</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/print.css">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/show_all.css">
    <link rel="stylesheet" href="../css/show_customers.css">
</head>
<body>
    <div class="container text-center">

        <div class="row header">
            <div class="col">
                <?php
                    $address = fopen("../print/address.txt", "r") or die();
                    while(!feof($address)) { 
                        echo '<span class="name">'.fgets($address) . "</span><br>";
                    } fclose($address);
                ?>
            </div>
            <div class="col">
                <div class="row print__border">
                    <div class="col-3 print__cell mt mb">Data</div>
                    <div class="col print__cell mt mb">
                        <?php echo $row['Data']; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="print__border container table">
            <div class="row">
                <div class="col-3 print__cell mt">Imię</div>
                <div class="col print__cell mt"><?php echo $row['Imie']; ?></div>
            </div>

            <div class="row">
                <div class="col-3 print__cell">Nazwisko</div>
                <div class="col print__cell"><?php echo $row['Nazwisko']; ?></div>
            </div>
            
            <?php if (!empty($row['Telefon'])) : ?>
                <div class="row">
                    <div class="col-3 print__cell">Telefon</div>
                    <div class="col print__cell"><?php echo $row['Telefon']; ?></div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($row['Mail'])) : ?>
                <div class="row">
                    <div class="col-3 print__cell">Mail</div>
                    <div class="col print__cell"><?php echo $row['Mail']; ?></div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-3 print__cell">Sprzęt</div>
                <div class="col print__cell"><?php echo $row['Sprzet']; ?></div>
            </div>

            <div class="row">
                <div class="col-3 print__cell">Opis</div>
                <div class="col print__cell"><?php echo $row['Opis']; ?></div>
            </div>

            <?php if (!empty($row['Uwagi'])) : ?>
                <div class="row">
                    <div class="col-3 print__cell mb">Uwagi</div>
                    <div class="col print__cell mb"><?php echo $row['Uwagi']; ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($row['Notatka'])) : ?>
                <div class="row">
                    <div class="col-3 print__cell mb">Notatka</div>
                    <div class="col print__cell mb"><?php echo $row['Notatka']; ?></div>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer text-justify">
            <?php
                $footer = fopen("../print/footer.txt", "r") or die();
                while(!feof($footer)) {
                    echo  fgets($footer) . "<br>";
                } fclose($footer);
            ?>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-3 mb-5">Podpis</div>
        </div>

        <div class="devide-border"></div>

        <div class="row header">
            <div class="col">
                <?php
                    $address = fopen("../print/address.txt", "r") or die();
                    while(!feof($address)) { 
                        echo '<span class="name">'.fgets($address) . "</span><br>";
                    } fclose($address);
                ?>
            </div>
            <div class="col">
                <div class="row print__border">
                    <div class="col-3 print__cell mt mb">Data</div>
                    <div class="col print__cell mt mb">
                        <?php echo $row['Data']; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="print__border container table">
            <div class="row">
                <div class="col-3 print__cell mt">Imię</div>
                <div class="col print__cell mt"><?php echo $row['Imie']; ?></div>
            </div>

            <div class="row">
                <div class="col-3 print__cell">Nazwisko</div>
                <div class="col print__cell"><?php echo $row['Nazwisko']; ?></div>
            </div>

            <div class="row">
                <div class="col-3 print__cell">Sprzęt</div>
                <div class="col print__cell"><?php echo $row['Sprzet']; ?></div>
            </div>

            <div class="row">
                <div class="col-3 print__cell">Opis</div>
                <div class="col print__cell"><?php echo $row['Opis']; ?></div>
            </div>

            <div class="row">
                <div class="col-3 print__cell mb">Uwagi</div>
                <div class="col print__cell mb"><?php echo $row['Uwagi']; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-3 mb-5">Pieczątka</div>
        </div>

        <div class="row panel">
            <div class="col"></div>
                <div class="form-check col mt-3">
                    <input class="form-check-input" type="checkbox" id="showUs" onclick="check()" checked>
                    <label class="form-check-label" for="showUs">
                        Dla nas
                    </label>
                </div>
                <div class="form-check col mt-3">
                    <input class="form-check-input" type="checkbox" id="showCustomer" onclick="check()" checked>
                    <label class="form-check-label" for="showCustomer">
                        Dla klienta
                    </label>
                </div>
            <button class="col-2 bg-green data__button btn m-2">Drukuj</button>
            <button class="col-2 bg-green data__button btn m-2" onclick="window.location.href='menu.php'">Anuluj</button>
        </div>

    </div>

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>