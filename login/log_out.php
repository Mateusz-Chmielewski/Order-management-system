<?php
    session_start();

    require_once 'check_is_logged.php';

    session_unset();
    header('Location: ../index.php');

?>