<?php
    function isMonth30($month) {
        if ($month == 4 || $month == 6 || $month == 9 || $month == 11)
            return true;
    }

    function isLeapYear($month) {
        if (($month % 4 == 0 && $month % 100 != 0) || $month % 400 == 0)
            return true;
    }
?>