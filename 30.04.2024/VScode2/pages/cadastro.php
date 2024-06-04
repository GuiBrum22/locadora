<?php
// Inclua o arquivo de conexão com o banco de dados
include('includes/db.php');

ob_start();

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
    header("Location: includes/cadastro_sucesso.php");
    exit();
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Cadastro</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Cadastro</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <div class="cadastro-container">
            <h2>Cadastro</h2>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="cliente">Cliente</option>
                    <option value="funcionario">Funcionário</option>
                </select><br><br>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome"><br><br>
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome"><br><br>

                <div id="cliente-info" style="display: none;">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco"><br><br>
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade"><br><br>
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado"><br><br>
                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular"><br><br>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email"><br><br>
                </div>

                <div id="funcionario-info" style="display: none;">
                    <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo"><br><br>
                    <label for="data_contratacao">Data de Contratação:</label>
                    <input type="date" id="data_contratacao" name="data_contratacao"><br><br>
                    <label for="salario">Salário:</label>
                    <input type="text" id="salario" name="salario"><br><br>
                    </div>
                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Cadastro</p>
    </footer>

    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            if (this.value === 'cliente') {
                document.getElementById('cliente-info').style.display = 'block';
                document.getElementById('funcionario-info').style.display = 'none';
            } else if (this.value === 'funcionario') {
                document.getElementById('cliente-info').style.display = 'none';
                document.getElementById('funcionario-info').style.display = 'block';
            }
        });
    </script>
</body>
</html>