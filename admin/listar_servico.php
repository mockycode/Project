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
            <?php 
                $result = $conn->query("SELECT * FROM servicos");
                echo "<a href='cadastrar_servico.php'>Novo Produto</a><hr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "<h3>{$row['nome']} - R$ " . number_format($row['preco'], 2, ',', '.') . "</h3>";
                    echo "<a href='editar_servico.php?id={$row['id_servico']}'>Editar</a> | ";
                    echo "<a href='excluir_servico.php?id={$row['id_servico']}'>Excluir</a>";
                    echo "</div><hr>";
                }
            ?>
        </div>
    </section>
</body>
</html>