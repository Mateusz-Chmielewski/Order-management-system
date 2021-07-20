<?php
    function ifExistDisplay($sessionName) {
        if (isset($_SESSION[$sessionName])) {
            echo $_SESSION[$sessionName];
            unset($_SESSION[$sessionName]);
            return true;
        } return false;
    }
?>