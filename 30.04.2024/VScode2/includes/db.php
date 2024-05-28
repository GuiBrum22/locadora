<?php
function pdo_connect_pgsql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_PORT = '5432';
    $DATABASE_USER = 'postgres';
    $DATABASE_PASS = 'postgres';
    $DATABASE_NAME = 'locadora';
    try {
        $pdo = new PDO('pgsql:host=' . $DATABASE_HOST . ';port=' . $DATABASE_PORT . ';dbname=' . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $exception) {
        $errorDetails = 'Error details: ' . $exception->getMessage() . ' Code: ' . $exception->getCode();
        error_log('Failed to connect to database: ' . $errorDetails);
        exit('Failed to connect to database. Check error log for details. Debug: ' . $errorDetails);
    }
}
?>
