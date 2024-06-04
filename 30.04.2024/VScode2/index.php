<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Veículos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'home':
                    include('pages/home.php');
                    break;
                case 'carros':
                    include('pages/carros.php');
                    break;
                case 'clientes':
                    include('pages/clientes.php');
                    break;
                case 'funcionarios':
                    include('pages/funcionarios.php');
                    break;
                case 'locacoes':
                    include('pages/locacoes.php');
                    break;
                case 'consultas':
                    include('pages/consultas.php');
                    break;
                case 'contato':
                    include('pages/contato.php');
                    break;
                case 'login':
                    include('pages/login.php');
                    break;
                case 'cadastro':
                    include('pages/cadastro.php');
                    break;
                default:
                    include('pages/home.php');
            }
        } else {
            include('pages/home.php');
        }
        ?>
    </main>

    <?php include('includes/footer.php'); ?>
</body>
</html>
