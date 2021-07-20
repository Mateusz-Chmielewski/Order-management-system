<?php
    session_start();

    require_once '../connection/connection.php';
    require_once 'check_months.php';

    $orderDateYear = $_POST['orderDateYear'];
    $orderDateMonth = $_POST['orderDateMonth'];
    $orderDateDay = $_POST['orderDateDay'];
    $orderState = $_POST['orderState'];
    $orderFirstName = $_POST['orderFirstName'];
    $orderLastName = $_POST['orderLastName'];
    $orderPhone = $_POST['orderPhone'];
    $orderMail = $_POST['orderMail']; 
    $orderDevice = $_POST['orderDevice']; 
    $orderDescription = $_POST['orderDescription']; 
    $orderComment = $_POST['orderComment']; 
    $orderNote = $_POST['orderNote']; 

    $_SESSION['remember_orderDateYear'] = $orderDateYear;
    $_SESSION['remember_orderDateMonth'] = $orderDateMonth;
    $_SESSION['remember_orderDateDay'] = $orderDateDay;
    $_SESSION['remember_orderState'] = $orderState;
    $_SESSION['remember_orderFirstName'] = $orderFirstName;
    $_SESSION['remember_orderLastName'] = $orderLastName;
    $_SESSION['remember_orderPhone'] = $orderPhone;
    $_SESSION['remember_orderMail'] = $orderMail;
    $_SESSION['remember_orderDevice'] = $orderDevice;
    $_SESSION['remember_orderDescription'] = $orderDescription;
    $_SESSION['remember_orderComment'] = $orderComment;
    $_SESSION['remember_orderNote'] = $orderNote;

    
    if (empty($orderDateYear) || empty($orderDateMonth) || empty($orderDateDay) || empty($orderFirstName) || empty($orderLastName) || empty($orderDevice) || empty($orderDescription)) {
        $emptyField = 'Pole nie może być puste';

        if (empty($orderDateYear) || empty($orderDateMonth) || empty($orderDateDay))
            $_SESSION['error_orderDate'] = $emptyField;

        if (empty($orderFirstName))
            $_SESSION['error_orderFirstName'] = $emptyField;

        if (empty($orderLastName))
            $_SESSION['error_orderLastName'] = $emptyField;

        if (empty($orderDevice))
            $_SESSION['error_orderDevice'] = $emptyField;

        if (empty($orderDescription))
            $_SESSION['error_orderDescription'] = $emptyField;

        header('Location: add_order.php');
        exit();
    }

    if (!is_numeric($orderDateYear) || (int) $orderDateYear < 1) {
        $_SESSION['error_orderDate'] = 'Rok - podano niewłaściwą wartość';

        header('Location: add_order.php');
        exit();
    }

    if (!is_numeric($orderDateMonth) || (int) $orderDateMonth < 1 || (int) $orderDateMonth > 12) {
        $_SESSION['error_orderDate'] = 'Miesiąc - podano niewłaściwą wartość';

        header('Location: add_order.php');
        exit();
    }


    if (!is_numeric($orderDateDay) || (int) $orderDateDay < 1 || (int) $orderDateDay > 31) {
        $_SESSION['error_orderDate'] = 'Dzień - podano niewłaściwą wartość';

        header('Location: add_order.php');
        exit();
    } else if (isMonth30((int) $orderDateMonth) && (int) $orderDateDay > 30) {
        $_SESSION['error_orderDate'] = 'Dzień - podano niewłaściwą wartość. Ten miesiąc ma 30 dni';

        header('Location: add_order.php');
        exit();
    } else if (isLeapYear((int) $orderDateYear) && (int) $orderDateMonth == 2 && $orderDateDay > 29) {
        $_SESSION['error_orderDate'] = 'Dzień - podano niewłaściwą wartość. Ten miesiąc ma 29 dni';

        header('Location: add_order.php');
        exit();
    } else if ((int) $orderDateMonth == 2 && $orderDateDay > 28) {
        $_SESSION['error_orderDate'] = 'Dzień - podano niewłaściwą wartość. Ten miesiąc ma 28 dni';

        header('Location: add_order.php');
        exit();
    }

    $orderDateYear = (string) $orderDateYear;
    while (strlen($orderDateYear) < 4)
        $orderDateYear = '0'.$orderDateYear;

    $orderDateMonth = (string) $orderDateMonth;
    while (strlen($orderDateMonth) < 2)
        $orderDateMonth = '0'.$orderDateMonth;

    $orderDateDay = (string) $orderDateDay;
    while (strlen($orderDateDay) < 2)
        $orderDateDay = '0'.$orderDateDay;

    $orderDate = $orderDateYear.'-'.$orderDateMonth.'-'.$orderDateDay;


    try {
        $connection = openConnection();

        $tsql = "SELECT ID_klienta FROM klienci WHERE Imie='$orderFirstName' AND Nazwisko='$orderLastName' AND Telefon='$orderPhone' and Mail='$orderMail'";
        $checkCustomers = sqlsrv_query($connection, $tsql);

        if (!$checkCustomers)
            throw new Exception;
                        
        $row = sqlsrv_fetch_array($checkCustomers, SQLSRV_FETCH_ASSOC);

        if ($row['ID_klienta'] != '') {
            $orderCustomerID = $row['ID_klienta'];
        } else {
                
            $tsql = "INSERT INTO klienci (Imie, Nazwisko, Telefon, Mail) VALUES ('$orderFirstName', '$orderLastName', '$orderPhone', '$orderMail')";
            $insertCustomer = sqlsrv_query($connection, $tsql);

            if (!$insertCustomer)
                throw new Exception;
            
            $tsql = "SELECT @@IDENTITY as ID_klienta";
            $insertCustomer = sqlsrv_query($connection, $tsql);
            $row = sqlsrv_fetch_array($insertCustomer, SQLSRV_FETCH_ASSOC);

            if (!$insertCustomer)
                throw new Exception;

            sqlsrv_free_stmt($insertCustomer);

            $orderCustomerID = $row['ID_klienta'];
        }

        sqlsrv_free_stmt($checkCustomers);

        $tsql = "INSERT INTO zlecenia (Klient, Data, Status, Sprzet, Opis, Uwagi, Notatka) 
                VALUES ('$orderCustomerID', '$orderDate', '$orderState', '$orderDevice', '$orderDescription', '$orderComment', '$orderNote')";

        $insertOrder = sqlsrv_query($connection, $tsql);

        if (!$insertOrder)
            throw new Exception;

        sqlsrv_free_stmt($insertOrder);

        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['confirmation'] = '<span class="error">Błąd dodania zlecenia</span>';
        header('Location: menu.php');
    }


    unset($_SESSION['remember_orderDateYear']);
    unset($_SESSION['remember_orderDateMonth']);
    unset($_SESSION['remember_orderDateDay']);
    unset($_SESSION['remember_orderState']);
    unset($_SESSION['remember_orderFirstName']);
    unset($_SESSION['remember_orderLastName']);
    unset($_SESSION['remember_orderPhone']);
    unset($_SESSION['remember_orderMail']);
    unset($_SESSION['remember_orderDevice']);
    unset($_SESSION['remember_orderDescription']);
    unset($_SESSION['remember_orderComment']);
    unset($_SESSION['remember_orderNote']);

    $_SESSION['confirmation'] = "Dodano zlecenie";
    header('Location: menu.php');
?>