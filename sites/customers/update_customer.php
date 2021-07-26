<?php
    session_start();

    require_once '../../login/check_is_logged.php';

    $customerID = $_GET['ID'];
    $customerFirstName = $_POST['customerFirstName'];
    $customerLastName = $_POST['customerLastName'];
    $customerPhone = $_POST['customerPhone'];
    $customerMail = $_POST['customerMail']; 


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
        header('Location: show_customers.php');
        exit();
    }


    $_SESSION['confirmation'] = "Edytowano klienta";
    header('Location: show_customers.php');
?>