<?php
    if (session_status() == PHP_SESSION_NONE)
        session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: '.dirname(__DIR__).'/index.php');
        exit();
    }
?>