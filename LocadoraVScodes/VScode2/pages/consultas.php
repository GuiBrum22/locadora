<?php include('includes/db.php'); ?>
<section id="consultas">
    <h2>Consultas Específicas</h2>
    <h3>Clientes que alugaram um carro específico (ID do carro = 1)</h3>
    <table>
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nome</th>
                <th>Sobrenome</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT Cliente.Id_cliente, Cliente.Nome, Cliente.Sobrenome
                    FROM Cliente
                    JOIN Locacao ON Cliente.Id_cliente = Locacao.Id_cliente
                    WHERE Locacao.Id_carro = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Id_cliente']}</td>
                            <td>{$row['Nome']}</td>
                            <td>{$row['Sobrenome']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum cliente encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
    <h3>Carros alugados por um cliente específico (ID do cliente = 1)</h3>
    <table>
        <thead>
            <tr>
                <th>ID Carro</th>
                <th>Modelo</th>
                <th>Placa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT Carro.Id_carro, Carro.Modelo, Carro.Placa
                    FROM Carro
                    JOIN Locacao ON Carro.Id_carro = Locacao.Id_carro
                    WHERE Locacao.Id_cliente = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Id_carro']}</td>
                            <td>{$row['Modelo']}</td>
                            <td>{$row['Placa']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum carro encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Adicione mais consultas conforme necessário -->
</section>
<?php $conn->close(); ?>
