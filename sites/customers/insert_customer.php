<?php
    session_start();

    $customerFirstName = $_POST['customerFirstName'];
    $customerLastName = $_POST['customerLastName'];
    $customerPhone = $_POST['customerPhone'];
    $customerMail = $_POST['customerMail']; 

    $_SESSION['remember_customerFirstName'] = $customerFirstName;
    $_SESSION['remember_customerLastName'] = $customerLastName;
    $_SESSION['remember_customerPhone'] = $customerPhone;
    $_SESSION['remember_customerMail'] = $customerMail;

    
    if (empty($customerFirstName) || empty($customerLastName)) {
        $emptyField = 'Pole nie może być puste';

        if (empty($customerFirstName))
            $_SESSION['error_customerFirstName'] = $emptyField;

        if (empty($customerLastName))
            $_SESSION['error_customerLastName'] = $emptyField;

        header('Location: add_customer.php');
        exit();
    }

    try {
        require_once '../../connection/connection.php';
        $connection = openConnection();

        $tsql = "SELECT ID_klienta FROM klienci WHERE Imie='$customerFirstName' AND Nazwisko='$customerLastName' AND Telefon='$customerPhone' and Mail='$customerMail'";
        $checkCustomers = sqlsrv_query($connection, $tsql);

        if (!$checkCustomers)
            // throw new Exception;
            die(print_r(sqlsrv_errors()));
                        
        while ($row = sqlsrv_fetch_array($checkCustomers, SQLSRV_FETCH_ASSOC))
            if ($row['ID_klienta'] != '') {
                $_SESSION['error_customer'] = "Taki klient już isnieje";

                header('Location: add_customer.php');
                exit();
            }
                


    } catch (Exception $e) {
        echo "Błąd";
    }
        

    sqlsrv_close($connection);
    
    unset($_SESSION['remember_customerFirstName']);
    unset($_SESSION['remember_customerLastName']);
    unset($_SESSION['remember_customerPhone']);
    unset($_SESSION['remember_customerMail']);

    // header('Location: show_customers.php');
?>