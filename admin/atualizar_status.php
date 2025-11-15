<?php
include '../conexao.php';
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/src/pages/form.php');
        exit();
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pedido = $_POST['id_pedido'];
    $acao = $_POST['acao'];

    if ($acao === 'concluido') {
        $novoStatus = 'concluido';
        $statusPagamento = 'pago';
    } else {
        $novoStatus = 'cancelado';
        $statusPagamento = 'falhou';
    }

    $sqlPedido = "UPDATE pedidos SET status='$novoStatus' WHERE id_pedido='$id_pedido'";
    $conn->query($sqlPedido);

    header("Location: pedidos.php");
    exit;
}
?>