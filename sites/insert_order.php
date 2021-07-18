<?php
    session_start();

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

    // require_once '../../connection/connection.php';

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


    // header('Location: menu.php');
?>