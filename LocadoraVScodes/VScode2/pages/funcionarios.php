<?php
session_start(); // Inicia a sessão
include ('includes/db.php'); // Inclui o arquivo de conexão

// Verificar se o usuário atual é um funcionário
if (isset($_SESSION['Id_funcionario'])) {
    $id_funcionario = $_SESSION['Id_funcionario'];
    $sql = "SELECT * FROM Funcionario WHERE Id_funcionario = :id_funcionario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Exibir seção de funcionários
        ?>
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

            .tabs {
                display: flex;
                cursor: pointer;
                margin-bottom: 20px;
            }

            .tab {
                background: #333;
                color: #fff;
                padding: 10px 20px;
                margin-right: 10px;
                border-radius: 5px;
                transition: background 0.3s;
            }

            .tab:hover, .tab.active {
                background: #007bff;
            }

            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th, .table td {
                padding: 10px;
                border: 1px solid #fff;
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
        </style>

        <div class="container">
            <div class="tabs">
                <div class="tab active" onclick="showTab('funcionarios')">Funcionários</div>
                <div class="tab" onclick="showTab('alterar-veiculo')">Alterar Veículo</div>
                <div class="tab" onclick="showTab('ver-clientes')">Ver Clientes</div>
            </div>

            <div id="funcionarios" class="tab-content active">
                <h2>Funcionários</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Cargo</th>
                            <th>Data de Contratação</th>
                            <th>Salário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM Funcionario";
                        $result = $conn->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>{$row['Id_funcionario']}</td>
                                        <td>{$row['Nome']}</td>
                                        <td>{$row['Sobrenome']}</td>
                                        <td>{$row['Cargo']}</td>
                                        <td>{$row['Data_contratacao']}</td>
                                        <td>{$row['Salario']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Nenhum funcionário encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="alterar-veiculo" class="tab-content">
                <h2>Alterar Veículo</h2>
                <!-- Formulário ou interface para alterar informações do veículo -->
                <form method="post" action="alterar_veiculo.php">
                    <label for="veiculo-id">ID do Veículo:</label>
                    <input type="text" id="veiculo-id" name="veiculo-id" required><br>
                    <label for="veiculo-nome">Nome do Veículo:</label>
                    <input type="text" id="veiculo-nome" name="veiculo-nome" required><br>
                    <label for="veiculo-status">Status do Veículo:</label>
                    <input type="text" id="veiculo-status" name="veiculo-status" required><br>
                    <button type="submit" class="btn">Alterar Veículo</button>
                </form>
            </div>

            <div id="ver-clientes" class="tab-content">
                <h2>Clientes</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sobrenome</th>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Celular</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM Cliente";
                        $result = $conn->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>{$row['Id_cliente']}</td>
                                        <td>{$row['Sobrenome']}</td>
                                        <td>{$row['Nome']}</td>
                                        <td>{$row['Endereco']}</td>
                                        <td>{$row['Cidade']}</td>
                                        <td>{$row['Estado']}</td>
                                        <td>{$row['Celular']}</td>
                                        <td>{$row['Email']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Nenhum cliente encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            function showTab(tabId) {
                var tabs = document.querySelectorAll('.tab-content');
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });

                var buttons = document.querySelectorAll('.tab');
                buttons.forEach(function(button) {
                    button.classList.remove('active');
                });

                document.getElementById(tabId).classList.add('active');
                document.querySelector('[onclick="showTab(\'' + tabId + '\')"]').classList.add('active');
            }
        </script>
        <?php
    } else {
        // Exibir mensagem de acesso negado se o usuário não for funcionário
        echo "Acesso negado. Você não é um funcionário.";
    }
} else {
    echo "Sessão não iniciada. Por favor, faça login.";
}

$conn = null; // Fecha a conexão
?>
