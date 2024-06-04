<?php
session_start(); // Inicia a sessão

include ('includes/db.php');

try {
    $conn = new PDO("pgsql:host=$localhost;dbname=$locadora", $postgres, $postgres);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

            <div class="container">
                <section id="funcionarios">
                    <h2>Funcionários</h2>
                    <table>
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
                </section>

                <!-- Exibir seção de clientes apenas para funcionários -->
                <section id="clientes">
                    <h2>Clientes</h2>
                    <table>
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
                </section>
            </div>
            <?php
        } else {
            // Exibir mensagem de acesso negado se o usuário não for funcionário
            echo "Acesso negado. Você não é um funcionário.";
        }
    } else {
        echo "Acesso negado. Sessão inválida.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null; // Fechar a conexão
?>
