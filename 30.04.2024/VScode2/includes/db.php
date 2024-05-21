<?php
// Verifica se a extensão PDO PostgreSQL está habilitada
if (!extension_loaded('pdo_pgsql')) {
    die('A extensão PDO PostgreSQL não está habilitada. Verifique a configuração do PHP.');
}

$DATABASE_HOST = 'localhost';
$DATABASE_PORT = '5432';
$DATABASE_USER = 'postgres';
$DATABASE_PASS = 'postgres';
$DATABASE_NAME = 'locadora';

try {
    // Cria a conexão ao banco de dados usando PDO
    $pdo = new PDO('pgsql:host=' . $DATABASE_HOST . ';port=' . $DATABASE_PORT . ';dbname=' . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
    // Define o modo de erro para Exception para que os erros sejam lançados e possam ser capturados.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Define o conjunto de caracteres para UTF-8
    $pdo->exec("SET NAMES 'UTF8'");
} catch (PDOException $exception) {
    // Log do erro ou exibição de mensagem mais detalhada.
    $errorDetails = 'Error details: ' . $exception->getMessage() . ' Code: ' . $exception->getCode();
    error_log('Failed to connect to database: ' . $errorDetails);
    exit ('Failed to connect to database. Check error log for details. Debug: ' . $errorDetails);
}

// Agora $pdo contém a conexão com o banco de dados PostgreSQL
?>
