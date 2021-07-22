<?php
    session_start();

    $host = $_POST['host'];
    $name = $_POST['name'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    $writeSettings = fopen("../connection/connection_data.txt", "w");
    $writeText = $host.';'.$name.';'.$user.';'.$password;
    fwrite($writeSettings, $writeText);
    fclose($writeSettings);

    $_SESSION['confirmation'] = "Zmiemiono dane połączenia";
    header('Location: ../index.php');

?>