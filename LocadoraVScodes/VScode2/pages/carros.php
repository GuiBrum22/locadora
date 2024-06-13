<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Carros Esportivos</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .car-card {
            background: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 20px;
            overflow: hidden;
            width: 300px;
            transition: transform 0.3s;
        }

        .car-card:hover {
            transform: scale(1.05);
        }

        .car-card img {
            width: 100%;
            height: auto;
        }

        .car-card-content {
            padding: 15px;
        }

        .car-card h3 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        .car-card p {
            margin: 0 0 5px;
        }

        .car-card .status {
            margin-top: 10px;
            font-weight: bold;
            color: #28a745;
        }

        .car-card .status.unavailable {
            color: #dc3545;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .reservation-form {
            margin-top: 10px;
            text-align: center;
        }

        .reservation-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        .reservation-form input[type="date"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .reservation-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s;
        }

        .reservation-form button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require 'includes/db.php'; // Supondo que isso inclua o arquivo com a função pdo_connect_pgsql()
        
        function getCarros($pdo)
        {
            $stmt = $pdo->query('SELECT * FROM Carro'); // Selecionar todos os carros
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $pdo = pdo_connect_pgsql(); // Supondo que isso estabeleça a conexão PDO corretamente
        $carros = getCarros($pdo);

        foreach ($carros as $carro) {
            $modelo = isset($carro['Modelo']) ? htmlspecialchars($carro['Modelo']) : '';
            $placa = isset($carro['Placa']) ? htmlspecialchars($carro['Placa']) : '';
            $ano = isset($carro['Ano']) ? htmlspecialchars($carro['Ano']) : '';
            $tipo = isset($carro['Tipo']) ? htmlspecialchars($carro['Tipo']) : '';
            $potencia = isset($carro['Potencia']) ? htmlspecialchars($carro['Potencia']) : '';
            $motor = isset($carro['Motor']) ? htmlspecialchars($carro['Motor']) : '';
            $imagem = isset($carro['Imagem']) ? htmlspecialchars($carro['Imagem']) : 'default.jpg';

            echo '<div class="car-card" onclick="toggleReservationForm(this)">';
            echo '<img src="' . $imagem . '" alt="' . $modelo . '">';
            echo '<div class="car-card-content">';
            echo '<h3>' . $modelo . '</h3>';
            echo '<p><strong>Placa:</strong> ' . $placa . '</p>';
            echo '<p><strong>Ano:</strong> ' . $ano . '</p>';
            echo '<p><strong>Tipo:</strong> ' . $tipo . '</p>';
            echo '<p><strong>Potência:</strong> ' . $potencia . '</p>';
            echo '<p><strong>Motor:</strong> ' . $motor . '</p>';
            echo '</div>';
            echo '<form class="reservation-form" style="display:none;" action="reservar.php" method="post">';
            echo '<input type="hidden" name="id_carro" value="' . (isset($carro['Id_carro']) ? htmlspecialchars($carro['Id_carro']) : '') . '">';
            echo '<label for="data">Data da Reserva:</label>';
            echo '<input type="date" name="data" required>';
            echo '<button type="submit" class="btn">Reservar</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>

    <script>
        function toggleReservationForm(element) {
            const form = element.querySelector('.reservation-form');
            const allForms = document.querySelectorAll('.reservation-form');
            allForms.forEach((f) => {
                if (f !== form) {
                    f.style.display = 'none';
                }
            });
            form.style.display = form.style.display === 'none' ? 'block' : 'none';

            // Adiciona um evento de clique no formulário para evitar que ele seja fechado ao clicar dentro dele
            form.addEventListener('click', (event) => {
                event.stopPropagation(); // Evita a propagação do evento de clique para o card
            });
        }
    </script>

</body>

</html>