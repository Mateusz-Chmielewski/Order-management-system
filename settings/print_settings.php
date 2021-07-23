<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dane do wydruku</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/show_all.css">
    <link rel="stylesheet" href="../css/show_customers.css">
</head>
<body>
    <div class="container">
        <div class="form__header">
            Dane <span class="color-green">do Wydruku</span> 
        </div>

        <?php

            $address = file_exists("../print/address.txt") ? file_get_contents("../print/address.txt") : "";
            $footer = file_exists("../print/footer.txt") ? file_get_contents("../print/footer.txt") : "";
            
        ?>

        <form action="save_print_data.php" method="post">

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-green">
                    <label for="address" class="form__input">Adres</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control form__print-txt" id="address" name="address" placeholder="Wpisz adres firmy"><?php echo $address; ?></textarea>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3 form__cell__header form__cell bg-silver">
                    <label for="footer" class="form__input">Stopka</label>
                </div>
                <div class="col form__cell">
                    <textarea type="text" class="form-control form__print-txt" id="footer" name="footer" placeholder="Wpisz stopkę"><?php echo $footer; ?></textarea>
                </div>
            </div>

            <div class="row form-group">
                <div class="col invisible"></div>
                <input type="submit" value="Zapisz" class="col-2 bg-green data__button btn m-2">
                <input type="button" value="Anuluj" class="col-2 bg-silver data__button btn m-2" onclick="window.location.href='../index.php'">
            </div>

        </form>

    </div>

    
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>