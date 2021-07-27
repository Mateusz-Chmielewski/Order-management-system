<?php
    $sqlSearch = " 1=1 ";
    $showSearch = "";
    
    if (isset($_POST['search'])) {
        $showSearch = $_POST['search'];
        $sqlSearch = " ID_zlecenia LIKE '%$showSearch%' 
                    OR Data LIKE '%$showSearch%' 
                    OR RTRIM(Imie) + ' ' + RTRIM(Nazwisko) LIKE '%$showSearch%'
                    OR RTRIM(Nazwisko) + ' ' + RTRIM(Imie) LIKE '%$showSearch%'
                    OR sprzet LIKE '%$showSearch%'
                    ";
    }

?>