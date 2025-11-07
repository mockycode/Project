<?php
include '../conexao.php';
$id = $_GET['id'];

$conn->query("DELETE FROM servicos WHERE id_servico=$id");
header("Location: listar_servico.php");
exit;
?>