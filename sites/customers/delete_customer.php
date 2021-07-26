<?php
    session_start();

    require_once '../../login/check_is_logged.php';

    try {
        require_once '../../connection/connection.php';
        $connection = openConnection();
        $ID = $_GET['ID'];
        $tsql = "DELETE FROM klienci WHERE ID_klienta='$ID'";
        $deleteCustomers = sqlsrv_query($connection, $tsql);

        if (!$deleteCustomers)
            throw new Exception;
                
        sqlsrv_free_stmt($deleteCustomers);
        
        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['confirmation'] = '<span class="error">Błąd usuwania klienta</span>';
        header('Location: show_customers.php');
        exit();
    }

    $_SESSION['confirmation'] = "Usunięto klienta";
    header('Location: show_customers.php');
?>