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
                <div class="col dashboard__button bg-green ">
                    Nowe zlecenie
                </div>
                <div class="col dashboard__button bg-silver">
                    Status
                </div>
                <div class="col dashboard__button bg-gray">
                    Sortus według
                </div>
                <div class="col dashboard__button bg-black">
                    Wyświetl Klientów
                </div>
            </div>
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
                for ($i = 0; $i < 20; $i++) :
            ?>
            
            <div class="row text-center">
                <div class="col-1 allign-center data__cell">
                    1
                </div>
                <div class="col-1 date data__cell">
                    2021-07-14
                </div>
                <div class="col-1 status data__cell">
                    Zakończone
                </div>
                <div class="col data__cell">
                    Bartłomiej
                </div>
                <div class="col-2 data__cell">
                    Żółtek
                </div>
                <div class="col-1 date data__cell">
                    666222444
                </div>
                <div class="col-2 data__cell">
                    Telefon
                </div>
                <div class="col-1 bg-green data__button">
                    Więcej
                </div>
            </div>

            <?php
                endfor;
            ?>
        </div>
    </div>
    

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>