<?php
include '../conexao.php';
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
<form method="post">
    <input type="text" name="nome" value="<?= $row['nome'] ?>" required>
    <textarea name="descricao"><?= $row['descricao'] ?></textarea>
    <input type="number" step="0.01" name="preco" value="<?= $row['preco'] ?>" required>
    <input type="text" name="categoria" value="<?= $row['categoria'] ?>">
    <button type="submit">Salvar</button>
</form>