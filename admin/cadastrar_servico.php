<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO servicos (nome, descricao, preco, categoria) VALUES ('$nome', '$descricao', '$preco', '$categoria')";
    $conn->query($sql);
    header("Location: listar_servicos.php");
    exit;
}
?>
<form method="post">
    <input type="text" name="nome" placeholder="Nome" required>
    <textarea name="descricao" placeholder="Descrição"></textarea>
    <input type="number" step="0.01" name="preco" placeholder="Preço" required>
    <input type="text" name="categoria" placeholder="Categoria">
    <button type="submit">Cadastrar</button>
</form>