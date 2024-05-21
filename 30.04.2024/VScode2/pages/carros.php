<?php include('includes/db.php'); ?>
<section id="carros">
    <h2>Carros Disponíveis</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Ano</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Carro WHERE Disponibilidade = true";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Id_carro']}</td>
                            <td>{$row['Modelo']}</td>
                            <td>{$row['Placa']}</td>
                            <td>{$row['Ano']}</td>
                            <td>{$row['Tipo']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum carro disponível.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>
<?php $conn->close(); ?>
