<?php
    session_start();

    $customerID = $_GET['ID'];
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

        header('Location: edit_customer.php?ID='.$customerID);
        exit();
    }

    try {
        require_once '../../connection/connection.php';
        $connection = openConnection();

        $tsql = "UPDATE klienci SET Imie='$customerFirstName', Nazwisko='$customerLastName', Telefon='$customerPhone', Mail='$customerMail' WHERE ID_klienta='$customerID'";
        $updateCustomer = sqlsrv_query($connection, $tsql);

        if (!$updateCustomer)
            throw new Exception;

            sqlsrv_free_stmt($updateCustomer);
            
            sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['confirmation'] = '<span class="error">Błąd edytowania klienta</span>';
    }

    unset($_SESSION['remember_customerFirstName']);
    unset($_SESSION['remember_customerLastName']);
    unset($_SESSION['remember_customerPhone']);
    unset($_SESSION['remember_customerMail']);

    $_SESSION['confirmation'] = "Edytowano klienta";
    header('Location: show_customers.php');
?>