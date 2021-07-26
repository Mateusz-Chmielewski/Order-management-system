<?php
    if (session_status() == PHP_SESSION_NONE)
        session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: '.$_SESSION['INDEX_PATH']);
        exit();
    }
?>