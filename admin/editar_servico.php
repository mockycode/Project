<?php
include '../conexao.php';
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/app/src/pages/form.html');
        exit();
    }
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];

    $sql = "UPDATE servicos SET nome='$nome', descricao='$descricao', preco='$preco', categoria='$categoria' WHERE id_servico=$id";
    $conn->query($sql);
    header("Location: listar_servico.php");
    exit;
}

$result = $conn->query("SELECT * FROM servicos WHERE id_servico=$id");
$row = $result->fetch_assoc();
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

    <div class="form-card">
        <form method="post">

            <label>Nome do Produto</label>
            <input type="text" name="nome" value="<?= $row['nome'] ?>" required>

            <label>Descrição</label>
            <textarea name="descricao"><?= $row['descricao'] ?></textarea>

            <label>Preço</label>
            <input type="number" step="0.01" name="preco" value="<?= $row['preco'] ?>" required>

            <label>Categoria</label>
            <input type="text" name="categoria" value="<?= $row['categoria'] ?>">

            <button class="btn-submit" type="submit">Atualizar Produto</button>
        </form>
    </div>
</div>
    </section>
</body>
</html>