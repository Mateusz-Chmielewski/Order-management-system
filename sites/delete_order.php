<?php
    session_start();

    require_once '../login/check_is_logged.php';

    try {
        require_once '../connection/connection.php';
        $connection = openConnection();
        $ID = $_GET['ID'];
        $tsql = "DELETE FROM zlecenia WHERE ID_zlecenia='$ID'";
        $deleteOrder = sqlsrv_query($connection, $tsql);

        if (!$deleteOrder)
            throw new Exception;
                
        sqlsrv_free_stmt($deleteOrder);
        
        sqlsrv_close($connection);
    } catch (Exception $e) {
        $_SESSION['confirmation'] = '<span class="error">Błąd usuwania zlecenia</span>';
        header('Location: menu.php');
        exit();
    }

    $_SESSION['confirmation'] = "Usunięto zlecenie";
    header('Location: menu.php');
?>