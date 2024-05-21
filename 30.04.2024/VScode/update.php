<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';

// Verifica se o ID do contato existe
if (isset($_GET['id'])) {
    // Verifica se o formulário foi enviado
    if (!empty($_POST)) {
        // Obtém os dados do formulário
        $id_contato = isset($_POST['id_contato']) ? $_POST['id_contato'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $cel = isset($_POST['cel']) ? $_POST['cel'] : '';
        $carro = isset($_POST['carro']) ? $_POST['carro'] : '';
        $cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : date('Y-m-d H:i:s');
        
        // Atualiza o registro no banco de dados
        $stmt = $pdo->prepare('UPDATE contatos SET nome = ?, email = ?, cel = ?, carro = ?, cadastro = ? WHERE id_contato = ?');
        $stmt->execute([$nome, $email, $cel, $carro, $cadastro, $_GET['id']]);
        $msg = 'Atualização Realizada com Sucesso!';
        // Redireciona de volta para a página de visualização após a atualização
        header('Location: read.php');
        exit;
    }

    // Obtém os dados do contato para exibição no formulário
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id_contato = ?');
    $stmt->execute([$_GET['id']]);
    $contato = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o contato existe
    if (!$contato) {
        exit('Pedido Não Localizado!');
    }
} else {
    exit('Nenhum Pedido Especificado!');
}
?>

<?=template_header('Atualizar/Alterar Pedidos')?>

<div class="content update">
    <h2>Atualizar Contato - <?=$contato['id_contato']?></h2>
    <form action="update.php?id=<?=$contato['id_contato']?>" method="post">
        <input type="hidden" name="id_contato" value="<?=$contato['id_contato']?>">
        <label for="nome">Nome</label>
        <input type="text" name="nome" placeholder="Seu Nome" value="<?=$contato['nome']?>">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="seuemail@seuprovedor.com.br" value="<?=$contato['email']?>">
        <label for="cel">Celular</label>
        <input type="text" name="cel" placeholder="(XX) X.XXXX-XXXX" value="<?=$contato['cel']?>">
        <label for="carro">carro</label>
        <input type="text" name="carro" placeholder="Carro" value="<?=$contato['carro ']?>">
        <label for="cadastro">Data do Pedido</label>
        <input type="datetime-local" name="cadastro" value="<?=date('Y-m-d\TH:i', strtotime($contato['cadastro']))?>">
        <input type="submit" value="Atualizar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
