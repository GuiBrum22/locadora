<?php
// Inclua o arquivo de conexão com o banco de dados
include('includes/db.php');

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os dados do formulário
    $tipo = $_POST["tipo"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $endereco = $_POST["endereco"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $celular = $_POST["celular"];
    $email = $_POST["email"];

    // Verifique se é um cliente ou funcionário
    if ($tipo == 'cliente') {
        // Insira os dados na tabela de Clientes
        $sql = "INSERT INTO Cliente (Sobrenome, Nome, Endereco, Cidade, Estado, Celular, Email)
                VALUES ('$sobrenome', '$nome', '$endereco', '$cidade', '$estado', '$celular', '$email')";
        $conn->exec($sql);
    } elseif ($tipo == 'funcionario') {
        // Receba os dados adicionais para funcionários
        $cargo = $_POST["cargo"];
        $data_contratacao = $_POST["data_contratacao"];
        $salario = $_POST["salario"];

        // Insira os dados na tabela de Funcionários
        $sql = "INSERT INTO Funcionario (Nome, Sobrenome, Cargo, Data_contratacao, Salario)
                VALUES ('$nome', '$sobrenome', '$cargo', '$data_contratacao', '$salario')";
        $conn->exec($sql);
    }

    // Redirecione para uma página de sucesso ou outra página após o cadastro
    header("Location: cadastro_sucesso.php");
    exit();
}
?>