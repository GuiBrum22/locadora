<?php
session_start();
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type']; // cliente ou funcionario

    if ($user_type == 'cliente') {
        $sql = "SELECT * FROM Cliente WHERE Email = :email AND Senha = :password";
    } else {
        $sql = "SELECT * FROM Funcionario WHERE Email = :email AND Senha = :password";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $user['Id'];
        $_SESSION['user_type'] = $user_type;

        if ($user_type == 'cliente') {
            header('Location: index.php?page=clientes');
        } else {
            header('Location: index.php?page=funcionarios');
        }
        exit;
    } else {
        $error = "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <label for="user_type">Tipo de Usuário:</label>
            <select id="user_type" name="user_type">
                <option value="cliente">Cliente</option>
                <option value="funcionario">Funcionário</option>
            </select>

            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="index.php?page=cadastro">Cadastre-se</a></p>
    </div>
</body>
</html>
