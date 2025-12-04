<?php 
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/app/src/pages/form.html');
        exit();
    }
include '../conexao.php';
    $sqlUsers = "SELECT COUNT(*) AS total FROM usuarios";
$resultUsers = $conn->query($sqlUsers);
$totalUsuarios = $resultUsers->fetch_assoc()['total'];

$sqlTotalPedidos = "SELECT COUNT(*) AS total FROM pedidos";
$resultTotalPedidos = $conn->query($sqlTotalPedidos);
$totalPedidos = $resultTotalPedidos->fetch_assoc()['total'];

$sqlPendentes = "SELECT COUNT(*) AS pendentes FROM pedidos WHERE status = 'Em andamento'";
$resultPendentes = $conn->query($sqlPendentes);
$pedidosPendentes = $resultPendentes->fetch_assoc()['pendentes'];

$sqlTotalFaturado = "SELECT SUM(valor_total) AS faturado FROM pedidos WHERE status = 'pago'";
$resultFaturado = $conn->query($sqlTotalFaturado);
$totalFaturado = $resultFaturado->fetch_assoc()['faturado'] ?? 0;
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
            <h2 class="subtitle">Visão Geral do Sistema</h2>

    <div class="dashboard">

        <div class="dash-card">
            <h3>Total de Usuarios</h3>
            <p class="numero"><?php echo $totalUsuarios; ?></p>
        </div>

        <div class="dash-card">
            <h3>Total Pedidos</h3>
            <p class="numero"><?php echo $totalPedidos; ?></p>
        </div>

        <div class="dash-card">
            <h3>Pedidos Pendentes</h3>
            <p class="numero"><?php echo $pedidosPendentes; ?></p>
        </div>

        <div class="dash-card">
            <h3>Total Faturado</h3>
            <p class="numero">R$ <?php echo number_format($totalFaturado, 2, ',', '.'); ?></p>
        </div>

    </div>

    <div class="dashboard-2">
        <div class="dash-wide">
            <h3>Últimos Pedidos</h3>
            <p style="color:#ccc; margin-top:5px;">Você pode acessar a lista completa em "Pedidos".</p>
        </div>

        <div class="dash-wide">
            <h3>Atividades Recentes</h3>
            <p style="color:#ccc; margin-top:5px;">Atualizações de status, novos cadastros, etc.</p>
        </div>
    </div>
        </div>
    </section>
</body>
</html>