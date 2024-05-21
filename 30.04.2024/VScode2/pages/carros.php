<?php
include('includes/db.php'); // Inclui o arquivo de conexão ao banco de dados

function getCarrosEsportivos($pdo) {
    $sql = 'SELECT * FROM Carro WHERE tipo = \'Esportivo\'';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isCarAvailable($pdo, $id_carro, $date) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM Reserva WHERE id_carro = ? AND data_reserva = ?');
    $stmt->execute([$id_carro, $date]);
    return $stmt->fetchColumn() == 0;
}

$carrosEsportivos = getCarrosEsportivos($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_carro = $_POST['id_carro'];
    $data_reserva = $_POST['data_reserva'];

    if (isCarAvailable($pdo, $id_carro, $data_reserva)) {
        $stmt = $pdo->prepare('INSERT INTO Reserva (id_carro, data_reserva) VALUES (?, ?)');
        $stmt->execute([$id_carro, $data_reserva]);
        $message = "Carro reservado com sucesso!";
    } else {
        $message = "Carro indisponível para a data selecionada.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Carros Esportivos</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .car-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .car-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .car-card .details {
            padding: 15px;
        }
        .car-card .details h3 {
            margin: 0 0 10px;
        }
        .car-card .details p {
            margin: 5px 0;
            color: #555;
        }
        .car-card .details .availability {
            color: green;
            font-weight: bold;
        }
        .car-card .details .unavailable {
            color: red;
            font-weight: bold;
        }
        .reservation-form {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($message)): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <?php if (count($carrosEsportivos) > 0): ?>
            <?php foreach ($carrosEsportivos as $carro): ?>
                <div class="car-card">
                    <img src="<?= htmlspecialchars($carro['imagem'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($carro['modelo'], ENT_QUOTES) ?>">
                    <div class="details">
                        <h3><?= htmlspecialchars($carro['modelo'], ENT_QUOTES) ?></h3>
                        <p><strong>Placa:</strong> <?= htmlspecialchars($carro['placa'], ENT_QUOTES) ?></p>
                        <p><strong>Ano:</strong> <?= htmlspecialchars($carro['ano'], ENT_QUOTES) ?></p>
                        <p><strong>Potência:</strong> <?= htmlspecialchars($carro['potencia'], ENT_QUOTES) ?></p>
                        <p><strong>Motor:</strong> <?= htmlspecialchars($carro['motor'], ENT_QUOTES) ?></p>
                        <form class="reservation-form" method="post">
                            <input type="hidden" name="id_carro" value="<?= htmlspecialchars($carro['id_carro'], ENT_QUOTES) ?>">
                            <label for="data_reserva">Data da Reserva:</label>
                            <input type="date" name="data_reserva" required>
                            <button type="submit">Reservar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum carro esportivo disponível.</p>
        <?php endif; ?>
    </div>
</body>
</html>
