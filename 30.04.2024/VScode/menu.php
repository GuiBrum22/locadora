<?php
include 'functions.php';

$pdo = pdo_connect_pgsql();

// Verifica se a conexão foi estabelecida com sucesso
if (!$pdo) {
    echo "Erro ao conectar ao banco de dados.";
    exit();
}

// Obtém as carros do menu
$stmt = $pdo->query('SELECT * FROM menu');
$carros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se há carros para exibir
if (!$carros) {
    echo "Nenhum carro encontrado no menu.";
    exit();
}
?>

<?=template_header('Menu de Carros')?>

<style>
    /* Estilos para o botão de escolha */
    .btn-choose {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 8px;
    }

    .btn-choose:hover {
        background-color: #45a049;
        color: white;
    }
</style>

<div class="content menu">
    <h2>Menu de Carros</h2>
    <div class="carro">
        <?php foreach ($carros as $carro): ?>
            <div class="carro">
                <img src="<?=$carro['imagem_url']?>" alt="<?=$carro['nome']?>">
                <div class="details">
                    <h3><?=$carro['nome']?></h3>
                    <?php
                    // Debug: Verifica os ingredientes antes da conversão
                    echo "Ingredientes: " . $carro['ingredientes'] . "<br>";
                    $ingredientes = json_decode($carro['ingredientes'], true);
                    ?>
                    <p>Preço: R$ <?=$carro['preco']?></p>
                    <!-- Botão de escolha -->
                    <form action="create.php" method="post">
                        <input type="hidden" name="carro" value="<?=$carro['nome']?>">
                        <input type="submit" value="Escolher" class="btn-choose">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>
