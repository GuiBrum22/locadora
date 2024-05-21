<?php include('includes/db.php'); ?>
<section id="locacoes">
    <h2>Locações</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Cliente</th>
                <th>ID Carro</th>
                <th>Data de Início</th>
                <th>Data de Fim</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Locacao";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Id_locacao']}</td>
                            <td>{$row['Id_cliente']}</td>
                            <td>{$row['Id_carro']}</td>
                            <td>{$row['Data_inicio']}</td>
                            <td>{$row['Data_fim']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhuma locação encontrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>
<?php $conn->close(); ?>
