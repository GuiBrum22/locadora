<?php
function pdo_connect_pgsql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_PORT = '5432';
    $DATABASE_USER = 'postgres';
    $DATABASE_PASS = 'postgres';
    $DATABASE_NAME = 'carrosBrum';
    try {
        $pdo = new PDO('pgsql:host=' . $DATABASE_HOST . ';port=' . $DATABASE_PORT . ';dbname=' . $DATABASE_NAME . ';user=' . $DATABASE_USER . ';password=' . $DATABASE_PASS);
        // Define o modo de erro para Exception para que os erros sejam lançados e possam ser capturados.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $exception) {
        // Log do erro ou exibição de mensagem mais detalhada.
        $errorDetails = 'Error details: ' . $exception->getMessage() . ' Code: ' . $exception->getCode();
        error_log('Failed to connect to database: ' . $errorDetails);
        exit ('Failed to connect to database. Check error log for details. Debug: ' . $errorDetails);
    }
}

function getPedidosDetalhesCliente() {
    $pdo = pdo_connect_pgsql();
    $stmt = $pdo->query('SELECT c.nome AS cliente, p.id_pedido, p.data_pedido, p.valor_total FROM pedidos p INNER JOIN clientes c ON p.id_cliente = c.id_cliente');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function template_header($title)
{
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Pedidos - Carros Brum</h1>
            <a href="index.php"><i class="fas fa-home"></i>Inicio</a>
    		<a href="read.php"><i class="fas fa-shopping-basket"></i>Pedidos</a>
            <a href="search.php">Pesquisar Carros</a>
            <a href="menu.php">Menu</a>

    	</div>
    </nav>
EOT;
}
function template_footer()
{
    echo <<<EOT
    </body>
</html>
EOT;
}
?>