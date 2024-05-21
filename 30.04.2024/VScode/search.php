<?php
include 'functions.php';

$pdo = pdo_connect_pgsql();

$msg = '';
$carros = [];

// Verifica se o termo de pesquisa foi enviado via POST
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    // Verifica se o termo de pesquisa não está vazio
    if (!empty($search)) {
        // Busca carros no menu com base no termo de pesquisa
        $stmt = $pdo->prepare('SELECT * FROM menu WHERE nome LIKE :search');
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        $carros = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!$carros) {
            $msg = 'Nenhum carro encontrado.';
        }
    } else {
        // Se a pesquisa estiver vazia, exibe todos os carros
        $stmt = $pdo->query('SELECT * FROM menu');
        $carros = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!$carros) {
            $msg = 'Nenhum carro encontrado no menu.';
        }
    }
}
?>

<?=template_header('Pesquisar Carro')?>

<div class="content search">
    <h2>Pesquisar carro</h2>
    <form action="search.php" method="post">
        <input type="text" name="search" placeholder="Digite o nome da carro">
        <input type="submit" value="Pesquisar">
    </form>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
    <div class="carro">
        <?php foreach ($carros as $carro): ?>
            <div class="carro">
                <img src="<?=$carro->imagem_url?>" alt="<?=carro->nome?>">
                <div class="details">
                    <h3><?=$carro->nome?></h3>
                    <p>Ingredientes: <?=$carro->potencia?></p>
                    <p>Preço: R$ <?=$carro->preco?></p>
                    <!-- Botão de escolha -->
                    <form action="create.php" method="post">
                        <input type="hidden" name="nome" value="<?=carro->nome?>">
                        <input type="submit" value="Escolher" style="background-color: green;">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>
