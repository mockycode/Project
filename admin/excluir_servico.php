<?php
include '../conexao.php';
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/src/pages/form.php');
        exit();
    }
$id = $_GET['id'];

$conn->query("DELETE FROM servicos WHERE id_servico=$id");
header("Location: listar_servico.php");
exit;
?>