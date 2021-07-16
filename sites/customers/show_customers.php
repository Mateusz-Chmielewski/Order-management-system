<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>System zarządzania zleceniami</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/site.css">
    <link rel="stylesheet" href="../../css/show_all.css">
    <link rel="stylesheet" href="../../css/show_customers.css">
</head>
<body>
    <div class="container">

        <?php
            // require_once '../connection/connection.php';

            // print_r(openConnection());
        ?>

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
                    <a href="../menu.php">Wyświetl Zlecenia</a>
                </div>
            </div>
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
                for ($i = 0; $i < 20; $i++) :
            ?>
            
            <div class="row text-center">
                <div class="col-2 data__cell">
                    Bartłomiej
                </div>
                <div class="col-2 data__cell">
                    Żółtek
                </div>
                <div class="col-1 date data__cell">
                    666222444
                </div>
                <div class="col data__cell">
                    bartlomiej.zoltek1@protonmail.com
                </div>
                <div class="col-1 bg-silver data__button" id="getWidth">
                    Edytuj
                </div>
                <div class="col-1 bg-gray data__button">
                    Usuń
                </div>
                <div class="col-1 bg-black data__button">
                    Nowe
                </div>
            </div>
            

            <?php
                endfor;
            ?>
        </div>
    </div>
    
    
    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/set_more-option_width.js"></script>

    
</body>
</html> 