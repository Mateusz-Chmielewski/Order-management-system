<?php
    $sqlSearch = " 1=1 ";
    $showSearch = "";
    
    if (isset($_POST['search'])) {
        $showSearch = $_POST['search'];
        $sqlSearch = " Telefon LIKE '%$showSearch%' 
                    OR RTRIM(Imie) + ' ' + RTRIM(Nazwisko) LIKE '%$showSearch%'
                    OR RTRIM(Nazwisko) + ' ' + RTRIM(Imie) LIKE '%$showSearch%'
                    OR Mail LIKE '%$showSearch%'
                    ";
    }

?>