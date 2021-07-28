<?php
    $sqlSort = " Nazwisko ASC ";
    $showSort = "Nazwisko rosnąco";

    if (isset($_POST['sort'])) {
        $showSort = $_POST['sort'];
        
        if ($showSort == "Nazwisko malejąco")
            $sqlSort = " Nazwisko DESC ";
        elseif ($showSort == "Nazwisko rosnąco")
            $sqlSort = " Nazwisko ASC ";
        elseif ($showSort == "Imię malejąco")
            $sqlSort = " Imie DESC ";
        elseif ($showSort == "Imię rosnąco")
            $sqlSort = " Imie ASC ";
    }

?>