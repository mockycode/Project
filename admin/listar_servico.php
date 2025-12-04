<?php
include '../conexao.php';
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/app/src/pages/form.html');
        exit();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/app/src/assets/styles/admin.css">
</head>
<body>
        <section class="admin">
        <?php include '../includes/menu-left.php'; ?>

        <div class="rigth">
            <h1>Olá, Administrador!</h1>
            <div class="produtos-container">
    <a class="btn-novo" href="cadastrar_servico.php">Novo Produto</a>

    <?php 
        $result = $conn->query("SELECT * FROM servicos");

        while ($row = $result->fetch_assoc()) { ?>
            
            <div class="produto-card">
                
                <div class="produto-img">
                    <img src="../uploads/<?= $row['imagem'] ?>" alt="Imagem do produto">
                </div>

                <div class="produto-info">
                    <h3><?= $row['nome'] ?></h3>
                    <p class="descricao"><?= $row['descricao'] ?></p>
                    <p class="preco">R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>

                    <div class="botoes">
                        <a class="btn editar" href="editar_servico.php?id=<?= $row['id_servico'] ?>">Editar</a>
                        <a class="btn excluir" href="excluir_servico.php?id=<?= $row['id_servico'] ?>">Excluir</a>
                    </div>
                </div>

            </div>

    <?php } ?>
</div>
        </div>
    </section>
</body>
</html>