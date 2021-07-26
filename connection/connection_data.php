<?php
        if (!file_exists(dirname(__DIR__)."\connection\connection_data.txt")) {
            $db_host = "";
            $db_name = "";
            $db_user = "";
            $db_password = "";
        } else {
            $file = file_get_contents(dirname(__DIR__)."\connection\connection_data.txt");
            $split = explode(";", $file);

            $db_host = $split[0];
            $db_name = $split[1];
            $db_user = $split[2];
            $db_password = $split[3];
        }

?>