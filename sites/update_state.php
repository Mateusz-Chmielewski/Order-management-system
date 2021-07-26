<?php
    session_start();

    require_once '../login/check_is_logged.php';
    require_once '../connection/connection.php';

    $orderID = $_GET['ID'];
    $orderState = $_POST['orderState'];

    try {
        $connection = openConnection();

        $tsql = "UPDATE zlecenia SET Status='$orderState' WHERE ID_zlecenia='$orderID'";
        
        $updateState = sqlsrv_query($connection, $tsql);

        if (!$updateState)
            throw new Exception;

        sqlsrv_free_stmt($updateState);

        sqlsrv_close($connection);

    } catch (Exception $e) {
        $_SESSION['confirmation'] = '<span class="error">Błąd edytowania statusu zlecenia</span>';
        header('Location: menu.php');
        exit();
    }

    $_SESSION['confirmation'] = "Edytowano status zlecenia";
    header('Location: menu.php');
?>