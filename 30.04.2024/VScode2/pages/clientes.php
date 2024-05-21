<?php include('includes/db.php'); ?>
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

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
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
<?php $conn->close(); ?>
