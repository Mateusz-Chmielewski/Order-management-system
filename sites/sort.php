<?php
    $sqlSort = " ID_zlecenia DESC ";
    $showSort = "ID malejąco";

    if (isset($_POST['sort'])) {
        $showSort = $_POST['sort'];
        
        if ($showSort == "ID malejąco")
            $sqlSort = " ID_zlecenia DESC ";
        elseif ($showSort == "ID rosnąco")
            $sqlSort = " ID_zlecenia ASC ";
        elseif ($showSort == "Data malejąco")
            $sqlSort = " Data DESC ";
        elseif ($showSort == "Data rosnąco")
            $sqlSort = " Data ASC ";
        elseif ($showSort == "Nazwisko malejąco")
            $sqlSort = " Nazwisko DESC ";
        elseif ($showSort == "Nazwisko rosnąco")
            $sqlSort = " Nazwisko ASC ";
        elseif ($showSort == "Imię malejąco")
            $sqlSort = " Imie DESC ";
        elseif ($showSort == "Imię rosnąco")
            $sqlSort = " Imie ASC ";
    }

?>