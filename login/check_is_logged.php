<?php
    session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: '.$_SESSION['INDEX_PATH']);
        exit();
    }
?>