<?php

    session_start();
    require_once '../login/check_is_logged.php';

    $address = $_POST['address'];
    $footer = $_POST['footer'];

    $writeAddress = fopen("../print/address.txt", "w");
    fwrite($writeAddress, $address);
    fclose($writeAddress);

    $writeFooter = fopen("../print/footer.txt", "w");
    fwrite($writeFooter, $footer);
    fclose($writeFooter);

    $_SESSION['confirmation'] = "Zapisano zmiany danych do wydruku";
    header('Location: ../sites/menu.php');

?>