<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System zarządzania zleceniami</title>
</head>
<body>
    <?php
        if (file_exists('connection/connection_data.txt')) {
            header("Location: sites/menu.php");
            exit;
        } else {
            header("Location: settings/connection_settings.php");
            exit;
        }
    ?>
</body>
</html>