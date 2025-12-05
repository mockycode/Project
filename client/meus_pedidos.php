<?php
session_start();
include '../conexao.php';

if (!isset($_SESSION['tipo'])) {
    header("Location: ../public/app/src/pages/form.html");
    exit();
}

$userId = $_SESSION['usuario'];

$sql = "
    SELECT 
        p.id_pedido,
        p.valor_total,
        p.status,
        p.data_pedido
    FROM pedidos p
    WHERE p.id_usuario = ?
    ORDER BY p.data_pedido DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$pedidos = [];
while ($row = $result->fetch_assoc()) {
    $pedidos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cliente | Meus Pedidos</title>
    <link rel="shortcut icon" href="/project/public/app/src/src/assets/components/logo/logo-mockycode.svg" type="image/x-icon">
</head>
<body>
<section class="admin">
<?php include '../includes/menu-left-client.php'?>
<div class="rigth">
    <h1>Ola, Usuario!</h1>
    <h2>Meus Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <p>Você ainda não fez nenhum pedido.</p>

    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($pedidos as $p): ?>
                    <tr>
                        <td>#<?= $p['id_pedido'] ?></td>
                        <td>R$ <?= number_format($p['valor_total'], 2, ',', '.') ?></td>

                        <td>
                            <span class="status <?= $p['status'] ?>">
                                <?= ucfirst($p['status']) ?>
                            </span>
                        </td>

                        <td><?= date("d/m/Y H:i", strtotime($p['data_pedido'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</section>
</body>
</html>