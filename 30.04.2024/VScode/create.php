<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';

if (!empty($_POST)) {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $cel = isset($_POST['cel']) ? $_POST['cel'] : '';
    $carro = isset($_POST['carro']) ? $_POST['carro'] : '';
    $cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : date('Y-m-d H:i:s');

    $stmt = $pdo->prepare('INSERT INTO contatos (nome, email, cel, carro, cadastro) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$nome, $email, $cel, $carro, $cadastro]);
    $msg = 'Pedido Realizado com Sucesso!';
}
?>

<?=template_header('Cadastro de Pedidos')?>

<div class="content update">
    <h2>Registrar Pedido</h2>
    <form action="create.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome" placeholder="Seu Nome">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="seuemail@seuprovedor.com.br">
        <label for="cel">Celular</label>
        <input type="text" name="cel" placeholder="(XX) X.XXXX-XXXX">
        <label for="carro">Carro</label>
        <input type="text" name="carro" placeholder="Carro">
        <label for="cadastro">Data do Pedido</label>
        <input type="datetime-local" name="cadastro" value="<?= date('Y-m-d\TH:i') ?>">
        <input type="submit" value="Criar">
    </form>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
