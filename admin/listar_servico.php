<?php
include '../conexao.php';
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/src/pages/form.php');
        exit();
    }

$result = $conn->query("SELECT * FROM servicos");
echo "<a href='cadastrar_servico.php'>Novo Serviço</a><hr>";

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>{$row['nome']} - R$ " . number_format($row['preco'], 2, ',', '.') . "</h3>";
    echo "<a href='editar_servico.php?id={$row['id_servico']}'>Editar</a> | ";
    echo "<a href='excluir_servico.php?id={$row['id_servico']}'>Excluir</a>";
    echo "</div><hr>";
}
?>