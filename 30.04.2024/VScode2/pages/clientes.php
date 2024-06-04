<?php
include('includes/db.php');

$conn = pdo_connect_pgsql();

$sql = "SELECT * FROM Cliente";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

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
            <?php if ($stmt->rowCount() > 0) { ?>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?= isset($row['id'])? $row['id'] : ''?></td>
                        <td><?= isset($row['sobrenome'])? $row['sobrenome'] : ''?></td>
                        <td><?= isset($row['nome'])? $row['nome'] : ''?></td>
                        <td><?= isset($row['endereco'])? $row['endereco'] : ''?></td>
                        <td><?= isset($row['cidade'])? $row['cidade'] : ''?></td>
                        <td><?= isset($row['estado'])? $row['estado'] : ''?></td>
                        <td><?= isset($row['celular'])? $row['celular'] : ''?></td>
                        <td><?= isset($row['email'])? $row['email'] : ''?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr><td colspan="8">Nenhum cliente encontrado.</td></tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php $conn = null; // Release the connection ?>