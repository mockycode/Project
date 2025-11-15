<?php
session_start();

    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/src/pages/form.php');
        exit();
    }
include '../conexao.php';


// Consulta todos os pedidos com seus detalhes
$sql = "
SELECT 
    p.id_pedido,
    u.nome AS cliente,
    u.email,
    s.nome AS servico,
    s.categoria,
    pi.preco_unitario,
    p.status AS status_pedido,
    pg.metodo_pagamento,
    pg.status_pagamento,
    p.data_pedido,
    p.valor_total
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id_usuario
JOIN pedido_itens pi ON pi.id_pedido = p.id_pedido
JOIN servicos s ON pi.id_servico = s.id_servico
LEFT JOIN pagamentos pg ON pg.id_pedido = p.id_pedido
ORDER BY p.data_pedido DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle de Pedidos</title>
    <style>
        body {
            background: #f5f5f5;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background: #222;
            color: white;
        }
        tr:nth-child(even) { background: #f9f9f9; }
        .btn-aprovar { background: #28a745; color: white; }
        .btn-cancelar { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <h1>Pedidos e Pagamentos</h1>
    <table>
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Serviço</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Status Pedido</th>
                <th>Método</th>
                <th>Status Pagamento</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id_pedido'] ?></td>
                <td><?= htmlspecialchars($row['cliente']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['servico']) ?></td>
                <td><?= htmlspecialchars($row['categoria']) ?></td>
                <td>R$ <?= number_format($row['preco_unitario'], 2, ',', '.') ?></td>
                <td><?= ucfirst($row['status_pedido']) ?></td>
                <td><?= strtoupper($row['metodo_pagamento']) ?></td>
                <td><?= ucfirst($row['status_pagamento']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($row['data_pedido'])) ?></td>
                <td>
                    <form method="POST" action="atualizar_status.php" style="display:inline;">
                        <input type="hidden" name="id_pedido" value="<?= $row['id_pedido'] ?>">
                        <button class="btn btn-aprovar" name="acao" value="concluido">✔</button>
                        <button class="btn btn-cancelar" name="acao" value="cancelado">✖</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>