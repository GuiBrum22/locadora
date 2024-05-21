<?php include('includes/db.php'); ?>
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

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
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
<?php $conn->close(); ?>
